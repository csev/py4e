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
        paren = line.find('(')
        atsign = line.find('@')
        if paren < 1 or atsign < 1 :
            print line
            continue
        print line[:paren+1]+line[atsign+1:]
        continue

    print line
