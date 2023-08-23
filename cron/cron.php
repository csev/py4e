<?php

header("Content-Type: text/plain; charset=utf-8");

$dirname = dirname(__DIR__);
require_once $dirname."/tsugi/config.php";

$marker_file = __DIR__."/cron.txt";

$now = time();
if ( file_exists($marker_file) ) {
   $file_time = filemtime($marker_file);
   $delta = time() - $file_time;
} else {
    $delta = 24*60*60;
}

/* ------------- Actual cron --------------- */

$ZIP_TIME = 30*60; // 30 Minutes

if ( $delta > $ZIP_TIME ) {
    echo("\nRunning bash code.sh\n");
    echo(system("cd .. ; bash code.sh"));
    echo("\n\nRunning code cleanup.sh\n");
    echo(system("cd ../code ; bash -vx cleanup.sh"));
    echo("\n\nRunning code3 cleanup.sh\n");
    echo(system("cd ../code3 ; bash -vx cleanup.sh"));
    echo("\n\n");
    touch($marker_file);
} else {
    echo("Delta $delta z:$ZIP_TIME\n");
}


