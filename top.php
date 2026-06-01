<?php
use \Tsugi\Core\LTIX;

require_once __DIR__ . '/site/site.php';

if ( ! isset($CFG) ) {
    if ( ! defined('COOKIE_SESSION') ) {
        define('COOKIE_SESSION', true);
    }
    require_once __DIR__ . '/tsugi/config.php';
    $LAUNCH = LTIX::session_start();
}

if ( vhost_require_variant('top.php') ) {
    return;
}

$OUTPUT->header();
?>
<style>
body {
    font-family: var(--font-family);
    font-size: 1.2rem;
    line-height: 1.93rem;
    color: var(--text);
    background-color: var(--background-color);
}
</style>
