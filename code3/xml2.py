import xml.etree.ElementTree as ET

datos = '''
<cosa>
  <usuarios>
    <usuario x="2">
      <id>001</id>
      <nombre>Chuck</nombre>
    </usuario>
    <usuario x="7">
      <id>009</id>
      <nombre>Brent</nombre>
    </usuario>
  </usuarios>
</cosa>'''

cosa = ET.fromstring(datos)
lst = cosa.findall('usuarios/usuario')
print('Total de usuarios:', len(lst))

for item in lst:
    print('Nombre', item.find('nombre').text)
    print('Id', item.find('id').text)
    print('Atributo', item.get('x'))
