import math
from youtube_transcript_api import YouTubeTranscriptApi

# 1.89 -> 00:00:01,890
def time2str(ticks) :
    frac = int( ticks * 1000 ) % 1000;
    ticks = int(math.floor(ticks))
    hh = int(math.floor(ticks / (60*60)))
    ticks = ticks - (hh*60*60)
    mm = int(math.floor(ticks / 60))
    ticks = ticks - mm * 60
    return f"{hh:02}:{mm:02}:{ticks:02},{frac:03}"

captions = YouTubeTranscriptApi.get_transcript("fvhNadKjE8g")

# {'text': 'Hello everybody and welcome to chapter', 'start': 0.0, 'duration': 1.89}
# {'text': "one of Python for Everybody. I'm Charles", 'start': 1.89, 'duration': 1.92}

for i in range(len(captions)):
    caption = captions[i]
    text = caption["text"]
    start = caption["start"]
    duration = caption["duration"]
    if i < len(captions)-1 :
        end = captions[i+1]["start"]
    else :
        end = start + duration
    print(i+1)
    print(time2str(start)+' --> '+time2str(end))
    print(text)
    print()

# 1
# 00:00:00,000 --> 00:00:01,890
# Hello everybody and welcome to chapter
#
# 2
# 00:00:01,890 --> 00:00:03,810
# one of Python for Everybody. I'm Charles

