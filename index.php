<?php
use \Tsugi\Core\LTIX;
use \Tsugi\UI\Output;

require_once "top.php";
require_once "nav.php";
?>
<div id="container">

<h1>Python for Everybody</h1>

<p>The goal of this site is to provide a set of materials in support of my <a href="book.php">Python for Everybody</a> book to allow you to learn Python on your own. This page serves as an outline of the materials to support the textbook.

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
