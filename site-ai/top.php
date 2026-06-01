<?php
use \Tsugi\Core\LTIX;

require_once __DIR__ . '/styles.php';

global $CFG, $OUTPUT, $LAUNCH;

if ( ! isset($CFG) ) {
    if ( ! defined('COOKIE_SESSION') ) {
        define('COOKIE_SESSION', true);
    }
    require_once dirname(__DIR__) . '/tsugi/config.php';
    $LAUNCH = LTIX::session_start();
} elseif ( ! isset($OUTPUT) ) {
    $LAUNCH = LTIX::session_start();
}

$OUTPUT->header();
ai_print_styles();
