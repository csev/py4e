<?php

function buildMenu() {
    global $CFG;
    $R = $CFG->apphome . '/';
    $T = $CFG->wwwroot . '/';
    $adminmenu = isset($_COOKIE['adminmenu']) && $_COOKIE['adminmenu'] == "true";
    $set = new \Tsugi\UI\MenuSet();
    $set->setHome($CFG->servicename, $CFG->apphome);
    $set->addLeft('Lessons', $R.'lessons');
    if ( isset($CFG->tdiscus) && $CFG->tdiscus ) $set->addLeft('Discussions', $R.'discussions');
    if ( isset($_SESSION['id']) ) {
        $set->addLeft('Assignments', $R.'assignments');
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
        $submenu->addLink('Service Level', $R.'service');
        if ( isset($_COOKIE['adminmenu']) && $_COOKIE['adminmenu'] == "true" ) {
            $submenu->addLink('Administer', $T . 'admin/');
        }
        $submenu->addLink('Logout', $R.'logout');

        if ( isset($_SESSION['avatar']) ) {
            $set->addRight('<img src="'.$_SESSION['avatar'].'" title="'.htmlentities(__('User Profile Menu - Includes logout')).'" style="height: 2em;"/>', $submenu);
            // htmlentities($_SESSION['displayname']), $submenu);
        } else {
            $set->addRight(htmlentities($_SESSION['displayname']), $submenu);
        }
    } else {
        $set->addRight('Login', $R.'login');
    }

    $imenu = new \Tsugi\UI\Menu();

    $imenu->addLink('Instructor', 'https://online.dr-chuck.com');
    $imenu->addLink('Office Hours', 'http://www.dr-chuck.com/office/');
    $set->addRight('Book', $R . 'book');
    $set->addRight('Instructor', $imenu);

    return($set);
}

