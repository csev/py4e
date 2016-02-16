<?php 
include("../config.php");
$codes = file_get_contents('../ISO-639-2_utf-8.txt');
$codes = explode('|',$codes);
?><body style="font-family: sans-serif">
<h2>Python for Informatics: Exploring Information</h2>
<p>
<ul class="menu vertical nested">
<?php
$folders = scandir('.');
foreach($folders as $folder ) {
    if ( strpos($folder,'.') === 0 ) continue;
    if ( ! is_dir($folder) ) continue;
    $name = $folder;
    if ( strlen($folder) > 1 ) {
        $prefix = strtolower(substr($folder,0,2));
        $pos = array_search($prefix,$codes);
        if ( $pos !== False && $pos+1 < count($codes)-1 ) {
            if ( strlen($codes[$pos+1]) > 0 ) $name = $codes[$pos+1];
        }
    }
?>
          <li>
             <a href="#"><?= htmlentities($name) ?></a>
             <ul class="menu vertical nested">
<?php

    $link = $CFG->cdnroot.'/slides/'.$folder;
    $files = scandir($folder);
    foreach($files as $file) {
        if ( strpos($file,'.') === 0 ) continue;
        echo('<li><a href="'.$link.'/'.$file.'" target="_blank">'.htmlentities($file).'</a></li>'."\n");
    }

    echo(" </ul></li>\n");
}
?>
<!--
                <li><a href="https://drive.google.com/folderview?id=0B7X1ycQalUnyWXg2MVhTbEZFT28&usp=sharing" target="_blank">Translations on Google Drive</a></li>
          </li>
-->
        </ul>
</p>
<p>
If you are interested in helping with the translations of the slides, please read
<a href="https://docs.google.com/document/d/1cwXpPxEAWZNNmR2NjS5onAExPBJMb03B_DFFIHXFMqA/edit"
target="_blank">the instructions</a> for editing the files.  We also have a 
<a href="https://groups.google.com/forum/#!forum/py4inf" target="_blank">Google Group</a>
to coordinate among the folks doing the translations.
</p>
</body>
<?php
require_once "../footer.php";
