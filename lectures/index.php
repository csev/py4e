Yo
<pre>
<?php
require_once "../tsugi/config.php";

$uri = $CFG->apphome . "/lectures";

if ( isset($_SERVER['REQUEST_URI']) ) {
    $uri = str_replace('lectures', 'lectures3', $_SERVER['REQUEST_URI']);
}

header("Location: ".$uri);
