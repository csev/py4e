# Search for lines that start 'X' followed by any non whitespace
# characters and ':' then output the first group of non whitespace
# characters that follows
import re
hand = open('mbox-short.txt')
for line in hand:
    line = line.rstrip()
    x = re.findall('^X\S*: (\S+)', line)
    if not x: continue
    print(x)
