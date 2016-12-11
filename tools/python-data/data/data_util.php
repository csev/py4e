<?php

use \Tsugi\Util\Mersenne_Twister;
use \Tsugi\Util\Net;
use \Tsugi\Core\LTIX;

// Global Configuration Options

// $GLOBAL_PYTHON_DATA_URL = false; // To serve locally
$GLOBAL_PYTHON_DATA_URL = 'http://py4e-data.dr-chuck.net/';

// $GLOBAL_PYTHON_DATA_REMOVE_HTTPS = true;  // To map data urls to http:
$GLOBAL_PYTHON_DATA_REMOVE_HTTPS = false;

function getShuffledNames($code) {
    global $NAMES;
    if ( ! is_array($NAMES) ) {
        die("Name data not loaded");
    }
    $MT = new Mersenne_Twister($code);
    $new = $MT->shuffle($NAMES);
    return $new;
}

function getRandomNumbers($code, $count=400, $max=10000) {
    $retval = array();
    $MT = new Mersenne_Twister($code);
    for($i=0; $i < $count; $i++ ) {
        $retval[] = $MT->getNext(1,$max);
    }
    return $retval;
}

function validate($sanity, $code ) {
    if ( strlen($code) < 1 ) return "Python code is required";
    foreach($sanity as $match => $message ) {
        if ( $match[0] == '/' ) {
            if ( preg_match($match, $code) ) return $message;
        } else if ( $match[0] == '!' ) {
            if ( strpos($code,substr($match,1)) !== false ) return $message;
        } if (strpos($code,$match) === false ) {
            return $message;
        }
    }
    return true;
}

function httpsWarning($url) {
    if ( strpos($url, 'https://') !== 0 ) return;
?>
<p><b>Note:</b> If you get an error when you run your program that complains about 
<b>CERTIFICATE_VERIFY_FAILED</b> when you call <b>urlopen()</b>, make the following
changes to your program:
<pre>
import urllib
import json
<b>import ssl</b>

...

    print 'Retrieving', url
    <b>scontext = ssl.SSLContext(ssl.PROTOCOL_TLSv1)</b>
    uh = urllib.urlopen(url<b>, context=scontext</b>)
    data = uh.read()
</pre>
This will keep your Python code from rejecting the server's certificate.
</p>
<?php
}

function deHttps($url) {
    global $GLOBAL_PYTHON_DATA_REMOVE_HTTPS;
    if ( ! $GLOBAL_PYTHON_DATA_REMOVE_HTTPS ) return $url;
    return str_replace('https://', 'http://', $url);
}

function dataUrl($file) {
    global $GLOBAL_PYTHON_DATA_URL;
    if ( is_string($GLOBAL_PYTHON_DATA_URL) ) {
        return $GLOBAL_PYTHON_DATA_URL.$file;
    }
    $url = LTIX::curPageUrlScript();
    $retval = str_replace('index.php','data/'.$file,$url);
    return $retval;
}

function getJsonOrDie($sample_url) {
    $sample_data = Net::doGet($sample_url);
    $sample_count = strlen($sample_data);
    $response = Net::getLastHttpResponse();
    $sample_json = json_decode($sample_data);
    if ( $response != 200 || $sample_json == null ) {
        error_log("DIE: Sample response=$response url=$sample_url json_error=".json_last_error_msg());
        die("Sample response=$response url=$sample_url json_error=".json_last_error_msg());
    }
    return $sample_json;
}

function sumCommentJson($json) {
    $total = 0;
    foreach($json->comments as $comment) {
        $total = $total + $comment->count;
    }
    return $total;
}

