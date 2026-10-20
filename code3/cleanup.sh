#! /bin/sh

rm -f *.pyc */*.pyc
if [ -f gmane/mapping.sqlite ]; then
    mv gmane/mapping.sqlite gmane/mapping.save
fi
rm -f *.sqlite */*.sqlite
if [ -f gmane/mapping.save ]; then
    mv gmane/mapping.save gmane/mapping.sqlite
fi
rm -f *.zip

find . -name '__pycache__' -exec rm -rf {} +

zip_one() {
    name=$1
    shift
    for dir in "$@"; do
        if [ ! -d "$dir" ]; then
            echo "Skipping $name ($dir is not present)"
            return 0
        fi
    done
    zip -r "$name" "$@"
}

zip_one geodata.zip geodata
zip_one opengeo.zip opengeo
zip_one gmane.zip gmane
zip_one pagerank.zip pagerank
zip_one tracks.zip tracks
zip_one roster.zip roster
zip_one bs4.zip bs4 soupsieve
