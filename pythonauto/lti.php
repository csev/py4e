<?php
require_once "setup.php";
require_once 'keys.php';

// Load up the LTI Support code
require_once 'util/lti_util.php';

session_start();
header('Content-Type: text/html; charset=utf-8');

// Initialize, all secrets are 'secret', do not set session, and do not redirect
$context = new BLTI("secret", false, false);
?>
<html>
<head>
  <title>IMS Learning Tools Interoperability 1.1</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body style="font-family:sans-serif; background-color:#add8e6">
<?php
echo("<p><b>IMS LTI 1.1 PHP Provider</b></p>\n");
echo("<p>This is a very simple reference implementaton of the Tool side (i.e. provider)
for IMS LTI 1.1.</p>\n");

$sourcedid = $_REQUEST['lis_result_sourcedid'];
if (get_magic_quotes_gpc()) $sourcedid = stripslashes($sourcedid);
$sourcedid = urlencode($sourcedid);

if ( $context->valid ) {
   if ( $_POST['launch_presentation_return_url']) {
     $msg = 'A%20message%20from%20the%20tool%20provider.';
     $error_msg = 'An%20error%20message%20from%20the%20tool%20provider.';
     $sep = (strpos($_POST['launch_presentation_return_url'], '?') === FALSE) ? '?' : '&amp;';
     print "<p><a href=\"{$_POST['launch_presentation_return_url']}\">Return to tool consumer</a> (";
     print "<a href=\"{$_POST['launch_presentation_return_url']}{$sep}lti_msg={$msg}&amp;lti_log=LTI%20log%20entry:%20{$msg}\">with a message</a> or ";
     print "<a href=\"{$_POST['launch_presentation_return_url']}{$sep}lti_errormsg={$error_msg}&amp;lti_errorlog=LTI%20error%20log%20entry:%20{$error_msg}\">with an error</a>";
     print ")</p>\n";
   }

    if ( $_POST['lis_result_sourcedid'] && $_POST['lis_outcome_service_url'] ) {
        print "<p><b>Note:</b> This launch can submit a grade back to the LMS using LTI 1.1 Outcome Service.  Press\n";
        print '<a href="common/tool_provider_outcome.php?sourcedid='.$sourcedid;
        print '&key='.urlencode($_POST['oauth_consumer_key']);
        print '&seret=secret';
        print '&url='.urlencode($_POST['lis_outcome_service_url']).'">';
        print 'here to send a grade back via LIS/LTI Outcome Service</a>.</p>'."\n";
    }

    print "<pre>\n";
    print "Context Information:\n\n";
    print $context->dump();
    print "</pre>\n";
} else {
    print "<p style=\"color:red\">Could not establish context: ".$context->message."<p>\n";
}
print "<p>Base String:<br/>\n";
print $context->basestring;
print "<br/></p>\n";

print "<pre>\n";
print "Raw POST Parameters:\n\n";
ksort($_POST);
foreach($_POST as $key => $value ) {
    if (get_magic_quotes_gpc()) $value = stripslashes($value);
    print "$key=$value (".mb_detect_encoding($value).")\n";
}

print "\nRaw GET Parameters:\n\n";
ksort($_GET);
foreach($_GET as $key => $value ) {
    if (get_magic_quotes_gpc()) $value = stripslashes($value);
    print "$key=$value (".mb_detect_encoding($value).")\n";
}
print "</pre>";

?>
