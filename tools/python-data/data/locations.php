<?php

use \Tsugi\Util\Net;
use \Tsugi\Util\Mersenne_Twister;

$GEODATA = false;
$json_data = false;
if ( file_exists('locations.txt') ) {
    $json_data = file_get_contents('locations.txt');
} else if (file_exists('../locations.txt') ) {
    $json_data = file_get_contents('../locations.txt');
} else if (file_exists('data/locations.txt') ) {
    $json_data = file_get_contents('data/locations.txt');
}

$json = null;
if ( $json_data != false ) {
    $json = json_decode($json_data, true);
    if ( is_array($json) && count($json) > 0 ) {
        // OK
    } else {
        $json = null;
    }
}

if ( $json !== null ) {
    $LOCATIONS = array_keys($json);
    $GEODATA = $json;
}

$LOCATIONS=array_unique($LOCATIONS);
sort($LOCATIONS);

// Need to do this more than once as data changes
function load_geo($code, $api_url) {
    global $LOCATIONS;
    $retval = false;
    $MT = new Mersenne_Twister($code);
    $sample = $MT->shuffle($LOCATIONS);
    for ($i=0; $i< 10; $i++) {
        $sample_location = $sample[$i];
        // Retrieve the data
        $sample_url = $api_url . '?address=' . urlencode($sample_location) . "&key=42";
        $sample_data = Net::doGet($sample_url);
        $sample_count = strlen($sample_data);
        $response = Net::getLastHttpResponse();
        $sample_json = json_decode($sample_data);
        if ( $response != 200 || $sample_json == null || ( !isset($sample_json->results[0])) || 
            ! isset($sample_json->results[0]->place_id) ) {
            error_log("DIE: Load $i fail response=$response url=$sample_url json_error=".json_last_error_msg());
            continue;
        }
        $sample_place =  $sample_json->results[0]->place_id;
        return array($sample_location, $sample_place, $sample_count, $sample_url);
    }
    die("Could not load sample response=$response url=$sample_url json_error=".json_last_error_msg());
}

