<?php
use \Tsugi\Core\LTIX;
use \Tsugi\UI\Output;

require_once "top.php";
require_once "nav.php";
?>
<div id="container">
<h1>Python for Everybody</h1>
<?php if ( isset($_SESSION['id']) ) { ?>
<p>
Welcome to my Massive Open Online Course (MOOC) version of Python for Everybody. 
Now that you have logged in, you have access to course-style features of this web site.
<ul class="list-group">
<li class="list-group-item">
As you go through the <a href="tsugi/lessons.php">Lessons</a> in the course you now will see additional
links to the autograders in the class.  You can attempt the autograders and get a score.</li>
<li class="list-group-item">
You can track your progress through the course using the <a href="tsugi/assignments.php">Assignments</a>
tool and when you complete a group of assignments, you can earn a <a href="tsugi/badges.php">Badge</a>.
You can download these badges and host them on your web site or refer the badge URLs on this site.</li>
<li class="list-group-item">
There is an
<a href="https://disqus.com/home/channel/pythonforeverybody/" target="_blank">online disucssion forum</a>
hosted by Disqus.</li>
<li class="list-group-item">
If you want to use these Creative Commons Licensed materials 
in your own classes you can download or link to the artifacts on this site,
<a href="tsugi/cc/export.php">export the course material</a> as an
IMS Common Cartridge®, or apply for
an IMS Learning Tools Interoperability® (LTI®)
<a href="tsugi/admin/key/index.php">key and secret</a>
 to launch the autograders from your LMS.
</li>
</ul>
<?php } else { ?>
<p>
Hello and welcome to my site where you can work through my course materials related to
my free <a href="book.php">Python for Everybody</a> text book.
<p>
You can use this web site many different ways:
<ul class="list-group">
<li class="list-group-item">
You browse my videos and course materials under <a href="tsugi/lessons.php">Lessons</a>.  The materials
I have developed
for this class are all provided with a Creative Commons license so you can download or link to
them to incorporate them into your own teaching if you like.</li>
<li class="list-group-item">
This site uses <a href="http://www.tsugi.org" target="_blank">Tsugi</a> framework to embed a learning
management system into this site.  So if you <a href="tsugi/login.php">log in</a> to this site
it is as if you have joined a free, global
open and online course.  You have a grade book, autograded assignments, a discussion forum, and can earn
badges for your efforts.</li>
<li class="list-group-item">
If you want to use these Creative Commons Licensed materials 
in your own classes you can download or link to the artifacts on this site,
<a href="tsugi/cc/export.php">export the course material</a> as an
IMS Common Cartridge®, or apply for
an IMS Learning Tools Interoperability® (LTI®)
<a href="tsugi/admin/key/index.php">key and secret</a>
 to launch the autograders from your LMS.
</li>
<li class="list-group-item">
The code for this site including the autograders, slides, and course content is all available on
<a href="https://github.com/csev/pythonlearn" target="_blank">GitHub</a>.  That means you could make your own
copy of the course site, publish it and remix it any way you like.  Even more exciting, you could translate
the entire site (course) into your own language and publish it.</li>
</ul>
<?php } ?>
I think that this is an exciting way to provide online materials.  If you are interested in collaborating
to build these kinds of sites for yourself, please see the
<a href="http://www.tsugi.org" target="_blank">tsugi.org</a> website.
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
