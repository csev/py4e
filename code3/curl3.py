import os
import urllib.request, urllib.parse, urllib.error

print('Ingresa una URL como http://data.pr4e.org/cover3.jpg')
urlstr = input().strip()
img = urllib.request.urlopen(urlstr)

# Obtener la última "palabra"
palabras = urlstr.split('/')
nombre_archivo = palabras[-1]

# No sobreescribir el archivo
if os.path.exists(nombre_archivo):
    if input('¿Remplazar ' + nombre_archivo + ' (S/n)?') != 'S':
        print('Datos no copiados')
        exit()
    print('Reemplazando', nombre_archivo)

manejador_a = open(nombre_archivo, 'wb')
longitud = 0
while True:
    info = img.read(100000)
    if len(info) < 1: break
    longitud = longitud + len(info)
    manejador_a.write(info)

print(longitud, 'caracteres copiados en', nombre_archivo)
manejador_a.close()
