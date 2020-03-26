total = 0
contador = 0
while (True):
    inp = input('Ingresa un número: ')
    if inp == 'fin': break
    valor = float(inp)
    total = total + valor
    contador = contador + 1

promedio = total / contador
print('Promedio:', promedio)
