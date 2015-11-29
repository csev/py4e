import urllib
import json

TWITTER_URL = 'http://api.twitter.com/1/statuses/friends/ACCT.json'

while True:
    print ''
    acct = raw_input('Enter Twitter Account:')
    if ( len(acct) < 1 ) : break
    url = TWITTER_URL.replace('ACCT', acct)
    print 'Retrieving', url
    document = urllib.urlopen (url).read()
    print 'Retrieved', len(document), 'characters.' 
    js = json.loads(document)
    count = 0
    for user in js:
        count = count + 1
        if count > 4 : break
        print user['screen_name']
        status =  user.get('status', None)
        if status is not None : 
            txt = status['text']
            print '  ',txt[:50]
