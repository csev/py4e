import os
from BeautifulSoup import *
count = 0
for (dirname, dirs, files) in os.walk('html'):
   for filename in files:
      if not filename.endswith('.html') : continue
      filename = 'html/' + filename
      fhand = open(filename)
      html = fhand.read()
      fhand.close()
      html = html.replace('``','"')
      html = html.replace("''",'"')
      soup = BeautifulSoup(html)
      html = str(soup)
      open(filename,"w").write(html)
      print filename, len(html)
