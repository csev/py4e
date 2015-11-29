<?php
$name = basename($_SERVER['SCRIPT_URL'],".php");
?>
<html>
<head>
<title>Python for Informatics <?php echo($name); ?></title>
</head>
<body style="font-family: sans-serif;">
<ul>
<li><a href="http://www.pythonlearn.com/youtube/<?php echo($name); ?>.php" target="_blank">Watch on YouTube</a></li>
<li><a href="http://www.pythonlearn.com/lectures/<?php echo($name);?>.ppt" target="_blank">PowerPoint Slides</a></li>
<li><a href="http://www.pythonlearn.com/videos/<?php echo($name);?>.mp3" target="_blank">Download Audio</a></li>
<li><a href="http://www.pythonlearn.com/videos/<?php echo($name);?>.mp4" target="_blank">Download Video</a> (Large)</li>
</ul>
</body>
</html>
