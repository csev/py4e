import urllib.request, urllib.parse, urllib.error
from twurl import aumentar
import ssl

# https://apps.twitter.com/
# Crear App y obtener las cuatro cadenas, luego colocarlas en hidden.py

print('* Conectando a Twitter...')
url = aumentar('https://api.twitter.com/1.1/statuses/user_timeline.json',
              {'screen_name': 'drchuck', 'count': '2'})
print(url)

# Ignorar errores de certificado SSL
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

conexion = urllib.request.urlopen(url, context=ctx)
datos = conexion.read()
print(datos)

print ('======================================')
cabeceras = dict(conexion.getheaders())
print(cabeceras)
