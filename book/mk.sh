
for fn in *.tex; do
    echo "the next file is $fn"
    x=`basename $fn .tex`
    echo $x
    # pandoc -o `basename $fn .tex`.txt $fn
    pre.py $x.tex | tee p1.txt | pandoc -f latex -w markdown | tee p2.txt | post.py | tee p3.txt | post2.py | tee $x.txt | pandoc -f markdown -w html > $x.html
    
done
