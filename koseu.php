<?php

use \Tsugi\Core\LTIX;

define('COOKIE_SESSION', true);
require_once "tsugi/config.php";

$launch = LTIX::session_start();

// Handle rest style paths .../lessons => lessons.php
$router = new Tsugi\Util\FileRouter();
$file = $router->fileCheck();
if ( $file ) {
    require_once($file);
    return;
}

// Pull in the Koseu LMS
$app = new \Koseu\Core\Application($launch);
$app['debug'] = true;

$app->run();
