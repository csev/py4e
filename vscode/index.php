<?php

if ( ! defined('COOKIE_SESSION') ) define('COOKIE_SESSION', true);

require_once "../tsugi/config.php";
require_once "Parsedown.php";
require_once "Parsedown_emoji.php";

require_once "../top.php";
require_once "../nav.php";

if ( ! function_exists('endsWith') ) {
function endsWith($haystack, $needle) {
    // search forward starting from end minus needle length characters
    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
}
}

$url = $_SERVER['REQUEST_URI'];

$pieces = explode('/',$url);

$file = false;
$contents = false;
if ( $pieces >= 2 ) {
   $file = $pieces[count($pieces)-1];
   if ( ! endsWith($file, '.md') ) $file = false;
   if ( ! $file || ! file_exists($file) ) $file = false;
}

if ( $file !== false ) {
    $contents = file_get_contents($file);
    $HTML_FILE = $file;
}

function x_sel($file) {
    global $HTML_FILE;
    $retval = 'value="'.$file.'"';
    if ( strpos($HTML_FILE, $file) === 0 ) {
        $retval .= " selected";
    }
    return $retval;
}


$OUTPUT->header();
?>
<style>
center {
    padding-bottom: 10px;
}
@media print {
    #chapters {
        display: none;
    }
}
</style>
<?php
$OUTPUT->bodyStart();
// $OUTPUT->topNav();

if ( $contents != false ) {
?>
<script>
function onSelect() {
    console.log($('#chapters').val());
    window.location = $('#chapters').val();
}
</script>
<div style="float:right">
<select id="chapters" onchange="onSelect();">
  <option <?= x_sel("ngrok_mac.md") ?>>Using Ngrok on the Mac</option>
  <option <?= x_sel("ngrok_win.md") ?>>Using Ngrok on Windows</option>
</select>
</div>
<?php
    $Parsedown = new Parsedown();
    $result = str_replace($parsedown_emoji_search, $parsedown_emoji_replace, $Parsedown->text($contents));
    echo $Parsedown->text($result);
} else {
?>
<p>
This is a set of supplementary documentation for use with this
web site.
</p>
<ul>
<li><a href="ngrok_mac.md">Using Ngrok and the Autograder on a Macintosh</a></li>
<li><a href="ngrok_win.md">Using Ngrok and the Autograder on Windows-10</a></li>
</ul>
<p>
Note that if you are running Windows and the bash shell, NGrok does not seem to start.  
Use the Windows Command line to run NGrok on Windows.
<p>
If you find a mistake in this documentation, feel free to send me a fix using
<a href="https://github.com/csev/wa4e/tree/master/md" target="_blank">Github</a>.
</p>
<?php
}
$OUTPUT->footer();

