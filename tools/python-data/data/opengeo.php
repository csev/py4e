<?php

require_once "rate_limit.php";

$serviceurl = 'https://nominatim.openstreetmap.org/search.php?';

$q = \Tsugi\Util\U::get($_GET, 'q', false);
if ( ! $q ) {
?>
<h1>Python For Everybody Caching Open StreetMap Server</h1>
<p>
This server is used in the Python for Everybody (www.py4e.com)
series of courses.  It is <b>highly</b> cached using CloudFlare
edge servers.  The student assignments retrieve a provided
fixed list of addresses so nearly every request will be fulfilled by the cache.
Each student adds one address to their list and that one will 
miss the cache once.
</p>
<p>
If a request makes it past the cache, it will be delayed 
by 5 seconds before being forwarded to the OpenStreetMap server
in order not to trigger its rate limit.
</p>
<p>
This server has its own rate limiting to keep users
from busting this cache and triggering OpenStreetMap's rate limit.
</p>
<?php
	return;
}

$ipaddr = \Tsugi\Util\Net::getIP();
$delta = check_rate_limit('/tmp/opengeo.db', $ipaddr, $q);

error_log("opengeo $q $ipaddr $delta");

if ( $delta < 3 ) {
    sleep(20);
} else { 
    sleep(7);
}

$parms = array();
$parms['q'] = $q;
$parms['format'] = 'geojson';
$parms['limit'] = 1;
$parms['addressdetails'] = 1;
$parms['accept-language'] = 'en';

$url = $serviceurl . http_build_query($parms);

header('Content-Type: application/json; charset=utf-8');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_USERAGENT, "Python For Everybody Cached Server (https://py4e-data.dr-chuck.net/opengeo)");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "X-OpenStreetMap-Purpose" => "This is used to support students around the world exploring APIs in a Python course (www.py4e.com)",
    "X-OpenStreetMap-Contact" => "If there are issues with these requests, please contact Charles Severance (csev at umich.edu)",
));

$contents = curl_exec($ch);
curl_close($ch);

// Failed to open stream: HTTP request failed! HTTP/1.1 403 Forbidden
if ( ! is_string($contents) ) {
    $retval = new \stdClass();
    $retval->code = curl_errno($ch);
    $retval->error = curl_error($ch);
    error_log("Failed opengeo $retval->code $retval->error $url");
    $retval->note = "Something went wrong when talking to the Open Street Map API";
    echo(json_encode($retval));
    return;
}

echo($contents);

