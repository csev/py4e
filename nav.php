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

if ( $CFG->requireVhostVariant('nav.php') ) {
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
