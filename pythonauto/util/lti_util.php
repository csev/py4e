<?php

// Turn this off
if ( function_exists ( 'libxml_disable_entity_loader' ) ) libxml_disable_entity_loader();

require_once 'OAuth.php';

// Returns true if this is a Basic LTI message
// with minimum values to meet the protocol
function is_lti_request() {
   $good_message_type = $_REQUEST["lti_message_type"] == "basic-lti-launch-request";
   $good_lti_version = $_REQUEST["lti_version"] == "LTI-1p0";
   $resource_link_id = $_REQUEST["resource_link_id"];
   if ($good_message_type and $good_lti_version and isset($resource_link_id) ) return(true);
   return false;
}

// Basic LTI Class that does the setup and provides utility
// functions
class BLTI {

    public $valid = false;
    public $complete = false;
    public $message = false;
    public $basestring = false;
    public $info = false;
    public $row = false;
    public $context_id = false;  // Override context_id
    public $consumer_id = false;
    public $user_id = false;
    public $course_id = false;
    public $resource_id = false;

    function __construct($parm=false, $usesession=true, $doredirect=true) {

        // If this request is not an LTI Launch, either
        // give up or try to retrieve the context from session
        if ( ! is_lti_request() ) {
            if ( $usesession === false ) return;
            if ( strlen(session_id()) > 0 ) {
                $row = $_SESSION['_lti_row'];
                if ( isset($row) ) $this->row = $row;
                $context_id = $_SESSION['_lti_context_id'];
                if ( isset($context_id) ) $this->context_id = $context_id;
                $info = $_SESSION['_lti_context'];
                if ( isset($info) ) {
                    $this->info = $info;
                    $this->valid = true;
                    return;
                }
                $this->message = "Could not find context in session";
                return;
            }
            $this->message = "Session not available";
            return;
        }

        // Insure we have a valid launch
        if ( empty($_REQUEST["oauth_consumer_key"]) ) {
            $this->message = "Missing oauth_consumer_key in request";
            return;
        }
        $oauth_consumer_key = $_REQUEST["oauth_consumer_key"];

        // Find the secret - either form the parameter as a string or
        // look it up in a database from parameters we are given
        $secret = false;
        $row = false;
        if ( is_string($parm) ) {
            $secret = $parm;
        } else if ( ! is_array($parm) ) {
            $this->message = "Constructor requires a secret or database information.";
            return;
        } else {
            $sql = 'SELECT * FROM '.$parm['table'].' WHERE '.
                ($parm['key_column'] ? $parm['key_column'] : 'oauth_consumer_key').
                '='.
                "'".mysql_real_escape_string($oauth_consumer_key)."'";
            $result = mysql_query($sql);
            $num_rows = mysql_num_rows($result);
            if ( $num_rows != 1 ) {
                $this->message = "Your consumer is not authorized oauth_consumer_key=".$oauth_consumer_key;
                return;
            } else {
                while ($row = mysql_fetch_assoc($result)) {
                    $secret = $row[$parms['secret_column']?$parms['secret_column']:'secret'];
                    $context_id = $row[$parms['context_column']?$parms['context_column']:'context_id'];
                    if ( $context_id ) $this->context_id = $context_id;
                    $this->row = $row;
                    break;
                }
                if ( ! is_string($secret) ) {
                    $this->message = "Could not retrieve secret oauth_consumer_key=".$oauth_consumer_key;
                    return;
                }
            }
        }

        // Verify the message signature
        $store = new TrivialOAuthDataStore();
        $store->add_consumer($oauth_consumer_key, $secret);

        $server = new OAuthServer($store);

        $method = new OAuthSignatureMethod_HMAC_SHA1();
        $server->add_signature_method($method);
        $request = OAuthRequest::from_request();

        $this->basestring = $request->get_signature_base_string();

        try {
            $server->verify_request($request);
            $this->valid = true;
        } catch (Exception $e) {
            $this->message = $e->getMessage();
            return;
        }

        // Store the launch information in the session for later
        $newinfo = array();
        foreach($_POST as $key => $value ) {
            if ( $key == "basiclti_submit" ) continue;
            if ( strpos($key, "oauth_") === false ) {
                $newinfo[$key] = $value;
                continue;
            }
            if ( $key == "oauth_consumer_key" ) {
                $newinfo[$key] = $value;
                continue;
            }
        }

        $this->info = $newinfo;
        if ( $usesession == true and strlen(session_id()) > 0 ) {
             $_SESSION['_lti_context'] = $this->info;
             unset($_SESSION['_lti_row']);
             unset($_SESSION['_lti_context_id']);
             if ( $this->row ) $_SESSION['_lti_row'] = $this->row;
             if ( $this->context_id ) $_SESSION['_lti_context_id'] = $this->context_id;
        }

        if ( $this->valid && $doredirect ) {
            $this->redirect();
            $this->complete = true;
        }
    }

    function addSession($location) {
        if ( ini_get('session.use_cookies') == 0 ) {
            if ( strpos($location,'?') > 0 ) {
               $location = $location . '&';
            } else {
               $location = $location . '?';
            }
            $location = $location . session_name() . '=' . session_id();
        }
        return $location;
    }

    function isInstructor() {
        $roles = $this->info['roles'];
        $roles = strtolower($roles);
        if ( ! ( strpos($roles,"instructor") === false ) ) return true;
        if ( ! ( strpos($roles,"administrator") === false ) ) return true;
        return false;
    }

    function getUserEmail() {
        $email = $this->info['lis_person_contact_email_primary'];
        if ( strlen($email) > 0 ) return $email;
        # Sakai Hack
        $email = $this->info['lis_person_contact_emailprimary'];
        if ( strlen($email) > 0 ) return $email;
        return false;
    }

    function getUserShortName() {
        $email = $this->getUserEmail();
        $givenname = $this->info['lis_person_name_given'];
        $familyname = $this->info['lis_person_name_family'];
        $fullname = $this->info['lis_person_name_full'];
        if ( strlen($email) > 0 ) return $email;
        if ( strlen($givenname) > 0 ) return $givenname;
        if ( strlen($familyname) > 0 ) return $familyname;
        return $this->getUserName();
    }

    function getUserName() {
        $givenname = $this->info['lis_person_name_given'];
        $familyname = $this->info['lis_person_name_family'];
        $fullname = $this->info['lis_person_name_full'];
        if ( strlen($fullname) > 0 ) return $fullname;
        if ( strlen($familyname) > 0 and strlen($givenname) > 0 ) return $givenname + $familyname;
        if ( strlen($givenname) > 0 ) return $givenname;
        if ( strlen($familyname) > 0 ) return $familyname;
        return $this->getUserEmail();
    }

    // Name spaced
    function getUserKey() {
        $oauth = $this->info['oauth_consumer_key'];
        $id = $this->info['user_id'];
        if ( strlen($id) > 0 and strlen($oauth) > 0 ) return $oauth . ':' . $id;
        return false;
    }

    // Un-Namespaced
    function getUserLKey() {
        $id = $this->info['user_id'];
        if ( strlen($id) > 0 ) return $id;
        return false;
    }

    function setUserID($new_id) {
        $this->user_id = $new_id;
    }

    function getUserID() {
        return $this->user_id;
    }

    function getUserImage() {
        $image = $this->info['user_image'];
        if ( strlen($image) > 0 ) return $image;
        $email = $this->getUserEmail();
        if ( $email === false ) return false;
        $size = 40;
        $grav_url = $_SERVER['HTTPS'] ? 'https://' : 'http://';
        $grav_url = $grav_url . "www.gravatar.com/avatar.php?gravatar_id=".md5( strtolower($email) )."&size=".$size;
        return $grav_url;
    }

    function getResourceKey() {
        $oauth = $this->info['oauth_consumer_key'];
        $id = $this->info['resource_link_id'];
        if ( strlen($id) > 0 and strlen($oauth) > 0 ) return $oauth . ':' . $id;
        return false;
    }

    function getResourceLKey() {
        $id = $this->info['resource_link_id'];
        if ( strlen($id) > 0 ) return $id;
        return false;
    }

    function setResourceID($new_id) {
        $this->resource_id = $new_id;
    }

    function getResourceID() {
        return $this->resource_id;
    }

    function getResourceTitle() {
        $title = $this->info['resource_link_title'];
        if ( strlen($title) > 0 ) return $title;
        return false;
    }

    function getConsumerKey() {
        $oauth = $this->info['oauth_consumer_key'];
        return $oauth;
    }

    function setConsumerID($new_id) {
        $this->consumer_id = $new_id;
    }

    function getConsumerID() {
        return $this->consumer_id;
    }

    function getCourseLKey() {
        if ( $this->context_id ) return $this->context_id;
        $id = $this->info['context_id'];
        if ( strlen($id) > 0 ) return $id;
        return false;
    }

    function getCourseKey() {
        if ( $this->context_id ) return $this->context_id;
        $oauth = $this->info['oauth_consumer_key'];
        $id = $this->info['context_id'];
        if ( strlen($id) > 0 and strlen($oauth) > 0 ) return $oauth . ':' . $id;
        return false;
    }

    function setCourseID($new_id) {
        $this->course_id = $new_id;
    }

    function getCourseID() {
        return $this->course_id;
    }

    function getCourseName() {
        $label = $this->info['context_label'];
        $title = $this->info['context_title'];
        $id = $this->info['context_id'];
        if ( strlen($label) > 0 ) return $label;
        if ( strlen($title) > 0 ) return $title;
        if ( strlen($id) > 0 ) return $id;
        return false;
    }

    function getCSS() {
        $list = $this->info['launch_presentation_css_url'];
        if ( strlen($list) < 1 ) return array();
        return explode(',',$list);
    }

    function getReturnURL() {
        $url = $this->info['launch_presentation_return_url'];
        if ( strlen($url) > 0 ) return $url;
        return false;
    }

    function getOutcomeService() {
        $retval = $this->info['lis_outcome_service_url'];
        if ( strlen($retval) > 1 ) return $retval;
        return false;
    }

    function getOutcomeSourceDID() {
        $retval = $this->info['lis_result_sourcedid'];
        if ( strlen($retval) > 1 ) return $retval;
        return false;
    }

    function redirect($url=false) {
        if ( $url === false ) {
      $host = $_SERVER['HTTP_HOST'];
      $uri = $_SERVER['PHP_SELF'];
      $location = $_SERVER['HTTPS'] ? 'https://' : 'http://';
      $location = $location . $host . $uri;
    } else {
      $location = $url;
    }

    if ( headers_sent() ) {
      echo('<a href="'.htmlentities($location).'">Continue</a>'."\n");
    } else {
        $location = htmlentities($this->addSession($location));
      header("Location: $location");
    }
    }

    function dump() {
        if ( ! $this->valid or $this->info == false ) return "Context not valid\n";
        $ret = "";
        if ( $this->isInstructor() ) {
            $ret .= "isInstructor() = true\n";
        } else {
            $ret .= "isInstructor() = false\n";
        }
        $ret .= "getConsumerKey() = ".$this->getConsumerKey()."\n";
        $ret .= "getUserLKey() = ".$this->getUserLKey()."\n";
        $ret .= "getUserKey() = ".$this->getUserKey()."\n";
        $ret .= "getUserID() = ".$this->getUserID()."\n";
        $ret .= "getUserEmail() = ".$this->getUserEmail()."\n";
        $ret .= "getUserShortName() = ".$this->getUserShortName()."\n";
        $ret .= "getUserName() = ".$this->getUserName()."\n";
        $ret .= "getUserImage() = ".$this->getUserImage()."\n";
        $ret .= "getResourceKey() = ".$this->getResourceKey()."\n";
        $ret .= "getResourceID() = ".$this->getResourceID()."\n";
        $ret .= "getResourceTitle() = ".$this->getResourceTitle()."\n";
        $ret .= "getCourseName() = ".$this->getCourseName()."\n";
        $ret .= "getCourseKey() = ".$this->getCourseKey()."\n";
        $ret .= "getCourseID() = ".$this->getCourseID()."\n";
        $ret .= "getOutcomeSourceDID() = ".$this->getOutcomeSourceDID()."\n";
        $ret .= "getOutcomeService() = ".$this->getOutcomeService()."\n";
        return $ret;
    }

}

/**
 * A Trivial memory-based store - no support for tokens
 */
class TrivialOAuthDataStore extends OAuthDataStore {
    private $consumers = array();

    function add_consumer($consumer_key, $consumer_secret) {
        $this->consumers[$consumer_key] = $consumer_secret;
    }

    function lookup_consumer($consumer_key) {
        if ( strpos($consumer_key, "http://" ) === 0 ) {
            $consumer = new OAuthConsumer($consumer_key,"secret", NULL);
            return $consumer;
        }
        if ( $this->consumers[$consumer_key] ) {
            $consumer = new OAuthConsumer($consumer_key,$this->consumers[$consumer_key], NULL);
            return $consumer;
        }
        return NULL;
    }

    function lookup_token($consumer, $token_type, $token) {
        return new OAuthToken($consumer, "");
    }

    // Return NULL if the nonce has not been used
    // Return $nonce if the nonce was previously used
    function lookup_nonce($consumer, $token, $nonce, $timestamp) {
        // Should add some clever logic to keep nonces from
        // being reused - for no we are really trusting
  // that the timestamp will save us
        return NULL;
    }

    function new_request_token($consumer) {
        return NULL;
    }

    function new_access_token($token, $consumer) {
        return NULL;
    }
}

function signParameters($oldparms, $endpoint, $method, $oauth_consumer_key, $oauth_consumer_secret,
    $submit_text = false, $org_id = false, $org_desc = false)
{
    global $last_base_string;
    $parms = $oldparms;
    if ( ! isset($parms["lti_version"]) ) $parms["lti_version"] = "LTI-1p0";
    if ( ! isset($parms["lti_message_type"]) ) $parms["lti_message_type"] = "basic-lti-launch-request";
    if ( ! isset($parms["oauth_callback"]) ) $parms["oauth_callback"] = "about:blank";
    if ( $org_id ) $parms["tool_consumer_instance_guid"] = $org_id;
    if ( $org_desc ) $parms["tool_consumer_instance_description"] = $org_desc;
    if ( $submit_text ) $parms["ext_submit"] = $submit_text;

    $test_token = '';

    $hmac_method = new OAuthSignatureMethod_HMAC_SHA1();
    $test_consumer = new OAuthConsumer($oauth_consumer_key, $oauth_consumer_secret, NULL);

    $acc_req = OAuthRequest::from_consumer_and_token($test_consumer, $test_token, $method, $endpoint, $parms);
    $acc_req->sign_request($hmac_method, $test_consumer, $test_token);

    // Pass this back up "out of band" for debugging
    $last_base_string = $acc_req->get_signature_base_string();

    $newparms = $acc_req->get_parameters();

  // Don't want to pull GET parameters into POST data so
    // manually pull back the oauth_ parameters
  foreach($newparms as $k => $v ) {
        if ( strpos($k, "oauth_") === 0 ) {
            $parms[$k] = $v;
        }
    }

    return $parms;
}

  function postLaunchHTML($newparms, $endpoint, $debug=false, $iframeattr=false) {
    global $last_base_string;
    $r = "<div id=\"ltiLaunchFormSubmitArea\">\n";
    if ( $iframeattr ) {
        $r = "<form action=\"".$endpoint."\" name=\"ltiLaunchForm\" id=\"ltiLaunchForm\" method=\"post\" target=\"basicltiLaunchFrame\" encType=\"application/x-www-form-urlencoded\">\n" ;
    } else {
        $r = "<form action=\"".$endpoint."\" name=\"ltiLaunchForm\" id=\"ltiLaunchForm\" method=\"post\" encType=\"application/x-www-form-urlencoded\">\n" ;
    }
    $submit_text = $newparms['ext_submit'];
    foreach($newparms as $key => $value ) {
        $key = htmlspecialchars($key);
        $value = htmlspecialchars($value);
        if ( $key == "ext_submit" ) {
            $r .= "<input type=\"submit\" name=\"";
        } else {
            $r .= "<input type=\"hidden\" name=\"";
        }
        $r .= $key;
        $r .= "\" value=\"";
        $r .= $value;
        $r .= "\"/>\n";
    }
    if ( $debug ) {
        $r .= "<script language=\"javascript\"> \n";
        $r .= "  //<![CDATA[ \n" ;
        $r .= "function basicltiDebugToggle() {\n";
        $r .= "    var ele = document.getElementById(\"basicltiDebug\");\n";
        $r .= "    if(ele.style.display == \"block\") {\n";
        $r .= "        ele.style.display = \"none\";\n";
        $r .= "    }\n";
        $r .= "    else {\n";
        $r .= "        ele.style.display = \"block\";\n";
        $r .= "    }\n";
        $r .= "} \n";
        $r .= "  //]]> \n" ;
        $r .= "</script>\n";
        $r .= "<a id=\"displayText\" href=\"javascript:basicltiDebugToggle();\">";
        $r .= get_string("toggle_debug_data","basiclti")."</a>\n";
        $r .= "<div id=\"basicltiDebug\" style=\"display:none\">\n";
        $r .=  "<b>".get_string("basiclti_endpoint","basiclti")."</b><br/>\n";
        $r .= $endpoint . "<br/>\n&nbsp;<br/>\n";
        $r .=  "<b>".get_string("basiclti_parameters","basiclti")."</b><br/>\n";
        foreach($newparms as $key => $value ) {
            $key = htmlspecialchars($key);
            $value = htmlspecialchars($value);
            $r .= "$key = $value<br/>\n";
        }
        $r .= "&nbsp;<br/>\n";
        $r .= "<p><b>".get_string("basiclti_base_string","basiclti")."</b><br/>\n".$last_base_string."</p>\n";
        $r .= "</div>\n";
    }
    $r .= "</form>\n";
    if ( $iframeattr ) {
        $r .= "<iframe name=\"basicltiLaunchFrame\"  id=\"basicltiLaunchFrame\" src=\"\"\n";
        $r .= $iframeattr . ">\n<p>".get_string("frames_required","basiclti")."</p>\n</iframe>\n";
    }
    if ( ! $debug ) {
        $ext_submit = "ext_submit";
        $ext_submit_text = $submit_text;
        $r .= " <script type=\"text/javascript\"> \n" .
            "  //<![CDATA[ \n" .
            "    document.getElementById(\"ltiLaunchForm\").style.display = \"none\";\n" .
            "    nei = document.createElement('input');\n" .
            "    nei.setAttribute('type', 'hidden');\n" .
            "    nei.setAttribute('name', '".$ext_submit."');\n" .
            "    nei.setAttribute('value', '".$ext_submit_text."');\n" .
            "    document.getElementById(\"ltiLaunchForm\").appendChild(nei);\n" .
            "    document.ltiLaunchForm.submit(); \n" .
            "  //]]> \n" .
            " </script> \n";
    }
    $r .= "</div>\n";
    return $r;
}

/* This is a bit of homage to Moodle's pattern of internationalisation */
function get_string($key,$bundle) {
    return $key;
}

function do_post_request($url, $data, $optional_headers = null)
{
  $params = array('http' => array(
              'method' => 'POST',
              'content' => $data
            ));

  if ($optional_headers !== null) {
     $header = $optional_headers . "\r\n";
  }
  // $header = $header . "Content-type: application/x-www-form-urlencoded\r\n";
  $params['http']['header'] = $header;
  $ctx = stream_context_create($params);
  $fp = @fopen($url, 'rb', false, $ctx);
  if (!$fp) {
    throw new Exception("Problem with $url, $php_errormsg");
  }
  $response = @stream_get_contents($fp);
  if ($response === false) {
    throw new Exception("Problem reading data from $url, $php_errormsg");
  }
  return $response;
}


  // Parse a descriptor
  function launchInfo($xmldata) {
    $xml = new SimpleXMLElement($xmldata);
    if ( ! $xml ) {
       echo("Error parsing Descriptor XML\n");
       return;
    }
    $launch_url = $xml->secure_launch_url[0];
    if ( ! $launch_url ) $launch_url = $xml->launch_url[0];
    if ( $launch_url ) $launch_url = (string) $launch_url;
    $custom = array();
    if ( $xml->custom[0]->parameter )
    foreach ( $xml->custom[0]->parameter as $resource) {
      $key = (string) $resource['key'];
      $key = strtolower($key);
      $nk = "";
      for($i=0; $i < strlen($key); $i++) {
        $ch = substr($key,$i,1);
        if ( $ch >= "a" && $ch <= "z" ) $nk .= $ch;
        else if ( $ch >= "0" && $ch <= "9" ) $nk .= $ch;
        else $nk .= "_";
      }
      $value = (string) $resource;
      $custom["custom_".$nk] = $value;
    }
    return array("launch_url" => $launch_url, "custom" => $custom ) ;
  }

  function curPageURL() {
    $pageURL = (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != "on")
             ? 'http'
             : 'https';
    $pageURL .= "://";
    $pageURL .= $_SERVER['HTTP_HOST'];
    //$pageURL .= $_SERVER['REQUEST_URI'];
    $pageURL .= $_SERVER['PHP_SELF'];
    return $pageURL;
  }


function getLastOAuthBodyBaseString() {
    global $LastOAuthBodyBaseString;
    return $LastOAuthBodyBaseString;
}

function getLastOAuthBodyHashInfo() {
    global $LastOAuthBodyHashInfo;
    return $LastOAuthBodyHashInfo;
}


function getOAuthKeyFromHeaders()
{
    $request_headers = OAuthUtil::get_headers();
    // print_r($request_headers);

    if (@substr($request_headers['Authorization'], 0, 6) == "OAuth ") {
        $header_parameters = OAuthUtil::split_header($request_headers['Authorization']);

        // echo("HEADER PARMS=\n");
        // print_r($header_parameters);
        return $header_parameters['oauth_consumer_key'];
    }
    return false;
}

function handleOAuthBodyPOST($oauth_consumer_key, $oauth_consumer_secret)
{
    $request_headers = OAuthUtil::get_headers();
    // print_r($request_headers);

    // Must reject application/x-www-form-urlencoded
    if ($request_headers['Content-Type'] == 'application/x-www-form-urlencoded' ) {
        throw new Exception("OAuth request body signing must not use application/x-www-form-urlencoded");
    }

    if (@substr($request_headers['Authorization'], 0, 6) == "OAuth ") {
        $header_parameters = OAuthUtil::split_header($request_headers['Authorization']);

        // echo("HEADER PARMS=\n");
        // print_r($header_parameters);
        $oauth_body_hash = $header_parameters['oauth_body_hash'];
        // echo("OBH=".$oauth_body_hash."\n");
    }

    if ( ! isset($oauth_body_hash)  ) {
        throw new Exception("OAuth request body signing requires oauth_body_hash body");
    }

    // Verify the message signature
    $store = new TrivialOAuthDataStore();
    $store->add_consumer($oauth_consumer_key, $oauth_consumer_secret);

    $server = new OAuthServer($store);

    $method = new OAuthSignatureMethod_HMAC_SHA1();
    $server->add_signature_method($method);
    $request = OAuthRequest::from_request();

    global $LastOAuthBodyBaseString;
    $LastOAuthBodyBaseString = $request->get_signature_base_string();
    // echo($LastOAuthBodyBaseString."\n");

    try {
        $server->verify_request($request);
    } catch (Exception $e) {
        $message = $e->getMessage();
        throw new Exception("OAuth signature failed: " . $message);
    }

    $postdata = file_get_contents('php://input');
    // echo($postdata);

    $hash = base64_encode(sha1($postdata, TRUE));

    global $LastOAuthBodyHashInfo;
  $LastOAuthBodyHashInfo = "hdr_hash=$oauth_body_hash body_len=".strlen($postdata)." body_hash=$hash";

    if ( $hash != $oauth_body_hash ) {
        throw new Exception("OAuth oauth_body_hash mismatch");
    }

    return $postdata;
}

function sendOAuthBodyPOST($method, $endpoint, $oauth_consumer_key, $oauth_consumer_secret, $content_type, $body)
{
    $hash = base64_encode(sha1($body, TRUE));

    $parms = array('oauth_body_hash' => $hash);

    $test_token = '';
    $hmac_method = new OAuthSignatureMethod_HMAC_SHA1();
    $test_consumer = new OAuthConsumer($oauth_consumer_key, $oauth_consumer_secret, NULL);

    $acc_req = OAuthRequest::from_consumer_and_token($test_consumer, $test_token, $method, $endpoint, $parms);
    $acc_req->sign_request($hmac_method, $test_consumer, $test_token);

    // Pass this back up "out of band" for debugging
    global $LastOAuthBodyBaseString;
    $LastOAuthBodyBaseString = $acc_req->get_signature_base_string();
    // echo($LastOAuthBodyBaseString."\n");

    $header = $acc_req->to_header();
    $header = $header . "\r\nContent-Type: " . $content_type . "\r\n";

    $params = array('http' => array(
        'method' => 'POST',
        'content' => $body,
        'header' => $header
        ));

    $ctx = stream_context_create($params);
    try {
        $fp = @fopen($endpoint, 'r', false, $ctx);
    } catch (Exception $e) {
        $fp = false;
    }
    if ($fp) {
        $response = @stream_get_contents($fp);
    } else {  // Try CURL
        $headers = explode("\r\n",$header);
        $response = sendXmlOverPost($endpoint, $body, $headers);
    }

    if ($response === false) {
        throw new Exception("Problem reading data from $endpoint, $php_errormsg");
    }
    return $response;
}

function sendXmlOverPost($url, $xml, $header) {
  if ( ! function_exists('curl_init') ) return false;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);

  // For xml, change the content-type.
  curl_setopt ($ch, CURLOPT_HTTPHEADER, $header);

  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // ask for results to be returned
/*
  if(CurlHelper::checkHttpsURL($url)) {
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  }
*/

  // Send to remote and return data to caller.
  $result = curl_exec($ch);
  curl_close($ch);
  return $result;
}

/*  $postBody = str_replace(
      array('SOURCEDID', 'GRADE', 'OPERATION','MESSAGE'),
      array($sourcedid, $_REQUEST['grade'], $operation, uniqid()),
      getPOXGradeRequest());
*/

function getPOXGradeRequest() {
    return '<?xml version = "1.0" encoding = "UTF-8"?>
<imsx_POXEnvelopeRequest xmlns = "http://www.imsglobal.org/services/ltiv1p1/xsd/imsoms_v1p0">
  <imsx_POXHeader>
    <imsx_POXRequestHeaderInfo>
      <imsx_version>V1.0</imsx_version>
      <imsx_messageIdentifier>MESSAGE</imsx_messageIdentifier>
    </imsx_POXRequestHeaderInfo>
  </imsx_POXHeader>
  <imsx_POXBody>
    <OPERATION>
      <resultRecord>
        <sourcedGUID>
          <sourcedId>SOURCEDID</sourcedId>
        </sourcedGUID>
        <result>
          <resultScore>
            <language>en-us</language>
            <textString>GRADE</textString>
          </resultScore>
        </result>
      </resultRecord>
    </OPERATION>
  </imsx_POXBody>
</imsx_POXEnvelopeRequest>';
}

/*  $postBody = str_replace(
      array('SOURCEDID', 'OPERATION','MESSAGE'),
      array($sourcedid, $operation, uniqid()),
      getPOXRequest());
*/
function getPOXRequest() {
    return '<?xml version = "1.0" encoding = "UTF-8"?>
<imsx_POXEnvelopeRequest xmlns = "http://www.imsglobal.org/services/ltiv1p1/xsd/imsoms_v1p0">
  <imsx_POXHeader>
    <imsx_POXRequestHeaderInfo>
      <imsx_version>V1.0</imsx_version>
      <imsx_messageIdentifier>MESSAGE</imsx_messageIdentifier>
    </imsx_POXRequestHeaderInfo>
  </imsx_POXHeader>
  <imsx_POXBody>
    <OPERATION>
      <resultRecord>
        <sourcedGUID>
          <sourcedId>SOURCEDID</sourcedId>
        </sourcedGUID>
      </resultRecord>
    </OPERATION>
  </imsx_POXBody>
</imsx_POXEnvelopeRequest>';
}

/*     sprintf(getPOXResponse(),uniqid(),'success', "Score read successfully",$message_ref,$body);
*/

function getPOXResponse() {
    return '<?xml version="1.0" encoding="UTF-8"?>
<imsx_POXEnvelopeResponse xmlns="http://www.imsglobal.org/services/ltiv1p1/xsd/imsoms_v1p0">
    <imsx_POXHeader>
        <imsx_POXResponseHeaderInfo>
            <imsx_version>V1.0</imsx_version>
            <imsx_messageIdentifier>%s</imsx_messageIdentifier>
            <imsx_statusInfo>
                <imsx_codeMajor>%s</imsx_codeMajor>
                <imsx_severity>status</imsx_severity>
                <imsx_description>%s</imsx_description>
                <imsx_messageRefIdentifier>%s</imsx_messageRefIdentifier>
            </imsx_statusInfo>
        </imsx_POXResponseHeaderInfo>
    </imsx_POXHeader>
    <imsx_POXBody>%s
    </imsx_POXBody>
</imsx_POXEnvelopeResponse>';
}

function replaceResultRequest($grade, $sourcedid, $endpoint, $oauth_consumer_key, $oauth_consumer_secret) {
    $method="POST";
    $content_type = "application/xml";
    $operation = 'replaceResultRequest';
    $postBody = str_replace(
        array('SOURCEDID', 'GRADE', 'OPERATION','MESSAGE'),
        array($sourcedid, $grade, $operation, uniqid()),
        getPOXGradeRequest());

    $response = sendOAuthBodyPOST($method, $endpoint, $oauth_consumer_key, $oauth_consumer_secret, $content_type, $postBody);
    return parseResponse($response);
}

function parseResponse($response) {
    $retval = Array();
    try {
        $xml = new SimpleXMLElement($response);
        $imsx_header = $xml->imsx_POXHeader->children();
        $parms = $imsx_header->children();
        $status_info = $parms->imsx_statusInfo;
        $retval['imsx_codeMajor'] = (string) $status_info->imsx_codeMajor;
        $retval['imsx_severity'] = (string) $status_info->imsx_severity;
        $retval['imsx_description'] = (string) $status_info->imsx_description;
        $retval['imsx_messageIdentifier'] = (string) $parms->imsx_messageIdentifier;
        $imsx_body = $xml->imsx_POXBody->children();
        $operation = $imsx_body->getName();
        $retval['response'] = $operation;
        $parms = $imsx_body->children();
    } catch (Exception $e) {
        throw new Exception('Error: Unable to parse XML response' . $e->getMessage());
    }

    if ( $operation == 'readResultResponse' ) {
       try {
           $retval['language'] =(string) $parms->result->resultScore->language;
           $retval['textString'] = (string) $parms->result->resultScore->textString;
       } catch (Exception $e) {
            throw new Exception("Error: Body parse error: ".$e->getMessage());
       }
    }
    return $retval;
}
?>
