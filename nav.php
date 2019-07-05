<?php
$OUTPUT->bodyStart();
$R = $CFG->apphome . '/';
$T = $CFG->wwwroot . '/';
$adminmenu = isset($_COOKIE['adminmenu']) && $_COOKIE['adminmenu'] == "true";
$set = new \Tsugi\UI\MenuSet();
$set->setHome($CFG->servicename, $CFG->apphome);
$set->addLeft('Empezar', $R.'install');
$set->addLeft('Lecciones', $R.'lessons');
if ( isset($_SESSION['id']) ) {
    $set->addLeft('Asignaciones', $R.'assignments');
    // If both are set we go to discuss.php
    if ( isset($CFG->disqushost) ) $set->addLeft('Discuss', $T.'discuss');
    else if ( isset($CFG->disquschannel) ) $set->addLeft('Discuss', $CFG->disquschannel);
} else {
    $set->addLeft('Materiales', $R.'materials');
}

if ( isset($_SESSION['id']) ) {
    $submenu = new \Tsugi\UI\Menu();
    $submenu->addLink('Perfil', $R.'profile');
    if ( isset($CFG->google_map_api_key) ) {
        $submenu->addLink('Mapa', $R.'map');
    }

    $submenu->addLink('Insignias', $R.'badges');
    $submenu->addLink('Materiales', $R.'materials');
    if ( $CFG->providekeys ) {
        $submenu->addLink('LMS Integración', $T . 'settings');
    }
    if ( isset($CFG->google_classroom_secret) ) {
        $submenu->addLink('Google Classroom', $T.'gclass/login');
    }
    $submenu->addLink('App Store gratis', 'https://www.tsugicloud.org');
    $submenu->addLink('Califica este curso', 'https://www.class-central.com/mooc/7363/python-for-everybody');
    $submenu->addLink('Intimidad', $R.'privacy');
    if ( isset($_COOKIE['adminmenu']) && $_COOKIE['adminmenu'] == "true" ) {
        $submenu->addLink('Admininster', $T . 'admin/');
    }
    if ( $CFG->DEVELOPER ) {
        $submenu->addLink('Test LTI Tools', $T . 'dev');
    }
    $submenu->addLink('Cerrar sesión', $R.'logout');
    if ( isset($_SESSION['avatar']) ) {
        $set->addRight('<img src="'.$_SESSION['avatar'].'" style="height: 2em;"/>', $submenu);
        // htmlentities($_SESSION['displayname']), $submenu);
    } else {
        $set->addRight(htmlentities($_SESSION['displayname']), $submenu);
    }
} else {
    $set->addRight('Iniciar sesión', $R.'login');
}

$imenu = new \Tsugi\UI\Menu();

$imenu->addLink('Instructor', 'http://www.dr-chuck.com');
$imenu->addLink('Horas de oficina', 'http://www.dr-chuck.com/office/');
$set->addRight('Libro', $R . 'book');
$set->addRight('Instructor', $imenu);

// Set the topNav for the session
$OUTPUT->topNavSession($set);

$OUTPUT->topNav();
$OUTPUT->flashMessages();
