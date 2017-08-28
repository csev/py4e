import os
import urllib

print 'Please enter a URL like http://www.py4inf.com/cover.jpg'
urlstr = raw_input().strip()
img = urllib.urlopen(urlstr)

# Get the last "word"
words = urlstr.split('/')
fname = words[-1]

# Don't overwrite the file
if os.path.exists(fname) :
    if raw_input('Replace '+fname+' (Y/n)?') != 'Y' :
        print 'Data not copied'
        exit()
    print 'Replacing',fname

fhand = open(fname, 'w')
size = 0
while True:
    info = img.read(100000)
    if len(info) < 1 : break
    size = size + len(info)
    fhand.write(info)

print size,'characters copied to',fname
fhand.close()
