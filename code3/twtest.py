import urllib.request, urllib.parse, urllib.error
from twurl import augment

print('* Calling Twitter...')
url = augment('https://api.twitter.com/1.1/statuses/user_timeline.json',
              {'screen_name': 'drchuck', 'count': '2'})
print(url)
connection = urllib.request.urlopen(url)
data = connection.read()
print(data)

headers = dict(connection.getheaders())
print(headers)
