<?php
require_once "setup.php";

// Load up the LTI Support code
require_once 'util/lti_util.php';

session_start();
header('Content-Type: text/html; charset=utf-8');

// Why not?
$oauth_consumer_key = "12345";
$oauth_consumer_secret = "secret";

if ( ! is_lti_request() ) {
    // Initialize, no secret, pull from session, and do not redirect
    $context = new BLTI(false, true, false);
    if ( isset($_SESSION['oauth_consumer_key']) && isset($_SESSION['oauth_consumer_secret']) ) {
        $oauth_consumer_key = $_SESSION['oauth_consumer_key'];
        $oauth_consumer_secret = $_SESSION['oauth_consumer_secret'];
    }
} else {
    if ( isset($_POST['oauth_consumer_key']) ) {
        $oauth_comsumer_key = $_POST['oauth_consumer_key'];
        require_once 'keys.php';
        if ( isset($LTI_KEYS[$oauth_consumer_key]) ) $oauth_consumer_secret = $LTI_KEYS[$oauth_consumer_key];
    }
    // Initialize, all secrets are 'secret', set session, and do not redirect
    $context = new BLTI($oauth_consumer_secret, true, false);
    if ( ! $context->valid ) {
        echo("<h1>Error: Incorrect LTI secret</h1>");
        return;
    }
    $_SESSION['oauth_consumer_secret'] = $oauth_consumer_secret;
    $_SESSION['oauth_consumer_key'] = $oauth_consumer_key;
}
?>
<!DOCTYPE html>
<html>
<head>
<?php 
require_once "header.php";
require_once "exercises.php";

$QTEXT = 'Please write a Python program to open the file 
"mbox-short.txt" and count the number of lines in the file and 
match the desired output below:';
$DESIRED = '1910 Lines';
$CODE = 'fh = open("mbox-short.txt", "r")

count = 0
for line in fh:
   count = count + 1

print count,"Lines"
';
$CHECKS = false;
$ex = "count";

if ( isset($_REQUEST["exercise"]) ) {
    $ex = $_REQUEST["exercise"];
    $EX = false;
    if ( isset($EXERCISES[$ex]) ) $EX = $EXERCISES[$ex];
    if ( $EX !== false ) {
        $CODE = '';
        $QTEXT = $EX["qtext"];
        $DESIRED = $EX["desired"];
        if ( isset($EX["code"]) ) $CODE = $EX["code"];
        if ( isset($EX["checks"]) ) $CHECKS = json_encode($EX["checks"]);
    }
}
$DESIRED = rtrim($DESIRED);
?>
<style>
body { font-family: sans-serif; }
</style>
<script src="dist/skulpt.js" type="text/javascript"></script>
<script src="dist/jquery.min.js" type="text/javascript"></script> 
<script type="text/javascript">
<?php
    if ( $CHECKS === false ) {
        echo("   window.CHECKS = false;\n");
    } else {
        echo("   window.CHECKS = $CHECKS;\n");
    }
?>
    window.GLOBAL_ERROR = true;
    window.GLOBAL_TIMER = false;

    if (typeof console == "undefined") {
        console = {log: function() {}};
    }

    function hideall() {
        $("#check").hide();
        $("#grade").hide();
        $("#redo").hide();
        $("#gradegood").hide();
        $("#gradebad").hide();
    }

    function finalcheck() {
        if ( window.GLOBAL_TIMER != false ) window.clearInterval(window.GLOBAL_TIMER);
        window.GLOBAL_TIMER = false;
        hideall();
        $("#spinner").hide();
        var prog = document.getElementById("code").value;
        for ( var key in window.CHECKS ) {
            // The key can be inverted if the first character is !
            if ( key.length > 1 && key.substring(0,1) == '!' ) {
                xkey = key.substring(1);
                if ( prog.indexOf(xkey) < 0 ) continue;
            } else {
                if ( prog.indexOf(key) >= 0 ) continue;
            }
            alert(window.CHECKS[key]);
            window.GLOBAL_ERROR = true;
            break;
        }

        if ( window.GLOBAL_ERROR ) {
            $("#redo").show();
        } else {
            $("#check").show();
            $("#grade").show();
        }
    }

    function outf(text)
    {
        // console.log('Text='+text);
        var output = document.getElementById("output");
        oldtext = output.innerHTML;
        oldtext = oldtext.replace(/<span.*span>/g,"")
        text = text.replace(/</g, '&lt;');
        newtext = oldtext + text;
        output.innerHTML = newtext;
        var desired = document.getElementById("desired").innerHTML;

        deslines = desired.split('\n');
        newlines = newtext.split('\n');
        newoutput = '';
        err = false;
        if ( window.GLOBAL_TIMER != false ) window.clearInterval(window.GLOBAL_TIMER);
        window.GLOBAL_TIMER = setTimeout("finalcheck();",1500);
        for ( i=0, newlength = newlines.length; i < newlength; i++ ) {
            if ( i > 0 ) newoutput += '\n';
            nl = newlines[i];
            newoutput += nl;
            if ( i >= deslines.length ) {
                if ( !err ) newoutput += '<span style="color:red"> &larr; Extra output</span>';
                err = true;
                continue;
            }
            dl = deslines[i];
            if ( dl != nl ) {
                if ( !err ) newoutput += '<span style="color:red"> &larr; Mismatch</span>';
                err = true;
                continue;
            }
        }
        if ( !err && deslines.length > newlines.length ) {
            newoutput += '<span style="color:red"> &larr; Missing output</span>';
        }
        window.GLOBAL_ERROR = err;
        console.log(err);
        output.innerHTML = newoutput;
    }

    function runit()
    {
        hideall();
        $("#spinner").show();
        var prog = document.getElementById("code").value;
        var output = document.getElementById("output");
        output.innerHTML = '';
        Sk.configure({output:outf});
        try {
            var module = Sk.importMainWithBody("<stdin>", false, prog);
        } catch (e) {
            window.GLOBAL_ERROR = true;
            hideall();
            $("#spinner").hide();
            $("#redo").show();
            if ( window.GLOBAL_TIMER != false ) window.clearInterval(window.GLOBAL_TIMER);
            window.GLOBAL_TIMER = false;
            alert(e);
        }
        return false;
    }

    function gradeit() {
        $("#check").hide();
        $("#spinner").show();
        $.getJSON('<? echo $context->addSession('grade.php'); ?>', function(data) {
            console.log(data);
            $("#spinner").hide();
            if ( data["status"] == "success") {
                $("#gradegood").show();
            } else {
                $("#gradebad").show();
            }
        });
        return false;
    }

$(document).ready( function() {
	$doc = $(window).height();
	$it = $("#inputs").offset().top;
	$fh = $("#footer").height();
	$avail = $doc - $it - $fh + 10;
	if ( $avail < 500 ) $avail = 500;
	if ( $avail > 900 ) $avail = 900;
	$ih = $avail * 0.6;
	$("#inputs").height($ih);
	$("#outputs").height($avail*0.4);
	$ct = $('#code').offset().top;
	$('#code').height($ih - ($ct - $it)-15);$
} );
</script>
</head>
<body>
<div style="padding: 0px 15px 0px 15px;">
<div id="inputs" style="height:300px; min-height:200px;">
<div class="well">
<?php echo($QTEXT); ?>
</div>
<form style="height:100%;">
<button onclick="runit()" type="button">Check Code</button>
<?php
if ( $context->valid && $context->getOutcomeService() !== false ) {
?>
<button id="grade" onclick="gradeit()" type="button" style="display:none">Submit Grade</button>
<?php } ?>
<?php
if ( ! $context->valid && isset($_GET["done"]) ) {
  $url = $_GET['done'];
  echo("<button onclick=\"window.location='$url';\" type=\"button\">Done</button>\n");
}
?>
<img id="spinner" src="dist/spinner.gif" style="vertical-align: middle;display: none">
<span id="redo" style="color:red;display:none"> Please Correct your code and re-run. </span>
<span id="check" style="color:green;display:none"> Congratulations the exercise is complete. </span>
<span id="gradegood" style="color:green;display:none"> Grade Updated. </span>
<span id="gradebad" style="color:red;display:none"> Error storing grade. </span>
<br/>
Enter Your Python Code Here:<br/>
<textarea id="code" cols="80" style="font-family:fixed;font-size:16px;color:blue;width:99%;">
<?php echo($CODE); ?>
</textarea>
</form>
</div>
<div id="outputs" style="height:300px; min-height:200px;">
<div id="left" style="width:50%;float:right;height:100%;overflow:scroll;border:1px solid black">
<b>Desired Output</b>
<pre id="desired" style="height:100%"><?php echo($DESIRED); echo("\n"); ?>
</pre>
</div>
<div id="right" style="width:49%;height:100%;float:left;overflow:scroll;border:1px solid black">
<b>Your Output</b>
<pre id="output" style="height:100%;"></pre>
</div>
</div>

<div id="mbox-short.txt" style="display:none"><?php
$fh = fopen("mbox-short.txt","r");
while (!feof($fh)) {
   $line = fgets($fh);
   $line = str_replace("&","&amp;",$line);
   $line = str_replace("<","&lt;",$line);
   echo $line;
}
fclose($fh);
?></div>
<div id="footer">
<br clear="all"/>
<center>
This autograder is based on <a href="http://skulpt.org/" target="_new">Skulpt</a>.
</center>
</div>
<?php

print "<!--\n";
print "Context Information:\n\n";
print $context->dump();

print "\nSESSION Parameters:\n\n";
ksort($_SESSION);
foreach($_SESSION as $key => $value ) {
    if (get_magic_quotes_gpc()) $value = stripslashes($value);
    print "$key=$value (".mb_detect_encoding($value).")\n";
}
print "-->";

?>
</div>
</body>
