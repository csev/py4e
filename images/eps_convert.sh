#! /bin/bash

for f in *.eps
do
 b=`basename $f .eps`
 p=$b.png
 if test -f $p; then
  echo "Skipping $fp"
  continue
 fi
 echo "Processing $f"
 open $f
done
