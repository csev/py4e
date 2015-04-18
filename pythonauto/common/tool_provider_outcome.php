<html>
<head>
  <title>IMS Learning Tools Interoperability</title>
</head>
<body style="font-family:sans-serif; background-color:#add8e6">
<p><b>Tool Provider Calling the IMS LIS/LTI Outcome Service</b></p>
<p>This is a simple implementation of the Simple Outcomes Service.</p>
<?php 
// Load up the LTI Support code
require_once("../util/lti_util.php");

// Note - We avoid using the session in this file to avoid deadlocks
// If we were calling a web service on the same server

if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
 error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
} else { 
 error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
}

ini_set("display_errors", 1);

$oauth_consumer_secret = $_REQUEST['secret'];
if (strlen($oauth_consumer_secret) < 1 ) $oauth_consumer_secret = 'secret';

$sourcedid = $_REQUEST['sourcedid'];
if (get_magic_quotes_gpc()) $sourcedid = stripslashes($sourcedid);

?>
<p>
<form method="POST">
Service URL: <input type="text" name="url" size="100" disabled="true" value="<?php echo(htmlentities($_REQUEST['url']));?>"/></br>
lis_result_sourcedid: <input type="text" name="sourcedid" disabled="true" size="100" value="<?php echo(htmlentities($sourcedid));?>"/></br>
OAuth Consumer Key: <input type="text" name="key" disabled="true" size="80" value="<?php echo(htmlentities($_REQUEST['key']));?>"/></br>
OAuth Consumer Secret: <input type="text" name="secret" size="80" value="<?php echo(htmlentities($oauth_consumer_secret));?>"/></br>
</p><p>
Grade to Send to LMS: <input type="text" name="grade" value="<?php echo(htmlentities($_REQUEST['grade']));?>"/>
(i.e. 0.95)<br/>
<input type='submit' name='submit' value="Send Grade">
<input type='submit' name='submit' value="Read Grade">
<input type='submit' name='submit' value="Delete Grade"></br>
</form>
<?php 
$url = $_REQUEST['url'];
if(!in_array($_SERVER['HTTP_HOST'],array('localhost','127.0.0.1')) && strpos($url,'localhost') > 0){ ?>
<p>
<b>Note</b> This service call may not work.  It appears as though you are 
calling a service running on <b>localhost</b> from a tool that
is not running on localhost.
Because these services are server-to-server calls if you are 
running your LMS on "localhost", you must also run this script
on localhost as well.  If your LMS has a real Internet
address you should be OK.  You can get a copy of the test
tools to run locally at 
to test your LMS instance running on localhost.
(<a href="../lti.zip" target="_new">Download</a>) 
</p>
<?php
}

$oauth_consumer_key = $_REQUEST['key'];
$method="POST";
$endpoint = $_REQUEST['url'];
$content_type = "application/xml";

if ( $_REQUEST['submit'] == "Send Grade" && isset($_REQUEST['grade'] ) ) {
    $operation = 'replaceResultRequest';
    $postBody = str_replace(
	array('SOURCEDID', 'GRADE', 'OPERATION','MESSAGE'), 
	array($sourcedid, $_REQUEST['grade'], $operation, uniqid()), 
	getPOXGradeRequest());
} else if ( $_REQUEST['submit'] == "Read Grade" ) {
    $operation = 'readResultRequest';
    $postBody = str_replace(
	array('SOURCEDID', 'OPERATION','MESSAGE'), 
	array($sourcedid, $operation, uniqid()), 
	getPOXRequest());
} else if ( $_REQUEST['submit'] == "Delete Grade" ) {
    $operation = 'deleteResultRequest';
    $postBody = str_replace(
	array('SOURCEDID', 'OPERATION','MESSAGE'), 
	array($sourcedid, $operation, uniqid()), 
	getPOXRequest());
} else {
    exit();
}

$response = sendOAuthBodyPOST($method, $endpoint, $oauth_consumer_key, $oauth_consumer_secret, $content_type, $postBody);
global $LastOAuthBodyBaseString;
$lbs = $LastOAuthBodyBaseString;


try { 
    $retval = parseResponse($response);
} catch(Exception $e) {
    $retval = $e->getMessage();
}

echo("\n<pre>\n");
echo("Service Url:\n");
echo(htmlentities($endpoint)."\n\n");
print_r($retval);
echo("\n");
echo("------------ POST RETURNS ------------\n");
$response = str_replace("><","&gt;\n&lt;",$response);
$response = str_replace("<","&lt;",$response);
$response = str_replace(">","&gt;",$response);
echo($response);

echo("\n\n------------ WE SENT ------------\n");
$postBody = str_replace("<","&lt;",$postBody);
$postBody = str_replace(">","&gt;",$postBody);
echo($postBody);
echo("\nBase String:\n");
echo($lbs);
echo("\n</pre>\n");

?>
