<?php
$url = $_SERVER['PHP_SELF'];
$pieces = explode('/',$url);
if ( count($pieces) == 3 && $pieces[1] == 'videos' && strlen($pieces[2]) > 1 ) {
  $file = str_replace("PY4INF", "Py4Inf", $pieces[2]);
  $file = str_replace("py4inf", "Py4Inf", $file);
  // header("Location: http://afs.dr-chuck.com/books/py4inf/media/".$file);
  header("Location: http://www-personal.umich.edu/~csev/books/py4inf/media/".$file);
} else {
  // header("Location: http://afs.dr-chuck.com/books/py4inf/media/");
  header("Location: http://www-personal.umich.edu/~csev/books/py4inf/media/");
}
