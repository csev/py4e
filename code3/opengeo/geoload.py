import urllib.request, urllib.parse, urllib.error
import http
import sqlite3
import json
import time
import ssl
import sys

serviceurl = 'https://nominatim.openstreetmap.org/search.php?'

# Dodatkowe szczegóły dla urllib
# http.client.HTTPConnection.debuglevel = 1

conn = sqlite3.connect('geodata.sqlite')
cur = conn.cursor()

cur.execute('''
CREATE TABLE IF NOT EXISTS Lokalizacje (adres TEXT, geo_dane TEXT)''')

# Ignoruj błędy związane z certyfikatami SSL
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

fh = open("where.data")
count = 0
nofound = 0
for line in fh:
    if count > 200 :
        print('Pobrano 200 lokalizacji, uruchom ponownie by pobrać więcej')
        break

    address = line.strip()
    print('')
    cur.execute("SELECT geo_dane FROM Lokalizacje WHERE adres= ?",
        (memoryview(address.encode()), ))

    try:
        data = cur.fetchone()[0]
        print("Znaleziono w bazie ", address)
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

    print('Pobieranie', url)
    uh = urllib.request.urlopen(url, context=ctx)
    data = uh.read().decode()
    print('Pobrano', len(data), 'znaków', data[:20].replace('\n', ' '))
    count = count + 1

    try:
        js = json.loads(data)
    except:
        print(data)  # Wyświetlamy jeśli Unicode spowoduje błąd
        continue

    if not js or 'features' not in js:
        print('==== Błąd pobierania ====')
        print(data)
        break

    if len(js['features']) == 0:
        print('==== Nie odnaleziono obiektu ====')
        nofound = nofound + 1

    cur.execute('''INSERT INTO Lokalizacje (adres, geo_dane)
                VALUES ( ?, ? )''', (memoryview(address.encode()), memoryview(data.encode()) ) )
    conn.commit()
    time.sleep(1) # https://operations.osmfoundation.org/policies/nominatim/
if nofound > 0:
    print('Liczba obiektów, dla których nie udało się odnaleźć lokalizacji:', nofound)
print("Uruchom aplikację geodump.py, aby odczytać dane z bazy danych i zwizualizować je na mapie.")
