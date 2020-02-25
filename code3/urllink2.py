# Para ejecutar este programa descarga BeautifulSoup
# https://pypi.python.org/pypi/beautifulsoup4

# O descarga el archivo
# http://www.py4e.com/code3/bs4.zip
# y descomprimelo en el mismo directorio que este archivo

from urllib.request import urlopen
from bs4 import BeautifulSoup
import ssl

# Ignorar errores de certificado SSL
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

url = input('Introduzca - ')
html = urlopen(url, context=ctx).read()
sopa = BeautifulSoup(html, "html.parser")

# Obtener todas las etiquetas de anclaje
etiquetas = sopa('a')
for etiqueta in etiquetas:
    # Look at the parts of a tag
    print('ETIQUETA:', etiqueta)
    print('URL:', etiqueta.get('href', None))
    print('Contenido:', etiqueta.contents[0])
    print('Atributos:', etiqueta.attrs)
