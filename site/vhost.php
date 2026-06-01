<?php
/**
 * Hostname-based vhost helpers. Copy unchanged to each *4e site.
 *
 * Define vhost_domain_suffixes() in site/site.php (e.g. array('py4e.com')).
 *
 * Subdomain vhosts (labs, ai, …): put UI + config under a variant directory — usually
 * {id}/ (e.g. site-labs/config.php). Override the folder name in vhost_variant_directories()
 * in site/site.php (e.g. ai hostname -> site-ai/). Config function must be named
 * {id}_apply_vhost_config($CFG).
 *
 * Host patterns (per suffix example.com):
 *   {id}.example.com, {id}.local.example.com, {id}.localhost  (id != www)
 *   local.example.com (dev www), www.example.com / example.com (production www)
 *
 * Not part of Tsugi — each site includes site/site.php from tsugi_settings.php.
 */

function vhost_site_root() {
    static $root = null;
    if ( $root === null ) {
        $root = dirname(__DIR__);
    }
    return $root;
}

function vhost_request_host() {
    $host = strtolower($_SERVER['HTTP_HOST'] ?? '');
    if ( strpos($host, ':') !== false ) {
        $host = explode(':', $host, 2)[0];
    }
    return $host;
}

/**
 * Subdomain vhost id (e.g. labs, ai) or false on www / apex / path-based dev.
 *
 * @return string|false
 */
function vhost_id() {
    static $id = null;
    static $resolved = false;
    if ( $resolved ) {
        return $id;
    }
    $resolved = true;
    $id = false;

    $host = vhost_request_host();

    if ( preg_match('/^([a-z0-9-]+)\.localhost$/', $host, $m) && $m[1] !== 'www' ) {
        $id = $m[1];
        return $id;
    }

    foreach ( vhost_domain_suffixes() as $suffix ) {
        $quoted = preg_quote($suffix, '/');
        if ( preg_match('/^([a-z0-9-]+)\.' . $quoted . '$/', $host, $m) && $m[1] !== 'www' ) {
            $id = $m[1];
            return $id;
        }
        if ( preg_match('/^([a-z0-9-]+)\.local\.' . $quoted . '$/', $host, $m) ) {
            $id = $m[1];
            return $id;
        }
    }

    return $id;
}

/**
 * Filesystem directory for a vhost id (defaults to id; see vhost_variant_directories()).
 *
 * @param string|false|null $id vhost id, or null for current vhost_id()
 * @return string|false
 */
function vhost_variant_dir($id = null) {
    if ( $id === null ) {
        $id = vhost_id();
    }
    if ( ! $id ) {
        return false;
    }
    if ( function_exists('vhost_variant_directories') ) {
        $map = vhost_variant_directories();
        if ( isset($map[$id]) && is_string($map[$id]) && $map[$id] !== '' ) {
            return $map[$id];
        }
    }
    return $id;
}

function vhost_is_local_www_site() {
    static $is_local_www = null;
    if ( $is_local_www !== null ) {
        return $is_local_www;
    }

    $host = vhost_request_host();
    foreach ( vhost_domain_suffixes() as $suffix ) {
        if ( $host === 'local.' . $suffix ) {
            $is_local_www = true;
            return $is_local_www;
        }
    }

    $is_local_www = false;
    return $is_local_www;
}

function vhost_is_production_www_site() {
    static $is_prod_www = null;
    if ( $is_prod_www !== null ) {
        return $is_prod_www;
    }

    $host = vhost_request_host();
    foreach ( vhost_domain_suffixes() as $suffix ) {
        if ( $host === 'www.' . $suffix || $host === $suffix ) {
            $is_prod_www = true;
            return $is_prod_www;
        }
    }

    $is_prod_www = false;
    return $is_prod_www;
}

function vhost_uses_vhost_urls() {
    if ( vhost_id() ) {
        return true;
    }
    return vhost_is_local_www_site() || vhost_is_production_www_site();
}

/**
 * Path to a site file; prefers variant directory override when on a subdomain vhost.
 */
function vhost_site_file($filename) {
    $dir = vhost_variant_dir();
    if ( $dir ) {
        $variant_path = vhost_site_root() . '/' . $dir . '/' . $filename;
        if ( file_exists($variant_path) ) {
            return $variant_path;
        }
    }
    return vhost_site_root() . '/' . $filename;
}

/**
 * Require a PHP file from the active vhost variant directory (e.g. site-labs/home.php).
 */
function vhost_require_variant($filename) {
    $dir = vhost_variant_dir();
    if ( ! $dir ) {
        return false;
    }
    $path = vhost_site_root() . '/' . $dir . '/' . $filename;
    if ( ! is_readable($path) ) {
        return false;
    }
    require $path;
    return true;
}

/**
 * Load variant config.php and call {id}_apply_vhost_config($CFG) when on that vhost.
 */
function vhost_apply_variant_config($CFG) {
    $id = vhost_id();
    if ( ! $id ) {
        return;
    }
    $dir = vhost_variant_dir($id);
    if ( ! $dir ) {
        return;
    }
    $config = vhost_site_root() . '/' . $dir . '/config.php';
    if ( ! is_readable($config) ) {
        return;
    }
    require_once $config;
    $fn = $id . '_apply_vhost_config';
    if ( function_exists($fn) ) {
        $fn($CFG);
    }
}

function vhost_request_base_path() {
    static $base = null;
    if ( $base !== null ) {
        return $base;
    }

    $script = $_SERVER['SCRIPT_NAME'] ?? '';
    if ( preg_match('#^(/.+)/(tsugi|index)\.php$#', $script, $matches) ) {
        $base = $matches[1];
        return $base;
    }
    if ( strpos($script, '/tsugi/') !== false ) {
        $base = preg_replace('#/tsugi/.*#', '', $script);
        return $base;
    }

    $base = '';
    return $base;
}

function vhost_apply_host_urls($CFG) {
    if ( ! vhost_uses_vhost_urls() ) {
        return;
    }

    $host = vhost_request_host();
    $scheme = 'http';
    if ( ! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ) {
        $scheme = 'https';
    } elseif ( ! empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) {
        $scheme = 'https';
    }

    $base = vhost_request_base_path();
    $CFG->apphome = $scheme . '://' . $host . $base;
    $CFG->wwwroot = $CFG->apphome . '/tsugi';
}
