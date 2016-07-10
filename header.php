<!DOCTYPE html>
<html lang="en">
    <head>
<?php
    if ( !isset($CFG) ) {
        // Will only work in top-level files
        try {
            require_once("config.php");
        } catch (Exception $e) {
             die("Please copy config-dist.php to config.php and edit");
        }
    }
?>
        <title>Python for Everybody: Exploring Data in Python 3</title>
        <meta charset="utf-8"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta name="viewport" content="width=device-width,initial-scale=1">  
        <link rel="stylesheet" href="<?= $CFG->cdnroot ?>/assets/foundation/css/foundation.css" type="text/css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= $CFG->cdnroot ?>/assets/style.css" type="text/css" />
        <link rel="alternate" type="application/rss+xml" title="PythonLearn Podcast" href="http://www.pythonlearn.com/audiofeed.xml" />
        <script src="<?= $CFG->cdnroot ?>/assets/foundation/js/vendor/jquery.min.js"></script>
        <script src="<?= $CFG->cdnroot ?>/assets/foundation/js/foundation.js"></script>
        <script>
            var lastScroll = 0;
            jQuery(window).scroll(function(){
                var w = jQuery(window);

                if (w.scrollTop() < lastScroll || w.scrollTop() == 0) {
                    jQuery(".title-bar").show();
                    lastScroll = w.scrollTop()+15;
                }
                if (w.scrollTop() > lastScroll){
                    jQuery(".title-bar").hide();
                    lastScroll = w.scrollTop()-10;	
                }
            });
        </script>
    </head>
    <body>
