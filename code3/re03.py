# Αναζητάμε τις γραμμές που αρχίζουν με 'F', ακολουθούμενο
# από 2 χαρακτήρες, ακολουθούμενους από 'm:'
import re
hand = open('mbox-short.txt')
for line in hand:
    line = line.rstrip()
    if re.search('^F..m:', line):
        print(line)
