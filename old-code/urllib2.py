import urllib

fhand = urllib.urlopen('http://localhost:8080/')
for line in fhand:
   print line.strip()

