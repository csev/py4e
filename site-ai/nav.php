<?php

global $CFG, $OUTPUT;

require_once __DIR__ . '/buildmenu.php';

$OUTPUT->bodyStart();

$set = buildMenu();
$CFG->defaultmenu = $set;

$OUTPUT->topNavSession($set);
$OUTPUT->topNav();
$OUTPUT->flashMessages();
