<?php

require_once('buildmenu.php');

$OUTPUT->bodyStart();

$set = buildMenu();
$CFG->defaultmenu = $set;

// Set the topNav for the session
$OUTPUT->topNavSession($set);

$OUTPUT->topNav();
$OUTPUT->flashMessages();
