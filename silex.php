<?php

define('COOKIE_SESSION', true);
require_once "tsugi/config.php";

use \Tsugi\Core\LTIX;

$launch = LTIX::session_start();
$app = new \Tsugi\Silex\Application($launch);
$app['tsugi']->output->buffer = false;
$app['debug'] = true;

// TODO: Deal with Twig Errors
$app->error(function (\Exception $e, $code) use ($app) {
    global $CFG, $LAUNCH, $OUTPUT, $USER, $CONTEXT, $LINK, $RESULT;
    include("top.php");
    include("nav.php");
?>
<div>
<p>You have accessed a page which does not exist.
<pre>
<?php var_dump($code); ?>
</pre>
</p>
</div>
<?php
    include("footer.php");
    return "";
});

// Hook up the Koseu and Tsugi tools
\Tsugi\Controllers\Login::routes($app);
\Tsugi\Controllers\Logout::routes($app);
\Koseu\Controllers\Map::routes($app);
\Koseu\Controllers\Badges::routes($app);
\Koseu\Controllers\Assignments::routes($app);
\Koseu\Controllers\Lessons::routes($app);

$app->get('/dump', function() use ($app) {
    global $OUTPUT;
    return $app['twig']->render('@Tsugi/Dump.twig',
        array('session' => $OUTPUT->safe_var_dump($_SESSION))
    );
});

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
