<?php

require_once('data/data_util.php');

use \Tsugi\Core\LTIX;
use \Tsugi\Util\LTI;

$sanity = array(
  'urllib' => 'You should use urllib to retrieve the data from the URL',
  'json' => 'You should use json to parse the data retrieved from the URL'
);

// A random code
$code = $USER->id+$LINK->id+$CONTEXT->id;

// Set the data URLs
$sample_url = dataUrl('comments_42.json');
$actual_url = dataUrl('comments_'.$code.'.json');

// Compute the sum data
$json = getJsonOrDie(dataUrl('comments_42.json'));
$sum_sample = sumCommentJson($json);

$json = getJsonOrDie(dataUrl('comments_'.$code.'.json'));
$sum = sumCommentJson($json);

$oldgrade = $RESULT->grade;
if ( isset($_POST['sum']) && isset($_POST['code']) ) {
    $RESULT->setJsonKey('code', $_POST['code']);

    if ( $_POST['sum'] != $sum ) {
        $_SESSION['error'] = "Your sum did not match";
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
<b>Extracting Data from JSON</b>
<p>
In this assignment you will write a Python program somewhat similar to
<a href="http://www.py4e.com/code3/json2.py" target="_blank">http://www.py4e.com/code3/json2.py</a>.
The program will prompt for a URL, read the JSON data from that URL using
<b>urllib</b> and then parse and extract the comment counts from the JSON data,
compute the sum of the numbers in the file and enter the sum below:<br/>
</p>
<p>
We provide two files for this assignment.  One is a sample file where we give you the sum for your
testing and the other is the actual data you need to process for the assignment.
<ul>
<li> Sample data: <a href="<?= deHttps($sample_url) ?>" target="_blank"><?= deHttps($sample_url) ?></a>
(Sum=<?= $sum_sample ?>) </li>
<li> Actual data: <a href="<?= deHttps($actual_url) ?>" target="_blank"><?= deHttps($actual_url) ?></a>
(Sum ends with <?= $sum%100 ?>)<br/> </li>
</ul>
You do not need to save these files to your folder since your
program will read the data directly from the URL.
<b>Note:</b> Each student will have a distinct data url for the assignment - so only use your
own data url for analysis.
</p>
<b>Data Format</b>
<p>
The data consists of a number of names and comment counts in JSON as follows:
<pre>
{
  comments: [
    {
      name: "Matthias"
      count: 97
    },
    {
      name: "Geomer"
      count: 97
    }
    ...
  ]
}
</pre>
<p>
The closest sample code that shows how to parse JSON and extract a list is
<a href="http://www.py4e.com/code3/json2.py" target="_blank">json2.py</a>.  You might also want
to look at
<a href="http://www.py4e.com/code3/geoxml.py" target="_blank">geoxml.py</a>
to see how to prompt for a URL and retrieve data from a URL.
</p>
<p><b>Sample Execution</b></p>
<pre>
$ python3 solution.py
Enter location: http://py4e-data.dr-chuck.net/comments_42.json
Retrieving http://py4e-data.dr-chuck.net/comments_42.json
Retrieved 2733 characters
Count: 50
Sum: 2...
</pre>
<?php httpsWarning($sample_url); ?>
<p><b>Turning in the Assignment</b>
<form method="post">
Enter the sum from the actual data and your Python code below:<br/>
Sum: <input type="text" size="20" name="sum">
(ends with <?= $sum%100 ?>)
<input type="submit" value="Submit Assignment"><br/>
Python code:<br/>
<textarea rows="20" style="width: 90%" name="code"></textarea><br/>
</form>

