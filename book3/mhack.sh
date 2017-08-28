
for fn in *.mkd; do
    echo "the next file is $fn"
    x=`basename $fn .mkd`
    echo $x
    python mhack.py < $x.mkd > /tmp/$x.mkd
    cp /tmp/$x.mkd $x.mkd

done
