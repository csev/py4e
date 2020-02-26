# Búsqueda de líneas que tengan una arroba entre caracteres
import re
man = open('mbox-short.txt')
for linea in man:
    linea = linea.rstrip()
    x = re.findall(r'\S+@\S+', linea)
    if len(x) > 0:
        print(x)
