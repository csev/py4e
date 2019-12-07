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

$api_url = dataUrl('json');

// Compute the stuff for the output
$code = 42;
$sample = load_geo(42, $api_url);
$sample_location = $sample[0];
$sample_place = $sample[1];
$sample_count = $sample[2];
$sample_url = $sample[3];

$code = $USER->id+$LINK->id+$CONTEXT->id;
$actual = load_geo($code, $api_url);
$actual_location = $actual[0];
$actual_place = $actual[1];
$actual_count = $actual[2];
$actual_url = $actual[3];

$oldgrade = $RESULT->grade;
if ( isset($_POST['place_id']) && isset($_POST['code']) ) {
    $RESULT->setJsonKeys( array(
        'code' => $_POST['code'],
        'place_id' => $_POST['place_id'],
        'actual_url' => $actual_url,
        'actual_place' => $actual_place
    ));

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
<a href="http://www.py4e.com/code3/geojson.py" target="_blank">http://www.py4e.com/code3/geojson.py</a>.
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
<a href="<?= deHttps($api_url).'?' ?>" target="_blank"><?= deHttps($api_url) ?>?</a>
</pre>
This API uses the same parameter (address) as the Google API.
This API also has no rate limit so you can test as often as you like.
If you visit the URL with no parameters, you get "No address..." response.
</p>
<p>
To call the API, you need to include a <b>key=</b> parameter and provide the
address that you are requesting as the <b>address=</b> parameter that is
properly URL encoded using the <b>urllib.parse.urlencode()</b> function as shown in
<a href="http://www.py4e.com/code3/geojson.py"
target="_blank">http://www.py4e.com/code3/geojson.py</a>
</p>
<p>
Make sure to check that your code is using the API endpoint is as shown above.
You will get <em>different</em> results from the <b>geojson</b> and <b>json</b>
endpoints so make sure you are using the same end point as this autograder is using.
<p>
<?php httpsWarning($api_url); ?>
<p><b>Test Data / Sample Execution</b></p>
<p>
You can test to see if your program is working with a
location of "<?= $sample_location ?>" which will have a
<b>place_id</b> of "<?= $sample_place ?>".
<pre>
$ python3 solution.py
Enter location: <?= $sample_location . "\n" ?>
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
