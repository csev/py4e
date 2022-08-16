import xml.etree.ElementTree as ET

input = '''
<stuff>
  <χρήστες>
    <χρήστης x="2">
      <id>001</id>
      <όνομα>Chuck</όνομα>
    </χρήστης>
    <χρήστης x="7">
      <id>009</id>
      <όνομα>Brent</όνομα>
    </χρήστης>
  </χρήστες>
</stuff>'''

stuff = ET.fromstring(input)
lst = stuff.findall('χρήστες/χρήστης')
print('Πλήθος χρηστών:', len(lst))

for item in lst:
    print('Όνομα', item.find('όνομα').text)
    print('Id', item.find('id').text)
    print('Χαρακτηριστικό', item.get('x'))
