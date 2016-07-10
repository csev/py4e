#!/usr/bin/python
# -*- coding: utf-8 -*-

lines = list()
while True:
    try:
        line = raw_input()
    except:
        break
    lines.append(line)

for i in range(len(lines)):
    line = lines[i]
    if len(line) > 0 : 
        print line
        continue 

    if i < 1 or i > len(lines)-2 :
        print line
        continue

    if len(lines[i-1]) == 0 : continue
    if lines[i-1].startswith('\\index') and lines[i+1].startswith('\\index') : 
        continue
    print line
