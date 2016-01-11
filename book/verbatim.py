
import re

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
    fh = open(fn)
    print '~~~~ {.python}'
    blank = True
    for ln in fh:
        print ln.strip()
        blank = len(ln.strip()) > 0 
    
    if fn.startswith('../') :
        if blank : print 
        fu = fn.replace('../','http://www.pythonlearn.com/')
        print '# Code:', fu
    print '~~~~'
