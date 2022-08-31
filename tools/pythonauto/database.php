<?php

// To allow this to be called directly or from admin/upgrade.php
if ( !isset($PDOX) ) {
    require_once "../config.php";
    $CURRENT_FILE = __FILE__;
    require $CFG->dirroot."/admin/migrate-setup.php";
}

// Dropping tables
$DATABASE_UNINSTALL = array(
"drop table if exists {$CFG->dbprefix}pythonauto_log",
);

// Creating tables
$DATABASE_INSTALL = array(
array( "{$CFG->dbprefix}pythonauto_log",
"create table {$CFG->dbprefix}pythonauto_log (
    log_id      INTEGER NOT NULL KEY AUTO_INCREMENT,
    link_id     INTEGER NOT NULL,
    user_id     INTEGER NOT NULL,

    exercise    VARCHAR(128) NULL,
    code        TEXT NULL,
    grade       FLOAT NULL,

    created_at  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP NULL,

    CONSTRAINT `{$CFG->dbprefix}pythonauto_log_ibfk_1`
        FOREIGN KEY (`link_id`)
        REFERENCES `{$CFG->dbprefix}lti_link` (`link_id`)
        ON DELETE CASCADE ON UPDATE CASCADE,

    CONSTRAINT `{$CFG->dbprefix}pythonauto_loghread_ibfk_2`
        FOREIGN KEY (`user_id`)
        REFERENCES `{$CFG->dbprefix}lti_user` (`user_id`)
        ON DELETE CASCADE ON UPDATE CASCADE


) ENGINE = InnoDB DEFAULT CHARSET=utf8"),

);

// Database upgrade
$DATABASE_UPGRADE = function($oldversion) {
    global $CFG, $PDOX;


    return 202001010815;

}; // Don't forget the semicolon on anonymous functions :)

// Do the actual migration if we are not in admin/upgrade.php
if ( isset($CURRENT_FILE) ) {
    include $CFG->dirroot."/admin/migrate-run.php";
}

