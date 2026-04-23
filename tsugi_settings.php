<?php

/**
 * These are some configuration variables that are not secure / sensitive
 *
 * This file is included at the end of tsugi/config.php
 */

// This is how the system will refer to itself.
$CFG->servicename = 'PY4E';
$CFG->servicedesc = 'OER materials for Python for Everybody textbook';

// Default theme

$CFG->context_title = "Python for Everybody";
$CFG->tool_folders = array("admin", "../tools", "../mod", "tool");

$CFG->lessons = $CFG->dirroot.'/../lessons-items.json';

$CFG->youtube_playlist = 'PLlRFEj9H3Oj7Bp8-DfGpfAfDBiblRfl5p';

$CFG->youtube_url = $CFG->apphome . '/mod/youtube/';

$CFG->tdiscus = $CFG->wwwroot . '/tool/tdiscus/';

$CFG->giftquizzes = $CFG->dirroot.'/../py4e-private/quiz';

$CFG->sessionlifetime = 18*60*60;  // 18 hours

$CFG->google_login_redirect = $CFG->apphome . "/login";

