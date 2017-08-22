<?php

require_once('../config.php');

// Make PHP paths pretty .../install => install.php
$router = new Tsugi\Util\FileRouter();
$file = $router->fileCheck();
if ( $file ) {
    require_once($file);
    return;
}

// Make a Tsugi Application
$launch = \Tsugi\Core\LTIX::requireData();
$app = new \Tsugi\Silex\Application($launch);

// Add some routes
\Tsugi\Controllers\Analytics::routes($app);

$app->run();
