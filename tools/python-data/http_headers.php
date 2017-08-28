<?php

use \Tsugi\Core\LTIX;
use \Tsugi\Util\LTI;
use \Tsugi\Util\Net;

function mapdown($input) {
    return preg_replace('/[^a-z0-9]/i','',strtolower($input));
}

// Compute the stuff for the output
$getUrl = 'http://data.pr4e.org/intro-short.txt';

$data = Net::doGet($getUrl);
$response = Net::getLastHttpResponse();
if ( $response != 200 ) {
    die("Response=$response url=$getUrl");
}
$headers = Net::parseHeaders();

$fields = array(
    'Last-Modified',
    'ETag',
    'Content-Length',
    'Cache-Control',
    'Content-Type'
);

$oldgrade = $RESULT->grade;
// If we have a POST, pass to the GET
if ( count($_POST) > 0 ) {
    $_SESSION['postdata'] = $_POST;

    $count = 0;
    $good = 0;
    foreach($headers as $key => $val ) {
        if ( ! in_array($key,$fields) ) continue;
        $postkey = mapdown($key);
        $count++;
        if ( isset($_POST[$postkey])&& mapdown($_POST[$postkey]) == mapdown($val) ) {
            $good++;
        }
    } 
    if ( $count == 0 ) {
        die("No expected fields found");
    }

    $gradetosend = (1.0 * $good) / $count;
    LTIX::gradeSendDueDate($gradetosend, $oldgrade, $dueDate);

    header('Location: '.addSession('index.php'));
    return;
}

if ( $RESULT->grade > 0 ) {
    echo('<p class="alert alert-info">Your current grade on this assignment is: '.($RESULT->grade*100.0).'%</p>'."\n");
}

if ( $dueDate->message ) {
    echo('<p style="color:red;">'.$dueDate->message.'</p>'."\n");
}

$postdata = isset($_SESSION['postdata']) ? $_SESSION['postdata'] : array();
unset($_SESSION['postdata']);

?>
<p>
<b>Exploring the HyperText Transport Protocol</b>
<p>
You are to retrieve the following document using the HTTP protocol in a way
that you can examine the HTTP Response headers.
<ul>
<li><a href="<?= $getUrl ?>" target="_blank"><?= $getUrl ?></a></li>
</ul>
</p>
<p>
There are three ways that you might retrieve this web page and look at the response headers:
<ul>
<li><b>Preferred:</b> Modify the <a href="<?= $CFG->apphome ?>/code3/socket1.py" target="_blank">socket1.py</a>
program to retrieve the above URL and print out the headers and data.  
Make sure to <b>change</b> the code to retrieve the above URL - the values are
different for each URL.
</li>
<li>Open the URL in a web browser with a developer console or FireBug and manually examine the headers that
are returned.</li>
<li>Use the <b>telnet</b> program as shown in lecture to retrieve the headers and content.</li>
</ul>
</p>
<p>
Enter the header values in each of the fields below and press "Submit".
<form method="post">
<?php
    $count = 0;
    foreach($headers as $key => $val ) {
        if ( ! in_array($key,$fields) ) continue;
        $postkey = mapdown($key);
        $count++;
        echo(htmlentities($key).':<br/>');
        echo('<input type="text" size="60" name="'.$postkey.'" ');
        if ( isset($postdata[$postkey]) ) {
            echo('value="'.htmlentities($postdata[$postkey]).'" /> ');
            if ( mapdown($postdata[$postkey]) == mapdown($val) ) {
                echo('<i class="fa fa-check text-success"></i>');
            } else {
                echo('<i class="fa fa-times text-danger"></i>');
            }
        } else {
            echo("/> ");
        }
        echo("<br/>\n");
    } 
?>
<input type="submit">
</form>
</p>
<?php
if ( $USER->instructor ) {
echo("\n<hr/>");
echo("\n<pre>\n");
echo("Retrieved information:\n");
print_r($headers);
echo("\n");
echo($data);
echo("\n</pre>\n");
}
