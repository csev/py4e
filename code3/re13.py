# Αναζητάμε τις γραμμές που ξεκινούν με 'From ' και ένα σύνολο χαρακτήρων
# ακολουθούμενων από δύο ψηφία, ακολουθούμενα από ':'
# Στη συνέχεια εκτυπώνουμε τα ψηφία, εάν βρεθούν
import re
hand = open('mbox-short.txt')
for line in hand:
    line = line.rstrip()
    x = re.findall('^From .* ([0-9][0-9]):', line)
    if len(x) > 0: print(x)
