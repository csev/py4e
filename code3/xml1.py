import xml.etree.ElementTree as ET

data = '''
<άτομο>
  <όνομα>Chuck</όνομα>
  <τηλέφωνο τύπος="εσωτερικό">
    +1 734 303 4456
  </τηλέφωνο>
  <email κρυφό="ναι" />
</άτομο>'''

tree = ET.fromstring(data)
print('Όνομα:', tree.find('όνομα').text)
print('Χαρακτηριστικό:', tree.find('email').get('κρυφό'))
