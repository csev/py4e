# Para ejecutar este programa descarga BeautifulSoup
# https://pypi.python.org/pypi/beautifulsoup4

# O descarga el archivo
# http://www.py4e.com/code3/bs4.zip
# y descomprimelo en el mismo directorio que este archivo

import urllib.request, urllib.parse, urllib.error
from bs4 import BeautifulSoup
import ssl

# Ignorar errores de certificado SSL
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

pendientes = list()
visitados = list()
url = input('Introduzca - ')
pendientes.append(url)
contador = int(input('Cuántos para recuperar - '))

while len(pendientes) > 0 and contador > 0 :
    print("====== Por Recuperar:",contador, "En Espera:", len(pendientes))
    url = pendientes.pop()
    contador = contador - 1

    if (not url.startswith('http')):
        print("Ignorando", url)
        continue

    if (url.find('facebook') > 0):
        continue

    if (url.find('linkedin') > 0):
        continue

    if (url in visitados):
        print("Visitado", url)
        continue

    print("===== Recuperando ", url)

    try:
        html = urllib.request.urlopen(url, context=ctx).read()
    except:
        print("*** Error en la recuperación")
        continue

    soup = BeautifulSoup(html, 'html.parser')
    visitados.append(url)

    # Recuperar todos las etiquetas de anclaje
    etiquetas = soup('a')
    for etiqueta in etiquetas:
        nuevaurl = etiqueta.get('href', None)
        if (nuevaurl is not None):
            pendientes.append(nuevaurl)
