pre.py 02-variables.tex | pandoc -f latex -o 02-variables.tex 
pre.py 02-variables.tex | pandoc -f latex -w markdown > 02-variables.tmp
pre.py 02-variables.tex | tee p1.txt | pandoc -f latex -w markdown | tee p2.txt | post.py | tee p3.txt | post2.py | tee 02-variables.txt | pandoc -f markdown -w html > 02-variables.html

