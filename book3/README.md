Python for Everybody
--------------------

These \*.mkd files are now the master files for the book (i.e. 
I will not run the conversion any more).

To produce the PDF of the book, you will need to install LaTeX on your 
system.  For Debian-derived (Ubuntu, Mint, etc.) Linux:

    sudo apt-get install texlive-full
    sudo apt-get install pandoc

For Macintosh,

    https://www.tug.org/mactex/
    https://www.tug.org/mactex/mactextras.html

To produce the book run

    bash book.sh

The output `bash book.sh` is in the file `x.pdf` and `x.epub`.

*Note that the build scripts require Python 2*

## Build Server

There is a continuous build server that I have on Digital Ocean that builds
the PDF and epub versions of the book every hour or so.

    http://do1.dr-chuck.com/pythonlearn/EN_us/pythonlearn.pdf
    http://do1.dr-chuck.com/pythonlearn/EN_us/pythonlearn.epub

Just check in changes and these files will update.

This server also rebuilds any translations every hour or so.

## Alternate Build Scripts

In addition to the official `book.sh1`, there are other build scripts that make
alternate versions of the book.   If you make changes to the content, you
should run all these scripts and check it all into github so it ends up online.

* `phpbook.sh` will make an html/php verion of the book that is an extension
of this site in `../html3` - this is then checked into github.

* `htmlbook.sh` will make an html verion of the book, with interactive examples
embedded in trinkets. These files are in `books/html` if you want to download
or view them.

* `zipbook.sh` will make two html versions of the book with Trinket branding,
one with interactive examples (that require an internet connection to work) and one with 
syntax highlighted code blocks for completely offline viewing.  A zip containing 
these is at `/book/zips/pfe.zip` if you'd just like to download it.

* `trinketbook.sh` will make the nunjucks template that we use to host the book
at [books.trinket.io](https://books.trinket.io).  This is likely not of use to you
unless you're looking for an example of how to get the book source into your own
templating language.  If you'd like to see the output of this script it's in
`books/trinket/pfe`.   Also updates `../trinket3`.

If you'd like to make your own build script, you can use these as examples. If
your build script might have use to others, consider contributing it in a pull request.
Note that each build script plays nicely with the others and the represent parallel
workflows.  Please don't alter any of the python scripts that are used by another
script if you intend on contributing a new script. 

## KindleGen

The `book.sh` script will generate the `x.mobi` file is KindleGen is in the path:

    https://www.amazon.com/gp/feature.html?docId=1000765211

For Linux:

    curl -O http://kindlegen.s3.amazonaws.com/kindlegen_linux_2.6_i386_v2_9.tar.gz
    tar xfv kindlegen_linux_2.6_i386_v2_9.tar.gz 
    cp kindlegen /usr/local/bin

## Createspace

Just take the `x.pdf` and `x.mobi` files and copy them into the `createspace`
folder, adding a date in the filename as version and then upload them to 
createspace ins kindle publishing.

Chinese Version
---------------

If you are building the file for Chinese, touch the file

    touch .chinese

So it runs LaTeX in a way to produce chinese documents.

Install the 'Noto Serif CJK SC' Font.  Download from here and unzip:

    https://noto-website.storage.googleapis.com/pkgs/NotoSerifCJK.ttc.zip

You should get a file like `NotoSerifCJK.ttc`.

On Mac copy the file to `~/Library/Fonts` and rebuild font cache:

    sudo atsutil databases -remove

On Linux put them in `/usr/share/fonts`:

    [ -d /usr/share/fonts/opentype ] || sudo mkdir /usr/share/fonts/opentype
    [ -d /usr/share/fonts/opentype/noto ] || sudo mkdir /usr/share/fonts/opentype/noto
    sudo mv NotoSerifCJK.ttc /usr/share/fonts/opentype/noto
    sudo fc-cache -f -v

Strange Note:  If you are running on a small memory linux system, you 
may encounter the error "I can't write on file `test.pdf'" - turns
out this is `xelatex` running out of RAM - this fixed it.

    dd if=/dev/zero of=/var/512mb.swap bs=1M count=512
    mkswap /var/512mb.swap
    swapon /var/512mb.swap

Ref: https://tex.stackexchange.com/questions/16801/xelatex-i-cant-write-on-file-test-pdf

## Contributing

If you want to contribute, feel free to fork the py4e
repository and send me pull requests.   

https://github.com/csev/py4e

We can also use the issue tracker to coordinate if that helps.

/Chuck

