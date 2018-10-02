<?php
if ( file_exists('../config.php') ) {
    require_once("../config.php");
} else {
    require_once("../../config.php");
}

require_once("names.php");
require_once("data_util.php");

use \Tsugi\Util\LTI;
use \Tsugi\Core\LTIX;
use \Tsugi\Util\Mersenne_Twister;

// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Cache-Control: post-check=0, pre-check=0", false);
// header("Pragma: no-cache");

// https://support.cloudflare.com/hc/en-us/articles/200168396-What-will-Cloudflare-compress-
header("Cache-Control: no-transform, max-age=2592000");


$local_path = get_request_document();
$pos = strpos($local_path,'?');
if ( $pos > 0 ) $local_path = substr($local_path,0,$pos);

if ( strpos($local_path,"geojson") === 0 ) {
    require_once("geojson.php");
    return;

} else if ( strpos($local_path,"xml") === 0 ) {
    require_once("geocode.php");
    return;

} else if ( strpos($local_path,"json") === 0 ) {
    require_once("geocode.php");
    return;

// New
} else if ( strpos($local_path, "regex_sum_") === 0 && strpos($local_path, ".txt") !== false ) {
    header('Content-Type: text/plain');
    $code = 42;
    $pieces = preg_split('/[_.]/',$local_path);
    if ( count($pieces) == 4 && $pieces[2]+0 > 0 ) {
        $code = $pieces[2]+0;
    }
    if ( $code == 42 ) {
        echo("This file contains the sample data\n\n");
    } else {
        echo("This file contains the actual data for your assignment - good luck!\n\n");
    }

    $handle = fopen("../static/intro.txt", "r");
    if ($handle) {
        $count = 0;
        $MT = new Mersenne_Twister($code);
        // header('Content-Disposition: attachment; filename='.$local_path.';');
        while (($line = fgets($handle)) !== false) {
            $count++;
            $choose = ($count < 400 ) ? $MT->getNext(0,9) : 1 ;
            if ( $choose != 0 ) {
                echo($line);
                continue;
            }
            $howmany = $MT->getNext(1,3);
            if ( $howmany == 1 ) {
                echo($MT->getNext(1,10000).' '.$line);
            } else if ( $howmany == 2 ) {
                echo($MT->getNext(1,10000).' '.rtrim($line).' '.$MT->getNext(1,10000)."\n");
            } else if ( $howmany == 3 ) {
                $words = explode(' ',$line);
                if ( count($words) > 3 ) {
                    for($i=0; $i<count($words);$i++) {
                        echo($words[$i].' ');
                        if ( $i < 3 ) {
                            echo($MT->getNext(1,10000).' ');
                        }
                    }
                } else {
                    echo($MT->getNext(1,10000).' '.$MT->getNext(1,10000).' '.$MT->getNext(1,10000)."\n");
                }
            }

            // process the line read.
        }
        echo("42\n");
        echo("The end\n");

        fclose($handle);
    } else {
        echo("<p>File not found: intro.txt</p>\n");
        return;
    } 
    return;

// comments_12345.html
} else if ( strpos($local_path, "comments_") === 0 && strpos($local_path, ".html") !== false ) {
    header('Content-Type: text/html');
?><html>
<head>
<title>Welcome to the comments assignment from www.py4e.com</title>
</head>
<body>
<?php
    $code = 42;
    $pieces = preg_split('/[_.]/',$local_path);
    if ( count($pieces) == 3 && $pieces[1]+0 > 0 ) {
        $code = $pieces[1]+0;
    }
    
    if ( $code == 42 ) {
        echo("<h1>This file contains the sample data for testing</h1>\n\n");
    } else {
        echo("<h1>This file contains the actual data for your assignment - good luck!</h1>\n\n");
    }
?>
<table border="2">
<tr>
<td>Name</td><td>Comments</td>
</tr>
<?php
    $new = getShuffledNames($code);
    $nums = getRandomNumbers($code,min(50,count($new)),100);
    $data = array();
    for($i=0; $i<count($nums); $i++) {
        $data[$new[$i]] = $nums[$i];
    }
    arsort($data);
    foreach( $data as $k=>$v ) {
        echo('<tr><td>'.$k.'</td><td><span class="comments">'.$v.'</span></td></tr>'."\n");
    }
    echo("</table>\n</body>\n</html>\n");
    return;

// comments_12345.xml
} else if ( strpos($local_path, "comments_") === 0 && strpos($local_path, ".xml") !== false ) {
    header('Content-Type: application/xml; charset=utf-8');
    echo('<?xml version="1.0" encoding="UTF-8"?>'."\n");
    echo("<commentinfo>\n");
    $code = 42;
    $pieces = preg_split('/[_.]/',$local_path);
    if ( count($pieces) == 3 && $pieces[1]+0 > 0 ) {
        $code = $pieces[1]+0;
    }
    
    if ( $code == 42 ) {
        echo("  <note>This file contains the sample data for testing</note>\n\n");
    } else {
        echo("  <note>This file contains the actual data for your assignment - good luck!</note>\n\n");
    }

    $new = getShuffledNames($code);
    $nums = getRandomNumbers($code,min(50,count($new)),100);
    $data = array();
    for($i=0; $i<count($nums); $i++) {
        $data[$new[$i]] = $nums[$i];
    }
    arsort($data);
    echo("  <comments>\n");
    foreach( $data as $k=>$v ) {
        echo("    <comment>\n");
        echo("       <name>$k</name>\n");
        echo("       <count>$v</count>\n");
        echo("    </comment>\n");
    }
    echo("  </comments>\n");
    echo("</commentinfo>\n");
    return;

} else if ( strpos($local_path, "comments_") === 0 && strpos($local_path, ".json") !== false ) {
    header('Content-Type: application/json; charset=utf-8');
    $code = 42;
    $pieces = preg_split('/[_.]/',$local_path);
    if ( count($pieces) == 3 && $pieces[1]+0 > 0 ) {
        $code = $pieces[1]+0;
    }
    
    $arr = array();
    if ( $code == 42 ) {
        $arr['note'] = "This file contains the sample data for testing";
    } else {
        $arr['note'] = "This file contains the actual data for your assignment";
    }
    $new = getShuffledNames($code);
    $nums = getRandomNumbers($code,min(50,count($new)),100);
    $data = array();
    for($i=0; $i<count($nums); $i++) {
        $data[$new[$i]] = $nums[$i];
    }
    arsort($data);
    $comments = array();
    foreach( $data as $k=>$v ) {
        $comments[] = array('name' => $k, 'count' => $v ) ;
    }
    $arr['comments'] = $comments;
    echo(LTI::jsonIndent(json_encode($arr)));
    return;

} else if ( strpos($local_path, "known_by_") === 0 ) {
    header('Content-Type: text/html');
    $code = 12345;
    $name = $NAMES[0];
    $pieces = preg_split('/[_.]/',$local_path);
    if ( count($pieces) == 4 ) {
        $where = array_search($pieces[2], $NAMES);
        if ( $where !== false ) {
            $name = $NAMES[$where];
            $code = $where;
        } else {
            $name = $pieces[2];
            $code = 12345;
        }
    }
    
?><html>
<head>
<title>People that <?= htmlentities($name) ?> knows</title>
<style>
.overlay{
    opacity:0.99;
    background-color:#eee;
    position:fixed;
    width:100%;
    height:100%;
    top:0px;
    left:0px;
    z-index:1000;
}
</style>
</head>
<body>
<h1>People that <?= htmlentities($name) ?> knows</h1>
<div class="overlay" id="overlay" style="display:none" >
<center>
<h2>
This screen randomly changes the height between list items and vanishes 
after a while to make sure that you retrieve and process the data
in a Python program rather than simply counting down pressing links, and 
doing the assignment without writing a Python program :).
The names are in the same order in the HTML even though they 
shift around on the screen visually.
Your Python program can look at the page as long as it likes.
</h2>
</center>
</div>
<ul>
<?php
    $curr_url = LTIX::curPageUrlScript();
    $curr_url = str_replace("/index.php", "", $curr_url);
    $new = getShuffledNames($code);
    for($i = 0; $i < count($new) && $i < 100; $i++) {
        $new_url = $curr_url."/known_by_".$new[$i].".html";
        echo('<li style="margin-top: '.rand(1,$i+25).'px;"><a href="'.$new_url.'">'
            .$new[$i]."</a></li>\n");
    }
?>
</ul>
<script>
// http://stackoverflow.com/questions/20423322/simple-setting-off-display-none-block-with-javascript
function showHide(id) {
    var el = document.getElementById(id);
    if( el && el.style.display == 'none')    
        el.style.display = 'block';
    else 
        el.style.display = 'none';
}
setTimeout('showHide("overlay");', 2500);

</script>
</body>
</html>
<?php

    return;
} else if ( strpos($local_path, "debug") === 0 ) {
    echo("<pre>\n");
    echo("getCurrentUrl(): ".$CFG->getCurrentUrl()."\n");
    echo("LTIX::curPageUrlScript: ".LTIX::curPageUrlScript()."\n");    

    var_dump($_SERVER);
    echo("</pre>\n");
    return;
}
if ( strlen($local_path) > 0 ) {
    echo('<p>File not found '.htmlentities($local_path).'</p>');
} else {
?>
<html>
<head>
<title>Data Sources</title>
</head>
<body style="font-family: sans-serif;">
<h1>Test data sources</h1>
<p>
This application has a number of test data sources for
<a href="http://www.py4e.com/" target="_blank">
Python for Informatics: Exploring Information</a> written by
<a href="http://www.twitter.com/drchuck" target="_blank">@DrChuck</a> / 
<a href="http://www.dr-chuck.com/" target="_blank">www.dr-chuck.com</a>.
<ul>
<li><a href="geojson" target="_blank">A subset of data from the Google Geo Coding API</a></li>
<li><a href="regex_sum_42.txt" target=_"blank">Some data in a text file to be summed</a></li>
<li><a href="comments_42.html" target=_"blank">Some data in an html file to be summed</a></li>
<li><a href="comments_42.xml" target=_"blank">Some data in an xml file to be summed</a></li>
<li><a href="comments_42.json" target=_"blank">Some data in an json file to be summed</a></li>
<li><a href="known_by_42.html" target=_"blank">A set of friend lists</a></li>
</ul>
</p>
<p>
This data is set up to be served by a Content Data Network (CDN) product like 
<a href="https://www.cloudflare.com/" target="_blank">CloudFlare</a> to 
conserve bandwidth and provide quicker access to a worldwide learner
population.  There is a cloud-hosted copy of this data at
<a href="http://py4e-data.dr-chuck.net" target="_blank">py4e-data.dr-chuck.net</a>
that you may be able to use.


<?php 
}
