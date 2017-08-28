<?php

use \Tsugi\Util\Mersenne_Twister;

require_once "names.php";
require_once "courses.php";

function makeRoster($code,$course_count=false,$name_count=false) {
    global $names, $courses;
    $MT = new Mersenne_Twister($code);
    $retval = array();
    $cc = 0;
    foreach($courses as $k => $course) {
    $cc = $cc + 1;
    if ( $course_count && $cc > $course_count ) break;
        $new = $MT->shuffle($names);
        $new = array_slice($new,0,$MT->getNext(17,53));
        $inst = 1;
        $nc = 0;
        foreach($new as $k2 => $name) {
            $nc = $nc + 1;
            if ( $name_count && $nc > $name_count ) break;
            $retval[] = array($name, $course, $inst);
            $inst = 0;
        }
    }
    return $retval;
}


// Load the export to JSON format from MySQL
function load_mysql_json_export($data) {

    $pos = 0;
    $retval = array();
    $errors = array();
    $things = explode('//',$data);
    // echo("<pre>\n");
    // print_r($things);
    foreach($things as $thing) {
        if ( strpos($thing,'[{') === false || strpos($thing, '}]') === false ) {
            continue;
        }
        $thing = trim($thing);
        $pieces = explode("\n",$thing);
        // echo("==========\n"); print_r($pieces);
        if ( count($pieces) != 3 ) continue;
        $name = trim($pieces[0]);
        $chunks = explode('.',$name);
        if ( count($chunks) > 1 ) {
            $name = $chunks[count($chunks)-1];
        }
        $name = strtolower($name);
        // echo("name=$name\n");
        $json = json_decode($pieces[2], true);
        if ( $json === NULL ) {
            $errors[] = "Unable to parse the $name JSON ".json_last_error();
            continue;
        }

        $retval[$name] = $json;
        if ( count($json) < 1 ) continue;

        $key = strtolower($name).'_id';
        if ( !isset($json[0][$key]) ) continue;

        $table = array();
        foreach($json as $row) {
            if ( isset($row[$key]) && is_numeric($row[$key]) ) {
                $table[$row[$key]+0] = $row;
            }
        }
        $retval[$name."_table"] = $table;
    }

    // echo("<pre>\n"); print_r($retval); echo("</pre>\n");
    return $retval;
}
