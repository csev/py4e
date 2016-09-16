<?php
use \Tsugi\Core\LTIX;

define('COOKIE_SESSION', true);
require_once "tsugi/config.php";
$LAUNCH = LTIX::session_start();

$OUTPUT->header();
