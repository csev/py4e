#! /bin/bash

rm *.tmp *.aux
latex book
makeindex book
latex book
dvipdf book.dvi book.pdf
if [[ "$OSTYPE" == "darwin"* ]]; then
  open book.pdf
elif [[ "$OSTYPE" == "linux-gnu" && -n "$DISPLAY" ]]; then
  xdg-open book.pdf
else
  echo "Output on book.pdf"
fi
echo Removed temporary files
rm -f book.aux book.ind book.ilg book.log book.dvi book.idx book.toc book.haux book.hind book.image.tex book.tmp book.idv book.4tc book.lg book.xref
