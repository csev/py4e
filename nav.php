<?php
$P7 = strpos(phpversion(), '7') === 0;
// $P7 = true;
// $P7 = false;
$OUTPUT->bodyStart();
$R = $CFG->apphome . '/';
$T = $CFG->wwwroot . '/';
$adminmenu = isset($_COOKIE['adminmenu']) && $_COOKIE['adminmenu'] == "true";
$set = new \Tsugi\UI\MenuSet();
$set->setHome($CFG->servicename, $CFG->apphome);
$set->addLeft('Get Started', $R.'install');
if ( $P7 ) {
    $set->addLeft('Lessons', $R.'lessons');
} else {
    $set->addLeft('Lessons', $T.'lessons');
}
if ( isset($_SESSION['id']) ) {
    if ( $P7 ) {
        $set->addLeft('Assignments', $R.'assignments');
    } else {
        $set->addLeft('Assignments', $T.'assignments');
    }
    // If both are set we go to discuss.php
    if ( isset($CFG->disqushost) ) $set->addLeft('Discuss', $T.'discuss');
    else if ( isset($CFG->disquschannel) ) $set->addLeft('Discuss', $CFG->disquschannel);
} else {
    $set->addLeft('Materials', $R.'materials');
}

if ( isset($_SESSION['id']) ) {
    $submenu = new \Tsugi\UI\Menu();
    if ( $P7 ) {
        $submenu->addLink('Profile', $R.'profile');
    } else {
        $submenu->addLink('Profile', $T.'profile');
    }
    if ( isset($CFG->google_map_api_key) ) {
        if ( $P7 ) {
            $submenu->addLink('Map', $R.'map');
        } else {
            $submenu->addLink('Map', $T.'map');
        }
    }

    if ( $P7 ) {
        $submenu->addLink('Badges', $R.'badges');
    } else {
        $submenu->addLink('Badges', $T.'badges');
    }
    $submenu->addLink('Materials', $R.'materials');
    if ( $CFG->DEVELOPER ) {
        $submenu->addLink('Test LTI Tools', $T . 'dev');
    }
    if ( $CFG->providekeys ) {
        $submenu->addLink('LMS Integration', $T . 'admin/key/indexp');
    }
    if ( isset($_COOKIE['adminmenu']) && $_COOKIE['adminmenu'] == "true" ) {
        $submenu->addLink('Administer', $T . 'admin/');
    }
    $submenu->addLink('Rate this course', 'https://www.class-central.com/mooc/7363/python-for-everybody');
    if ( $P7 ) {
        $submenu->addLink('Logout', $R.'logout');
    } else {
        $submenu->addLink('Logout', $T.'logout');
    }
    if ( isset($_SESSION['avatar']) ) {
        $set->addRight('<img src="'.$_SESSION['avatar'].'" style="height: 2em;"/>', $submenu);
        // htmlentities($_SESSION['displayname']), $submenu);
    } else {
        $set->addRight(htmlentities($_SESSION['displayname']), $submenu);
    }
} else {
    if ( $P7 ) {
        $set->addRight('Login', $R.'login');
    } else {
        $set->addRight('Login', $T.'login');
    }
}

$set->addRight('Book', $R . 'book');
$set->addRight('Instructor', 'http://www.dr-chuck.com');

// Set the topNav for the session
$OUTPUT->topNavSession($set);

$OUTPUT->topNav();
$OUTPUT->flashMessages();
