man_a = open('mbox-short.txt')
for linea in man_a:
    linea = linea.rstrip()
    if not linea.startswith('From '): continue
    palabras = linea.split()
    print(palabras[2])
