
# https://pypi.org/project/python-youtube/

import math
import json
import hashlib
import sys
import os
from youtube_transcript_api import YouTubeTranscriptApi
from pyyoutube import Api
import util
import string

if len(sys.argv) != 2 : 
    print('Please add the language')
    quit()

language = sys.argv[1]
if not os.path.isdir(language) :
    print("Missing folder for", language)
    quit()

newsrts = list()
updates = list()
same = 0
for filename in os.listdir(language):
    f = os.path.join(language, filename)
    # checking if it is a file
    if f.find('_index.json') >= 0  : continue
    if not os.path.isfile(f) : continue

    pieces = f.replace('.srt', '').split()
    if len(pieces) < 2 : continue
    videoId = pieces[len(pieces)-1]
    filestr = open(f).read()
    filemd = util.hash_srt(filestr)

    try:
        captions = YouTubeTranscriptApi.get_transcript(videoId, languages=[language])
        # print(captions)
    except:
        newsrts.append(f)
        continue

    output = util.caption2srt(captions)
    ymd = util.hash_srt(output)
    if ymd == filemd : 
        same = same + 1
        print('.', end='', flush=True)
        continue

    # {'text': 'Hello everybody and welcome to chapter', 'start': 0.0, 'duration': 1.89}
    # {'text': "one of Python for Everybody. I'm Charles", 'start': 1.89, 'duration': 1.92}

    updates.append(f)

print()
print('Unchanged', same)
for filename in newsrts:
    print('NEW', filename)
for filename in updates:
    print('UPDATE', filename)
