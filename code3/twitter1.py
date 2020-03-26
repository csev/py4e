import urllib.request, urllib.parse, urllib.error
import twurl
import ssl

# https://apps.twitter.com/
# Crear App y obtener las cuatro cadenas, luego colocarlas en hidden.py

TWITTER_URL = 'https://api.twitter.com/1.1/statuses/user_timeline.json'

# Ignorar errores de certificado SSL
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

while True:
    print('')
    cuenta = input('Ingresa una cuenta de Twitter:')
    if (len(cuenta) < 1): break
    url = twurl.aumentar(TWITTER_URL,
                         {'screen_name': cuenta, 'count': '2'})
    print('Recuperando', url)
    conexion = urllib.request.urlopen(url, context=ctx)
    datos = conexion.read().decode()
    print(datos[:250])
    cabeceras = dict(conexion.getheaders())
    # Imprimir cabeceras
    print('Restantes', cabeceras['x-rate-limit-remaining'])
