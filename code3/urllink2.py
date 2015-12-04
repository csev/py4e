# Note - this code must run in Python 2.x and you must download
# http://www.pythonlearn.com/code/BeautifulSoup.py
# Into the same folder as this program

import urllib.request, urllib.parse, urllib.error
from BeautifulSoup import *

url = input('Enter - ')
html = urllib.request.urlopen(url).read()

soup = BeautifulSoup(html)

# Retrieve all of the anchor tags
tags = soup('a')
for tag in tags:
    # Look at the parts of a tag
    print('TAG:',tag)
    print('URL:',tag.get('href', None))
    print('Contents:',tag.contents[0])
    print('Attrs:',tag.attrs)
