#!/usr/bin/python
# -*- coding: utf-8 -*-

while True:
    try:
        line = raw_input()
    except:
        break

    if line.find('@index@') >= 0 : 
        pieces = line.split('@')
        for i in range(len(pieces)):
            if pieces[i] != 'index' : continue 
            if i+2 > len(pieces) : continue
            print '\index{'+pieces[i+1]+'}'
        didindex = True
        continue

    if line.startswith('![image](') :
        line =line.replace('.eps)',')')
        print line
        continue

    line = line.replace("`'",'"').replace("'`",'"')
    line = line.replace("“",'"').replace("”",'"')
    line = line.replace("’","'")
    line = line.replace('<span>**','*').replace('**</span>','*')
    line = line.replace('<span>__','_').replace('__</span>','_')
    line = line.replace('<span>*','*').replace('*</span>','*')
    line = line.replace('<span>_','*').replace('_</span>','_')
    line = line.replace('<span>','`').replace('</span>', '`')
    print line

