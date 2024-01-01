#! /bin/sh

# To render Chinese text, touch the file
#    touch .chinese
# in this folder so as to run the LaTex to make Chinese output

# Pick your Python
MY_PYTHON=python
if which python3; then
MY_PYTHON=python3
fi
echo Using python command: $MY_PYTHON

# For yucks make the epub
cat epub-metadata.txt *.mkd | grep -v '^%' | $MY_PYTHON pre-html.py | $MY_PYTHON verbatim.py | iconv -f utf8 -t ascii//TRANSLIT | pandoc --default-image-extension=svg --css=epub.css -o x.epub

rm tmp.* *.tmp *.aux
pandoc A0-preface.mkd -o tmp.prefacex.tex
sed < tmp.prefacex.tex 's/section{/section*{/' > tmp.preface.tex
cat [0-9]*.mkd | $MY_PYTHON verbatim.py | iconv -f utf8 -t ascii//TRANSLIT > tmp.verbatim 
pandoc -s -N -f markdown+definition_lists -t latex --toc --default-image-extension=png -V fontsize:10pt -V documentclass:book --template=template.latex -o tmp.tex < tmp.verbatim 
pandoc [A-Z][A-Z]*.mkd -o tmp.app.tex

sed < tmp.app.tex -e 's/subsubsection{/xyzzy{/' -e 's/subsection{/plugh{/' -e 's/section{/chapter{/' -e 's/xyzzy{/subsection{/' -e 's/plugh{/section{/'  > tmp.appendix.tex

# For Amazon we stick with jpg
# sed < tmp.tex '/includegraphics/s/jpg/eps/' | sed 's"includegraphics{../photos"includegraphics[height=3.0in]{../photos"' | iconv -f utf8 -t ascii//TRANSLIT > tmp.sed
# sed < tmp.tex '/includegraphics/s/jpg/eps/' | sed 's"includegraphics{../photos"includegraphics[height=3.0in]{../photos"' | iconv -f utf8 -t ascii//TRANSLIT > tmp.sed
sed < tmp.tex 's"includegraphics{../photos"includegraphics[height=3.0in]{../photos"' | iconv -f utf8 -t ascii//TRANSLIT > tmp.sed
diff tmp.sed tmp.tex

$MY_PYTHON texpatch.py < tmp.sed | iconv -f utf8 -t ascii//TRANSLIT > tmp.patch

mv tmp.patch tmp.tex
pdflatex tmp
makeindex tmp
pdflatex tmp

mv tmp.pdf x.pdf

open x.pdf
rm tmp.*
