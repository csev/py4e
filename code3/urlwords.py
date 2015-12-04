import urllib.request, urllib.parse, urllib.error

counts = dict()
fhand = urllib.request.urlopen('http://www.py4inf.com/code/romeo.txt')
for line in fhand:
    words = line.split()
    for word in words:
        counts[word] = counts.get(word,0) + 1   
print(counts)
