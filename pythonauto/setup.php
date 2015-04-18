<?php
if ( ! defined('COOKIE_SESSION') ) {
    ini_set('session.use_cookies', '0');
    ini_set('session.use_only_cookies',0);
    ini_set('session.use_trans_sid',1); 
}

error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);

// No trailer
