<?php

if ( ! isset($CFG->GEOCODE_KEY) ) {
    die('$CFG->GEOCODE_KEY not set');
}

if ( ! isset($_GET['address']) ) { 
    die("No address...");
}

$address = $_GET['address'];

$serviceurl = "https://maps.googleapis.com/maps/api/geocode/json?key=".$CFG->GEOCODE_KEY."&address=";

header('Content-Type: application/json');

$url = $serviceurl . urlencode($address);
error_log("geocode ".$address);

$contents = file_get_contents($url);
echo($contents);

