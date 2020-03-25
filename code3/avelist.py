numlista = list()
while (True):
    inp = input('Ingresa un número: ')
    if inp == 'fin': break
    valor = float(inp)
    numlista.append(valor)

promedio = sum(numlista) / len(numlista)
print('Promedio:', promedio)
