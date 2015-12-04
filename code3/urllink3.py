# Note - this code must run in Python 2.x and you must download
# http://www.pythonlearn.com/code/BeautifulSoup.py
# Into the same folder as this program

import urllib.request, urllib.parse, urllib.error
from BeautifulSoup import *

todo = list()
visited = list()
url = input('Enter - ')
todo.append(url)

while len(todo) > 0 :
    print("====== Todo list count is ",len(todo))
    url = todo.pop()

    if ( not url.startswith('http') ) : 
        print("Skipping", url)
        continue

    if ( url.find('facebook') > 0 ) :
        continue

    if ( url in visited ) :
        print("Visited", url)
        continue

    print("===== Retrieving ", url)

    html = urllib.request.urlopen(url).read()
    soup = BeautifulSoup(html)
    visited.append(url)

    # Retrieve all of the anchor tags
    tags = soup('a')
    for tag in tags:
        newurl = tag.get('href', None)
        if ( newurl != None ) : 
            todo.append(newurl)

