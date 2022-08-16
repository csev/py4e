import urllib.request, urllib.parse, urllib.error
import json
import ssl

api_key = False
# Εάν διαθέτετε κλειδί API Google Places, πληκτρολογήστε το εδώ
# api_key = 'AIzaSy___IDByT70'
# https://developers.google.com/maps/documentation/geocoding/intro

if api_key is False:
    api_key = 42
    serviceurl = 'http://py4e-data.dr-chuck.net/json?'
else :
    serviceurl = 'https://maps.googleapis.com/maps/api/geocode/json?'

# Αγνόησε τα σφάλματα πιστοποιητικού SSL
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

while True:
    address = input('Εισαγάγετε τοποθεσία: ')
    if len(address) < 1: break

    parms = dict()
    parms['address'] = address
    if api_key is not False: parms['key'] = api_key
    url = serviceurl + urllib.parse.urlencode(parms)

    print('Ανάκτηση', url)
    uh = urllib.request.urlopen(url, context=ctx)
    data = uh.read().decode()
    print('Ανακτήθηκαν', len(data), 'χαρακτήρες')

    try:
        js = json.loads(data)
    except:
        js = None

    if not js or 'status' not in js or js['status'] != 'OK':
        print('==== Αποτυχία ανάκτησης ====')
        print(data)
        continue

    print(json.dumps(js, indent=4))

    lat = js['results'][0]['geometry']['location']['lat']
    lng = js['results'][0]['geometry']['location']['lng']
    print('πλάτος', lat, 'μήκος', lng)
    location = js['results'][0]['formatted_address']
    print(location)
