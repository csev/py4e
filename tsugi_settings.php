<?php

/**
 * These are some configuration variables that are not secure / sensitive
 *
 * This file is included at the end of tsugi/config.php
 */

// This is how the system will refer to itself.
$CFG->servicename = 'PY4E';
$CFG->servicedesc = 'OER materials for Python for Everybody textbook';

// Theme Tsugi to your institutions colors. If not set, default colors will be used.
$CFG->theme = array(
    "primary" => "#284B6B", //default color for nav background, splash background, buttons, text of tool menu
    "secondary" => "#EEEEEE", // Nav text and nav item border color, background of tool menu
    "text" => "#111111", // Standard copy color
    "text-light" => "#5E5E5E", // A lighter version of the standard text color for elements like "small"
    "font-url" => "https://fonts.googleapis.com/css?family=Source+Sans+Pro", // Optional custom font url for using Google fonts
    "font-family" => "'Source Sans Pro', Corbel, Avenir, 'Lucida Grande', 'Lucida Sans', sans-serif", // Font family
    "font-size" => "14px", // This is the base font size used for body copy. Headers,etc. are scaled off this value
);

$CFG->context_title = "Python for Everybody";

$CFG->lessons = $CFG->dirroot.'/../lessons.json';
