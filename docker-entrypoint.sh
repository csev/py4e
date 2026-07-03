#!/usr/bin/env bash
#
# Entry point for the PY4E container.
#
#   1. Generate tsugi/config.php from environment variables (once).
#   2. Wait for the database to accept connections.
#   3. Run the Tsugi DB upgrade to create/patch tables.
#   4. Hand off to Apache (or whatever CMD was given).
#
set -euo pipefail

APP_ROOT="/var/www/html"
TSUGI_DIR="${APP_ROOT}/tsugi"
CONFIG_FILE="${TSUGI_DIR}/config.php"

# -----------------------------------------------------------------------------
# Configuration knobs (override via docker/compose environment)
# -----------------------------------------------------------------------------
: "${PY4E_APPHOME:=http://localhost:8080}"          # public URL of the site root
: "${PY4E_WWWROOT:=${PY4E_APPHOME}/tsugi}"           # public URL of the tsugi mount
: "${PY4E_DB_HOST:=db}"
: "${PY4E_DB_PORT:=3306}"
: "${PY4E_DB_NAME:=tsugi}"
: "${PY4E_DB_USER:=ltiuser}"
: "${PY4E_DB_PASS:=ltipassword}"
: "${PY4E_ADMIN_PW:=admin}"
: "${PY4E_DB_PDO:=mysql:host=${PY4E_DB_HOST};port=${PY4E_DB_PORT};dbname=${PY4E_DB_NAME}}"
: "${PY4E_RUN_UPGRADE:=true}"                        # set false to skip DB upgrade on boot

# -----------------------------------------------------------------------------
# 1. Generate tsugi/config.php
# -----------------------------------------------------------------------------
# We start from Tsugi's shipped config-dist.php (which constructs $CFG) and then
# append env-driven overrides plus py4e's tsugi_settings.php. Appending is
# resilient to Tsugi version changes because the last assignment wins.
if [ ! -f "${CONFIG_FILE}" ]; then
    echo "[py4e] Generating ${CONFIG_FILE} from config-dist.php ..."
    cp "${TSUGI_DIR}/config-dist.php" "${CONFIG_FILE}"

    cat >> "${CONFIG_FILE}" <<'PHP'

/* ----------------------------------------------------------------------------
 * Docker environment overrides (appended by docker-entrypoint.sh).
 * Reads configuration from environment variables so the same image works on
 * localhost and on a VPS (e.g. Dokploy) without editing files.
 * ------------------------------------------------------------------------- */
$__env = function ($k, $d = null) { $v = getenv($k); return ($v === false || $v === '') ? $d : $v; };

$CFG->wwwroot    = $__env('PY4E_WWWROOT', $CFG->wwwroot);
$CFG->apphome    = $__env('PY4E_APPHOME', $CFG->wwwroot);

// Tsugi's static assets (bootstrap, jquery, css, ...) are NOT in the tsugi repo;
// they are served from the CDN by default. Override PY4E_STATICROOT to point at
// a self-hosted copy of the tsugi-static repo if you don't want the CDN.
$CFG->staticroot = $__env('PY4E_STATICROOT', 'https://static.tsugi.org');

// Build the PDO string from the individual host/port/name vars that compose
// passes to this container (PY4E_DB_PDO can still override the whole string).
$__db_host = $__env('PY4E_DB_HOST', 'db');
$__db_port = $__env('PY4E_DB_PORT', '3306');
$__db_name = $__env('PY4E_DB_NAME', 'tsugi');
$CFG->pdo    = $__env('PY4E_DB_PDO', "mysql:host={$__db_host};port={$__db_port};dbname={$__db_name}");
$CFG->dbuser = $__env('PY4E_DB_USER', $CFG->dbuser);
$CFG->dbpass = $__env('PY4E_DB_PASS', $CFG->dbpass);

$CFG->adminpw = $__env('PY4E_ADMIN_PW', $CFG->adminpw);

// Optional Google login / Maps integration.
if ($__env('PY4E_GOOGLE_CLIENT_ID'))     $CFG->google_client_id     = $__env('PY4E_GOOGLE_CLIENT_ID');
if ($__env('PY4E_GOOGLE_CLIENT_SECRET')) $CFG->google_client_secret = $__env('PY4E_GOOGLE_CLIENT_SECRET');
if ($__env('PY4E_GOOGLE_MAP_API_KEY'))   $CFG->google_map_api_key   = $__env('PY4E_GOOGLE_MAP_API_KEY');

$CFG->tool_folders  = array("admin", "../tools", "../mod");
$CFG->install_folder = $CFG->dirroot.'/../mod';

// py4e's non-secret settings (servicename, menu callback, vhost config, ...).
if (is_readable(__DIR__.'/../tsugi_settings.php')) {
    require_once __DIR__.'/../tsugi_settings.php';
}
PHP
    chown www-data:www-data "${CONFIG_FILE}"
else
    echo "[py4e] Using existing ${CONFIG_FILE}"
fi

# -----------------------------------------------------------------------------
# 2. Wait for the database
# -----------------------------------------------------------------------------
echo "[py4e] Waiting for database at ${PY4E_DB_HOST}:${PY4E_DB_PORT} ..."
for i in $(seq 1 60); do
    if php -r '
        $c = @new mysqli(getenv("PY4E_DB_HOST"), getenv("PY4E_DB_USER"),
                          getenv("PY4E_DB_PASS"), getenv("PY4E_DB_NAME"),
                          (int)getenv("PY4E_DB_PORT"));
        exit($c && !$c->connect_errno ? 0 : 1);
    ' 2>/dev/null; then
        echo "[py4e] Database is up."
        break
    fi
    if [ "$i" -eq 60 ]; then
        echo "[py4e] WARNING: database not reachable after 60s; starting anyway." >&2
    fi
    sleep 1
done

# -----------------------------------------------------------------------------
# 3. Create / upgrade Tsugi tables
# -----------------------------------------------------------------------------
if [ "${PY4E_RUN_UPGRADE}" = "true" ]; then
    echo "[py4e] Running Tsugi database upgrade ..."
    # upgrade.php must be run from inside the admin/ folder (it resolves paths
    # relative to the current working directory).
    if ! ( cd "${TSUGI_DIR}/admin" && php upgrade.php ); then
        echo "[py4e] WARNING: DB upgrade returned non-zero; check config/DB." >&2
    fi
fi

echo "[py4e] Startup complete. Launching: $*"
exec "$@"
