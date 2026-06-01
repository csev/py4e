<?php

require_once __DIR__ . '/site/site.php';

if ( ! isset($CFG) ) {
    if ( ! defined('COOKIE_SESSION') ) {
        define('COOKIE_SESSION', true);
    }
    require_once __DIR__ . '/tsugi/config.php';
    \Tsugi\Core\LTIX::session_start();
}

if ( vhost_require_variant('nav.php') ) {
    return;
}

require_once('buildmenu.php');

$OUTPUT->bodyStart();

$set = buildMenu();
$CFG->defaultmenu = $set;

// Set the topNav for the session
$OUTPUT->topNavSession($set);

$OUTPUT->topNav();
$OUTPUT->flashMessages();
