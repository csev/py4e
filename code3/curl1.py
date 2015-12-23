import urllib.request, urllib.parse, urllib.error

img = urllib.request.urlopen('http://www.py4inf.com/cover.jpg').read()
fhand = open('cover.jpg', 'wb')
fhand.write(img)
fhand.close()
