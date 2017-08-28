#!/usr/bin/python

first = True
while True:
    try:
        line = raw_input()
    except:
        break
    if first :
        print '<?php if ( file_exists("../booktop.php") ) {'
        print '  require_once "../booktop.php";'
        print '  ob_start();'
        print '}?>'

    first = False
    line = line.rstrip()
    print line

print '<?php if ( file_exists("../bookfoot.php") ) {'
print '  $HTML_FILE = basename(__FILE__);'
print '  $HTML = ob_get_contents();'
print '  ob_end_clean();'
print '  require_once "../bookfoot.php";'
print '}?>'
