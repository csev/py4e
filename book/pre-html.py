#!/usr/bin/python

while True:
    try:
        line = raw_input()
    except:
        break
    
    # General patching

    # ![Where Programs Live](height=1.5in@../images/arch2)
    # ![Where Programs Live](../images/arch2)
    if line.find('!') == 0 : 
        oparen = line.find('(')
        cparen = line.find(')')
        atsign = line.find('@')

        if atsign < 0 : atsign=oparen

        if cparen < atsign or cparen < 1 or oparen < 1 or atsign < 1 :
            print line
            continue
        fname = line[atsign+1:cparen]
        try:
            fh = open(fname+'.svg')
        except:
            fname = fname+'.png'

        print line[:oparen+1]+fname+')'
        continue

    print line
