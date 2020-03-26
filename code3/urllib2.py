import urllib.request, urllib.parse, urllib.error

man_a = urllib.request.urlopen('http://www.dr-chuck.com/page1.htm')
for linea in man_a:
    print(linea.decode().strip())
