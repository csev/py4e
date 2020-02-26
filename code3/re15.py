# Búsqueda de líneas que contengan 'New Revision: ' seguido de un número
# Después convertir el número en flotante y agregarlo a la lista nums
# Finalmente imprimir el tamaño y el promedio de la lista nums
import re
nombrea = input('Ingresa un nombre de archivo: ')
man = open(nombrea)
nums = list()
for linea in man:
    linea = linea.rstrip()
    x = re.findall('New Revision: ([0-9]+)', linea)
    if len(x) == 1:
        val = float(x[0])
        nums.append(val)
print(len(nums))
print(sum(nums)/len(nums))
