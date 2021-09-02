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
    if ( strpos($HTML_FILE, $file) === 0 ) {
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
  <option <?= x_sel("01-intro") ?>>Κεφάλαιο 1: Εισαγωγή</option>
  <option <?= x_sel("02-variables") ?>>Κεφάλαιο 2: Μεταβλητές</option>
  <option <?= x_sel("03-conditional") ?>>Κεφάλαιο 3: Συνθήκες</option>
  <option <?= x_sel("04-functions") ?>>Κεφάλαιο 4: Συναρτήσεις</option>
  <option <?= x_sel("05-iterations") ?>>Κεφάλαιο 5: Επαναλήψεις</option>
  <option <?= x_sel("06-strings") ?>>Κεφάλαιο 6: Strings - Συμβολοσειρές</option>
  <option <?= x_sel("07-files") ?>>Κεφάλαιο 7: Αρχεία</option>
  <option <?= x_sel("08-lists") ?>>Κεφάλαιο 8: Λίστες</option>
  <option <?= x_sel("09-dictionaries") ?>>Κεφάλαιο 9: Λεξικά - Dictionaries</option>
  <option <?= x_sel("10-tuples") ?>>Κεφάλαιο 10: Πλειάδες - Tuples</option>
  <option <?= x_sel("11-regex") ?>>Κεφάλαιο 11: Σύντομες Εκφράσεις - Regex</option>
  <option <?= x_sel("12-network") ?>>Κεφάλαιο 12: Δικτυακά Προγράμματα</option>
  <option <?= x_sel("13-web") ?>>Κεφάλαιο 13: Python και Υπηρεσίες Ιστού</option>
  <option <?= x_sel("14-objects") ?>>Κεφάλαιο 14: Αντικείμενα στην Python </option>
  <option <?= x_sel("15-database") ?>>Κεφάλαιο 15: Python και Βάσεις Δεδομένων</option>
  <option <?= x_sel("16-viz") ?>>Κεφάλαιο 16: Οπτικοποίηση Δεδομένων</option>
</select>
</div>

<?php
echo($body);
?>
<hr/>
<p>
Αν εντοπίσετε κάποιο λάθος σε αυτό το βιβλίο μην δστάσετε να μου στείλετε τη διόρθωση στο
<a href="https://github.com/csev/py4e/tree/master/book3" target="_blank">Github</a>.
</p>
<?php

$OUTPUT->footer();
