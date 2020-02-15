import string
manejador = open('romeo-full.txt')
contadores = dict()
for linea in manejador:
    linea = linea.translate(str.maketrans('', '', string.punctuation))
    linea = linea.lower()
    palabras = linea.split()
    for palabra in palabras:
        if palabra not in contadores:
            contadores[palabra] = 1
        else:
            contadores[palabra] += 1

# Ordenar el diccionario por valor
lst = list()
for clave, valor in list(contadores.items()):
    lst.append((valor, clave))

lst.sort(reverse=True)

for clave, valor in lst[:10]:
    print(clave, valor)
