pre.py 02-variables.tex | tee /tmp/p1.tmp | pandoc -f latex -w markdown | tee /tmp/p2.tmp | post.py | tee /tmp/p3.tmp | post2.py | tee 02-variables.mkd | pandoc -f markdown -w html > 02-variables.html

pre.py 01-intro.tex | tee /tmp/p1.tmp | pandoc -f latex -w markdown | tee /tmp/p2.tmp | post.py | tee /tmp/p3.tmp | post2.py | tee 01-intro.mkd | pandoc --default-image-extension=png -f markdown -w html > 01-intro.html

pre.py 15-viz.tex | tee /tmp/p1.tmp | pandoc -f latex -w markdown | tee /tmp/p2.tmp | post.py | tee /tmp/p3.tmp | post2.py | tee 15-viz.mkd | pandoc --default-image-extension=png -f markdown -w html > 15-viz.html

