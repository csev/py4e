# Αναζητάμε τις γραμμές που περιέχουν ένα σύμβολο at μεταξύ χαρακτήρων.
# Οι χαρακτήρες πρέπει να είναι γράμματα ή αριθμοί
import re
hand = open('mbox-short.txt')
for line in hand:
    line = line.rstrip()
    x = re.findall('[a-zA-Z0-9]\S*@\S*[a-zA-Z]', line)
    if len(x) > 0:
        print(x)
