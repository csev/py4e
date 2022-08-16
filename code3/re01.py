# Αναζητάμε τις γραμμές που περιέχουν τη λέξη 'From'
import re
hand = open('mbox-short.txt')
for line in hand:
    line = line.rstrip()
    if re.search('From:', line):
        print(line)
