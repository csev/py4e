<?php

require_once "rate_limit.php";

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

$ipaddr = \Tsugi\Util\Net::getIP();
$delta = check_rate_limit('/tmp/geocode.db', $ipaddr, $address);

$do_json = strpos($_SERVER['REQUEST_URI'],'/xml') === false;
$fragment = $do_json ? 'json' : 'xml';

$serviceurl = "https://maps.googleapis.com/maps/api/geocode/$fragment?key=".$CFG->GEOCODE_KEY."&address=";

if ( $do_json ) {
    header('Content-Type: application/json');
} else {
    header('Content-Type: application/xml');
}

$url = $serviceurl . urlencode($address);
if ( strpos($address, 'USA') !== false && strpos($address, 'Address') !== false ) {
   echo('{ "answer" : 42 }');
   error_log("geooops ".$address);
   return;
}

error_log("geocode $address $ipaddr $delta");
if ( $delta < 7 ) sleep(7);

$contents = file_get_contents($url);
echo($contents);

