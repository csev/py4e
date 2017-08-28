<?php

require_once "../config.php";
\Tsugi\Core\LTIX::getConnection();
require_once "data/data_util.php";
require_once "data/names.php";
require_once "data/locations.php";

use \Tsugi\Core\LTIX;
use \Tsugi\Util\LTI;
use \Tsugi\Util\Net;

if ( ! isCli() ) die("CLI only");

$file = fopen("locations.inp","r");
if ( ! $file ) die('unable to open file');

$url = 'http://maps.googleapis.com/maps/api/geocode/json?';

$i = 400;
while (($address = fgets($file)) !== false) {
    $address = trim($address);
    $actual_url = $url . '?address=' . urlencode($address);
    $actual_data = Net::doGet($actual_url);
    $actual_count = strlen($actual_data);
    $response = Net::getLastHttpResponse();
    $actual_json = json_decode($actual_data);
    if ( $response != 200 || $actual_json == null || ( !isset($actual_json->results[0])) || 
        ( !isset($actual_json->results[0]->place_id)) ) {
        echo("Flawed response=$response url=$actual_url json_error=".json_last_error_msg()."\n");
        continue;
    }
    $actual_place =  $actual_json->results[0]->place_id;
    echo("actual_place=$actual_place\n");
    $GEO[$address] = $actual_data;
    if ( $i-- < 0 ) break;
}
fclose($file);

echo count($GEO)."\n";
$fh = fopen('locations.txt', 'w') or die("can't open file");
fwrite($fh, json_encode($GEO));
fclose($fh);

