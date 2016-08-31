<?php
use \Tsugi\Core\LTIX;
use \Tsugi\UI\Output;

require_once "top.php";
require_once "nav.php";
?>
<div id="container">

<h1>Python for Everybody (PY4E)</h1>

<p>The goal of this site is to provide a set of materials in support of 
my <a href="book.php">Python for Everybody</a> book to allow you to learn 
Python on your own. The <a href="tsugi/lessons.php">Lessons</a> page serves as an 
outline of the materials to support the textbook.  
</p>
<p>
If you <a href="tsugi/login.php">log in</a> to this site, you can submit homework to its 
autograders and track your progress through the materials.  
There are a number of badges that you can earn by doing the assignments in this class.
</p>
<h2>Under Construction</h2>
<p>
<b>Note:</b>
The slides, videos, and autograders are in the process of being updated from Python 2.0 to Python 3.0 during Fall 2016 as I teach SI502 on campus using my new book.  You may also be interested in the 
older version of this book: <a href="http://www.py4inf.com" target="_blank">Python for Informatics: Exploring Information in Python 2.0</a>.
</p>
<h2>Audio Archive</h2>
<p>
Here is an archive of the 
<a href="https://archive.org/details/201509UMSI502Podcasts_201601" target="_blank">live lecture recordings</a> 
from SI502 at the UM School of Information Fall 2015.
</p>
<!--
<?php
echo(Output::safe_var_dump($_SESSION));
var_dump($USER);
?>
-->
</div>
<?php $OUTPUT->footer();
