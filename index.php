<?php
use \Tsugi\Core\LTIX;
use \Tsugi\UI\Output;

require_once "top.php";
require_once "nav.php";
?>
<div id="container">
<div style="margin-left: 10px; float:right">
<iframe width="400" height="225" src="https://www.youtube.com/embed/UjeNA_JtXME?rel=0" frameborder="0" allowfullscreen></iframe>
</div>
<h1>Python for Everybody</h1>
<?php if ( isset($_SESSION['id']) ) { ?>
<p>
Welcome to my free web site for Python for Everybody.
Now that you have logged in, you have access to course-style features of this web site.
<ul>
<li>
As you go through the <a href="lessons">Lessons</a> in the course you now will see additional
links to the autograders in the class.  You can attempt the autograders and get a score.</li>
<li>
You can track your progress through the course using the <a href="assignments">Assignments</a>
tool and when you complete a group of assignments, you can earn a <a href="badges">Badge</a>.
You can download these badges and host them on your web site or refer the badge URLs on this site.</li>
<li>
If you want to use these Creative Commons Licensed materials
in your own classes you can
<a href="materials.php">download or link</a> to the artifacts on this site,
<a href="tsugi/cc/">export the course material</a> as an
IMS Common Cartridge®, or apply for
an IMS Learning Tools Interoperability® (LTI®)
<a href="tsugi/admin/key/index.php">key and secret</a>
 to launch the autograders from your LMS.
</li>
</ul>
<?php } else { ?>
<p>
This web site is building a set of free 
<a href="lessons">materials</a>, 
<a href="https://www.youtube.com/watch?v=UjeNA_JtXME&list=PLlRFEj9H3Oj7Bp8-DfGpfAfDBiblRfl5p&index=1" target="_blank">lectures</a>, 
<a href="book.php">book</a>
and assignments to help students
learn how to program in Python.
You can take this course and receive a certificate at:
<ul>
<li><a href="https://www.coursera.org/specializations/python" target="_blank">Coursera: Python for Everybody Specialization</a> </li>
<li><a href="https://www.edx.org/bio/charles-severance" target="_blank">edX: Python for Everybody</a></li>
<li><a href="https://www.futurelearn.com/courses/programming-for-everybody-python" target="_blank">FutureLearn: Programming for Everybody (Getting Started with Python)</a></li>
<li><a href="https://www.youtube.com/watch?v=8DvywoWv6fI" target="_blank">FreeCodeCamp</a></li>
<li><a href="https://online.umich.edu/series/python-for-everybody/" target="_blank">Free certificates for University of Michgan students and staff</a></li>
</ul>
<p>
If you <a href="tsugi/login.php">log in</a> to this site
you have joined a free, global
open and online course.  You have a grade book, autograded assignments, discussion forums, and can earn
badges for your efforts.</p>
<p>
We take your privacy seriously on this site, you can review our
<a href="privacy">Privacy Policy</a> for more details.
</p>
<p>
If you want to use these materials
in your own classes you can download or link to the artifacts on this site,
<a href="tsugi/cc/">export the course material</a> as an
IMS Common Cartridge®, or apply for
an IMS Learning Tools Interoperability® (LTI®)
<a href="tsugi/admin/key/index.php">key and secret</a>
 to launch the autograders from your LMS.
</p>
<p>
The code for this site including the autograders, slides, and course content is all available on
<a href="https://github.com/csev/py4e" target="_blank">GitHub</a>.  That means you could make your own
copy of the course site, publish it and remix it any way you like.  Even more exciting, you could translate
the entire site (course) into your own language and publish it.  I have provided
some <a href="https://github.com/csev/py4e/blob/master/TRANSLATION.md" target="_new">
instructions on how to translate this course</a> in my GitHub repository.
</p>
<?php } ?>
This site uses <a href="http://www.tsugi.org" target="_blank">Tsugi</a>
framework to embed a learning management system into this site and
provide the autograders.
If you are interested in collaborating
to build these kinds of sites for yourself, please see the
<a href="http://www.tsugi.org" target="_blank">tsugi.org</a> website and/or
contact me.
</p>
<p>
And yes, Dr. Chuck actually has a race car - it is called the
<a href="https://www.sakaiger.com/sakaicar/" target=_blank">SakaiCar</a>.
He races in a series called
<a href="https://www.24hoursoflemons.com" target="_blank">24 Hours of Lemons</a>.
</p>
<!--
<?php
echo(Output::safe_var_dump($_SESSION));
var_dump($USER);
?>
-->
</div>
<?php $OUTPUT->footer();
