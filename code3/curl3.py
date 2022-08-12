import os
import urllib.request, urllib.parse, urllib.error

print('Παρακαλώ εισαγάγετε μια διεύθυνση URL όπωςhttp://data.pr4e.org/cover3.jpg')
urlstr = input().strip()
img = urllib.request.urlopen(urlstr)

# Πάρε την τελευταία "λέξη"
words = urlstr.split('/')
fname = words[-1]

# Μην αντικαταστήσεις το αρχείο
if os.path.exists(fname):
    if input('Να αντικατασταθεί το ' + fname + ' (Ν/ο)?') != 'Ν':
        print('Τα δεδομένα δεν αντιγράφηκαν')
        exit()
    print('Αντικατάσταση του', fname)

fhand = open(fname, 'wb')
size = 0
while True:
    info = img.read(100000)
    if len(info) < 1: break
    size = size + len(info)
    fhand.write(info)

print(size, 'χαρακτήρες αντιγράφηκαν στο ', fname)
fhand.close()
