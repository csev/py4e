<?php

use \Tsugi\Core\LTIX;

define('COOKIE_SESSION', true);
require_once "tsugi/config.php";

$launch = LTIX::session_start();

require_once $CFG->dirroot."/../site/site.php";
$buildmenu = vhost_site_file('buildmenu.php');
if ( file_exists($buildmenu) ) {
    require_once $buildmenu;
    $CFG->defaultmenu = buildMenu();
    $OUTPUT->topNavSession($CFG->defaultmenu);
}

// Make PHP paths pretty .../install => install.php
$router = new Tsugi\Util\FileRouter();
$file = $router->fileCheck();
if ( $file ) {
    require_once($file);
    return;
}

// Pull in the Tsugi LMS Routes (/lessons, /map, /badges ...)
$app = new \Tsugi\Controllers\Tsugi($launch);
$app['debug'] = true;

$app->run();
