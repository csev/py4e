import urllib.request, urllib.parse, urllib.error
import xml.etree.ElementTree as ET
import ssl

clave_api = False
# Si tienes una clave API de Google Places, ingresala aquí
# clave_api = 'AIzaSy___IDByT70'
# https://developers.google.com/maps/documentation/geocoding/intro

if clave_api is False:
    clave_api = 42
    url_de_servicio = 'http://py4e-data.dr-chuck.net/xml?'
else :
    url_de_servicio = 'https://maps.googleapis.com/maps/api/geocode/xml?'

# Ignorar errores de certificado SSL
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

while True:
    direccion = input('Ingresa una ubicación: ')
    if len(direccion) < 1: break

    parms = dict()
    parms['address'] = direccion
    if clave_api is not False: parms['key'] = clave_api
    url = url_de_servicio + urllib.parse.urlencode(parms)
    print('Recuperando', url)
    uh = urllib.request.urlopen(url, context=ctx)

    datos = uh.read()
    print('Recuperados', len(datos), 'caracteres')
    print(datos.decode())
    tree = ET.fromstring(datos)

    resultados = tree.findall('result')
    lat = resultados[0].find('geometry').find('location').find('lat').text
    lng = resultados[0].find('geometry').find('location').find('lng').text
    ubicacion = resultados[0].find('formatted_address').text

    print('lat', lat, 'lng', lng)
    print(ubicacion)
