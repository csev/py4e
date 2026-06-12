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

$api_url = dataUrl('opengeo');

// Sample data (code 42) - live API call
$sample = load_opengeo(42, $api_url);
$sample_location = $sample[0];
$sample_plus = $sample[1];
$sample_count = $sample[2];
$sample_url = $sample[3];

$code = $USER->id+$LINK->id+$CONTEXT->id;

if ( $USER->instructor && isset($_GET['clear_location']) ) {
    unset($_SESSION['geo_json_instructor_location']);
}

if ( $USER->instructor && array_key_exists('instructor_location', $_POST) ) {
    $override_location = trim($_POST['instructor_location']);
    if ( strlen($override_location) > 0 ) {
        $_SESSION['geo_json_instructor_location'] = $override_location;
    } else {
        unset($_SESSION['geo_json_instructor_location']);
    }
}

function geo_json_assignment_location($code, $USER) {
    if ( $USER->instructor && isset($_SESSION['geo_json_instructor_location']) ) {
        return $_SESSION['geo_json_instructor_location'];
    }
    return pick_location($code);
}

$actual_location = geo_json_assignment_location($code, $USER);

$oldgrade = $RESULT->grade;
if ( array_key_exists('plus_code', $_POST) && array_key_exists('code', $_POST) ) {

    $_SESSION['geo_json_post'] = array(
        'code' => $_POST['code'] ?? '',
        'plus_code' => $_POST['plus_code'] ?? '',
    );

    // Re-query the API at grading time so we match what the student sees
    $grade_location = geo_json_assignment_location($code, $USER);
    $actual = lookup_opengeo($grade_location, $api_url);
    $actual_place = $actual[1];
    $actual_url = $actual[3];

    $RESULT->setJsonKeys( array(
        'code' => $_POST['code'],
        'plus_code' => $_POST['plus_code'],
        'actual_url' => $actual_url,
        'actual_place' => $actual_place,
        'actual_location' => $grade_location
    ));

    if ( $_POST['plus_code'] != $actual_place ) {
        $_SESSION['error'] = "Your plus_code did not match";
        if ( $USER->instructor ) $_SESSION['error'] = "Your plus_code '".$_POST['plus_code']."' did not match $actual_place";
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

$post_code = '';
$post_plus_code = '';
if ( isset($_SESSION['geo_json_post']) ) {
    $post_code = $_SESSION['geo_json_post']['code'] ?? '';
    $post_plus_code = $_SESSION['geo_json_post']['plus_code'] ?? '';
    unset($_SESSION['geo_json_post']);
}

// Live API lookup for page display (same endpoint students use)
$actual = lookup_opengeo($actual_location, $api_url);
$actual_place = $actual[1];
$actual_count = $actual[2];
$actual_url = $actual[3];

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
<a href="http://www.py4e.com/code3/opengeo.py" target="_blank">http://www.py4e.com/code3/opengeo.py</a>.
The program will prompt for a location, contact a web service and retrieve
JSON for the web service and parse that data, and retrieve the first
<b>plus_code</b> from the JSON.
An
<a href="https://en.wikipedia.org/wiki/Open_Location_Code" target="_blank">Open Location Code</a>
is a textual identifier that is another form of address based on the location of the address.
</p>
<p>
<b>API End Points</b>
</p>
<p>
To complete this assignment, you should use this API endpoint that has a static subset
of the Open Street Map Data.
<pre>
<a href="<?= deHttps($api_url).'?' ?>" target="_blank"><?= deHttps($api_url) ?>?</a>
</pre>
This API also has no rate limit so you can test as often as you like.
If you visit the URL with no parameters, you get "No address..." response.
</p>
<p>
To call the API, you need to provide the
address that you are requesting as the <b>q=</b> parameter that is
properly URL encoded using the <b>urllib.parse.urlencode()</b> function as shown in
<a href="http://www.py4e.com/code3/opengeo.py"
target="_blank">http://www.py4e.com/code3/opengeo.py</a>
</p>
<p>
<?php httpsWarning($api_url); ?>
<p><b>Test Data / Sample Execution</b></p>
<p>
You can test to see if your program is working with a
location of "<?= $sample_location ?>" which will have a
<b>plus_code</b> of "<?= $sample_plus ?>".
<pre>
$ python solution.py
Enter location: <?= $sample_location . "\n" ?>
Retrieving <?= deHttps($sample_url) . "\n" ?>
Retrieved <?= $sample_count ?> characters
Plus code <?= $sample_plus ?>
</pre>
</p>
<p><b>Turn In</b></p>
<p>
Please run your program to find the <b>plus_code</b> for this location:
<pre>
<?= $actual_location ?>
</pre>
Make sure to enter the name and case exactly as above
and enter the <b>plus_code</b> and your Python code below.
Hint: The first five characters of the <b>plus_code</b>
are "<?= substr($actual_place,0,5) ?> ..."<br/>
</p>
<p>
Make sure to retreive the data from the URL specified above and <b>not</b> the
normal Google API.  Your program should work with the Google API - but the
<b>plus_code</b> may not match for this assignment.
</p>
<form method="post">
<?php if ( $USER->instructor ) { ?>
<p><b>Instructor:</b> Paste the student's location below to replicate their assignment.
<?php if ( isset($_SESSION['geo_json_instructor_location']) ) { ?>
(<a href="<?= addSession('index.php?clear_location=1') ?>">use my location</a>)
<?php } ?>
</p>
Location Override: <input type="text" size="60" name="instructor_location" value="<?= htmlentities($actual_location) ?>"><br/>
<?php } ?>
plus_code: <input type="text" size="40" name="plus_code" value="<?= htmlspecialchars($post_plus_code, ENT_QUOTES) ?>">
<input type="submit" value="Submit Assignment"><br/>
Python code:<br/>
<textarea rows="20" style="width: 90%" name="code"><?= htmlspecialchars($post_code, ENT_QUOTES) ?></textarea><br/>
</form>
<?php
$retrieval_output = "Retrieving ".deHttps($actual_url)."\n"
    ."Retrieved ".$actual_count." characters\n"
    ."Plus code ".$actual_place;
if ( $USER->instructor ) {
    echo("<pre>\n".htmlspecialchars($retrieval_output)."\n</pre>\n");
} else {
    echo("<!--\n".htmlspecialchars($retrieval_output)."\n-->\n");
}
?>
<script>
console.log(<?= json_encode('py4e opengeo: Easter Egg greetings from Dr. Chuck\'s data server') ?>);
console.log(<?= json_encode('Retrieving '.deHttps($actual_url)) ?>);
console.log(<?= json_encode('Retrieved '.$actual_count.' characters') ?>);
console.log(<?= json_encode('Plus code '.$actual_place) ?>);
</script>
