import urllib
from BeautifulSoup import *

print "Warning - this program wil likely run forever'

url = raw_input('Enter starting point - ')
urls = list()
urls.append(url)
done = list()

while len(urls) > 0 : 
    print "================ We have ",len(urls)," Urls ======="
    url = urls.pop()
    print "========= Retrieveing URL = ",url
    done.append(url)
    try:
        html = urllib.urlopen(url).read()
    except:
        print "Failed to retrieve",url
        continue

    print "Length",len(html)
    soup = BeautifulSoup(html)

    # Retrieve all of the anchor tags
    tags = soup('a')
    print "Link count:",len(tags)
    for tag in tags:
        link = tag.get('href', None)
        if link is None : continue
        if not link.startswith('http:') : continue
        print link
        if link not in done: urls.append(link)
