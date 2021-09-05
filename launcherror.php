<?php
use \Tsugi\Util\U;

$error = U::get($_REQUEST, 'detail');

// Adjust / internationalize
if ( strpos($error,"Session expired - please re-launch") === 0 ||
    strpos($error,"Session has expired") === 0 ) {

    $error = __('Η συνεδρία σας έχει λήξει');
}

$_SESSION['error'] = $error;

header("Location: ".addSession($CFG->apphome));
