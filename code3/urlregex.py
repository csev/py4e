# Αναζήτηση συνδέσμων εντός του URL εισόδου
import urllib.request, urllib.parse, urllib.error
import re
import ssl

# Αγνόηση των σφαλμάτων πιστοποιητικού SSL
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

url = input('Εισάγεται - ')
html = urllib.request.urlopen(url, context=ctx).read()
links = re.findall(b'href="(http[s]?://.*?)"', html)
for link in links:
    print(link.decode())
