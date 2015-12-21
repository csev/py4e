Python for Everybody
--------------------

Welcome to the under-construction book "Python for Everybody".

While this book is under construction, it is copyright, all rights reserved
Charles R. Severance.  Once the book is in better shape I will move it back
to Creative Commons.

These \*.mkd files are now the master files for the book (i.e. 
I will not run the conversion any more).

To produce the book run

    bash book.sh

The output `bash book.sh` is in the file `x.pdf` and `x.epub`.

If you want to contribute, feel free to fork the pythonlearn
repository and send me pull requests.   

https://github.com/csev/pythonlearn

We can also use the issue tracker to coordinate if that helps.

This is a very rough conversion.  I wrote several Python programs
(see the convert folder) to go through the LaTeX, hack it, extract 
anything that looked like code, run it through 2to3 and put in the 
converted book.  So some of the code is converted perfectly but 
other bits are still broken or Python 2.0 because my auto-process
missed something.   We will fix those by hand.

Tasks to do:

* Go through and fix all the code sequences - fix any Python 2.0 and then 
run the code to verify the output

* Find, fix and remove all the Python 3.0 does this differend footnotes

* Make a new cover

* Redraw all figures in OmniGraffle

* also fix all the sample code in the code3 folder.

* Fix spacing on all the glossary entries

And many other things...

/Chuck

