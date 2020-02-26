# Búsqueda de líneas que contengan 'From'
import re
man = open('mbox-short.txt')
for linea in man:
    linea = linea.rstrip()
    if re.search('From:', linea):
        print(linea)
