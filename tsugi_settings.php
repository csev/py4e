<?php

/**
 * These are some configuration variables that are not secure / sensitive
 *
 * This file is included at the end of tsugi/config.php
 */

require_once __DIR__ . '/site/site.php';

// This is how the system will refer to itself.
$CFG->servicename = 'PY4E';
$CFG->servicedesc = 'OER materials for Python for Everybody textbook';

// Default theme

$CFG->context_title = "Python for Everybody";
$CFG->tool_folders = array("admin", "../tools", "../mod", "tool");

$CFG->lessons = $CFG->dirroot.'/../lessons-items.json';

$CFG->youtube_playlist = 'PLlRFEj9H3Oj7Bp8-DfGpfAfDBiblRfl5p';

$CFG->giftquizzes = $CFG->dirroot.'/../py4e-private/quiz';

$CFG->sessionlifetime = 18*60*60;  // 18 hours

if ( vhost_uses_vhost_urls() ) {
    vhost_apply_host_urls($CFG);
}

vhost_apply_variant_config($CFG);

$CFG->youtube_url = $CFG->apphome . '/mod/youtube/';
$CFG->tdiscus = $CFG->wwwroot . '/tool/tdiscus/';
$CFG->google_login_redirect = $CFG->apphome . "/login";
