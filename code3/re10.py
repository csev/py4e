# Búsqueda de líneas que comiencen con 'X' seguida de cualquier caracter que
# no sea espacio y ':' seguido de un espacio y cualquier número.
# El número incluye decimales.
import re
man = open('mbox-short.txt')
for linea in man:
    linea = linea.rstrip()
    if re.search(r'^X\S*: [0-9.]+', linea):
        print(linea)
