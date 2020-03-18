man_a = open('mbox-short.txt')
for linea in man_a:
    palabras = linea.split()
    # print('Depuración:', palabras)
    if len(palabras) == 0: continue
    if palabras[0] != 'From': continue
    print(palabras[2])
