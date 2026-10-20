#! /bin/bash
set -e

cd "$(dirname "$0")"

rm -f code.zip
if [ -d code ]; then
    zip -r code.zip code
fi

# Leave the per-assignment zips out of the full sample archive.
rm -f code3.zip
if [ -d code3 ]; then
    zip -r code3.zip code3 -x 'code3/*.zip' '*/__pycache__/*' '*.pyc'
fi
