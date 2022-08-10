# Αναζητάμε τις γραμμές που ξεκινούν με 'Details: rev='
# ακολουθούμενο από ψηφία.
# Στη συνέχεια εκτυπώνουμε τον αριθμό, αν βρεθεί.
import re
hand = open('mbox-short.txt')
for line in hand:
    line = line.rstrip()
    x = re.findall('^Details:.*rev=([0-9]+)', line)
    if len(x) > 0:
        print(x)
