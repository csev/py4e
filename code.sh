#! /bin/bash
set -e

cd "$(dirname "$0")"

# code/ only redirects to code3. code.zip and code3.zip are both the
# Python 3 samples. Leave the per-assignment zips out of that archive.
rm -f code.zip code3.zip
if [ -d code3 ]; then
    zip -r code3.zip code3 -x 'code3/*.zip' '*/__pycache__/*' '*.pyc'
    cp code3.zip code.zip
fi
