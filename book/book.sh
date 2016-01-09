#! /bin/sh

# For yucks make the epub
cat *.mkd | python verbatim.py | pandoc --default-image-extension=svg --epub-stylesheet=epub.css -o x.epub

rm tmp.* *.tmp *.aux
pandoc A0-preface.mkd -o tmp.prefacex.tex
sed < tmp.prefacex.tex 's/section{/section*{/' > tmp.preface.tex
# pandoc -s -N -f markdown+definition_lists -t latex --toc --default-image-extension=eps -V fontfamily:arev -V fontsize:10pt -V documentclass:book --template=template.latex [0-9]*.mkd [A][A-Z]*.mkd -o tmp.tex
cat [0-9]*.mkd | python verbatim.py | pandoc -s -N -f markdown+definition_lists -t latex --toc --default-image-extension=eps -V fontsize:10pt -V documentclass:book --template=template.latex -o tmp.tex

pandoc [A-Z][A-Z]*.mkd -o tmp.app.tex
sed < tmp.app.tex 's/section{/chapter{/' > tmp.appendix.tex

sed < tmp.tex '/includegraphics/s/jpg/eps/' | sed 's"includegraphics{../photos"includegraphics[height=3.0in]{../photos"' > tmp.sed
diff tmp.sed tmp.tex
python texpatch.py < tmp.sed > tmp.patch

mv tmp.patch tmp.tex
latex tmp
makeindex tmp
latex tmp
dvipdf tmp.dvi x.pdf
if [[ "$OSTYPE" == "darwin"* ]]; then
  open x.pdf
elif [[ "$OSTYPE" == "linux-gnu" && -n "$DISPLAY" ]]; then
  xdg-open x.pdf
else
  echo "Output on x.pdf"
fi

rm tmp.*
