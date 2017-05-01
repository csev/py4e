<?php

require_once("tsugi/vendor/autoload.php");

$app = new \Silex\Application();
// $app['debug'] = true;

$app->error(function (\Exception $e, $code) use ($app) {
    global $CFG, $OUTPUT, $USER, $CONTEXT, $LINK, $RESULT;
    include("top.php");
    include("nav.php");
?>
<div>
<p>You have accessed a page which does not exist.
</p>
</div>
<?php
    include("footer.php");
    return "";
});

$app->get('/materials', function () {
    global $CFG, $OUTPUT, $USER, $CONTEXT, $LINK, $RESULT;
    require_once('materials.php');
    return "";
});

$app->get('/book', function () {
    global $CFG, $OUTPUT, $USER, $CONTEXT, $LINK, $RESULT;
    require_once('book.php');
    return "";
});

$app->get('/install', function () {
    global $CFG, $OUTPUT, $USER, $CONTEXT, $LINK, $RESULT;
    require_once('install.php');
    return "";
});

$app->run();
