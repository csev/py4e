<?php

define('COOKIE_SESSION', true);
require_once "tsugi/config.php";

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use \Tsugi\Core\LTIX;

$launch = LTIX::session_start();
$app = new \Tsugi\Silex\Application($launch);
$app['tsugi']->output->buffer = false;
$app['debug'] = true;

$app->error(function (NotFoundHttpException $e, Request $request, $code) use ($app) {
    global $CFG, $LAUNCH, $OUTPUT, $USER, $CONTEXT, $LINK, $RESULT;

    $P7 = strpos(phpversion(), '7') === 0;

    if ( $P7 ) {
        return $app['twig']->render('@Tsugi/Error.twig',
            array('error' => '<p>Page not found.</p>')
        );
    } else {
        include("top.php");
        include("nav.php");
        echo("<h2>Page not found.</h2>\n");
        include("footer.php");
        return "";
    }
});

$P7 = strpos(phpversion(), '7') === 0;

// Hook up the Koseu and Tsugi tools
if ( $P7 ) {
    \Tsugi\Controllers\Login::routes($app);
    \Tsugi\Controllers\Logout::routes($app);
    \Tsugi\Controllers\Profile::routes($app);
    \Tsugi\Controllers\Map::routes($app);
    \Koseu\Controllers\Badges::routes($app);
    \Koseu\Controllers\Assignments::routes($app);
    \Koseu\Controllers\Lessons::routes($app);

    $app->get('/dump', function() use ($app) {
        global $OUTPUT;
        return $app['twig']->render('@Tsugi/Dump.twig',
            array('session' => $OUTPUT->safe_var_dump($_SESSION))
        );
    });
}

$app->get('/materials', function () {
    global $CFG, $LAUNCH, $OUTPUT, $USER, $CONTEXT, $LINK, $RESULT;
    require_once('materials.php');
    return "";
});

$app->get('/book', function () {
    global $CFG, $LAUNCH, $OUTPUT, $USER, $CONTEXT, $LINK, $RESULT;
    require_once('book.php');
    return "";
});

$app->get('/install', function () {
    global $CFG, $LAUNCH, $OUTPUT, $USER, $CONTEXT, $LINK, $RESULT;
    require_once('install.php');
    return "";
});

$app->run();
