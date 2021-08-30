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
        obrack = line.find('[')
        cbrack = line.find(']')
        atsign = line.find('@')

        if atsign < 0 : atsign=oparen

        if cparen < atsign or cparen < 1 or oparen < 1 or atsign < 1 :
            print line
            continue

        linktext = ''
        if obrack > 0 and cbrack > 0 and cbrack > obrack :
            linktext = line[obrack+1:cbrack]

        attribs = dict()
        if atsign > oparen :
            attribsstr = line[oparen+1:atsign]
            pieces = attribsstr.split(',')
            for piece in pieces:
                kvp = piece.split('=');
                if len(kvp) != 2 : continue
                attribs[kvp[0]] = kvp[1]

        fname = line[atsign+1:cparen]
        try:
            fh = open(fname+'.svg')
            fname = fname+'.svg'
        except:
            fname = fname+'.png'

  
        if attribs.get('height') :
            print '<figure>'
            print '<img src="'+fname+'" alt="'+linktext+'" style="height: '+attribs.get('height')+';"/>'
            print '<figcaption>'+linktext+'</figcaption>'
            print '</figure>'
        else :
            print line[:oparen+1]+fname+')'

        continue

    print line
