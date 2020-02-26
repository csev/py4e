# Búsqueda de líneas que tengan una arroba entre caracteres
# Los caracteres deben ser una letra o un número
# Los resultados serán un poco más precisos que re07.py para las direcciones email
import re
man = open('mbox-short.txt')
for linea in man:
    linea = linea.rstrip()
    x = re.findall(r'[a-zA-Z0-9\-.]\S+@[a-zA-Z0-9].\S+[a-zA-Z]', linea)
    if len(x) > 0:
        print(x)
