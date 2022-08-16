# Αναζητάμε τις γραμμές που αρχίζουν με 'From' 
# και περιέχουν ένα σύμβολο at
import re
hand = open('mbox-short.txt')
for line in hand:
    line = line.rstrip()
    if re.search('^From:.+@', line):
        print(line)
