
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

    fh = open(x[0])
    print '~~~~ {.python}'
    for ln in fh:
        print '   ',ln.rstrip()
    print '~~~~'
