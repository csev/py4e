#!/bin/bash
# Testfile
#cat trinket/test | python verbatim.py --trinket | pandoc -s -f markdown -t html --template=trinket/template --toc --default-image-extension=svg --css=../trinket/simplegrid.css -o html/test.html 

# Clean directory
find html/. -type f -not -name 'figs2' | xargs rm

# Make a symlink to figs
#(cd html && ln -s ../figs2/)

# Pick your Python
MY_PYTHON=python
if which python3; then
MY_PYTHON=python3
fi
echo Using python command: $MY_PYTHON

# Convert all mkd into html
for fn in *.mkd; do
    echo "the next file is $fn"
    x=`basename $fn .mkd`
    echo $x
    cat $fn | \
    $MY_PYTHON pre-html.py | \
    tee tmp.html.pre.$x | \
    $MY_PYTHON verbatim.py --files | \
    pandoc -s \
    --no-highlight \
    -f markdown -t html \
    --default-image-extension=svg \
    --css=http://thisisdallas.github.io/Simple-Grid/simpleGrid.css \
    -o html/$x.html
done

rm tmp.*

# Make the zip
rm zips/html.zip
zip -r9 zips/html.zip html && echo "Wrote zips/html.zip"

# Clean directory
echo
echo Cleaning up html folder
find html/. -type f -not -name 'figs2' | xargs rm
