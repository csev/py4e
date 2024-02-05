<?php

use \Tsugi\Core\LTIX;
use \Tsugi\Util\LTI;
use \Tsugi\Util\Mersenne_Twister;

$MAX_UPLOAD_FILE_SIZE = 1024*1024;

require_once "sql_util.php";


$answer = array(
  array(
    "Chase the Ace",
    "AC/DC",
    "Who Made Who",
    "Rock"
  ),
  array(
    "D.T.",
    "AC/DC",
    "Who Made Who",
    "Rock"
  ),
  array(
    "For Those About To Rock (We Salute You)",
    "AC/DC",
    "Who Made Who",
    "Rock"
  )
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
        $results = @$db->query("
            SELECT Track.title, Artist.name, Album.title, Genre.name
                FROM Track JOIN Genre JOIN Album JOIN Artist
                ON Track.genre_id = Genre.ID and Track.album_id = Album.id
                    AND Album.artist_id = Artist.id
                ORDER BY Artist.name LIMIT 3");
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
    $pos = 0;
    while ($row = $results->fetchArray()) {
        $ans = $answer[$pos];
        foreach($ans as $i => $txt ) {
            if ($row[$i] != $txt ) break;
        }
        $good++;
        $pos++;
    }

    if ( $good < 3 ) {
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
upload your SQLite3 database here: <br/>
<input name="database" type="file"> 
(Must have a .sqlite suffix)<br/>
<input type="submit">
<p>
You do not need to export or convert the database -  simply upload 
the <b>.sqlite</b> file that your program creates.  See the example code for
the use of the <b>connect()</b> statement.
</p>
</form>
</p>
<h1>Musical Track Database</h1>
<p>
This application will read an iTunes export file in XML and produce a properly
normalized database with this structure:
<pre>
CREATE TABLE Artist (
    id  INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    name    TEXT UNIQUE
);

CREATE TABLE Genre (
    id  INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    name    TEXT UNIQUE
);

CREATE TABLE Album (
    id  INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    artist_id  INTEGER,
    title   TEXT UNIQUE
);

CREATE TABLE Track (
    id  INTEGER NOT NULL PRIMARY KEY 
        AUTOINCREMENT UNIQUE,
    title TEXT  UNIQUE,
    album_id  INTEGER,
    genre_id  INTEGER,
    len INTEGER, rating INTEGER, count INTEGER
);
</pre>
</p>
<p>
If you run the program multiple times in testing or with different files, 
make sure to empty out the data before each run.
<p>
You can use this code as a starting point for your application:
<a href="http://www.py4e.com/code3/tracks.zip" target="_blank">
http://www.py4e.com/code3/tracks.zip</a>.  
The ZIP file contains the <b>Library.xml</b> file to be used for this assignment.
You can export your own tracks from iTunes and create a database, but
for the database that you turn in for this assignment, only use the 
<b>Library.xml</b> data that is provided.
</p>
<p>
To grade this assignment, the program will run a query like this on
your uploaded database and look for the data it expects to see:
<pre>
SELECT Track.title, Artist.name, Album.title, Genre.name 
    FROM Track JOIN Genre JOIN Album JOIN Artist 
    ON Track.genre_id = Genre.ID and Track.album_id = Album.id 
        AND Album.artist_id = Artist.id
    ORDER BY Artist.name LIMIT 3
</pre>
The expected result of the modified query on your database is: (shown here as a simple HTML table with titles)
<table border="2">
<tr>
<th>Track</th><th>Artist</th><th>Album</th><th>Genre</th>
</tr>
<?php
foreach($answer as $ans) {
    echo("<tr>");
    foreach($ans as $i => $txt ) {
        echo("<td>".htmlentities($txt)."</td>");
    }
    echo("<tr>\n");
}
?>
</p>
