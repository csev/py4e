# Búsqueda de líneas que comiencen con 'X' seguida de cualquier caracter que
# no sea espacio en blanco y ':' seguido de un espacio y un número.
# El número puede incluir decimales.
# Después imprimir el número si es mayor a cero.
import re
man = open('mbox-short.txt')
for linea in man:
    linea = linea.rstrip()
    x = re.findall(r'^X\S*: ([0-9.]+)', linea)
    if len(x) > 0:
        print(x)
