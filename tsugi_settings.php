<?php

/**
 * These are some configuration variables that are not secure / sensitive
 *
 * This file is included at the end of tsugi/config.php
 */

// This is how the system will refer to itself.
$CFG->servicename = 'PY4E';
$CFG->servicedesc = 'Python for Everybody';

// Default theme

$CFG->context_title = "Python for Everybody";
$CFG->tool_folders = array("admin", "../tools", "../mod", "tool");

$CFG->youtube_playlist = 'PLlRFEj9H3Oj7Bp8-DfGpfAfDBiblRfl5p';

$CFG->giftquizzes = $CFG->dirroot.'/../py4e-private/quiz';

$CFG->sessionlifetime = 18*60*60;  // 18 hours

$CFG->privacy_url = $CFG->apphome . '/privacy.php';

$CFG->lessons = $CFG->dirroot.'/../lessons.json';

$CFG->youtube_url = $CFG->apphome . '/mod/youtube/';
$CFG->tdiscus = $CFG->wwwroot . '/tool/tdiscus/';
$CFG->google_login_redirect = $CFG->apphome . "/login";

$CFG->setExtension('premium', array(
   'supporter_url' => $CFG->apphome . '/support',
   'price' => '$15.00 USD',
   'premium_months' => 12,
   'refund_policy' => 'There are no refunds.',
   'premium_provider' => 'stripe'
));

$CFG->top_menu_callback = function() {
    global $CFG;
    $buildmenu = $CFG->dirroot.'/../buildmenu.php';
    if ( ! file_exists($buildmenu) ) {
        return false;
    }
    require_once $buildmenu;
    return buildMenu();
};

