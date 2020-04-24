<?php
$OUTPUT->bodyStart();
$R = $CFG->apphome . '/';
$T = $CFG->wwwroot . '/';
$adminmenu = isset($_COOKIE['adminmenu']) && $_COOKIE['adminmenu'] == "true";
$set = new \Tsugi\UI\MenuSet();
$set->setHome($CFG->servicename, $CFG->apphome);
$set->addLeft('Get Started', $R.'install');
$set->addLeft('Lessons', $R.'lessons');
if ( isset($_SESSION['id']) ) {
    $set->addLeft('Assignments', $R.'assignments');
    // $set->addLeft('Discuss', $R.'group');
    // If both are set we go to discuss.php
    // if ( isset($CFG->disqushost) ) $set->addLeft('Discuss', $T.'discuss');
    // else if ( isset($CFG->disquschannel) ) $set->addLeft('Discuss', $CFG->disquschannel);
} else {
    $set->addLeft('OER', $R.'materials');
}

if ( isset($_SESSION['id']) ) {
    $submenu = new \Tsugi\UI\Menu();
    $submenu->addLink('Profile', $R.'profile');
    if ( isset($CFG->google_map_api_key) ) {
        $submenu->addLink('Map', $R.'map');
    }

    $submenu->addLink('Badges', $R.'badges');
    $submenu->addLink('Materials', $R.'materials');
    if ( $CFG->providekeys ) {
        $submenu->addLink('LMS Integration', $T . 'settings');
    }
    if ( isset($CFG->google_classroom_secret) ) {
        $submenu->addLink('Google Classroom', $T.'gclass/login');
    }
    $submenu->addLink('Free App Store', 'https://www.tsugicloud.org');
    $submenu->addLink('Rate this course', 'https://www.class-central.com/mooc/7363/python-for-everybody');
    $submenu->addLink('Privacy', $R.'privacy');
    if ( isset($_COOKIE['adminmenu']) && $_COOKIE['adminmenu'] == "true" ) {
        $submenu->addLink('Administer', $T . 'admin/');
    }
    $submenu->addLink('Logout', $R.'logout');

    if ( isset($_SESSION['avatar']) ) {
        $set->addRight('<img src="'.$_SESSION['avatar'].'" style="height: 2em;"/>', $submenu);
        // htmlentities($_SESSION['displayname']), $submenu);
    } else {
        $set->addRight(htmlentities($_SESSION['displayname']), $submenu);
    }
} else {
    $set->addRight('Login', $R.'login');
}

$imenu = new \Tsugi\UI\Menu();

$imenu->addLink('Instructor', 'http://www.dr-chuck.com');
$imenu->addLink('Office Hours', 'http://www.dr-chuck.com/office/');
$set->addRight('Book', $R . 'book');
$set->addRight('Instructor', $imenu);

// Set the topNav for the session
$OUTPUT->topNavSession($set);

$OUTPUT->topNav();
$OUTPUT->flashMessages();
