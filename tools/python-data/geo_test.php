#!/usr/bin/env php
<?php
/**
 * Batch-test opengeo plus_code responses for every location in locations.inp.
 *
 *   php geo_test.php              # all locations
 *   php geo_test.php 50           # stop after 50 cache MISSes
 *   php geo_test.php 50 3         # 50 MISSes, pause 3 seconds after each MISS
 *
 * All locations.inp names are "known" to opengeo (sleep 2s on origin MISS).
 * Optional pause after a MISS spaces out requests so Geoapify is not hammered.
 */

if ( php_sapi_name() !== 'cli' ) {
    http_response_code(403);
    die("geo_test.php is CLI only. Run: php geo_test.php [miss_limit] [pause_seconds]\n");
}

require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/data/data_util.php";
require_once __DIR__ . "/data/locations.php";

use \Tsugi\Util\Net;

while ( ob_get_level() > 0 ) {
    ob_end_flush();
}
ob_implicit_flush(true);

function geo_test_cache_status() {
    $headers = Net::parseHeaders();
    $cf = '';
    $age = '';
    foreach ( $headers as $key => $value ) {
        $lk = strtolower($key);
        if ( $lk == 'cf-cache-status' ) $cf = $value;
        if ( $lk == 'age' ) $age = $value;
    }
    if ( strlen($cf) < 1 ) return array('status' => 'n/a', 'label' => 'cf-cache=n/a');
    $label = 'cf-cache='.$cf;
    if ( strlen($age) > 0 ) $label .= ' age='.$age;
    return array('status' => strtoupper($cf), 'label' => $label);
}

$miss_limit = null;
$pause = 0;
if ( isset($argv[1]) && is_numeric($argv[1]) ) {
    $miss_limit = (int) $argv[1];
}
if ( isset($argv[2]) && is_numeric($argv[2]) ) {
    $pause = (int) $argv[2];
}

$api_url = dataUrl('opengeo');
echo("Running geo_test against $api_url\n");
if ( $miss_limit !== null ) {
    echo("Stop after: $miss_limit cache MISSes\n");
} else {
    echo("Stop after: all locations tested\n");
}
if ( $pause > 0 ) echo("Pause: {$pause}s after each MISS\n");
echo("\n");

$cache_counts = array();
$misses = 0;
$tested = 0;
foreach ( get_locations() as $location ) {
    $sample_url = $api_url . '?q=' . urlencode($location) . '&key=42';
    $sample_data = Net::doGet($sample_url);
    $response = Net::getLastHttpResponse();
    $cache = geo_test_cache_status();
    $cache_counts[$cache['status']] = ($cache_counts[$cache['status']] ?? 0) + 1;
    $is_miss = ( $cache['status'] === 'MISS' );
    if ( $is_miss ) $misses++;
    $sample_json = json_decode($sample_data);
    if ( $response != 200 || $sample_json == null || ( !isset($sample_json->features[0])) ) {
        echo("*** Bad response=$response ".$cache['label']." url=$sample_url json_error=".json_last_error_msg()."\n");
        if ( is_string($sample_data) && strlen($sample_data) < 2000 ) {
            echo($sample_data."\n");
        }
        flush();
        $tested++;
        if ( $miss_limit !== null && $misses >= $miss_limit ) break;
        if ( $is_miss && $pause > 0 ) sleep($pause);
        continue;
    }
    if ( !isset($sample_json->features[0]->properties->plus_code) ) {
        echo("*** Could not find plus_code ".$cache['label']." $location\n");
        flush();
        $tested++;
        if ( $miss_limit !== null && $misses >= $miss_limit ) break;
        if ( $is_miss && $pause > 0 ) sleep($pause);
        continue;
    }
    $sample_place = $sample_json->features[0]->properties->plus_code;
    echo("location=$location plus_code=$sample_place ".$cache['label']."\n");
    flush();
    $tested++;
    if ( $miss_limit !== null && $misses >= $miss_limit ) break;
    if ( $is_miss && $pause > 0 ) sleep($pause);
}

echo("\nTested: $tested locations, $misses MISSes\n");
echo("Cloudflare cache summary:\n");
ksort($cache_counts);
foreach ( $cache_counts as $status => $count ) {
    echo("  $status: $count\n");
}
