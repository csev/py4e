<?php

use \Tsugi\Util\U;

function buildMenu() {
    global $CFG, $USER;
    $R = $CFG->apphome . '/';
    $T = $CFG->wwwroot . '/';
    $isInstructor = (isset($USER) && $USER && isset($USER->instructor) && $USER->instructor)
        || (isset($_SESSION['instructor']) && $_SESSION['instructor']);

    $set = new \Tsugi\UI\MenuSet();
    $set->setHome($CFG->servicename, $CFG->apphome);
    $set->addLeft('Labs', $R.'labs');

    if ( isset($_SESSION['id']) ) {
        $set->addLeft('Grades', $R.'grades');
        $submenu = new \Tsugi\UI\Menu();
        $submenu->addLink('Assignments', $R.'assignments');
        $submenu->addLink('Profile', $R.'profile');
        if ( $isInstructor ) {
            $submenu->addLink('Administer', $T . 'admin/');
        }
        $submenu->addLink('Logout', $R.'logout');

        if ( isset($_SESSION['avatar']) ) {
            $set->addRight(
                '<img src="'.$_SESSION['avatar'].'" title="'.htmlentities(__('User Profile Menu - Includes logout')).'" style="height: 2em;" referrerpolicy="no-referrer" alt="Avatar" loading="lazy"/>',
                $submenu
            );
        } else {
            $set->addRight(htmlentities($_SESSION['displayname']), $submenu);
        }
    } else {
        $set->addRight('Login', $R.'login');
    }

    if ( isset($_SESSION['id']) ) {
        $set->addRight(
            '<tsugi-notifications api-url="'. htmlspecialchars($T . 'api/notifications.php') . '" notifications-view-url="'. htmlspecialchars($R . 'notifications') . '" announcements-view-url="'. htmlspecialchars($R . 'announcements') . '"></tsugi-notifications>',
            false,
            true,
            'hidden-xs tsugi-wc-nav-item'
        );
    }

    return $set;
}
