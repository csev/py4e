<?php
if ( file_exists('../config.php') ) {
    require_once("../config.php");
} else {
    require_once("../../config.php");
}
require_once("locations.php");

$address = isset($_GET['address']) ? $_GET['address'] : false;
header('Content-Type: application/json; charset=utf-8');

if ( $address === false ) {
    sort($LOCATIONS);
    echo(\Tsugi\Util\LTI::jsonIndent(json_encode($LOCATIONS)));
    return;
}

$where = array_search($address, $LOCATIONS);
if ( $where === false ) {
    http_response_code(400);
    $retval = array('error' => 'Address not found in the list of available locations',
    'locations' => $LOCATIONS);
    echo(\Tsugi\Util\LTI::jsonIndent(json_encode($retval)));
    return;
}

// Check to see if we already have this in the variable
if ( $GEODATA !== false ) {
    echo($GEODATA[$address]);
    return;
}

lmsDie("DIE: Data failure - please contact the instructor");
