In terms of the data for these assignments, they can either be served
from the same server as the assignments, or I have a global copy at 

http://py4e-data.dr-chuck.net/

This server is hosted and updated, and sits behind a Content-Data-Network
so it should scale and be fast with a lage number of uses and be responsive
most of the places in the world.

To get the local serving to work, depending on your hosting provider, 
change the file data/data_util.php and change the global variables:

    // Global Configuration Options
    // $GLOBAL_PYTHON_DATA_URL = false; // To serve locally
    $GLOBAL_PYTHON_DATA_URL = 'http://py4e-data.dr-chuck.net/';
    // $GLOBAL_PYTHON_DATA_REMOVE_HTTPS = true;  // To map data urls to http:
    $GLOBAL_PYTHON_DATA_REMOVE_HTTPS = false;

To sereve locally, depending on your hosting provider, you may need to 
to tweak the data/.htaccess file to make sure that all URLs make it to
index.php:

    # FallbackResource index.php
    # Turn rewriting on
    Options +FollowSymLinks
    # Redirect requests to index.php
    # RewriteBase /
    RewriteEngine On
    RewriteRule .* index.php
    Header set Cache-Control "max-age=604800, public"

The above (default version) of the file works OK locally in MAMP, but
you might need to set the RewriteBase on some hosting environments.
You also might want to turn caching on or off (also see data/index.php)
to adjust performance if you are using a CDN.

Names from:

The Most Popular Names in Scotland, 2007 - Detailed Tables

http://www.nrscotland.gov.uk/files/statistics/pop-names-07-t4.csv

Via:

http://stackoverflow.com/questions/1452003/plain-computer-parseable-lists-of-common-first-names

