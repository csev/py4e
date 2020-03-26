import json

datos = '''
[
  { "id" : "001",
    "x" : "2",
    "nombre" : "Chuck"
  } ,
  { "id" : "009",
    "x" : "7",
    "nombre" : "Brent"
  }
]'''

info = json.loads(datos)
print('Total de usuarios:', len(info))

for elemento in info:
    print('Nombre', elemento['nombre'])
    print('Id', elemento['id'])
    print('Atributo', elemento['x'])
