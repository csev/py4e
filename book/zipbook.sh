#!/bin/bash
# Testfile
#cat trinket/test | python verbatim.py --trinket | pandoc -s -f markdown -t html --template=trinket/template --toc --default-image-extension=svg --css=../trinket/simplegrid.css -o html/test.html 

# Clean directory
find zip/. -type f -not -name 'figs2' | xargs rm

# Add in css file
mkdir zip/trinket
cp trinket/base.css trinket/lazysizes.min.js trinket/trinket.css trinket/go.js zip/trinket

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
    python consoles.py | \
    pandoc -s  \
    -f markdown -t html \
    --template=trinket/zip \
    --toc \
    --default-image-extension=svg \
    --css=https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css \
    -o zip/$x.html
    echo "Wrote zip/$x.html"
done

rm tmp.*
