import string
import sqlite3
import urllib
import xml.etree.ElementTree as ET
from BeautifulSoup import *

conn = sqlite3.connect('wikidata.db')
cur = conn.cursor()

cur.execute('''
    CREATE TABLE IF NOT EXISTS TinyTable (id INTEGER PRIMARY KEY, 
                   url TEXT, page BLOB, retrieved_at timestamp)''')

# A slightly extended dictionary
class sash(dict):
    def sortvalues(self,reverse=True):
        return sorted(self.items(),key=lambda x: (x[1], x[0]), reverse=reverse)

def tinyTable(url):
    global cur,conn
    cur.execute('SELECT id,page,retrieved_at FROM TinyTable WHERE URL = ?', (url, ))
    try:
        row = cur.fetchone()
        print 'DATE',row[2]
        return row[1]
    except:
        row = None
    print 'Retrieving', url

    data = urllib.urlopen (url).read()
    if row != None:
        cur.execute("UPDATE TinyTable SET page=?,retrieved_at=datetime('now') WHERE id=?", (unicode(data, 'utf-8'), row[0]))
    else:
        cur.execute("INSERT INTO TinyTable (url, page, retrieved_at) VALUES (?, ?, datetime('now'))",(url, unicode(data, 'utf-8')))
    conn.commit()
    return data

cururl = 'https://ctools.umich.edu/access/wiki/site/f57681b8-6db9-46cf-aad1-3a0bdd621138/home.html'
urls = list()
urls.append(cururl)
visited = list()
editcounts = sash()
postcounts = sash()

while len(urls) > 0 : 
    print '=== URLS Yet To Retrieve:',len(urls)
    cururl = urls.pop()
    if cururl in visited: continue
    print 'RETRIEVING',cururl
    data = tinyTable(cururl)
    visited.append(cururl)
    soup = BeautifulSoup(data)
    # print data[:3000]
    p = re.compile('\(.*?\)')
    paragraphs = soup('p')
    for para in paragraphs:
        try:
            posters = p.findall(para.contents[0])
        except:
            posters = list()

        for poster in posters:
            poster = poster.lower()
            postcounts[poster] = postcounts.get(poster,0) + 1

    tags = soup('a')
    # print 'Tags'
    for tag in tags:
        # print tag
        url = tag.get('href',None)
        if url == None : continue
        # Don't follow absolute urls
        if url.startswith('http') : continue
        newurl = urllib.basejoin(cururl,url)
        if newurl in visited : continue
        # print 'APPENDING',newurl
        urls.append(newurl)

    if not cururl.endswith('.html') : continue
    newurl = cururl.replace('.html','.20.rss')
    if newurl in visited: continue
    print 'RSS:', newurl
    data = tinyTable(newurl)
    visited.append(newurl)
    # print data[:500]

    stuff = ET.fromstring(data)
    lst = stuff.findall('channel/item/description')
    print 'Item count:', len(lst)

    for item in lst:
        dir(item)
        # print 'Text', item.text
        words = item.text.split()
        # print words[:10]
        name = words[3] + ' ' + words[4]
        if words[5] != 'at' : name = name + ' ' + words[5]
        # print name
        editcounts[name] = editcounts.get(name, 0 ) + 1

print 'EDITS:'
for (key,val) in editcounts.sortvalues():
   print key, val

for (key,val) in sorted(postcounts.items()):
   print key, val

conn.close()
