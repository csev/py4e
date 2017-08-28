# Search for lines that contain 'Author:' followed by any characters,
# an at sign, and any non whitespace character
# Then print the character group that follows the at sign
import re
hand = open('mbox-short.txt')
for line in hand:
    line = line.rstrip()
    x = re.findall('Author:.*@(\S+)', line)
    if not x: continue
    print(x)
