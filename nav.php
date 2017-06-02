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
    // If both are set we go to discuss.php
    if ( isset($CFG->disqushost) ) $set->addLeft('Discuss', $T.'discuss');
    else if ( isset($CFG->disquschannel) ) $set->addLeft('Discuss', $CFG->disquschannel);
} else {
    $set->addLeft('Materials', $R.'materials');
}

if ( isset($_SESSION['id']) ) {
    $submenu = new \Tsugi\UI\Menu();
    $submenu->addLink('Profile', $R.'profile');
    if ( isset($CFG->google_map_api_key) ) {
        $submenu->addLink('Map', $R.'map');
    }

    $submenu->addLink('Badges', $R.'badges');
    $submenu->addLink('Materials', $R.'materials');
    if ( $CFG->DEVELOPER ) {
        $submenu->addLink('Test LTI Tools', $T . 'dev');
    }
    if ( $CFG->providekeys ) {
        $submenu->addLink('LMS Integration', $T . 'admin/key/index');
    }
    if ( isset($_COOKIE['adminmenu']) && $_COOKIE['adminmenu'] == "true" ) {
        $submenu->addLink('Administer', $T . 'admin/');
    }
    $submenu->addLink('Rate this course', 'https://www.class-central.com/mooc/7363/python-for-everybody');
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

$set->addRight('Book', $R . 'book');
$set->addRight('Instructor', 'http://www.dr-chuck.com');

// Set the topNav for the session
$OUTPUT->topNavSession($set);

$OUTPUT->topNav();
$OUTPUT->flashMessages();
