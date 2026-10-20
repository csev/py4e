#!/bin/bash

# Clean directory
mkdir -p html zips
find html -type f -not -name 'figs2' -delete

# Make a symlink to figs
#(cd html && ln -s ../figs2/)

# Pick your Python
MY_PYTHON=python
if which python3; then
MY_PYTHON=python3
fi
echo Using python command: $MY_PYTHON

# A metadata title also inserts a heading. Chapters already have that
# heading in the markdown, so drop the extra block.
drop_injected_title() {
    if [ "$1" = yes ]; then
        sed '/<header id="title-block-header">/,/<\/header>/d'
    else
        cat
    fi
}

# Convert all mkd into html
for fn in *.mkd; do
    echo "the next file is $fn"
    x=`basename $fn .mkd`
    echo $x
    # Standalone HTML needs a <title>. Chapters that lack a Pandoc
    # title block use their first heading.
    title_args=()
    drop_title=no
    if ! head -n 1 "$fn" | grep -q '^%'; then
        drop_title=yes
        title=$(awk '
            NR > 1 && prev !~ /^%/ && prev ~ /[^[:space:]]/ && $0 ~ /^(=+|-+)$/ {
                print prev
                found = 1
                exit
            }
            { prev = $0 }
            END { if (!found) print "Python for Everybody" }
        ' "$fn")
        title_args=(--metadata "title=$title")
    fi
    cat $fn | \
    $MY_PYTHON pre-html.py | \
    tee tmp.html.pre.$x | \
    $MY_PYTHON verbatim.py --files | \
    pandoc -s \
    --no-highlight \
    -f markdown -t html \
    --default-image-extension=svg \
    --css=http://thisisdallas.github.io/Simple-Grid/simpleGrid.css \
    "${title_args[@]}" | \
    drop_injected_title "$drop_title" \
    > html/$x.html
done

rm tmp.*

# Make the zip
rm -f zips/html.zip
zip -r9 zips/html.zip html && echo "Wrote zips/html.zip"

# Clean directory
echo
echo Cleaning up html folder
find html -type f -not -name 'figs2' -delete
