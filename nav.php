<?php

require_once('buildmenu.php');

$OUTPUT->bodyStart();

$set = buildMenu();

// Set the topNav for the session
$OUTPUT->topNavSession($set);

$OUTPUT->topNav();
$OUTPUT->flashMessages();
