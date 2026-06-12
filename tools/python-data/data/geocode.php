<?php

$do_json = strpos($_SERVER['REQUEST_URI'],'/xml') === false;

if ( $do_json ) {
    header('Content-Type: application/json');
    echo('{"error": "This Google-based endpoint is no longer supported. We are now using OpenGeo in this course.",'."\n");
    echo('"new_sample_code": "https://www.py4e.com/code3/?folder=opengeo"}'."\n");
    return;
} else {
    header('Content-Type: application/xml');
    echo('<?xml version="1.0" encoding="UTF-8"?>'."\n");
?>
<root>
  <error>This Google-based endpoint is no longer supported. We are now using OpenGeo in this course.</error>
  <new_sample_code>https://www.py4e.com/code3/?folder=opengeo</new_sample_code>
</root>
<?php
    return;
}
