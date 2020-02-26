# Búsqueda de líneas que comienzan con From y tienen una arroba
import re
man = open('mbox-short.txt')
for linea in man:
    linea = linea.rstrip()
    if re.search('^From:.+@', linea):
        print(linea)
