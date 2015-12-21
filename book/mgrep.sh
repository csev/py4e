
for fn in *.mkd; do
    echo "the next file is $fn"
    x=`basename $fn .mkd`
    echo $x
    sed 's"www.pythonlearn.com/code/"www.pythonlearn.com/code3/"'g < $x.mkd > /tmp/$x.mkd
    cp /tmp/$x.mkd $x.mkd

done
