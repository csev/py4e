<?php

if ( ! isset($CFG->GEOCODE_KEY) ) {
    die('$CFG->GEOCODE_KEY not set');
}

if ( ! isset($_GET['address']) ) { 
    die("No address...");
}

if ( ! isset($_GET['key']) || $_GET['key'] != '42' ) { 
    die("Bad API key...");
}


$do_json = strpos($_SERVER['REQUEST_URI'],'geocode/xml') === false;
$fragment = $do_json ? 'json' : 'xml';

$address = $_GET['address'];

$serviceurl = "https://maps.googleapis.com/maps/api/geocode/$fragment?key=".$CFG->GEOCODE_KEY."&address=";

if ( $do_json ) {
    header('Content-Type: application/json');
} else {
    header('Content-Type: application/xml');
}

$url = $serviceurl . urlencode($address);
error_log("geocode ".$address);

$contents = file_get_contents($url);
echo($contents);

