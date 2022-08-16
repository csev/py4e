#!/bin/bash

# Pick your Python
MY_PYTHON=python
if which python3; then
MY_PYTHON=python3
fi
echo Using python command: $MY_PYTHON

# Clean directory
[[ -d ../html3 ]] || mkdir ../html3
rm ../html3/[0-9]*.php

# Convert all mkd into html
for fn in *.mkd; do
    echo "the next file is $fn"
    x=`basename $fn .mkd`
    echo $x
    cat $fn | \
    $MY_PYTHON pre-html.py | \
    tee tmp.html.pre.$x | \
    $MY_PYTHON verbatim.py --files | \
    tee tmp.html.verbatim.$x | \
    pandoc -s \
    -f markdown -t html \
    --no-highlight \
    --default-image-extension=svg | \
    tee tmp.html.post.$x | \
    $MY_PYTHON post-html.py | \
    cat > ../html3/$x.php
done

rm tmp.*
