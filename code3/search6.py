narchivo = input('Ingresa un nombre de archivo: ')
man_a = open(narchivo)
contador = 0
for linea in man_a:
    if linea.startswith('Subject:'):
        contador = contador + 1
print('Hay', contador, 'líneas de asunto (subject) en', narchivo)
