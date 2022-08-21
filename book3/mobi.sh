#! /bin/sh

# make the mobi if it works (add verbose for debugging)
if hash kindlegen 2>/dev/null; then
    kindlegen x.epub 
    echo "mobi generated"
else
    echo "mobi not generated - please install kindlegen"
fi
