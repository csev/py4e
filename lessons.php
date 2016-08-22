<?php
use \Tsugi\Util\LTI;
use \Tsugi\Core\LTIX;
use \Tsugi\UI\Lessons;

require_once "top.php";
$lessons = new Lessons();
$lessons->header();
require_once "nav.php";

echo('<div id="container">'."\n");

$OUTPUT->flashMessages();

$lessons->render();

echo('</div> <!-- container -->'."\n");

$OUTPUT->footerStart();
$lessons->footer();
$OUTPUT->footerend();
