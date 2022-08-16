import json

data = '''
{
  "όνομα" : "Chuck",
  "τηλέφωνο" : {
    "τύπος" : "εσωτερικό",
    "αριθμός" : "+1 734 303 4456"
   },
   "email" : {
     "κρυφό" : "ναι"
   }
}'''

info = json.loads(data)
print('Όνομα:', info["όνομα"])
print('Κρυφό:', info["email"]["κρυφό"])
