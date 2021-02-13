import urllib.request, urllib.parse, urllib.error
import http
import sqlite3
import json
import time
import ssl
import sys

serviceurl = 'https://nominatim.openstreetmap.org/search.php?'

# Additional detail for urllib
# http.client.HTTPConnection.debuglevel = 1

conn = sqlite3.connect('opengeo.sqlite')
cur = conn.cursor()

cur.execute('''
CREATE TABLE IF NOT EXISTS Locations (address TEXT, geodata TEXT)''')

# Ignoruj błędy związane z certyfikatami SSL
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

fh = open("where.data")
count = 0
nofound = 0
for line in fh:
    if count > 200 :
        print('Retrieved 200 locations, restart to retrieve more')
        break

    address = line.strip()
    print('')
    cur.execute("SELECT geodata FROM Locations WHERE address= ?",
        (memoryview(address.encode()), ))

    try:
        data = cur.fetchone()[0]
        print("Found in database", address)
        continue
    except:
        pass

    parms = dict()
    parms['q'] = address
    parms['format'] = 'geojson'
    parms['limit'] = 1
    parms['addressdetails'] = 1
    parms['accept-language'] = 'pl'

    url = serviceurl + urllib.parse.urlencode(parms)

    print('Retrieving', url)
    uh = urllib.request.urlopen(url, context=ctx)
    data = uh.read().decode()
    print('Retrieved', len(data), 'characters', data[:20].replace('\n', ' '))
    count = count + 1

    try:
        js = json.loads(data)
    except:
        print(data)  # We print in case unicode causes an error
        continue

    if not js or 'features' not in js:
        print('==== Download error ===')
        print(data)
        break

    if len(js['features']) == 0:
        print('==== Object not found ====')
        nofound = nofound + 1

    cur.execute('''INSERT INTO Locations (address, geodata)
                VALUES ( ?, ? )''', (memoryview(address.encode()), memoryview(data.encode()) ) )
    conn.commit()
    time.sleep(1) # https://operations.osmfoundation.org/policies/nominatim/

if nofound > 0:
    print('Number of features for which the location could not be found:', nofound)

print("Run geodump.py to read the data from the database so you can vizualize it on a map.")

