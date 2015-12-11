
for fn in *.mkd; do
    echo "the next file is $fn"
    x=`basename $fn .mkd`
    echo $x
    sed 's/www.py4inf.com/www.pythonlearn.com/'g < $x.mkd > /tmp/$x.mkd
    cp /tmp/$x.mkd $x.mkd

done
