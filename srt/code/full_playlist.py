
# https://pypi.org/project/python-youtube/

import math
import json
import hashlib
import sys
import os
from youtube_transcript_api import YouTubeTranscriptApi
from pyyoutube import Api
from secret import api_key
import util

api = Api(api_key=api_key())
if len(sys.argv) != 2 : 
    print('Please add the language')
    quit()

language = sys.argv[1]
if not os.path.isdir(language) :
    print("Missing folder for", language)
    quit()

playlist_item_by_playlist = api.get_playlist_items(playlist_id="PLlRFEj9H3Oj7Bp8-DfGpfAfDBiblRfl5p", count=None)

for item in playlist_item_by_playlist.items :
    title = item.snippet.title
    videoId = item.snippet.resourceId.videoId

    # transcript_list = YouTubeTranscriptApi.list_transcripts(videoId)
    # for transcript in transcript_list:
        # print(transcript.video_id, transcript.language, transcript.language_code)

    try:
        captions = YouTubeTranscriptApi.get_transcript(videoId, languages=[language])
    except:
        print('No Captions for', videoId, title)
        continue

    # {'text': 'Hello everybody and welcome to chapter', 'start': 0.0, 'duration': 1.89}
    # {'text': "one of Python for Everybody. I'm Charles", 'start': 1.89, 'duration': 1.92}

    output = util.caption2srt(captions)
    md = hashlib.md5(output.encode()).hexdigest()
    filename = language + '/' + title.replace('/','-') + ' - ' + videoId + '.srt'
    print(filename, md) 

    with open(filename, "w") as f:
        f.write(output)

    # 1
    # 00:00:00,000 --> 00:00:01,890
    # Hello everybody and welcome to chapter
    #
    # 2
    # 00:00:01,890 --> 00:00:03,810
    # one of Python for Everybody. I'm Charles

