# Αναζητάμε τις γραμμές που περιέχουν ένα σύμβολο at μεταξύ χαρακτήρων
import re
hand = open('mbox-short.txt')
for line in hand:
    line = line.rstrip()
    x = re.findall('\S+@\S+', line)
    if len(x) > 0:
        print(x)
