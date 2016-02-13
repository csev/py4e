import urllib.request, urllib.parse, urllib.error

fhand = urllib.request.urlopen('http://www.pythonlearn.com/code3/romeo.txt')
for line in fhand:
    print(line.decode().strip())

