<?php
use \Tsugi\Core\LTIX;
use \Tsugi\UI\Output;

require_once "top.php";
require_once "nav.php";
?>
<div id="container">

    <p>The goal of this site is to provide a set of materials in support of my <a href="book.php#python-for-informatics">Python for Informatics: Exploring Information</a> book to allow you to learn Python on your own. This page serves as an outline of the materials to support the textbook.
    </p>
    <p><b>New:</b> The <a href="book.php">Python 3 version</a> of the book is now available.  Over the next few months, the slides, and lecture recordings
will be updated to be Python 3.  We will keep all the Python 2 material as archives once the Python 3 material is complete.
    </p>
    <p>You can download the exercises, audio, and video lectures to your local computer so you can play them locally. This can be done with either a Right-Click or a Control-Click in most browsers.
    </p>


          <h4>Archive</h4></a>
          <p>
            Here is an archive of the <a href="https://archive.org/details/201509UMSI502Podcasts_201601" target="_blank">live lecture recordings</a> from SI502 at the UM School of Information Fall 2015.
          </p>
          <p>
            Here are <a href="videos/" target="_blank">archive copies</a> of the various audio, video, PowerPoints, PDFs and closed caption files if you want to reuse these materials in your own courses. All this material (including audio and video) is
            Copyright Creative Commons Attribution 3.0 unless otherwise indicated.
          </p>
          <h4>Big Data Workshop</h4></a>
          <p>
            Here are the materials for the <a href="workshop/materials.zip">Big Data Workshop</a>.
          </p>
<!--
<?php
echo(Output::safe_var_dump($_SESSION));
var_dump($USER);
?>
-->
</div>
<?php $OUTPUT->footer();
