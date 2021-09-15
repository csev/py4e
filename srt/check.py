
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
        chksum[filename] = chk
        print('.', end='', flush=True)
        continue
    diff = diff + 1

    # {'text': 'Hello everybody and welcome to chapter', 'start': 0.0, 'duration': 1.89}
    # {'text': "one of Python for Everybody. I'm Charles", 'start': 1.89, 'duration': 1.92}

    print()
    print(filename) 
    chksum[filename] = ymd

    with open(filename, "w") as f:
        f.write(output)

    # 1
    # 00:00:00,000 --> 00:00:01,890
    # Hello everybody and welcome to chapter
    #
    # 2
    # 00:00:01,890 --> 00:00:03,810
    # one of Python for Everybody. I'm Charles

checkfile = language + '/_index.json'
chk = json.dumps(chksum,  indent=4)
text_file = open(checkfile, "w")
n = text_file.write(chk)
text_file.close()

print()
print("Changed", diff)
print("Unchanged", same)
