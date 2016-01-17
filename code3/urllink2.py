# To run this, you can install BeautifulSoup 
# https://pypi.python.org/pypi/beautifulsoup4

# Or download the file
# http://www.pythonlearn.com/code3/bs4.zip
# and unzip it in the same directory as this file

import urllib.request
from bs4 import BeautifulSoup

url = input('Enter - ')
html = urllib.request.urlopen(url).read()

soup = BeautifulSoup(html, "html.parser")

# Retrieve all of the anchor tags
tags = soup('a')
for tag in tags:
    # Look at the parts of a tag
    print('TAG:',tag)
    print('URL:',tag.get('href', None))
    print('Contents:',tag.contents[0])
    print('Attrs:',tag.attrs)
