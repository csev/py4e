man_a = open('mbox-short.txt')
contador = 0
for linea in man_a:
    if linea.startswith('From:'):
        print(linea)
