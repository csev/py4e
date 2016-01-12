
import re
import sys

trinket = False
if "--trinket" in sys.argv:
    trinket = True

while True:
    try:
        line = raw_input()
    except:
        break
    
    x = re.findall('\\VerbatimInput{(.*)}', line)
    if not x : 
        print line
        continue
    fn = x[0]
    
    with open(fn) as fh:
        
        # Pre code
        
        # Open Wrapper
        if trinket:
            with open('trinket/trinket-script') as ts:
                print ts.read()
        else:        
            print '~~~~ {.python}'
            blank = True
        
        # Code
        for ln in fh:
            print ln.rstrip()
            blank = len(ln.strip()) > 0 
        
        # Post Code
        
        # Cannonical URL
        if fn.startswith('../') :
            # Add a blank unless there is one at end of file
            if blank : print 
            fu = fn.replace('../','http://www.pythonlearn.com/')
            print '# Code:', fu
        
        # Close wrapper
        if trinket:
            print '-->'
        else:
            print '~~~~'