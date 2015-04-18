<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
     "DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php include("header.php"); ?>
</head>
<body>
<?php include("nav.php"); ?>
<div id="main">
<center>
<p>
<a href=<? echo($_REQUEST["media"]); ?> >Download Media</a>
</p>
<embed showcontrols="1" height="100%" width="100%" autosize="1" src=<? echo($_REQUEST["media"]); ?>
 pluginspage='http://www.apple.com/quicktime/download/' >
</p>
</center>
</div>
<?php include("footer.php"); ?>
</body>
</html>
