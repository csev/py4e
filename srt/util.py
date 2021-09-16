
# https://pypi.org/project/python-youtube/

import math
import sys
import re
import hashlib

# 1.89 -> 00:00:01,890
def time2str(ticks) :
    frac = int( ticks * 1000 ) % 1000
    ticks = int(math.floor(ticks))
    hh = int(math.floor(ticks / (60*60)))
    ticks = ticks - (hh*60*60)
    mm = int(math.floor(ticks / 60))
    ticks = ticks - mm * 60
    return f"{hh:02}:{mm:02}:{ticks:02},{frac:03}"

# {'text': 'Hello everybody and welcome to chapter', 'start': 0.0, 'duration': 1.89}
# {'text': "one of Python for Everybody. I'm Charles", 'start': 1.89, 'duration': 1.92}

# 1
# 00:00:00,000 --> 00:00:01,890
# Hello everybody and welcome to chapter
#
# 2
# 00:00:01,890 --> 00:00:03,810
# one of Python for Everybody. I'm Charles

def caption2srt(captions) :
    retval = ''
    for i in range(len(captions)):
        caption = captions[i]
        text = caption["text"]
        start = caption["start"]
        duration = caption["duration"]
        if i < len(captions)-1 :
            end = captions[i+1]["start"]
        else :
            end = start + duration
        retval = retval + str(i+1) + "\n"
        retval = retval + time2str(start)+' --> '+time2str(end) + "\n"
        retval = retval + text + "\n"
        retval = retval + "\n"

    return retval

# https://stackoverflow.com/questions/92438/stripping-non-printable-characters-from-a-string-in-python
# build a table mapping all non-printable characters to None

def make_printable(a_string):
    """Replace non-printable characters in a string."""

    filtered_characters = list(s for s in a_string if s.isprintable())
    filtered_string = ''.join(filtered_characters)
    return filtered_string

def hash_srt(srt) :
    srt = make_printable(srt)
    srt = srt.replace(' ', '')
    srt = re.sub(r':[0-9][0-9],[0-9]+', '', srt)
    hval = hashlib.md5(srt.encode()).hexdigest()
    return hval

def get_videoid(f) :
    pieces = f.replace('.srt', '').split()
    if len(pieces) < 2 : return ''
    videoId = pieces[len(pieces)-1]
    return videoId
