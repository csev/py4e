import urllib
import json

# Reads from locations.inp and produces locations.txt

serviceurl = 'http://localhost:8888/tsugi/mod/python-data/data/geojson?'
serviceurl = 'http://pr4e.dr-chuck.com/tsugi/mod/python-data/data/geojson?'
serviceurl = 'http://maps.googleapis.com/maps/api/geocode/json?'

fh = open('locations.inp')

locations = dict()
for address in fh:
    address = address.strip()
    url = serviceurl + urllib.urlencode({'sensor':'false', 'address': address})
    print 'Retrieving', url
    uh = urllib.urlopen(url)
    data = uh.read()
    print 'Retrieved',len(data),'characters'

    try: js = json.loads(str(data))
    except: js = None
    if 'status' not in js or js['status'] != 'OK':
        print '==== Failure To Retrieve',address
        continue

    try:
        lat = js["results"][0]["geometry"]["location"]["lat"]
        lng = js["results"][0]["geometry"]["location"]["lng"]
        # print 'lat',lat,'lng',lng
        location = js['results'][0]['formatted_address']
        # print location
        place_id = js['results'][0]['place_id']
        print 'Place id', place_id
    except:
        print "=== Failure to parse",address
        contnue

    locations[address]= str(data)

f = open('locations.txt', 'w')
f.write(json.dumps(locations, indent=4))
f.close()




