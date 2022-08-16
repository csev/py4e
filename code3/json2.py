import json

data = '''
[
  { "id" : "001",
    "x" : "2",
    "όνομα" : "Chuck"
  } ,
  { "id" : "009",
    "x" : "7",
    "όνομα" : "Brent"
  }
]'''

info = json.loads(data)
print('Πλήθος χρηστών:', len(info))

for item in info:
    print('Όνομα', item['όνομα'])
    print('Id', item['id'])
    print('Χαρακτηριστικό', item['x'])
