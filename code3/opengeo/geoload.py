import urllib.request, urllib.parse, urllib.error
import http
import sqlite3
import json
import time
import ssl
import sys

serviceurl = 'https://py4e-data.dr-chuck.net/opengeo?'

# Πρόσθετες λεπτομέρειες για το urllib
# http.client.HTTPConnection.debuglevel = 1

conn = sqlite3.connect('opengeo.sqlite')
cur = conn.cursor()

cur.execute('''
CREATE TABLE IF NOT EXISTS Locations (address TEXT, geodata TEXT)''')

# Αγνόηση των σφαλμάτων πιστοποιητικού SSL
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

fh = open("where.data")
count = 0
nofound = 0
for line in fh:
    if count > 100 :
        print('Ανακτήθηκαν 100 τοποθεσίες, επανεκκινήστε για να ανακτήσετε περισσότερες')
        break

    address = line.strip()
    print('')
    cur.execute("SELECT geodata FROM Locations WHERE address= ?",
        (memoryview(address.encode()), ))

    try:
        data = cur.fetchone()[0]
        print("Βρέθηκε στη βάση δεδομένων", address)
        continue
    except:
        pass

    parms = dict()
    parms['q'] = address

    url = serviceurl + urllib.parse.urlencode(parms)

    print('Ανάκτηση του', url)
    uh = urllib.request.urlopen(url, context=ctx)
    data = uh.read().decode()
    print('Ανακτήθηκαν', len(data), 'χαρακτήρες', data[:20].replace('\n', ' '))
    count = count + 1

    try:
        js = json.loads(data)
    except:
        print(data)  # Εκτυπώνουμε σε περίπτωση που το unicode προκαλέσει σφάλμα
        continue

    if not js or 'features' not in js:
        print('==== Σφάλμα λήψης ===')
        print(data)
        break

    if len(js['features']) == 0:
        print('==== Το αντικείμενο δεν βρέθηκε ====')
        nofound = nofound + 1

    cur.execute('''INSERT INTO Locations (address, geodata)
                VALUES ( ?, ? )''', (memoryview(address.encode()), memoryview(data.encode()) ) )
    conn.commit()

    if count % 10 == 0 :
        print('Παύση για λίγο...')
        time.sleep(5)

if nofound > 0:
    print('Αριθμός χαρακτηριστικών για τα οποία δεν ήταν δυνατή η εύρεση της τοποθεσίας:', nofound)

print("Εκτελέστε το geodump.py για να διαβάσετε τα δεδομένα από τη βάση δεδομένων, ώστε να μπορέσετε να τα οπτικοποιήσετε σε έναν χάρτη.")

