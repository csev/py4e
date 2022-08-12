import urllib.request, urllib.parse, urllib.error

fhand = urllib.request.urlopen('http://data.pr4e.org/romeo.txt')

πλήθη = dict()
for γραμμή in fhand:
    λέξεις = γραμμή.decode().split()
    for λέξη in λέξεις:
        πλήθη[λέξη] = πλήθη.get(λέξη, 0) + 1
print(πλήθη)
