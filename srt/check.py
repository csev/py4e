
# https://pypi.org/project/python-youtube/

import math
import json
import hashlib
import sys
import os
from youtube_transcript_api import YouTubeTranscriptApi
from pyyoutube import Api
import util

if len(sys.argv) != 2 : 
    print('Please add the language')
    quit()

language = sys.argv[1]
if not os.path.isdir(language) :
    print("Missing folder for", language)
    quit()

checkfile = language + '/_index.json'
chkstr = open(checkfile).read()
chks = json.loads(chkstr)

chksum = dict()
same = 0
diff = 0

for (vid, chk) in chks.items() :
    pieces = vid.replace('.srt', '').split()
    if len(pieces) < 2 : continue
    videoId = pieces[len(pieces)-1]
    filename = vid
    filestr = open(filename).read()
    filemd = hashlib.md5(filestr.encode()).hexdigest()

    try:
        captions = YouTubeTranscriptApi.get_transcript(videoId)
    except:
        print('No Captions for', videoId, vid)
        continue

    output = util.caption2srt(captions)
    ymd = hashlib.md5(output.encode()).hexdigest()
    if ymd == filemd : 
        same = same + 1
        chksum[filename] = ymd
        print('.', end='', flush=True)
        continue
    diff = diff + 1

    # {'text': 'Hello everybody and welcome to chapter', 'start': 0.0, 'duration': 1.89}
    # {'text': "one of Python for Everybody. I'm Charles", 'start': 1.89, 'duration': 1.92}

    print()
    print('Need to upload',filename) 
    chksum[filename] = ymd

print()
print("To upload", diff)
print("Unchanged", same)
