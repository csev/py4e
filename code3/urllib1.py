import urllib.request, urllib.parse, urllib.error

fhand = urllib.request.urlopen('http://www.pythonlearn.com/code/romeo.txt')
for line in fhand:
    print(line.strip())

