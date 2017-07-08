<?php
use \Tsugi\Core\LTIX;
use \Tsugi\UI\Output;

$pos_head_start = strpos($HTML,'<head');
$pos_head_start = strpos($HTML,'<',$pos_head_start+1);
$pos_head_end = strpos($HTML,'</head',$pos_head_start);
$pos_body = strpos($HTML,'<body',$pos_head_end);
$pos_body = strpos($HTML,'<',$pos_body+1);
$pos_end = strpos($HTML,'</body',$pos_body);
$head = substr($HTML, $pos_head_start, $pos_head_end-$pos_head_start);
$body = substr($HTML, $pos_body, $pos_end-$pos_body);
require_once "top.php";
require_once "nav.php";

function x_sel($file) {
    global $HTML_FILE;
    $retval = 'value="'.$file.'"';
    if ( $file == $HTML_FILE ) {
        $retval .= " selected";
    }
    return $retval;
}

?>
<script>
function onSelect() {
    console.log($('#chapters').val());
    window.location = $('#chapters').val();
}
</script>    
<div style="float:right">
<select id="chapters" onchange="onSelect();">
  <option <?= x_sel("01-intro.php") ?>>Chapter 1: Introduction</option>
  <option <?= x_sel("02-variables.php") ?>>Chapter 2: Variables</option>
  <option <?= x_sel("03-conditional.php") ?>>Chapter 3: Conditionals</option>
  <option <?= x_sel("04-functions.php") ?>>Chapter 4: Functions</option>
  <option <?= x_sel("05-iterations.php") ?>>Chapter 5: Iterations</option>
  <option <?= x_sel("06-strings.php") ?>>Chapter 6: Strings</option>
  <option <?= x_sel("07-files.php") ?>>Chapter 7: Files</option>
  <option <?= x_sel("08-lists.php") ?>>Chapter 8: Lists</option>
  <option <?= x_sel("09-dictionaries.php") ?>>Chapter 9: Dictionaries</option>
  <option <?= x_sel("10-tuples.php") ?>>Chapter 10: Tuples</option>
  <option <?= x_sel("11-regex.php") ?>>Chapter 11: Regex</option>
  <option <?= x_sel("12-network.php") ?>>Chapter 12: Networked Programs</option>
  <option <?= x_sel("13-web.php") ?>>Chapter 13: Python and Web Services</option>
  <option <?= x_sel("14-database.php") ?>>Chapter 14: Python and Databases</option>
</select>
</div>

<?

echo($body);

$OUTPUT->footer();
