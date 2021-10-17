<?php

require_once "rate_limit.php";
require_once "opengeo_api.php";

/* opengeo_api.php

<?php
global $OPENGEO_KEY;
$OPENGEO_KEY = "5b1e........................5239";

*/

$serviceurl = 'https://nominatim.openstreetmap.org/search.php?format=geojson&limit=1&addressdetais=1&accept-language-en&q=';
$serviceurl = 'https://api.geoapify.com/v1/geocode/search?apiKey='.$OPENGEO_KEY.'&format=geojson&limit=1&addressdetais=1&accept-language-en&text=';

$q = \Tsugi\Util\U::get($_GET, 'q', false);
if ( ! $q ) {
?>
<h1>Python For Everybody Open StreetMap / GeoAPIfProxy Server</h1>
<p>
This server is used in the Python for Everybody
(<a href="https://www.py4e.com">www.py4e.com</a>)
series of courses.  It is <b>highly</b> cached using CloudFlare
edge servers worldwide.  The student assignments retrieve a
fixed list of addresses so nearly every request will be fulfilled by the cache.
Each student adds <i>one</i> address to their list and that one will
miss the CloudFlare cache once.
</p>
<p>
If a request makes it past the CloudFlare cache, it will be delayed
by 5 seconds in this proxy before being forwarded to the actual server
in order not to trigger its rate limit.
This server also has its own rate limiting to keep users
from bypassing the CloudFlare cache and triggering the actual server's rate limit.
</p>
<!--
<p>
This service acts as a caching proxy for the API and is
<a href="https://wiki.openstreetmap.org/wiki/Nominatim">Nominatim</a>
server provided by the
<a href="https://operations.osmfoundation.org/policies/nominatim/">
Open Street Map Foundation
</a>.
-->
Powered by <a href="https://www.geoapify.com/">Geoapify</a> at the free level.
We make every effort to use this service in an efficient
and respectful way.
</p>
<p>
This server is maintained by
<a href="http://www.twitter.com/drchuck" target="_blank">@DrChuck</a>.
</p>
<?php
	return;
}

$known_sites = file_get_contents("where.data");

$known = strpos($known_sites, $q."\n") !== false;

$ipaddr = \Tsugi\Util\Net::getIP();
if ( $known ) {
  error_log("opengeo $q $ipaddr known");
  sleep(2);
} else {

  if ( filter_bad_things($q, $ipaddr) ) return;

  $delta = check_rate_limit('/tmp/opengeo.db', $ipaddr, $q);

  error_log("opengeo $q $ipaddr $delta");

  if ( $delta < 3 ) {
      sleep(20);
  } else {
      sleep(7);
  }
}

$url = $serviceurl . urlencode($q);

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
    $retval->note = "Something went wrong when talking to GeoAPIify";
    echo(json_encode($retval));
    return;
}

$contents = str_replace('"name":', '"display_name":', $contents);
echo($contents);

