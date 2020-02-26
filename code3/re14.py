# Búsqueda de líneas que comienzan con 'Author:' seguido de cualquier número de caracteres,
# una arroba, y cualquier carácter que no sea espacio en blanco
# Después imprimir el grupo de caracteres que está después de la arroba
import re
man = open('mbox-short.txt')
for linea in man:
    linea = linea.rstrip()
    x = re.findall(r'Author:.*@(\S+)', linea)
    if not x: continue
    print(x)
