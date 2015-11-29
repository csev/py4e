<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
ini_set("display_errors", 1);
header('Content-Type: text/html; charset=utf-8');
session_start();
?>
<html>
<head>
  <title>IMS Learning Tools Interoperability</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body style="font-family:sans-serif;">
<?php
echo("<p><b>IMS LTI 1.1 Consumer Launch</b></p>\n");
echo("<p>This is a very simple reference implementaton of the LMS side (i.e. consumer) for IMS LTI 1.1.</p>\n");

require_once("util/lti_util.php");

    $cur_url = curPageURL();

    $lmsdata = array(
      "resource_link_id" => "120988f929-274612",
      "resource_link_title" => "Weekly Blog",
      "resource_link_description" => "A weekly blog.",
      "user_id" => "292832126",
      "roles" => "Instructor",  // or Learner
      "lis_person_name_full" => 'Jane Q. Public',
      "lis_person_name_family" => 'Public',
      "lis_person_name_given" => 'Given',
      "lis_person_contact_email_primary" => "user@school.edu",
      "lis_person_sourcedid" => "school.edu:user",
      "context_id" => "456434513",
      "context_title" => "Design of Personal Environments",
      "context_label" => "SI182",
      "tool_consumer_info_product_family_code" => "ims",
      "tool_consumer_info_version" => "1.1",
      "tool_consumer_instance_guid" => "lmsng.school.edu",
      "tool_consumer_instance_description" => "University of School (LMSng)",
      // 'launch_presentation_return_url' => $cur_url
      );

  foreach ($lmsdata as $k => $val ) {
      if ( $_POST[$k] && strlen($_POST[$k]) > 0 ) {
          $lmsdata[$k] = $_POST[$k];
      }
  }

  $key = trim($_REQUEST["key"]);
  if ( ! $key ) $key = "12345";
  $secret = trim($_REQUEST["secret"]);
  if ( ! $secret ) $secret = "secret";
  $endpoint = trim($_REQUEST["endpoint"]);
  $b64 = base64_encode($key.":::".$secret);
  if ( ! $endpoint ) $endpoint = str_replace("lms.php","auto.php",$cur_url);
  $cssurl = str_replace("lms.php","lms.css",$cur_url);

  $outcomes = trim($_REQUEST["outcomes"]);
  if ( ! $outcomes ) {
      $outcomes = str_replace("lms.php","common/tool_consumer_outcome.php",$cur_url);
      $outcomes .= "?b64=" . htmlentities($b64);
  }

  $tool_consumer_instance_guid = $lmsdata['tool_consumer_instance_guid'];
  $tool_consumer_instance_description = $lmsdata['tool_consumer_instance_description'];

?>
<script language="javascript"> 
  //<![CDATA[ 
function lmsdataToggle() {
    var ele = document.getElementById("lmsDataForm");
    if(ele.style.display == "block") {
        ele.style.display = "none";
    }
    else {
        ele.style.display = "block";
    }
} 
  //]]> 
</script>
<a id="displayText" href="javascript:lmsdataToggle();">Toggle Resource and Launch Data</a>
<?php
  echo("<div id=\"lmsDataForm\" style=\"display:block\">\n");
  echo("<form method=\"post\">\n");
  echo("<input type=\"submit\" value=\"Recompute Launch Data\">\n");
  echo("<input type=\"submit\" name=\"reset\" value=\"Reset\">\n");
  echo("<fieldset><legend>LTI Resource</legend>\n");
  $disabled = '';
  echo("Launch URL: <input size=\"60\" type=\"text\" $disabled size=\"60\" name=\"endpoint\" value=\"$endpoint\">\n");
  echo("<br/>Key: <input type\"text\" name=\"key\" $disapbled size=\"60\" value=\"$key\">\n");
  echo("<br/>Secret: <input type\"text\" name=\"secret\" $disabled size=\"60\" value=\"$secret\">\n");
  echo("</fieldset><p>");
  echo("<fieldset><legend>Launch Data</legend>\n");
  foreach ($lmsdata as $k => $val ) {
      echo($k.": <input type=\"text\" name=\"".$k."\" value=\"");
      echo(htmlspecialchars($val));
      echo("\"><br/>\n");
  }
  echo("</fieldset>\n");
  echo("</form>\n");
  echo("</div>\n");
  echo("<hr>");

  $parms = $lmsdata;
  // Cleanup parms before we sign
  foreach( $parms as $k => $val ) {
    if (strlen(trim($parms[$k]) ) < 1 ) {
       unset($parms[$k]);
    }
  }

  // Add oauth_callback to be compliant with the 1.0A spec
  $parms["oauth_callback"] = "about:blank";
  if ( $outcomes ) {
    $parms["lis_outcome_service_url"] = $outcomes;
    $parms["lis_result_sourcedid"] = "feb-123-456-2929::28883";
  }
    
  $parms['launch_presentation_css_url'] = $cssurl;

  $parms = signParameters($parms, $endpoint, "POST", $key, $secret, 
"Press to Launch", $tool_consumer_instance_guid, $tool_consumer_instance_description);

  $content = postLaunchHTML($parms, $endpoint, true, 
     "width=\"100%\" height=\"900\" scrolling=\"auto\" frameborder=\"1\" transparency");
  print($content);

?>
<hr>
<p>
Note: Unpublished drafts of IMS Specifications are only available to 
IMS members and any software based on an unpublished draft is subject to change.
Sample code is provided to help developers understand the specification more quickly.
Simply interoperating with this sample implementation code does not 
allow one to claim compliance with a specification.
<p>
<a href="http://developers.imsglobal.org/">IMS Developer Community</a>