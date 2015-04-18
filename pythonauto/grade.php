<?php
require_once "setup.php";

// Load up the LTI Support code
require_once 'util/lti_util.php';

session_start();

// Initialize, no secret, pull from session, and do not redirect
$context = new BLTI(false, true, false);
if ( ! $context->valid ) {
    echo json_encode(Array("status" => "failure", "detail" => "No context in session"));
    return;
}

$endpoint = $context->getOutcomeService();
if ( $endpoint === false ) {
    echo json_encode(Array("status" => "failure", "detail" => "No grade service available"));
    return;
}

$sourcedid = $context->getOutcomeSourceDID();
if ( $sourcedid === false ) {
    echo json_encode(Array("status" => "failure", "detail" => "No grade entry available"));
    return;
}

if ( isset($_SESSION['oauth_consumer_key']) && isset($_SESSION['oauth_consumer_secret']) ) {
    $oauth_consumer_key = $_SESSION['oauth_consumer_key'];
    $oauth_consumer_secret = $_SESSION['oauth_consumer_secret'];
} else {
    echo json_encode(Array("status" => "failure", "detail" => "No key/secret in session"));
    return;
}

$method="POST";
$content_type = "application/xml";

$operation = 'replaceResultRequest';
$postBody = str_replace(
	array('SOURCEDID', 'GRADE', 'OPERATION','MESSAGE'), 
	array($sourcedid, '1.0', 'replaceResultRequest', uniqid()), 
	getPOXGradeRequest());

$response = sendOAuthBodyPOST($method, $endpoint, $oauth_consumer_key, $oauth_consumer_secret, $content_type, $postBody);
global $LastOAuthBodyBaseString;
$lbs = $LastOAuthBodyBaseString;

try { 
    $retval = parseResponse($response);
} catch(Exception $e) {
    $retval = $e->getMessage();
}

$debug = Array("endpoint" => $endpoint,
"retval" => $retval,
"wesent" => $postBody,
"wegot" => $response,
"base" => $lbs);

$retval = Array("status" => "success");
if ( isset($_GET["debug"]) ) $retval['debug'] = $debug;
echo json_encode($retval);
?>
