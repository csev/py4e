#!/bin/bash

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

# Clean directory
[[ -d ../html3 ]] || mkdir ../html3
rm ../html3/[0-9]*.php

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
    tee tmp.html.verbatim.$x | \
    pandoc -s \
    -f markdown -t html \
    --no-highlight \
    --default-image-extension=svg \
    "${title_args[@]}" | \
    drop_injected_title "$drop_title" | \
    tee tmp.html.post.$x | \
    $MY_PYTHON post-html.py | \
    cat > ../html3/$x.php
done

rm tmp.*
