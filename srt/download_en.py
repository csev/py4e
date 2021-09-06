
# https://pypi.org/project/python-youtube/

import math
from youtube_transcript_api import YouTubeTranscriptApi
from pyyoutube import Api
from secret import api_key

api = Api(api_key=api_key());

# 1.89 -> 00:00:01,890
def time2str(ticks) :
    frac = int( ticks * 1000 ) % 1000;
    ticks = int(math.floor(ticks))
    hh = int(math.floor(ticks / (60*60)))
    ticks = ticks - (hh*60*60)
    mm = int(math.floor(ticks / 60))
    ticks = ticks - mm * 60
    return f"{hh:02}:{mm:02}:{ticks:02},{frac:03}"


playlist_item_by_playlist = api.get_playlist_items(playlist_id="PLlRFEj9H3Oj7Bp8-DfGpfAfDBiblRfl5p", count=None)

for item in playlist_item_by_playlist.items :
    title = item.snippet.title
    videoId = item.snippet.resourceId.videoId
    print(videoId, title)
    filename = 'en/' + title.replace('/','-') + ' - ' + videoId + '.srt'
    print(filename) 

    try:
        captions = YouTubeTranscriptApi.get_transcript(videoId)
    except:
        continue

    # {'text': 'Hello everybody and welcome to chapter', 'start': 0.0, 'duration': 1.89}
    # {'text': "one of Python for Everybody. I'm Charles", 'start': 1.89, 'duration': 1.92}

    with open(filename, "w") as f:
        for i in range(len(captions)):
            caption = captions[i]
            text = caption["text"]
            start = caption["start"]
            duration = caption["duration"]
            if i < len(captions)-1 :
                end = captions[i+1]["start"]
            else :
                end = start + duration
            f.write(str(i+1))
            f.write("\n")
            f.write(time2str(start)+' --> '+time2str(end))
            f.write("\n")
            f.write(text)
            f.write("\n")
            f.write("\n")

    # 1
    # 00:00:00,000 --> 00:00:01,890
    # Hello everybody and welcome to chapter
    #
    # 2
    # 00:00:01,890 --> 00:00:03,810
    # one of Python for Everybody. I'm Charles

