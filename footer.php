<?php

if ( ! defined('COOKIE_SESSION') ) {
    define('COOKIE_SESSION', true);
}

if ( ! isset($CFG) ) {
    require_once __DIR__ . '/tsugi/config.php';
}

if ( $CFG->requireVhostVariant('footer.php') ) {
    return;
}

$foot = '
<p style="font-size: 0.875rem; color: #333; margin-top: 5em;">
Copyright Creative Commons Attribution 4.0 - Charles R. Severance
</p>';

$OUTPUT->setAppFooter($foot);
$OUTPUT->footer();
