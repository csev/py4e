import urllib.request, urllib.parse, urllib.error

man_a = urllib.request.urlopen('http://data.pr4e.org/romeo.txt')

contadores = dict()
for linea in man_a:
    palabras = linea.decode().split()
    for palabra in palabras:
        contadores[palabra] = contadores.get(palabra, 0) + 1

print(contadores)
