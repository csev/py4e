<?php 

function media($name) {
    echo('<a href="youtube/'.$name.'.php" target="_blank">YouTube</a>,'."\n");
    echo('<a href="lectures/'.$name.'.ppt" target="_blank">PowerPoint</a>,'."\n");
    echo('<a href="lectures/'.$name.'.pdf" target="_blank">Slides PDF</a>,'."\n");
    echo('<a href="lectures/'.$name.'-Print.pdf" target="_blank">Slides PDF (Print)</a>,'."\n");
    echo('<a href="videos/'.$name.'.mp3" target="_blank">Audio</a>,'."\n");
    echo('<a href="videos/'.$name.'.mp4" target="_blank">Video Download (large)</a>'."\n");
}


