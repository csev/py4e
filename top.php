<?php
use \Tsugi\Core\LTIX;

define('COOKIE_SESSION', true);
require_once "tsugi/config.php";
$LAUNCH = LTIX::session_start();

// https://lefkomedia.com/adding-external-link-indicator-with-css/
$head = '
<style>
a[target="_blank"]:after {
    font-family: "FontAwesome";
    content: " \f08e";
}
.goog-te-banner-frame.skiptranslate {
    display: none !important;
    } 
body {
    top: 0px !important; 
    }
</style>';

$OUTPUT->setAppHeader($head);
$OUTPUT->header();
