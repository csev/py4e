# install beautifulsoup4 
# https://pypi.python.org/pypi/beautifulsoup4

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
