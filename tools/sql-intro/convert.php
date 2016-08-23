<?php

$names = array();
foreach(file('pop-names-07-t4.csv') as $line) {
   $pieces = explode(',', $line);
   if ( count($pieces) != 5 ) continue;
   if ( preg_match('/^[a-zA-Z]+$/',$pieces[0]) ) $names[] = $pieces[0];
   if ( preg_match('/^[a-zA-Z]+$/',$pieces[3]) ) $names[] = $pieces[3];
}
// var_dump($names);
sort($names);
echo("<?php\n");
echo ( '$names = array( ');
$first = true;
foreach ($names as $name ) {
    if ( ! $first ) echo(", ");
    $first = false;
    echo("'".$name."'");
}
echo(');'."\n");
