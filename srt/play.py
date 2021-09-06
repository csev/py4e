
# https://pypi.org/project/python-youtube/

from pyyoutube import Api
from secret import api_key
api = Api(api_key=api_key());

playlist_item_by_playlist = api.get_playlist_items(playlist_id="PLlRFEj9H3Oj7Bp8-DfGpfAfDBiblRfl5p", count=None)
# print(list(playlist_item_by_playlist.items));
# print('=======================')

# print(playlist_item_by_id.items[0].snippet.resourceId)
for item in playlist_item_by_playlist.items :
    title = item.snippet.title
    videoId = item.snippet.resourceId.videoId
    # print(item.snippet)
    # print(item.snippet.resourceId)
    print(videoId, title)


