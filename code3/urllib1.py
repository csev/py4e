import urllib.request

man_a = urllib.request.urlopen('http://data.pr4e.org/romeo.txt')
for linea in man_a:
    print(linea.decode().strip())
