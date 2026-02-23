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

$CFG->lessons = $CFG->dirroot.'/../lessons.json';
$CFG->lessons = $CFG->dirroot.'/../lessons-items.json';
$CFG->setExtension('lessons2_enable', true);
$CFG->youtube_playlist = 'PLlRFEj9H3Oj7Bp8-DfGpfAfDBiblRfl5p';

$CFG->youtube_url = $CFG->apphome . '/mod/youtube/';

$CFG->tdiscus = $CFG->apphome . '/mod/tdiscus/';

$CFG->launcherror = $CFG->apphome . "/launcherror";

$CFG->giftquizzes = $CFG->dirroot.'/../py4e-private/quiz';

// $CFG->setExtension('lessons2_enable', true);

$buildmenu = $CFG->dirroot.'/../buildmenu.php';
if ( file_exists($buildmenu) ) {
    require_once $buildmenu;
    $CFG->defaultmenu = buildMenu();
}

