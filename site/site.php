<?php
/**
 * Site-specific vhost configuration (PY4E). Copy site/vhost.php unchanged; edit this file per site.
 *
 * Subdomain vhosts (labs, ai, …): site-labs/, site-ai/, etc. — not here.
 *
 *   local.py4e.com      -> main / www view
 *   labs.local.py4e.com -> labs vhost (see site-labs/config.php)
 *   www.py4e.com / py4e.com (production www)
 *
 * Local dev: /etc/hosts + MAMP vhosts — see htdocs/apache/README.md (outside this repo).
 */

require_once __DIR__ . '/vhost.php';

/**
 * @return string[]
 */
function vhost_domain_suffixes() {
    return array('py4e.com');
}

/**
 * Map hostname vhost id -> on-disk variant folder (when id != folder name).
 *
 * @return array<string, string>
 */
function vhost_variant_directories() {
    return array(
        'ai' => 'site-ai',
        'labs' => 'site-labs',
    );
}
