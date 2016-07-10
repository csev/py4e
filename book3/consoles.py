#!/usr/bin/python
import re
import sys
import os

in_console_trinket = False

while True:
    try:
        line = raw_input()
    except:
        break
    
    # Search for opens and closes
    x = re.search('~~~~ {(.*)}', line)
    y = re.search('^~~~~$', line.strip())
    
    if x:
        whole_string = x.group(1)
        arguments = x.group(1).split()
    
    # Check for errors
    if x and ('trinket' in arguments):
        raise Exception("Error: found 'trinket'; should be '.trinket' in " + line)
    # If open, include script
    if x and ('.trinket' in arguments) and ('.python' in arguments) : 
        with open('trinket/console-trinket-script') as ts:
            # Is there a custom height?
            height = re.search(r'height="(\d*)"', whole_string) 
            if height:
                # Custom height; sub it in
                script = re.sub(r'height="\d*"', 'height="{0}"'.format(height.group(1)), ts.read())
            else:
                # Otherwise, use default
                script = ts.read()
            print script
            in_console_trinket = True
    
    # If close and we're in a trinket, end comment
    elif y and in_console_trinket:
        # Close wrapper
        print '-->'
        in_console_trinket = False
    # Otherwise echo the input
    elif in_console_trinket:
        # We're inside a trinket- print the code
        # (it's easier to debug when separating this out -)
        print line
    else:
        # otherwise, nothing to do- just print the line
        # comment this line out to debug:
        print line
        pass
