import json

datos = '''
{
  "nombre" : "Chuck",
  "teléfono" : {
    "tipo" : "intl",
    "número" : "+1 734 303 4456"
   },
   "email" : {
     "oculto" : "si"
   }
}'''

info = json.loads(datos)
print('Nombre:', info["nombre"])
print('Oculto:', info["email"]["oculto"])
