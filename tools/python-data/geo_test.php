<?php

require_once "../config.php";
require_once "data/data_util.php";
require_once "data/names.php";
require_once "data/locations.php";

use \Tsugi\Core\LTIX;
use \Tsugi\Util\LTI;
use \Tsugi\Util\Net;

$LAUNCH = LTIX::requireData();
$p = $CFG->dbprefix;

if ( ! $USER->instructor ) die('Must be instructor');

$sanity = array(
  'urllib' => 'You should use urllib to retrieve the data from the API',
  'urlencode' => 'You should use urlencode add parameters to the API url',
  'json' => 'You should use the json library to parse the API data'
);

echo("<pre>\n");
echo("Running test...\n");
// Run though all the locations
// var_dump($LOCATIONS);
$url = LTIX::curPageUrlScript();
$i = 500;
foreach ($LOCATIONS as $key => $location) {
    // echo(htmlentities($location)."\n");
    $api_url = str_replace('geo_test.php','data/geojson',$url);
    $sample_url = $api_url . '?address=' . urlencode($location);
    $sample_data = Net::doGet($sample_url);
    $sample_count = strlen($sample_data);
    $response = Net::getLastHttpResponse();
    $sample_json = json_decode($sample_data);
    if ( $response != 200 || $sample_json == null || ( !isset($sample_json->results[0])) ) {
        echo("*** Bad response=$response url=$sample_url json_error=".json_last_error_msg()."\n");
        echo(LTI::jsonIndent($sample_data));
        continue;
    }
    // echo("<pre>\n");echo(\Tsugi\Util\LTI::jsonIndent(json_encode($sample_json)));echo("</pre>\n");
    if ( !isset($sample_json->results[0]->place_id) ) {
        echo("*** Could not find place_id $location\n");
        // echo(\Tsugi\Util\LTI::jsonIndent($sample_data));
        continue;
    }
    $sample_place =  $sample_json->results[0]->place_id;
    echo("location=$location place=$sample_place\n");
    if ( $i-- < 1 ) break;
}
echo("</pre>\n");
