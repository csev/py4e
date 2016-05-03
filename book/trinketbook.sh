#!/bin/bash
# Testfile
#cat trinket/test | python verbatim.py --trinket | pandoc -s -f markdown -t html --template=trinket/template --toc --default-image-extension=svg --css=../trinket/simplegrid.css -o html/test.html 

# Clean directory
find trinket/pfe/. -type f -not -name 'figs2' | xargs rm

# Make a symlink to figs
#(cd html && ln -s ../figs2/)

OUTPUTDIR='trinket/pfe'

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
    pandoc -s --self-contained \
    -f markdown -t html \
    --template=trinket/nunjucks \
    --toc \
    --default-image-extension=svg \
    -o $OUTPUTDIR/$x.html
    # Post-process the TOC
    python trinket/buildtoc.py $OUTPUTDIR/$x.html
    
    # Add in extra CSS for syntax highlighting
    cat trinket/highlight.html >> $OUTPUTDIR/$x.html
done

rm tmp.*
