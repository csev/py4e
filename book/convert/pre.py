#!/usr/bin/python

import sys
import os

if len(sys.argv) != 2 : 
    print "Need a file name as argument"
    quit()

fname = str(sys.argv[1])
nfname = fname.replace(".tex","")

if not fname.endswith('.tex') : 
    print "File must have a .tex suffix"
    quit()

def processverb(verb) :
    fh = open('zap.py','w')
    for line in verb :
        fh.write(line+"\n")
    fh.close()
    os.system("2to3 -w zap.py > /dev/null 2> /dev/null")
    different = False
    new = open('zap.py','r').read().rstrip().split('\n')
    # print 'New: ',len(new)," old:",len(verb)
    different = False
    for i in range(len(verb)):
        if i >= len(new) :
            # print "New has less lines"
            different = True
            break

        if verb[i] != new[i] :
            # print "Mismatch",i,"---------------------------------------"
            # print "O:",verb[i]
            # print "N:",new[i]
            different = True
            break

    if different : 
        # for line in verb:
            # print line
        # print ">3to2>"
        for line in new:
            print line
        return

    for line in verb:
        if line.startswith('>>> ') or line.startswith('... ') :
            py = line[4:]
            fh = open('zap.py','w')
            fh.write(py+"\n");
            fh.close()
            os.system("2to3 -w zap.py > /dev/null 2> /dev/null")
            new = open('zap.py','r').read().rstrip()
            if line.startswith('>>> ') : 
                if py == new :
                    print '>>>', py
                else :
                    # print '>2>', py
                    print '>>>', new
            else :
                if py == new :
                    print '...', py
                else :
                    # print '.2.', py
                    print '...', new
        else :
            print line


text = open(fname).read().split('\n')
verb = list()
inverb = False
exno = 1
for line in text:
    line = line.rstrip()
    if line == '\\end{verbatim}' :
        inverb = False
        processverb(verb)
        print line
        verb = list()
        continue

    if line == '\\begin{ex}' :
        print line
        print "Exercise",str(exno)+':'
        exno = exno + 1
        continue

    if line.startswith('\\item[') :
        line = line.replace(':]',']')

    if inverb :
        verb.append(line)
        continue

    if line == '\\begin{verbatim}' :
        inverb = True
        print line
        continue

    if line.startswith('\\index') : 
        # print line
        new = line.replace('\\','@').replace('{','@').replace('}','@')
        print
        print new
        print
        continue

    print line
