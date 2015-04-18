Python for Informatics: Exploring Information
=============================================

This is the source code for "Python for Informatics: Exploring Information"
the web site for this book is http://www.pythonlearn.com/

LaTeX Files
-----------

The source file for the book is *book.tex* - this file includes the 
per-chapter files *00-cover.tex* through *AD-copyright.tex*

Workflow
--------

Once you have LaTeX and HeVeA installed properly the workflow is simple. 
To produce the PDF version of the book you type:

    bash book.sh

This leaves the output on *book.pdf* and if you are on a Mac or Linux, it
even attempts to open the PDF viewer for your system.

To produce the HTML version of the book you type:

    bash html.sh

This produces files in the *html* folder.  This folder contains the book, chapters in
HTML and the images for the book.  

To make EPUB or MOBI files I use the Calibre software.  The steps that I take in Caliper
are here:

* [Importing HTML into Calibre](CALIBRE.md)

I also have a server that builds the latest version from this repository at this URL:

* http://do1.dr-chuck.com/py4inf/EN-us/

I don't yet have the files that make up the build server checked in because it is 
still a bit of a hack.  If you want to set up your own build server - I will check
the files in.

Software Installation - Macintosh
---------------------------------

Running the script to produce the PDF is really easy and convenent on the Mac.  Simply
install this software:

* https://tug.org/mactex/

Make sure to install the extras as well.   If you have a recent Mac you **cannot** make
the binary download of *hevea* work as it is a PowerPC binary.  If you want to do the HTML
generation, you need a variant of Linux.

Software Installation - Ubuntu
------------------------------

This is the rough set of steps I use on Ubuntu:

    sudo apt-get install texlive-latex-base
    sudo apt-get install texlive-latex-recommended
    sudo apt-get install texlive-fonts-recommended 
    sudo apt-get install texlive-latex-extra
    sudo apt-get install hevea
    sudo apt-get install imagemagick

You could put them all on one long apt-get, but I like to see if they work :)

Once this is done, the *book.sh* and *html.sh* should both work just fine.  For
my own sanity, I have Parallels with an Ubuntu image that I can use to generate
HTML.  It was easier than keeping a four-year-old MacBook running with Rosetta
support.

Translating This Book
---------------------

This book is available with a 
Creative Commons
Attribution-NonCommercial-ShareAlike 3.0 Unported License.  So as long as you
are not intending to profit from the translation, no permission to translate
and publish is needed.  If you want to sell the resulting translated book 
commercially, please see the Appendix on Copyright and contact me.

Here are some of the translations in-progress:

* Korean - [Formatted Book](http://do1.dr-chuck.com/py4inf/KO-ko/book.pdf) | [Book Source](https://github.com/statkclee/py4inf-kor) (Lead: Victor KC Lee)
* Italian - [Google Doc](https://docs.google.com/document/d/1ZyxzXGe2qGgsc-Dbqs-pXvQFPKbpJfLs1cq2gUFkxqw/edit?usp=sharing) (Lead: Mauro Toselli)
* Spanish - [Formatted Book](http://do1.dr-chuck.com/py4inf/ES-es/) | [Book Source](https://github.com/hedemarrie/py4inf-esp) (Lead: Hedemarrie Dussan)

Feel free to send me a link (or just edit this page and send me a Pull Request).

You can use any technology you like LaTeX, Google Docs, WikiBook or whatever you choose.

If you can figure out LaTeX, the easiest way to translate the book is to fork
my repo on GitHub and start translating in your own repo.  That way it will be easier
to catch up with changes I make to the English version of the book.  

If you start a translation in github, please contact me so I can add it to my automatic 
build process:

* http://do1.dr-chuck.com/py4inf/

This way your latest work will be easily found by students and linked from my web site
once the translation is under way.

TO DO
-----

I need to document and check in the code to run a build server.  The build server
is another way for a MacBook user without HeVeA to develop.  Edit locally, check 
the PDF and then check in the changes wait a tick and then the HTML is made in 
the build server.

I have no idea how LaTeX works on Windows.  I would be happy to get a PR
with some documentation.

Chuck Severance - 
Mon Aug 18 22:20:12 EDT 2014




