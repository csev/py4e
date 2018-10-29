<?php

if ( ! isset($CFG->GEOCODE_KEY) ) {
    die('$CFG->GEOCODE_KEY not set');
}

$address = false;

if ( isset($_GET['address']) ) $address = $_GET['address'];
if ( ! $address && isset($_GET['query']) ) $address = $_GET['query'];
if ( ! $address ) {
    die("No address...");
}

if ( ! isset($_GET['key']) || $_GET['key'] != '42' ) { 
    die("Missing/incorrect key= parameter (it is an easy number to guess)...");
}


$do_json = strpos($_SERVER['REQUEST_URI'],'/xml') === false;
$fragment = $do_json ? 'json' : 'xml';

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

