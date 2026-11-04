<?php
use \Tsugi\Core\LTIX;

if ( ! defined('COOKIE_SESSION') ) {
    define('COOKIE_SESSION', true);
}

if ( ! isset($CFG) ) {
    require_once __DIR__ . '/tsugi/config.php';
}
if ( session_id() == "" ) {
    $LAUNCH = LTIX::session_start();
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
