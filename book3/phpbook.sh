#!/bin/bash
# Clean directory
[[ -d ../html3 ]] || mkdir ../html3
rm ../html3/[0-9]*.php

# Convert all mkd into html
for fn in *.mkd; do
    echo "the next file is $fn"
    x=`basename $fn .mkd`
    echo $x
    cat $fn | \
    python pre-html.py | \
    tee tmp.html.pre.$x | \
    python verbatim.py --files | \
    tee tmp.html.verbatim.$x | \
    pandoc -s \
    -f markdown -t html \
    --no-highlight \
    --default-image-extension=svg | \
    tee tmp.html.post.$x | \
    python post-html.py | \
    cat > ../html3/$x.php
done

rm tmp.*
