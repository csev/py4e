<?php
use \Tsugi\Util\U;

$error = U::get($_REQUEST, 'detail');

// Adjust / internationalize
if ( strpos($error,"Session expired - please re-launch") === 0 ||
    strpos($error,"Session has expired") === 0 ) {

    $error = __('Your session has expired');
}

$_SESSION['error'] = $error;

header("Location: ".addSession($CFG->apphome));
