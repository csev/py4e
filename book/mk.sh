
rm html/* 

for fn in *.tex; do
    echo "the next file is $fn"
    x=`basename $fn .tex`
    echo $x

    pre.py $x.tex | tee /tmp/p1.tmp | pandoc -f latex -w markdown | tee /tmp/p2.tmp | post.py | tee /tmp/p3.tmp | post2.py | tee $x.mkd | pandoc --default-image-extension=png -f markdown -w html > html/$x.html
    
done

rm zap.py*
