<?php

use \Tsugi\Core\LTIX;
use \Tsugi\Util\LTI;
use \Tsugi\Util\Mersenne_Twister;

$MAX_UPLOAD_FILE_SIZE = 1024*1024;

require_once "sql_util.php";


$answer = array(
"iupui.edu" => 536,
"umich.edu" => 491,
"indiana.edu" => 178,
"caret.cam.ac.uk" => 157,
"vt.edu" => 110
);

$oldgrade = $RESULT->grade;

if ( isset($_FILES['database']) ) {
    $fdes = $_FILES['database'];

    // Check to see if they left off the file
    if( $fdes['error'] == 4) {
        $_SESSION['error'] = 'Missing file, make sure to select a file before pressing submit';
        header( 'Location: '.addSession('index.php') ) ;
        return;
    }

    if ( $fdes['size'] > $MAX_UPLOAD_FILE_SIZE ) {
        $_SESSION['error'] = "Uploaded file must be < ".$OUTPUT->displaySize($MAX_UPLOAD_FILE_SIZE);
        header( 'Location: '.addSession('index.php') ) ;
        return;
    }

    if ( ! endsWith($fdes['name'],'.sqlite') ) {
        $_SESSION['error'] = "Uploaded file must have .sqlite suffix: ".$fdes['name'];
        header( 'Location: '.addSession('index.php') ) ;
        return;
    }

    if ( ! isset($fdes['tmp_name']) ) {
        $_SESSION['error'] = "Could not find file on server: ".$fdes['name'];
        header( 'Location: '.addSession('index.php') ) ;
        return;
    }

    if ( strlen($fdes['tmp_name']) < 1 ) {
        $_SESSION['error'] = "Temporary name not found: ".$fdes['name'];
        header( 'Location: '.addSession('index.php') ) ;
        return;
    }

    $file = $fdes['tmp_name'];

    $fh = fopen($file,'r');
    $prefix = fread($fh, 100);
    fclose($fh);
    if ( ! startsWith($prefix,'SQLite format 3') ) {
        $_SESSION['error'] = "Uploaded file is not SQLite3 format: ".$fdes['name'];
        header( 'Location: '.addSession('index.php') ) ;
        return;
    }

    $results = false;
    try {
        $db = new SQLite3($file, SQLITE3_OPEN_READONLY);
        $results = @$db->query('SELECT org, count FROM Counts 
            ORDER BY count DESC LIMIT 5');
    } catch(Exception $ex) {
        $_SESSION['error'] = "SQL Error: ".$ex->getMessage();
        header( 'Location: '.addSession('index.php') ) ;
        return;
    }

    if ( $results === false ) {
        $_SESSION['error'] = "SQL Query Error: ".$db->lastErrorMsg();
        header( 'Location: '.addSession('index.php') ) ;
        return;
    }

    $good = 0;

    while ($row = $results->fetchArray()) {
        $row[0] = trim($row[0]);
        if ( !isset($answer[$row[0]]) ) continue;
        if ( $answer[$row[0]] != $row[1] ) continue;
        $good++;
    }

    if ( $good < 5 ) {
        $_SESSION['error'] = "Data is incorrect: ".$fdes['name'];
        header( 'Location: '.addSession('index.php') ) ;
        return;
    }

    $gradetosend = 1.0;
    $scorestr = "Your answer is correct, score saved.";
    if ( $dueDate->penalty > 0 ) {
        $gradetosend = $gradetosend * (1.0 - $dueDate->penalty);
        $scorestr = "Effective Score = $gradetosend after ".$dueDate->penalty*100.0." percent late penalty";
    }
    if ( $oldgrade > $gradetosend ) {
        $scorestr = "New score of $gradetosend is < than previous grade of $oldgrade, previous grade kept";
        $gradetosend = $oldgrade;
    }

    // Use LTIX to send the grade back to the LMS.
    $debug_log = array();
    $retval = LTIX::gradeSend($gradetosend, false, $debug_log);
    $_SESSION['debug_log'] = $debug_log;

    if ( $retval === true ) {
        $_SESSION['success'] = $scorestr;
    } else if ( is_string($retval) ) {
        $_SESSION['error'] = "Grade not sent: ".$retval;
    } else {
        echo("<pre>\n");
        var_dump($retval);
        echo("</pre>\n");
        die();
    }

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
?>
<p>
<form name="myform" enctype="multipart/form-data" method="post" >
To get credit for this assignment, perform the instructions below and 
upload your SQLite3 database here:<br/>
<input name="database" type="file"> 
(Must have a .sqlite suffix)<br/>
Hint: The top organizational count is <?= $answer['iupui.edu'] ?>.<br/>
<input type="submit">
<p>
You do not need to export or convert the database -  simply upload 
the <b>.sqlite</b> file that your program creates.  See the example code for
the use of the <b>connect()</b> statement.
</p>
</form>
</p>
<h1>Counting Organizations</h1>
<p>
This application will read the mailbox data (mbox.txt) and count the
number of email messages per organization (i.e. domain name of the email
address) using a database with the following schema to maintain the counts.
<pre>
CREATE TABLE Counts (org TEXT, count INTEGER)
</pre>
When you have run the program on <b>mbox.txt</b> upload the resulting
database file above for grading.
</p>
<p>
If you run the program multiple times in testing or with dfferent files, 
make sure to empty out the data before each run.
<p>
You can use this code as a starting point for your application:
<a href="http://www.py4e.com/code3/emaildb.py" target="_blank">
http://www.py4e.com/code3/emaildb.py</a>.
</p>
<p>
The data file for this application is the same as in previous assignments:
<a href="http://www.py4e.com/code3/mbox.txt" target="_blank">
http://www.py4e.com/code3/mbox.txt</a>.
</p>
<p>
Because the sample code is using an <b>UPDATE</b> statement
and committing the results to the database as each record
is read in the loop, it might take as long as a few minutes to process
all the data.  The commit insists on completely writing all the
data to disk every time it is called.
</p>
<p>
The program can be speeded up greatly by moving the commit operation
outside of the loop.  In any database program, there is a balance
between the number of operations you execute between commits and the
importance of not losing the results of operations that have
not yet been committed.
</p>
