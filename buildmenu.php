<?php

function buildMenu() {
    global $CFG;
    $R = $CFG->apphome . '/';
    $T = $CFG->wwwroot . '/';
    $adminmenu = isset($_COOKIE['adminmenu']) && $_COOKIE['adminmenu'] == "true";
    $set = new \Tsugi\UI\MenuSet();
    $set->setHome($CFG->servicename, $CFG->apphome);
    $set->addLeft('Μαθήματα', $R.'lessons');
    if ( isset($CFG->tdiscus) && $CFG->tdiscus) $set->addLeft('Συζητήσεις', $R.'discussions');
    if ( isset($_SESSION['id']) ) {
        $set->addLeft('Εργασίες', $R.'assignments');
    } else {
        $set->addLeft('Ανοιχτοί Εκπαιδευτικοί Πόροι', $R.'materials');
    }
    
    if ( isset($_SESSION['id']) ) {
        $submenu = new \Tsugi\UI\Menu();
        $submenu->addLink('Προφίλ', $R.'profile');
        if ( isset($CFG->google_map_api_key) ) {
            $submenu->addLink('Χάρτης', $R.'map');
        }
    
        $submenu->addLink('Badges', $R.'badges');
        $submenu->addLink('Υλικό', $R.'materials');
        if ( $CFG->providekeys ) {
            $submenu->addLink('Ενσωμάτωση LMS', $T . 'settings');
        }
        if ( isset($CFG->google_classroom_secret) ) {
            $submenu->addLink('Google Classroom', $T.'gclass/login');
        }
        $submenu->addLink('Free App Store', 'https://www.tsugicloud.org');
        $submenu->addLink('Βαθμολογήστε αυτό το μάθημα', 'https://www.class-central.com/mooc/7363/python-for-everybody');
        $submenu->addLink('Απόρρητο', $R.'privacy');
        $submenu->addLink('επίπεδο υπηρεσιών', $R.'service');
        if ( isset($_COOKIE['adminmenu']) && $_COOKIE['adminmenu'] == "true" ) {
            $submenu->addLink('Διαχειριστής', $T . 'admin/');
        }
        $submenu->addLink('Αποσύνδεση', $R.'logout');

        if ( isset($_SESSION['avatar']) ) {
            $set->addRight('<img src="'.$_SESSION['avatar'].'" title="'.htmlentities(__('User Profile Menu - Includes logout')).'" style="height: 2em;"/>', $submenu);
            // htmlentities($_SESSION['displayname']), $submenu);
        } else {
            $set->addRight(htmlentities($_SESSION['displayname']), $submenu);
        }
    } else {
        $set->addRight('Σύνδεση', $R.'login');
    }

    $set->addRight('Βιβλίο', $R . 'book');
    $set->addRight('Εκπαιδευτής', 'https://online.dr-chuck.com');

    return($set);
}

