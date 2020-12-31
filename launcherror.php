<?php
use \Tsugi\Util\U;

$error = U::get($_REQUEST, 'detail');

$_SESSION['error'] = $error;

header("Location: ".addSession($CFG->apphome));
