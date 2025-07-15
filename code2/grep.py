# Search for lines that start with From and have an at sign
import re
hand = open('mbox.txt')
search = raw_input('Enter a regular expression: ')
count = 0 
for line in hand:
    line = line.rstrip()
    if re.search(search,line) : count = count + 1

print 'mbox.txt had',count,'lines that matched',search
