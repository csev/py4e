# Αναζητάμε τις γραμμές που αρχίζουν με 'X' ακολουθούμενο από οποιουσδήποτε
# μη λευκούς χαρακτήρες και ':', στη συνέχεια εξάγουμε την πρώτη ομάδα 
# μη λευκών χαρακτήρων που ακολουθούν
import re
hand = open('mbox-short.txt')
for line in hand:
    line = line.rstrip()
    x = re.findall('^X\S*: (\S+)', line)
    if not x: continue
    print(x)
