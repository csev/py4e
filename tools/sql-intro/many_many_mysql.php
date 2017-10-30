<?php

use \Tsugi\Core\LTIX;
use \Tsugi\Util\LTI;
use \Tsugi\Util\Mersenne_Twister;

$MAX_UPLOAD_FILE_SIZE = 1024*1024;

require_once "sql_util.php";

$oldgrade = $RESULT->grade;

// Compute the stuff for the output
$code = $USER->id+$LINK->id+$CONTEXT->id;
$roster = makeRoster($code,3,5);

function compare_func($a, $b) {
    // Course
    if ( $a[1] < $b[1] ) return -1;
    if ( $a[1] > $b[1] ) return 1;
    // Role (1 comes first)
    if ( $a[2] < $b[2] ) return 1;
    if ( $a[2] > $b[2] ) return -1;
    // User
    if ( $a[0] < $b[0] ) return -1;
    if ( $a[0] > $b[0] ) return 1;
    return 0;
}

usort($roster,"compare_func");

if ( isset($_FILES['json']) ) {
    $fdes = $_FILES['json'];

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

    if ( ! endsWith($fdes['name'],'.json') ) {
        $_SESSION['error'] = "Uploaded file must have .json suffix: ".$fdes['name'];
        header( 'Location: '.addSession('index.php') ) ;
        return;
    }
    $file = $fdes['tmp_name'];
    $data = file_get_contents($file);
    $tables = load_mysql_json_export($data);
    if ( is_string($tables) ) {
        $_SESSION['error'] = $tables;
        header( 'Location: '.addSession('index.php') ) ;
        return;
    }

    if ( isset($tables['user']) && isset($tables['course']) && isset($tables['member']) ) {
        // OK
    } else {
        $_SESSION['error'] = "Expecting user, course, and member tables";
        header( 'Location: '.addSession('index.php') ) ;
        return;
    }

    if ( isset($tables['user_table']) && isset($tables['course_table']) ) {
        // OK
    } else {
        $_SESSION['error'] = "Expecting user and course tables to have primary keys like user_id";
        header( 'Location: '.addSession('index.php') ) ;
        return;
    }

    // echo("<pre>\n");print_r($tables);echo("</pre>\n");
    $_SESSION['tables'] = $tables;  // For later debugging

    // Pull out the bits we need
    $course_table = $tables['course_table'];
    $user_table = $tables['user_table'];
    $member = $tables['member'];

    // Run the joins...
    $new = array();
    foreach($member as $m) {
        if ( isset($m['course_id']) && isset($m['user_id']) && isset($m['role']) ) {
            // Good
        } else {
            $_SESSION['error'] = 'Could not find user_id, course_id, or role in member table';
            header( 'Location: '.addSession('index.php') ) ;
            return;
        }
        $user_id = $m['user_id'];
        $course_id = $m['course_id'];
        $role = $m['role'];
        if ( !isset($user_table[$user_id]) ) {
            $_SESSION['error'] = "Could not find user with user_id=$user_id";
            header( 'Location: '.addSession('index.php') ) ;
            return;
        }
        if ( !isset($course_table[$course_id]) ) {
            $_SESSION['error'] = "Could not find course with course_id=$course_id";
            header( 'Location: '.addSession('index.php') ) ;
            return;
        }
        $new[] = array(trim($user_table[$user_id]['name']), trim($course_table[$course_id]['title']), $role);
    }

    usort($new,"compare_func");
    // echo("\n<pre>\n"); print_r($new); echo("\n</pre>\n"); die();

    // Check the lengths of the array
    $msg = '';
    if ( count($roster) != count($new) ) {
        $msg = "Expecting ".count($roster)." rows, found ".count($new)." rows. ";
    }

    // Compare the arrays
    for($i=0; $i<max(count($roster),count($new)); $i++) {
        if ( $i > count($roster)-1 ) {
            $_SESSION['error'] = "Your submitted file had > ".count($roster)." membership records.";
            header( 'Location: '.addSession('index.php') ) ;
            return;
        }
        if ( $i > count($new)-1 ) {
            $_SESSION['error'] = "Your submitted file had < ".count($roster)." membership records.";
            header( 'Location: '.addSession('index.php') ) ;
            return;
        }

        if ( $roster[$i] == $new[$i] ) continue;

        $_SESSION['error'] = $msg."Expecting row ".($i+1)." to be (" .
          $roster[$i][0].", ".$roster[$i][1].", ".$roster[$i][2].") " .
          "Found (".$new[$i][0].", ".$new[$i][1].", ".$new[$i][2].")";
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
upload your JSON export of the resulting database here: <br/>
<input name="json" type="file"> 
(Must have a .json suffix)<br/>
<input type="submit">
</p>
</form>
</p>
<h1>Tables for the Assignment</h1>
<p>
Create the following tables in a database named "roster".  Make sure that 
your database and tables are named exactly as follows including matching case.
<pre>
DROP TABLE IF EXISTS Member;
DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Course;

CREATE TABLE User (
    user_id     INTEGER NOT NULL AUTO_INCREMENT KEY,
    name        VARCHAR(128) UNIQUE
) ENGINE=InnoDB CHARACTER SET=utf8;

CREATE TABLE Course (
    course_id     INTEGER NOT NULL AUTO_INCREMENT KEY,
    title         VARCHAR(128) UNIQUE
) ENGINE=InnoDB CHARACTER SET=utf8;

CREATE TABLE Member (
    user_id       INTEGER,
    course_id     INTEGER,
    role          INTEGER,

    CONSTRAINT FOREIGN KEY (user_id) REFERENCES User (user_id)
      ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (course_id) REFERENCES Course (course_id)
       ON DELETE CASCADE ON UPDATE CASCADE,

    PRIMARY KEY (user_id, course_id)
) ENGINE=InnoDB CHARACTER SET=utf8;
</pre>
<h1>Course Data</h1>
<p>
You will normalize the following data (each user gets different data), and insert 
the following data items into your database, creating and linking all the 
foreign keys properly.  Encode instructor with a role of 1 and a learner with a role
of 0.
<pre>
<?php
foreach($roster as $entry) {
    $role = $entry[2] == 1 ? 'Instructor' : 'Learner';
    echo "$entry[0], $entry[1], $role\n";
}
?>
</pre>
</p>
<p>
You can test to see if your data has been entered properly with the following
SQL statement.
<pre>
SELECT User.name, Course.title, Member.role
    FROM User JOIN Member JOIN Course 
    ON User.user_id = Member.user_id AND Member.course_id = Course.course_id 
    ORDER BY Course.title, Member.role DESC, User.name
</pre>
The order of the data and number of rows that comes back from this query should be the 
same as above.  There should be no missing or extra data in your query.
</p>
<h1>What Turn In</h1>
<p>
When you have the data all inserted, use phpMyAdmin to Export the data as follows:
<ul>
<li>Select the database (do not select a table within the database)</li>
<li>Select the Export Tab</li>
<li>Select "Custom - display all possible options"</li>
<li>Select "Save output to a file"</li>
<li>Set the format to JSON</li>
<li>Leave everything else as default and run the export.</li>
</ul>
The output will be on a file named "roster.json" that should look like the following:
<pre>
/**
 Export to JSON plugin for PHPMyAdmin
 @version 0.1
 */

// Database 'roster'
// roster.Course

[{"course_id":"6","title":"si106"}, ... }]// roster.Member

[{"user_id":"1","course_id":"1","role":"1"}, ... }]// roster.User

[{"user_id":"15","name":"Areez"}, ... }]
</pre>
It is a somewhat strange format - it is one bit of JSON for each table.  You don't need 
to edit or even look at this file.  Simply upload it above.
</p>
<?php
if ( ! $USER->instructor ) {
    $OUTPUT->footer();
    return;
}
?>
<h1>Instructor Only Debug</h1>
Here is a set of insert statements to achieve this assignment.
<pre>
<?php
foreach($roster as $entry) {
    echo "INSERT IGNORE INTO User (name) VALUES ('$entry[0]');\n";
    echo "INSERT IGNORE INTO Course (title) VALUES ('$entry[1]');\n";
    echo "INSERT IGNORE INTO Member (user_id,course_id,role) VALUES
        ( (SELECT user_id FROM User WHERE name='$entry[0]') , 
          (SELECT course_id FROM Course WHERE title='$entry[1]') , $entry[2] );\n";
}
?>
</pre>
</p>
<?php
$OUTPUT->footer();
