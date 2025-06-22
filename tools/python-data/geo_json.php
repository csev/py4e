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

// Compute the stuff for the output
$code = 42;
$sample = load_opengeo(42, $api_url);
$sample_location = $sample[0];
$sample_plus = $sample[1];
$sample_count = $sample[2];
$sample_url = $sample[3];

$code = $USER->id+$LINK->id+$CONTEXT->id;
$actual = load_opengeo($code, $api_url);
$actual_location = $actual[0];
$actual_place = $actual[1];
$actual_count = $actual[2];
$actual_url = $actual[3];

$oldgrade = $RESULT->grade;
if ( isset($_POST['plus_code']) && isset($_POST['code']) ) {
    $RESULT->setJsonKeys( array(
        'code' => $_POST['code'],
        'plus_code' => $_POST['plus_code'],
        'actual_url' => $actual_url,
        'actual_place' => $actual_place
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
Retrieving http://...
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
plus_code: <input type="text" size="40" name="plus_code">
<input type="submit" value="Submit Assignment"><br/>
Python code:<br/>
<textarea rows="20" style="width: 90%" name="code"></textarea><br/>
</form>
