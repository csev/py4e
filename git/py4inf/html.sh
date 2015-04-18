# This needs netpbm and hevea from Darwin Ports

rm -rf html
mkdir html
hevea -O -e latexonly png.hva htmlonly book
# the following line is a kludge to prevent imagen from seeing
# the definitions in latexonly
grep -v latexonly book.image.tex > a; mv a book.image.tex
imagen -png book
hacha book.html
mv index.html book.css book*.html book*.png book*.gif *motif.gif html
rm book.haux book.hind book.htoc book.image.tex

echo " "
echo "Patching the HTML ..."
python fixhtml.py

