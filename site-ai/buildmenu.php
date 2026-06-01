<?php

use \Tsugi\Util\U;

function buildMenu() {
    global $CFG, $USER;
    $R = $CFG->apphome . '/';
    $T = $CFG->wwwroot . '/';
    $isInstructor = (isset($USER) && $USER && isset($USER->instructor) && $USER->instructor)
        || (isset($_SESSION['instructor']) && $_SESSION['instructor']);
    $showCalendarDueUi = isset($_SESSION['id'])
        && U::isNotEmpty($CFG->lessons)
        && \Tsugi\Grades\GradeUtil::showDueDates(U::get($_SESSION, 'context_id', 0));

    $set = new \Tsugi\UI\MenuSet();
    $set->setHome($CFG->servicename, $CFG->apphome);
    $set->addLeft('Lessons', $R . 'lessons');
    if ( isset($_SESSION['id']) ) {
        $set->addLeft('Assignments', $R . 'assignments');
        $set->addLeft('Book', $R . 'book');
    } else {
        $set->addLeft('OER', $R . 'materials');
    }

    if ( isset($_SESSION['id']) ) {
        $submenu = new \Tsugi\UI\Menu();
        $submenu->addLink('Announcements', $R . 'announcements');
        $submenu->addLink('Grades', $R . 'grades');
        $submenu->addLink('Pages', $R . 'pages');
        $submenu->addLink('Discussions', $R . 'discussions');
        if ( $isInstructor ) {
            $submenu->addLink('Notifications', $R . 'notifications');
        }
        $submenu->addLink('Courses', $R . 'coursesredirect.php');
        if ( isset($CFG->google_map_api_key) ) {
            $submenu->addLink('Map', $R . 'map');
        }
        $submenu->addLink('Profile', $R . 'profile');
        if ( $showCalendarDueUi ) {
            $submenu->addLink('Calendar', $R . 'calendar');
        }
        $submenu->addLink('Badges', $R . 'badges');
        $submenu->addLink('Materials', $R . 'materials');
        if ( $CFG->providekeys ) {
            $submenu->addLink('LMS Integration', $T . 'settings');
        }
        $submenu->addLink('Privacy', $R . 'privacy');
        $submenu->addLink('Service Level', $R . 'service');
        if ( $isInstructor ) {
            $submenu->addLink('Administer', $T . 'admin/');
        }
        $submenu->addLink('Logout', $R . 'logout');

        if ( isset($_SESSION['avatar']) ) {
            $set->addRight(
                '<img src="'.$_SESSION['avatar'].'" title="'.htmlentities(__('User Profile Menu - Includes logout')).'" style="height: 2em;" referrerpolicy="no-referrer" alt="Avatar" loading="lazy"/>',
                $submenu
            );
        } else {
            $set->addRight(htmlentities($_SESSION['displayname']), $submenu);
        }
    } else {
        $set->addRight('Login', $R . 'login');
        $set->addRight('Courses', $R . 'coursesredirect.php');
    }

    if ( isset($_SESSION['id']) ) {
        $set->addRight(
            '<tsugi-notifications api-url="'. htmlspecialchars($T . 'api/notifications.php') . '" notifications-view-url="'. htmlspecialchars($R . 'notifications') . '" announcements-view-url="'. htmlspecialchars($R . 'announcements') . '"></tsugi-notifications>',
            false,
            true,
            'hidden-xs tsugi-wc-nav-item'
        );

        if ( $showCalendarDueUi ) {
            $set->addRight(
                '<tsugi-calendar-due api-url="'. htmlspecialchars($R . 'calendar/json') . '" lessons-url="'. htmlspecialchars($R . 'calendar') . '" calendar-url="'. htmlspecialchars($R . 'calendar') . '"></tsugi-calendar-due>',
                false,
                true,
                'hidden-xs tsugi-wc-nav-item'
            );
        }

        if ( isset($CFG->tdiscus) && $CFG->tdiscus ) {
            $set->addRight(
                '<tsugi-discussions api-url="'. htmlspecialchars($R . 'discussions/json') . '" discussions-url="'. htmlspecialchars($R . 'discussions') . '"></tsugi-discussions>',
                false,
                true,
                'hidden-xs tsugi-wc-nav-item'
            );
        }
    }

    return $set;
}
