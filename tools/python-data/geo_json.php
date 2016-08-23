<?php

use \Tsugi\Core\LTIX;
use \Tsugi\Util\LTI;
use \Tsugi\Util\Net;
use \Tsugi\Util\Mersenne_Twister;

$sanity = array(
  'urllib' => 'You should use urllib to retrieve the data from the API',
  'urlencode' => 'You should use urlencode add parameters to the API url',
  'json' => 'You should use the json library to parse the API data'
);

// Compute the stuff for the output
$code = 42;
$MT = new Mersenne_Twister($code);
$sample = $MT->shuffle($LOCATIONS);
$sample_location = $sample[0];

$code = $USER->id+$LINK->id+$CONTEXT->id;
$MT = new Mersenne_Twister($code);
$actual = $MT->shuffle($LOCATIONS);
$actual_location = $actual[0];

// Retrieve the data
$api_url = dataUrl('geojson');
$google_api = 'http://maps.googleapis.com/maps/api/geocode/json?sensor=false&address=University+of+Michigan';
$sample_url = $api_url . '?sensor=false&address=' . urlencode($sample_location);
$actual_url = $api_url . '?sensor=false&address=' . urlencode($actual_location);

$sample_data = Net::doGet($sample_url);
$sample_count = strlen($sample_data);
$response = Net::getLastHttpResponse();
$sample_json = json_decode($sample_data);
if ( $response != 200 || $sample_json == null || ( !isset($sample_json->results[0])) ) {
    error_log("DIE: Sample response=$response url=$sample_url json_error=".json_last_error_msg());
    die("Sample response=$response url=$sample_url json_error=".json_last_error_msg());
}
// echo("<pre>\n");echo(LTI::jsonIndent(json_encode($sample_json)));echo("</pre>\n");
$sample_place =  $sample_json->results[0]->place_id;

$actual_data = Net::doGet($actual_url);
$actual_count = strlen($actual_data);
$response = Net::getLastHttpResponse();
$actual_json = json_decode($actual_data);
if ( $response != 200 || $actual_json == null || ( !isset($actual_json->results[0])) ) {
    error_log("DIE: Actual response=$response url=$actual_url json_error=".json_last_error_msg());
    die("Actual response=$response url=$actual_url json_error=".json_last_error_msg());
}
$actual_place =  $actual_json->results[0]->place_id;
// echo("sample_place=$sample_place actual_place=$actual_place");


$oldgrade = $RESULT->grade;
if ( isset($_POST['place_id']) && isset($_POST['code']) ) {
    $RESULT->setJsonKey('code', $_POST['code']);

    if ( $_POST['place_id'] != $actual_place ) {
        $_SESSION['error'] = "Your place_id did not match";
        header('Location: '.addSession('index.php'));
        return;
    }

    $val = validate($sanity, $_POST['code']);
    if ( is_string($val) ) {
        $_SESSION['error'] = $val;
        header('Location: '.addSession('index.php'));
        return;
    }

    LTIX::gradeSendDueDate(1.0, $oldgrade, $dueDate);
    // Redirect to ourself
    header('Location: '.addSession('index.php'));
    return;
}

// echo($goodsha);
if ( $RESULT->grade > 0 ) {
    echo('<p class="alert alert-info">Your current grade on this assignment is: '.($RESULT->grade*100.0).'%</p>'."\n");
}

if ( $dueDate->message ) {
    echo('<p style="color:red;">'.$dueDate->message.'</p>'."\n");
}
?>
<p>
<b>Calling a JSON API</b>
</p>
In this assignment you will write a Python program somewhat similar to 
<a href="http://www.pythonlearn.com/code/geojson.py" target="_blank">http://www.pythonlearn.com/code/geojson.py</a>.  
The program will prompt for a location, contact a web service and retrieve
JSON for the web service and parse that data, and retrieve the first
<b>place_id</b> from the JSON.
A place ID is a textual identifier that uniquely identifies a place as
within Google Maps.
</p>
<p>
<b>API End Points</b>
</p>
<p>
To complete this assignment, you should use this API endpoint that has a static subset
of the Google Data:
<pre>
<a href="<?= deHttps($api_url) ?>" target="_blank"><?= deHttps($api_url) ?></a>
</pre>
This API uses the same parameters (sensor and address) as the Google API.  
This API also has no rate limit so you can test as often as you like.
If you visit the URL with no parameters, you get a list of all of the 
address values which can be used with this API.
</p>
<p>
To call the API, you need to provide a <b>sensor=false</b> parameter and
the address that you are requesting as the <b>address=</b> parameter that is 
properly URL encoded using the <b>urllib.urlencode()</b> fuction as shown in 
<a href="http://www.pythonlearn.com/code/geojson.py" 
target="_blank">http://www.pythonlearn.com/code/geojson.py</a>
</p>
<!--
<p>
Just for fun, you can also test your program with the real Google API:
<pre>
<a href="<?= $google_api ?>" target="_blank"><?= $google_api ?></a>
</pre>
Since Google's data is always changing, the data returned from the Google API
could easily be different than from my local copy API.  And the Google
API has rate limits.  But your code should work with the Google API 
with no modifications other than the base URL.
</p>
-->
<?php httpsWarning($api_url); ?>
<p><b>Test Data / Sample Execution</b></p>
<p>
You can test to see if your program is working with a 
location of "<?= $sample_location ?>" which will have a 
<b>place_id</b> of "<?= $sample_place ?>".
<pre>
$ python solution.py
Enter location: <?= $sample_location ?> 
Retrieving http://...
Retrieved <?= $sample_count ?> characters
Place id <?= $sample_place ?> 
</pre>
</p>
<p><b>Turn In</b></p>
<p>
Please run your program to find the <b>place_id</b> for this location:
<pre>
<?= $actual_location ?>
</pre>
Make sure to enter the name and case exactly as above
and enter the <b>place_id</b> and your Python code below.
Hint: The first seven characters of the <b>place_id</b>
are "<?= substr($actual_place,0,7) ?> ..."<br/>
</p>
<p>
Make sure to retreive the data from the URL specified above and <b>not</b> the 
normal Google API.  Your program should work with the Google API - but the
<b>place_id</b> may not match for this assignment.
</p>
<form method="post">
place_id: <input type="text" size="40" name="place_id">
<input type="submit" value="Submit Assignment"><br/>
Python code:<br/>
<textarea rows="20" style="width: 90%" name="code"></textarea><br/>
</form>
