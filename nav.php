<div id="header">
<h1><a href="index.php" class="selected" accesskey="1">PythonLearn</a></h1>
<?php
   function navto($arg)
   {
	echo ('href="' . $arg . '"');
   	if ( strpos($_ENV["REQUEST_URI"], $arg) )  echo ' class="selected" ';
   }
   ?>
<ul class="toolbar">
<li><a <?php navto("book.php") ?> >Book</a></li>
<li><a <?php navto("install.php") ?> >Install</a></li>
<li><a href=http://www.pr4e.org/ target="_blank">MOOC</a></li>
<li><a href="http://python.xwmooc.net/" target="_blank">(Korean)</a></li>
<li><a href="http://www.dr-chuck.com/" target="_blank">Instructor</a></li>
<li><a href="http://www.python.org/" target="_blank">Python</a></li>
<li><a <?php navto("about.php") ?> >About</a></li>
</ul>
</div>
