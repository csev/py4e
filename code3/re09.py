# Búsqueda de líneas que comienzan con 'X' seguidas de cualquier caracter que
# no sea espacio en blanco, y ':', después imprimir el primer grupo de caracteres
# que no son espacios en blanco como sigue a continuación
import re
man = open('mbox-short.txt')
for linea in man:
    linea = linea.rstrip()
    x = re.findall(r'^X\S*: (\S+)', linea)
    if not x: continue
    print(x)
