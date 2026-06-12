<?php

use \Tsugi\Util\Net;
use \Tsugi\Util\Mersenne_Twister;

function get_locations() {
    static $locations = null;
    if ( $locations !== null ) return $locations;

    $paths = array(
        __DIR__ . '/../locations.inp',
        'locations.inp',
        'data/locations.inp',
    );

    $locations = array();
    foreach ( $paths as $path ) {
        if ( ! file_exists($path) ) continue;
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ( ! is_array($lines) ) continue;
        foreach ( $lines as $line ) {
            $line = trim($line);
            if ( strlen($line) > 0 ) $locations[] = $line;
        }
        break;
    }

    if ( count($locations) < 1 ) {
        die("Location list not found - missing locations.inp");
    }

    $locations = array_unique($locations);
    sort($locations);
    return $locations;
}

function pick_location($code, $index=0) {
    $locations = get_locations();
    $MT = new Mersenne_Twister($code);
    $sample = $MT->shuffle($locations);
    if ( ! isset($sample[$index]) ) {
        die("Could not pick location for code=$code index=$index");
    }
    return $sample[$index];
}

function lookup_opengeo($location, $api_url) {
    $sample_url = $api_url . '?q=' . urlencode($location) . "&key=42";
    $sample_data = Net::doGet($sample_url);
    $sample_count = strlen($sample_data);
    $response = Net::getLastHttpResponse();
    $sample_json = json_decode($sample_data);
    if ( $response != 200 || $sample_json == null || ( !isset($sample_json->features[0])) ||
        ! isset($sample_json->features[0]->properties) ||
        ! isset($sample_json->features[0]->properties->plus_code) ) {
        error_log("lookup_opengeo fail location=$location response=$response url=$sample_url json_error=".json_last_error_msg());
        return false;
    }
    $sample_place =  $sample_json->features[0]->properties->plus_code;
    return array($location, $sample_place, $sample_count, $sample_url);
}

function load_opengeo($code, $api_url, $max_tries=10) {
    $locations = get_locations();
    $MT = new Mersenne_Twister($code);
    $sample = $MT->shuffle($locations);
    $tries = min($max_tries, count($sample));
    for ($i=0; $i < $tries; $i++) {
        $retval = lookup_opengeo($sample[$i], $api_url);
        if ( is_array($retval) ) return $retval;
    }
    die("Could not load opengeo data for code=$code after $tries tries");
}
