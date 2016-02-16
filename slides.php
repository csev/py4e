<?php 
include("config.php");
include("header.php"); 
include("nav.php"); 
$codes = file_get_contents('ISO-639-2_utf-8.txt');
$codes = explode('|',$codes);
?>
<div class="hide-for-large" id="mobile-support"></div>
<div id="first-row" class="row">
     <div class="small-12 medium-12 large-3 large-push-9 columns">
        <div class="text-center">
            <a href="http://amzn.to/1KkULF3" target="_blank">
                <img width="auto" height="100%" src="BookCoverPreviewFront.jpg" alt="A picture of the book cover art"/>
            </a>
        </div>
    </div>

    <div class="small-12 medium-12 large-9 large-pull-3 columns">
        <h2>Python for Informatics: Exploring Information</h2>

<!-- book accordion menu -->
<div class="acc-menu" id="book-menu">
<ul class="vertical menu" data-accordion-menu>
  <li>
    <a href="#">Click Here To Get The Slides</a>
    <ul class="menu vertical nested">
      <li>
        <a href="#">Select A Language</a>
        <ul class="menu vertical nested">
<?php
$folders = scandir('slides');
foreach($folders as $folder ) {
    if ( strpos($folder,'.') === 0 ) continue;
    if ( ! is_dir('slides/'.$folder) ) continue;
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
    $files = scandir('slides/'.$folder);
    foreach($files as $file) {
        if ( strpos($file,'.') === 0 ) continue;
        echo('<li><a href="'.$link.'/'.$file.'" target="_blank">'.htmlentities($file).'</a></li>'."\n");
    }

    echo(" </ul></li>\n");
}
?>
<!--
          <li>
             <a href="#">Over 30 Translations on Google Drive</a>
             <ul class="menu vertical nested">
                <li><a href="https://drive.google.com/folderview?id=0B7X1ycQalUnyWXg2MVhTbEZFT28&usp=sharing" target="_blank">Go to Course Slides</a></li>
             </ul>
          </li>
-->
        </ul>
      </li>
    </ul>
  </li>
</ul>
</div>
</div>
</div>
<div class="row">
    <div class="small-12 columns">
        <br>
        <p>
            All of these materials are free and I want you to take them, use them and reuse them. If you would like to leave a tip, feel free to do so using the PayPal Donate button below.
        </p>
<center>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<div class="hide-for-large">
    <input type="image" width="60%" height="auto" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online!">
</div>
<div class="show-for-large">
    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online!">
</div>
<img alt=""src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif">
</form>
</center>
</div>
</div>

<script>
  jQuery(document).ready(function(){
               
                var elem = new Foundation.AccordionMenu(jQuery('.acc-menu'),
                             {multiOpen: false});
            });
</script>

<?php include("footer.php"); ?>
