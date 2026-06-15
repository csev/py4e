<?php

/**
 * Installation sanity checks for the PY4E home page only.
 *
 * Verifies that Tsugi is present, config.php exists, and the database is usable
 * before top.php starts a session and connects without friendly error messages.
 */

function py4e_sanity_die($title, $body_html) {
    error_log('PY4E sanity: '.$title);
    header('Content-Type: text/html; charset=utf-8');
    echo('<!DOCTYPE html><html lang="en"><head><meta charset="utf-8">'."\n");
    echo('<title>'.htmlspecialchars($title).'</title>'."\n");
    echo('<style>body{font-family:system-ui,sans-serif;line-height:1.5;max-width:48rem;margin:2rem auto;padding:0 1rem;}');
    echo('.alert-danger{color:#721c24;background:#f8d7da;border:1px solid #f5c6cb;padding:1rem;border-radius:.25rem;}');
    echo('pre{background:#f4f4f4;padding:.75rem;overflow:auto;}</style></head><body>'."\n");
    echo('<div class="alert-danger">'."\n");
    echo('<h1>'.htmlspecialchars($title).'</h1>'."\n");
    echo($body_html);
    echo("\n</div></body></html>\n");
    die();
}

$tsugi_dir = __DIR__ . '/tsugi';
$tsugi_url = 'tsugi/';

// Tsugi must be checked out as a subfolder of py4e
if ( ! is_dir($tsugi_dir) ) {
    py4e_sanity_die(
        'Tsugi is not installed',
        '<p>This copy of Python for Everybody expects a <code>tsugi</code> folder next to
        <code>index.php</code>, but that folder was not found.</p>
        <p>From your <code>py4e</code> directory, check out Tsugi:</p>
        <pre>cd py4e
git clone https://github.com/tsugiproject/tsugi.git tsugi</pre>
        <p>Then open <a href="'.htmlspecialchars($tsugi_url).'">'.htmlspecialchars($tsugi_url).'</a>
        and follow the setup instructions there.</p>
        <p>More detail: <a href="https://github.com/csev/py4e/blob/master/README.md"
        target="_blank" rel="noopener noreferrer">PY4E README</a></p>'
    );
}

$tsugi_markers = array(
    'config-dist.php',
    'lib/include/setup.php',
    'index.php',
);
$missing = array();
foreach ( $tsugi_markers as $marker ) {
    if ( ! is_readable($tsugi_dir . '/' . $marker) ) {
        $missing[] = $marker;
    }
}
if ( count($missing) > 0 ) {
    py4e_sanity_die(
        'Tsugi folder is incomplete',
        '<p>The <code>tsugi</code> folder exists but does not look like a complete Tsugi checkout.
        Missing: <code>'.htmlspecialchars(implode('</code>, <code>', $missing)).'</code></p>
        <p>From your <code>py4e</code> directory, refresh the Tsugi checkout:</p>
        <pre>cd py4e/tsugi
git pull
composer install</pre>
        <p>Or remove the folder and clone again:</p>
        <pre>cd py4e
rm -rf tsugi
git clone https://github.com/tsugiproject/tsugi.git tsugi
cd tsugi
composer install</pre>
        <p>Then visit <a href="'.htmlspecialchars($tsugi_url).'">'.htmlspecialchars($tsugi_url).'</a>
        to finish configuration.</p>'
    );
}

$config_file = $tsugi_dir . '/config.php';
if ( ! is_readable($config_file) ) {
    py4e_sanity_die(
        'Tsugi is not configured',
        '<p>Tsugi is present, but <code>tsugi/config.php</code> does not exist yet.</p>
        <p>Go to the Tsugi folder and create your configuration file:</p>
        <pre>cd py4e/tsugi
cp config-dist.php config.php</pre>
        <p>Edit <code>tsugi/config.php</code> and set at least:</p>
        <ul>
        <li><code>$CFG->pdo</code>, <code>$CFG->dbuser</code>, and <code>$CFG->dbpass</code></li>
        <li><code>$CFG->apphome</code> and <code>$wwwroot</code> for this site</li>
        <li><code>$CFG->adminpw</code></li>
        </ul>
        <p>Open <a href="'.htmlspecialchars($tsugi_url).'">'.htmlspecialchars($tsugi_url).'</a>
        for the Tsugi setup walkthrough, then refresh this page.</p>
        <p>Installation help: <a href="http://www.tsugi.org/" target="_blank" rel="noopener noreferrer">tsugi.org</a></p>'
    );
}

require_once $config_file;

if ( ! isset($CFG) ) {
    py4e_sanity_die(
        'Tsugi configuration error',
        '<p><code>tsugi/config.php</code> was loaded but did not create the <code>$CFG</code> object.</p>
        <p>Compare your file with <code>tsugi/config-dist.php</code> and fix any syntax errors.</p>
        <p>See <a href="'.htmlspecialchars($tsugi_url).'">'.htmlspecialchars($tsugi_url).'</a></p>'
    );
}

if ( strpos(__FILE__, ' ') !== false ) {
    py4e_sanity_die(
        'Invalid install path',
        '<p>Folder and file names in the install path must not contain spaces.</p>
        <p>Current file: <code>'.htmlspecialchars(__FILE__).'</code></p>'
    );
}

require_once $tsugi_dir . '/sanity-db.php';
