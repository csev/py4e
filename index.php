<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
     "DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php include("header.php"); ?>
</head>
<body>
<?php include("nav.php"); ?>
<div id="main">
<div style="float: right; width:300px; padding: 5px;">
<iframe width="300" height="169" src="//www.youtube.com/embed/UQVK-dsU7-Y" frameborder="0" allowfullscreen></iframe>
</div>
<p>
The goal of this site is to provide a set of materials in support of my
<a href="book.php">Python for Informatics: Exploring Information</a> book
to allow
you to learn Python on your own.  This page serves as an outline
of the materials to support the textbook.
</p>
<p>
<b>New:</b> The book is being converted into Python 3 and here is how
you could <a href="book/index.htm">help us with the conversion</a>.
</p>
You can download the exercises, audio, 
and video lectures to your local computer so you can play them locally.  This
can be done with either a Right-Click or a Control-Click in most browsers.
</p>
<?php
function media($name) {
    echo('<a href="youtube/'.$name.'.php" target="_blank">YouTube</a>,'."\n");
    // echo('<a href="lectures/'.$name.'.ppt" target="_blank">Slides</a>,'."\n");
    // Note - These both redirect
    echo('<a href="podcasts/'.$name.'.mp3" target="_blank">Audio</a>,'."\n");
    echo('<a href="videos/'.$name.'.mp4" target="_blank">Video</a>');
}
$afs = "http://www-personal.umich.edu/~csev";
?>
<p>
<ul>
<li>
Welcome Lecture - 
(<a href="https://www.youtube.com/watch?v=UQVK-dsU7-Y&index=2&list=PLlRFEj9H3Oj4JXIwMwN1_ss1Tk8wZShEJ"
    target="_blank">YouTube</a>,
<a href="https://itunes.apple.com/us/podcast/python-for-informaticss-official/id711095516?mt=2" target="_blank">Audio podcast for all lectures</a>)
</li>
<li>
Get your copy of the <a href="book.php">Python for Informatics: 
Exploring Information</a>.

<li>
Install the appropriate version of Python and a text editor
for your system following 
<a href=install.php>these instructions</a>.  </li>

<li>
Download <a href="code.zip" target="_blank">Sample code from the book</a>.</li>

<li>Play with the <a href="pythonauto/index.php">Auto-grader</a> and write a "hello world" program.

<li>
The 
<a href="https://drive.google.com/folderview?id=0B7X1ycQalUnyWXg2MVhTbEZFT28&usp=sharing" target="_blank">course slides</a> 
have been converted to Google drive and are being translated into 30 languages.
</li>

<li>Chapter 1 - Why program?
(<?php media('Py4Inf-01-Intro'); ?>)

<li>Chapter 2 - Variables, expressions, and statements
(<?php media('Py4Inf-02-Expressions'); ?>)

<br/>&nbsp;&nbsp;&bull;&nbsp;Worked Exercise Screencasts:
<a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-02-02.mp4"
    target="_blank">2.2</a>,
<a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-02-03.mp4"
    target="_blank">2.3</a> (suggest download)

<li>Chapter 3 - Conditional Execution
(<?php media('Py4Inf-03-Conditional'); ?>)

<br/>&nbsp;&nbsp;&bull;&nbsp;Worked Exercise Screencasts:
<a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-03-01.mp4"
    target="_blank">3.1</a>,
<a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-03-02.mp4"
    target="_blank">3.2</a> (suggest download)


<li>Chapter 4 - Functions
(<?php media('Py4Inf-04-Functions'); ?>)

<br/>&nbsp;&nbsp;&bull;&nbsp;Worked Exercise Screencasts:
<a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-04-06.mp4"
    target="_blank">4.6</a> (suggest download)

<li>Chapter 5 - Loops and iterations
(<?php media('Py4Inf-05-Iterations'); ?>)

<br/>&nbsp;&nbsp;&bull;&nbsp;Worked Exercise Screencasts:
<a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-05-01.mp4"
    target="_blank">5.1</a> (suggest download)

<li>Chapter 6 - Strings
(<?php media('Py4Inf-06-Strings'); ?>)

<br/>&nbsp;&nbsp;&bull;&nbsp;Worked Exercise Screencasts:
<a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-06-07.mp4"
    target="_blank">6.7</a> (suggest download)

<li>Chapter 7 - Files
(<?php media('Py4Inf-07-Files'); ?>)

<br/>&nbsp;&nbsp;&bull;&nbsp;Worked Exercise Screencasts:
<a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-07-01.mp4"
    target="_blank">7.1</a> (suggest download)

<li>Chapter 8 - Lists
(<?php media('Py4Inf-08-Lists'); ?>)

<br/>&nbsp;&nbsp;&bull;&nbsp;Worked Exercise Screencasts:
<a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-08.mp4"
    target="_blank">Finding and Fixing Errors - Lists of Words</a> (suggest download)

<li>Chapter 9 - Dictionaries
(<?php media('Py4Inf-09-Dictionaries'); ?>)

<br/>&nbsp;&nbsp;&bull;&nbsp;Worked Exercise Screencasts:
<a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-09.mp4"
    target="_blank">Most Common Word</a> (suggest download)

<li>Chapter 10 - Tuples
(<?php media('Py4Inf-10-Tuples'); ?>)

<br/>&nbsp;&nbsp;&bull;&nbsp;Worked Exercise Screencasts:
<a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-10.mp4"
    target="_blank">Top-5 Words</a> (suggest download)
</li>

<li>Chapter 11 - Regular Expressions
(<?php media('Py4Inf-11-Regex'); ?>,
<a href="lectures/Py4Inf-11-Regex-Guide.pdf" target="_new">Regex-Guide</a>)
</li>

<li>
When I teach from this book I spend two weeks on
<a href="https://www.coursera.org/course/insidetheinternet" target="_blank">Internet
History, Technology, and Security</a> 
between Chapters 11 and 12. Talking about history and technology allows the students
to take a mental break from programming and lays the ground work for the 
second half of the book.
</li>

<li>Chapter 12 - Network Programming (HTTP)
(<a href="<?= $afs ?>/books/py4inf/media/Py4Inf-12-HTTP.ppt" 
    target="_blank">Slides</a>, 
<a href="https://www.youtube.com/watch?v=Zr8BQiPNaFI&index=30&list=PLlRFEj9H3Oj4JXIwMwN1_ss1Tk8wZShEJ"
    target="_blank">YouTube</a>,
<a href="<?= $afs ?>/books/py4inf/media/Py4Inf-12-HTTP.mov"
    target="_blank">Download Video</a>,
Lecture Audio
<a href="<?= $afs ?>/books/py4inf/media/Py4Inf-12-Net-Prog-A.mp3"
    target="_blank">Part 1</a> and
<a href="<?= $afs ?>/books/py4inf/media/Py4Inf-12-Net-Prog-B.mp3"
    target="_blank">Part 2</a>)
<br/>&nbsp;&nbsp;&bull;&nbsp;Worked Exercise Screencasts:
<a href="<?= $afs ?>/books/py4inf/media/Py4Inf-ex-12-04.mp4"
    target="_blank">12.4 HTML Scraping with BeautifulSoup </a> (suggest download)
</li>
<li>Chapter 13 - Using Web Services
(<a href="<?= $afs ?>/books/py4inf/media/Py4Inf-13-WebServices.ppt" 
    target="_blank">Slides</a>, 
<a href="https://www.youtube.com/watch?v=6cwi1NcL0Zc&index=31&list=PLlRFEj9H3Oj4JXIwMwN1_ss1Tk8wZShEJ"
    target="_blank">YouTube</a>,
Download Video
<a href="<?= $afs ?>/books/py4inf/media/Py4Inf-13-Webservices-01.mp4"
    target="_blank">Part 1</a>,
<a href="<?= $afs ?>/books/py4inf/media/Py4Inf-13-Webservices-02.mp4"
    target="_blank">Part 2</a>, and
<a href="<?= $afs ?>/books/py4inf/media/Py4Inf-13-Webservices-03.mp4"
    target="_blank">Part 3</a>)
</li>
<li>Chapter 14 - Databases
(<a href="<?= $afs ?>/books/py4inf/media/Py4Inf-14-Database.ppt" 
    target="_blank">Slides</a>, 
Lecture Audio
<a href="<?= $afs ?>/books/py4inf/media/Py4Inf-14-Database-A.mp3"
    target="_blank">Part 1</a> and
<a href="<?= $afs ?>/books/py4inf/media/Py4Inf-14-Database-B.mp3"
    target="_blank">Part 2</a>)
<br/>&nbsp;&nbsp;&bull;&nbsp;SQLite3 Browser: <a href="http://sqlitebrowser.org/" target="_blank">http://sqlitebrowser.org/</a>
</li>
</ul>
<p>
Here is an archive of the 
<a href="https://archive.org/details/201509UMSI502Podcasts_201601" target="_blank">live lecture recordings</a>
from SI502 at the UM School of Information Fall 2015.
</p>
<p>
Here are <a href="videos/" target="_blank">archive copies</a> of the various audio, video, PowerPoints, PDFs and 
closed caption files if you want to reuse these materials in your own courses.
All this material (including audio and video) is Copyright Creative Commons Attribution 3.0 
unless otherwise indicated.  
<p>
Here are the materials for the 
<a href="workshop/materials.zip">Big Data Workshop</a>.
</div>
<div id="disqus_thread"></div>
<script>
/**
* RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
* LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL; // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');

s.src = '//pythonlearn.disqus.com/embed.js';

s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
<?php include("footer.php"); ?>
</body>
</html>
