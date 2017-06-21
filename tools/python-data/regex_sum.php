<?php

use \Tsugi\Core\LTIX;
use \Tsugi\Util\LTI;
use \Tsugi\Util\Net;

$sanity = array(
  're.findall' => 'You should use re.findall() to extract the numbers'
);

// Compute the stuff for the output
$code = $USER->id+$LINK->id+$CONTEXT->id;

$sample_url = dataUrl('regex_sum_42.txt');
$actual_url = dataUrl('regex_sum_'.$code.'.txt');

$sample_data = Net::doGet($sample_url);
$sample_count = strlen($sample_data);
$response = Net::getLastHttpResponse();
if ( $response != 200 ) {
    die("Response=$response url=$sample_url");
}

$actual_data = Net::doGet($actual_url);
$actual_count = strlen($actual_data);
$response = Net::getLastHttpResponse();
if ( $response != 200 ) {
    die("Response=$response url=$actual_url");
}

$actual_matches = array();
preg_match_all('/[0-9]+/',$actual_data,$actual_matches);
$actual_count = count($actual_matches[0]);
$actual_sum = 0;
foreach($actual_matches[0] as $match ) {
    $actual_sum = $actual_sum + $match;
}

$sample_matches = array();
preg_match_all('/[0-9]+/',$sample_data,$sample_matches);
$sample_count = count($sample_matches[0]);
$sample_sum = 0;
foreach($sample_matches[0] as $match ) {
    $sample_sum = $sample_sum + $match;
}

$oldgrade = $RESULT->grade;
if ( isset($_POST['sum']) && isset($_POST['code']) ) {
    $RESULT->setJsonKey('code', $_POST['code']);

    if ( $_POST['sum'] != $actual_sum ) {
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
<b>Finding Numbers in a Haystack</b>
<p>
In this assignment you will read through and parse a file with text and numbers.  You will extract all the numbers
in the file and compute the sum of the numbers.
</p>
<b>Data Files</b>
<p>
We provide two files for this assignment.  One is a sample file where we give you the sum for your
testing and the other is the actual data you need to process for the assignment.  
<ul>
<li> Sample data: <a href="<?= deHttps($sample_url) ?>" target="_blank"><?= deHttps($sample_url) ?></a> 
(There are <?= $sample_count ?> values with a sum=<?= $sample_sum ?>) </li>
<li> Actual data: <a href="<?= deHttps($actual_url) ?>" target="_blank"><?= deHttps($actual_url) ?></a> 
(There are <?= $actual_count ?> values and the sum ends with <?= $actual_sum%1000 ?>)<br/> </li>
</ul>
These links open in a new window.
Make sure to save the file into the same folder as you will be writing your Python program.
<b>Note:</b> Each student will have a distinct data file for the assignment - so only use your
own data file for analysis.
</p>
<b>Data Format</b>
<p>
The file contains much of the text from the introduction of the textbook
except that random numbers are inserted throughout the text.  Here is a sample of the output you might see:
<pre>
Why should you learn to write programs? 7746
12 1929 8827
Writing programs (or programming) is a very creative 
7 and rewarding activity.  You can write programs for 
many reasons, ranging from making your living to solving
8837 a difficult data analysis problem to having fun to helping 128
someone else solve a problem.  This book assumes that 
everyone needs to know how to program ...
</pre>
The sum for the sample text above is <b>27486</b>.
The numbers can appear anywhere in the line.  There can be any number of 
numbers in each line (including none).
</p>
<b>Handling The Data</b>
<p>
The basic outline of this problem is to read the file, look for integers using the
<b>re.findall()</b>, looking for a regular expression of <b>'[0-9]+'</b> and then 
converting the extracted strings to integers and summing up the integers.
</p>
<p>
<?php httpsWarning($sample_url); ?>
<b>Turn in Assignent</b>
<form method="post">
Enter the sum from the actual data and your Python code below:<br/>
Sum: <input type="text" size="20" name="sum"> (ends with <?= $actual_sum%1000 ?>)
<input type="submit" value="Submit Assignment"><br/>
Python code:<br/>
<textarea rows="20" style="width: 90%" name="code"></textarea><br/>
</form>
</p>
<b>Optional: Just for Fun</b>
<p>
There are a number of different ways to approach this problem.  While we don't recommend trying
to write the most compact code possible, it can sometimes be a fun exercise.  Here is a 
a redacted version of two-line version of this program using list comprehension:
<pre>
Python 2
import re
print sum( [ ****** *** * in **********('[0-9]+',**************************.read()) ] )

Python 3:
import re
print( sum( [ ****** *** * in **********('[0-9]+',**************************.read()) ] ) )
</pre>
Please don't waste a lot of time trying to figure out the shortest solution until you 
have completed the homework.   List comprehension is mentioned in Chapter 10 and the 
<b>read()</b> method is covered in Chapter 7.
</p>

