<?php

$CFG = new \stdCLass();

// Allow this to be served from different places and allow the 
// CDN to be elsewhere

// The actual live web root of this application
$CFG->wwwroot = "http://localhost:8888/pythonlearn";

// The root of a copy of this appilcation's static files on
// a CDN - can be the same as wwwroot for non-scaling instances
$CFG->cdnroot = $CFG->wwwroot;

$CFG->dirroot = realpath(dirname(__FILE__));

$afs = "http://www-personal.umich.edu/~csev";
$arch_podcast = "https://archive.org/download/2013Py4InfPodcast";

