# Αναζητάμε τις γραμμές που περιέχουν ένα σύμβολο at μεταξύ χαρακτήρων.
# Οι χαρακτήρες πρέπει να είναι γράμματα ή αριθμοί
# Το αποτέλεσμα θα είναι ελαφρώς ακριβέστερο από το re07.py 
# σε περίπτωση διευθύνσεων email
import re
hand = open('mbox-short.txt')
for line in hand:
    line = line.rstrip()
    x = re.findall('[a-zA-Z0-9\-.]\S+@[a-zA-Z0-9].\S+[a-zA-Z]', line)
    if len(x) > 0:
        print(x)
