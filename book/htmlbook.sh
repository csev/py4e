# Testfile
#cat trinket/test | python verbatim.py --trinket | pandoc -s -f markdown -t html --template=trinket/template --toc --default-image-extension=svg --css=../trinket/simplegrid.css -o html/test.html 

# Clean directory
find html/. -type f -not -name 'figs2' | xargs rm

# Make a symlink to figs
#(cd html && ln -s ../figs2/)

# Convert all mkd into html
for fn in *.mkd; do
    echo "the next file is $fn"
    x=`basename $fn .mkd`
    echo $x
    cat $fn | python verbatim.py --trinket | pandoc -s -f markdown -t html --template=trinket/template --toc --default-image-extension=svg --css=../trinket/simplegrid.css -o html/$x.html
done