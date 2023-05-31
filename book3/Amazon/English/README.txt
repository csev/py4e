
https://www.youtube.com/watch?v=agjGMNgdYR0

Step 1 - Adobe Creative Suite

Tools -> Flattener Preview - Flatten - Upload failed

Tools -> Save as PDF/A-2b - Upload failed

Tools -> Flatten -> Save as PDF/A-1a

Chat with KDP...


After the font setting is updated, re-upload following these steps:
1. Sign in: http://kdp.amazon.com
2. On your Bookshelf, next to the book you want to update, click the ellipsis ("…") under Paperback Actions
3. Select "Edit Paperback Content"
4. Scroll down to the "Manuscript" section
5. Click “Upload Paperback Manuscript”
6. Find and open the revised file
7. Once the content is uploaded, you'll see a "Manuscript uploaded successfully" message
8. Scroll down to the "Book Previewer" section and launch the previewer to approve the changes
9. Click "Save and Continue"
10. On the bottom of the Paperback Rights & Pricing page, click Publish

https://www.karlrupp.net/2016/01/embed-all-fonts-in-pdfs-latex-pdflatex/

latex my_file.tex
dvips my_file.dvi
ps2pdf -dPDFSETTINGS=/prepress -dEmbedAllFonts=true my_file.ps


https://community.adobe.com/t5/acrobat-discussions/discarding-cropped-areas-of-pages/td-p/4304473


-      ps2pdf12 will always produce PDF 1.2 output (Acrobat 3-and-later compatible).

       -      ps2pdf13 will always produce PDF 1.3 output (Acrobat 4-and-later compatible).

       -      ps2pdf14 will always produce PDF 1.4 output (Acrobat 5-and-later compatible).



exec "$ps2pdfwr" -dCompatibilityLevel=1.2 "$@"

ps2pdfwr -dCompatibilityLevel=1.x -dPDFSETTINGS=/prepress -dEmbedAllFonts=true tmp.ps tmp11.pdf
ps2pdf12 -dPDFSETTINGS=/prepress -dEmbedAllFonts=true tmp.ps tmp12.pdf
ps2pdf13 -dPDFSETTINGS=/prepress -dEmbedAllFonts=true tmp.ps tmp13.pdf
ps2pdf14 -dPDFSETTINGS=/prepress -dEmbedAllFonts=true tmp.ps tmp14.pdf

