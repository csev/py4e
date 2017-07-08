#!/bin/bash
# Testfile
#cat trinket/test | python verbatim.py --trinket | pandoc -s -f markdown -t html --template=trinket/template --toc --default-image-extension=svg --css=../trinket/simplegrid.css -o html/test.html 

# Clean directory
find zipbook/. -type f -not -path '*/images/*' -not -path '*/fonts/*' | xargs rm

# Add in css file
dirnames=("embeds" "offline")
for dir in "${dirnames[@]}"; do
    echo $dir
    cp trinket/base.css trinket/*.js trinket/trinket.css trinket/font-awesome.min.css trinket/fontawesome-webfont.woff2 zipbook/$dir/trinket
    cp trinket/index.html trinket/README.md zipbook/$dir
done

# Make a symlink to figs
#(cd html && ln -s ../figs2/)

# Convert all mkd into html
for fn in *.mkd; do
    echo "the next file is $fn"
    x=`basename $fn .mkd`
    echo $x

    cat $fn | \
    python pre-html.py | \
    tee tmp.html.pre.$x | \
    python verbatim.py --trinket --files | \
    tee tmp.html.verbatim.$x | \
    pandoc -s  \
    -f markdown -t html \
    --template=trinket/offline \
    --toc \
    --default-image-extension=svg \
    -o zipbook/offline/$x.html \
    && echo "Wrote zipbook/offline/$x.html"

    cat $fn | \
    python pre-html.py | \
    tee tmp.html.pre.$x | \
    python verbatim.py --trinket --files | \
    tee tmp.html.verbatim.$x | \
    python consoles.py | \
    pandoc -s  \
    -f markdown -t html \
    --template=trinket/zip \
    --toc \
    --default-image-extension=svg \
    -o zipbook/embeds/$x.html \
    && echo "Wrote zipbook/embeds/$x.html"
done

# Make the zip
rm zips/pfe.zip
zip -r9 zips/pfe.zip zipbook && echo "Wrote zips/pfe.zip"

# Updating ../trinket3

[[ -d ../trinket3 ]] || mkdir ../trinket3
rm ../trinket3/[0-9]*.html
cp -r zipbook/embeds/* ../trinket3


rm tmp.*
