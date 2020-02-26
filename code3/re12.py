# Búsqueda de líneas que comiencen con 'Details: rev='
# seguido de números y '.'
# Después imprimir el número si es mayor a cero
import re
man = open('mbox-short.txt')
for linea in man:
    linea = linea.rstrip()
    x = re.findall('^Details:.*rev=([0-9.]+)', linea)
    if len(x) > 0:
        print(x)
