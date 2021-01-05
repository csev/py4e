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

$CFG->youtube_url = $CFG->apphome . '/mod/youtube/';

$CFG->tdiscus = $CFG->apphome . '/mod/tdiscus/';

$CFG->launcherror = $CFG->apphome . "/launcherror";

$buildmenu = $CFG->dirroot.'/../buildmenu.php';
if ( file_exists($buildmenu) ) {
    require_once $buildmenu;
    $CFG->defaultmenu = buildMenu();
}

