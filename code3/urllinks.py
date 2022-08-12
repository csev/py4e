# Για να το εκτελέσετε, κάντε λήψη του αρχείου zip BeautifulSoup
# από  http://www.py4e.com/code3/bs4.zip
# και αποσυμπιέστε το στον ίδιο κατάλογο με αυτό το αρχείο

import urllib.request, urllib.parse, urllib.error
from bs4 import BeautifulSoup
import ssl

# Αγνόηση των σφαλμάτων πιστοποιητικού SSL
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

url = input('Εισάγετε - ')
html = urllib.request.urlopen(url, context=ctx).read()
soup = BeautifulSoup(html, 'html.parser')

# Ανάκτηση όλων των ετικετών αγκύρωσης
tags = soup('a')
for tag in tags:
    print(tag.get('href', None))
