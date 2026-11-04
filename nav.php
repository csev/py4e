<?php

if ( ! defined('COOKIE_SESSION') ) {
    define('COOKIE_SESSION', true);
}

if ( ! isset($CFG) ) {
    require_once __DIR__ . '/tsugi/config.php';
}
if ( session_id() == "" ) {
    $LAUNCH = \Tsugi\Core\LTIX::session_start();
}

$OUTPUT->bodyStart();
$OUTPUT->topNav();
$OUTPUT->flashMessages();
