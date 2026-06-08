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

$CFG->giftquizzes = $CFG->dirroot.'/../py4e-private/quiz';

$CFG->sessionlifetime = 18*60*60;  // 18 hours

$CFG->setExtension('vhost', array(
    'suffixes' => array('py4e.com'),
    'site_root' => dirname($CFG->dirroot),
    'vhosts' => array(
        'www' => array(
            'apphomes' => array(
                'https://local.py4e.com',
                'https://www.py4e.com',
                'https://py4e.com',
            ),
        ),
        'ai' => array(
            'apphomes' => array(
                'https://ai.local.py4e.com',
                'https://ai.py4e.com',
            ),
            'dir' => 'site-ai',
        ),
        'labs' => array(
            'apphomes' => array(
                'https://labs.local.py4e.com',
                'https://labs.py4e.com',
            ),
            'dir' => 'site-labs',
        ),
    ),
));

if ( $CFG->vhostUsesVhostUrls() ) {
    $CFG->applyVhostHostUrls();
}

$CFG->applyVhostVariantConfig();

$CFG->youtube_url = $CFG->apphome . '/mod/youtube/';
$CFG->tdiscus = $CFG->wwwroot . '/tool/tdiscus/';
$CFG->google_login_redirect = $CFG->apphome . "/login";
