import urllib.request, urllib.parse, urllib.error
import twurl
import json
import ssl

# https://apps.twitter.com/
# Crear App y obtener las cuatro cadenas, luego colocarlas en hidden.py

TWITTER_URL = 'https://api.twitter.com/1.1/friends/list.json'

# Ignorar errores de certificado SSL
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

while True:
    print('')
    cuenta = input('Ingresa una cuenta de Twitter:')
    if (len(cuenta) < 1): break
    url = twurl.aumentar(TWITTER_URL,
                         {'screen_name': cuenta, 'count': '5'})
    print('Recuperando', url)
    conexion = urllib.request.urlopen(url, context=ctx)
    data = conexion.read().decode()

    js = json.loads(data)
    print(json.dumps(js, indent=2))

    cabeceras = dict(conexion.getheaders())
    print('Restantes', cabeceras['x-rate-limit-remaining'])

    for u in js['users']:
        print(u['screen_name'])
        if 'status' not in u:
            print('   * Estado no encontrado')
            continue
        s = u['status']['text']
        print('  ', s[:50])
