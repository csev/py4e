<?php

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
