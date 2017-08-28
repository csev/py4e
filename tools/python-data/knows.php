<?php

require_once('data/data_util.php');

use \Tsugi\Core\LTIX;
use \Tsugi\Util\LTI;
use \Tsugi\Util\Mersenne_Twister;


// py4e-data.dr-chuck.net is 64 bit

if ( PHP_INT_SIZE == 8 ) {
    $GLOBAL_PYTHON_DATA_URL = "http://py4e-data.dr-chuck.net/";
} else {
    $GLOBAL_PYTHON_DATA_URL = false; // To serve locally
}

$sanity = array(
  'urllib' => 'You should use urllib to retrieve the HTML Pages',
  'BeautifulSoup' => 'You should use BeautifulSoup to parse the HTML'
);

// Compute the stuff for the output
$sample_pages = 4;
$sample_pos = 2;
$actual_pages = 7;
$actual_pos = 17;

$code = 12345;
$sample_names = array();
$names = getShuffledNames($code);
$name = $names[$sample_pos];
$sample_names[] = $name;
for($p=0;$p<$sample_pages;$p++) {
    $code = array_search($name, $NAMES);
    $names = getShuffledNames($code);
    $name = $names[$sample_pos];
    $sample_last = $name;
    $sample_names[] = $name;
}

if ( isset($_SESSION['debug']) && is_string($_SESSION['debug']) ) {
    $code = array_search($_SESSION['debug'], $NAMES);
    $name = $_SESSION['debug'];
} else {
    $code = $USER->id+$LINK->id+$CONTEXT->id;
    $names = getShuffledNames($code);
    $name = $names[$actual_pos];
}
$actual_names = array();
$actual_names[] = $name;
for($p=0;$p<$actual_pages;$p++) {
    $code = array_search($name, $NAMES);
    $names = getShuffledNames($code);
    $name = $names[$actual_pos];
    $actual_last = $name;
    $actual_names[] = $name;
}

$oldgrade = $RESULT->grade;
if ( isset($_POST['name']) && isset($_POST['code']) ) {
    if ( $USER->instructor && strpos($_POST['name'],'42') === 0 ) {
        $pieces = explode(',',$_POST['name']);
        $_SESSION['success'] = "Debug Mode Unlocked";
        if ( count($pieces) == 2 ) {
            $_SESSION['debug'] = $pieces[1];
        } else {
            $_SESSION['debug'] = true;
        }
        header('Location: '.addSession('index.php'));
        return;
    }

    $RESULT->setJsonKey('code', $_POST['code']);

    if ( $_POST['name'] != $actual_last ) {
        $_SESSION['error'] = "Your name did not match";
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

if ( $RESULT->grade > 0 ) {
    echo('<p class="alert alert-info">Your current grade on this assignment is: '.($RESULT->grade*100.0).'%</p>'."\n");
}

if ( $dueDate->message ) {
    echo('<p style="color:red;">'.$dueDate->message.'</p>'."\n");
}
$sample_url = dataUrl('known_by_'.$sample_names[0].'.html');
$actual_url = dataUrl('known_by_'.$actual_names[0].'.html');
?>
<p>
<b>Following Links in Python</b>
<p>
In this assignment you will write a Python program that expands on
<a href="http://www.py4e.com/code3/urllinks.py" target="_blank">http://www.py4e.com/code3/urllinks.py</a>.
The program will use <b>urllib</b> to read the HTML from the data files below,
extract the href= vaues from the anchor tags, scan for a tag that is in
a particular position relative to the first name in the list,
follow that link and repeat the process
a number of times and report the last name you find.
</p>
<p>
We provide two files for this assignment.  One is a sample file where we give
you the name for your testing and the other is the actual data you need
to process for the assignment
<ul>
<li> Sample problem: Start at
<a href="<?= deHttps($sample_url) ?>" target="_blank"><?= deHttps($sample_url) ?></a> <br/>
Find the link at position <b><?= $sample_pos+1 ?></b> (the first name is 1).
Follow that link.  Repeat this process <b><?= $sample_pages ?></b> times.  The
answer is the last name that you retrieve.<br/>
Sequence of names:
<?php
    foreach($sample_names as $name) {
        echo($name.' ');
    }
    echo("<br/>\n");
?>
Last name in sequence: <?= $sample_last ?><br/>
</li>
<li> Actual problem: Start at: <a href="<?= deHttps($actual_url) ?>" target="_blank"><?= deHttps($actual_url) ?></a> <br/>
Find the link at position <b><?= $actual_pos+1 ?></b> (the first name is 1).
Follow that link.  Repeat this process <b><?= $actual_pages ?></b> times.  The
answer is the last name that you retrieve.<br/>
Hint: The first character of the name of the last page
that you will load is: <?= substr($actual_last,0,1) ?><br/>
<?php
if ( isset($_SESSION['debug']) ) {
    echo("<pre>\n");
    echo("Debug sequence of names: \n");
    foreach($actual_names as $name) {
        echo("  $name\n");
    }
    echo("</pre>\n");
}
?>
</li>
</ul>
<b>Strategy</b>
<p>
The web pages tweak the height between the links and hide the page after a few seconds
to make it difficult for you to do the assignment without writing a Python program.
But frankly with a little effort and patience you can overcome these attempts to make it
a little harder to complete the assignment without writing a Python program.
But that is not the point.   The point is to write a clever Python program to solve the
program.
</p>
<p><b>Sample execution</b>
<p>
Here is a sample execution of a solution:
<pre>
$ python3 solution.py
Enter URL: <?= dataUrl('known_by_Fikret.html')."\n"; ?>
Enter count: 4
Enter position: 3
Retrieving: <?= dataUrl('known_by_Fikret.html')."\n"; ?>
Retrieving: <?= dataUrl('known_by_Montgomery.html')."\n"; ?>
Retrieving: <?= dataUrl('known_by_Mhairade.html')."\n"; ?>
Retrieving: <?= dataUrl('known_by_Butchi.html')."\n"; ?>
Retrieving: <?= dataUrl('known_by_Anayah.html')."\n"; ?>
</pre>
The answer to the assignment for this execution is "Anayah".
</p>
<?php httpsWarning($sample_url); ?>
<p><b>Turning in the Assignment</b>
<form method="post">
Enter the last name retrieved and your Python code below:<br/>
Name: <input type="text" size="20" name="name">
(name starts with <?= substr($actual_last,0,1) ?>)
<input type="submit" value="Submit Assignment"><br/>
<?php
if ( $USER->instructor ) {
    echo("<b>Instructor Note:</b> If you want to test a student's data enter '42,Viki' with with starting name of the student's actual data.<br/>");
}
?>
Python code:<br/>
<textarea rows="20" style="width: 90%" name="code"></textarea><br/>
</form>
