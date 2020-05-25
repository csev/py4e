Translating Python for Everybody
================================

These course materials are Creative Commons Attribution and so they can be used
as long as they are attibuted properly.  I am happy to help those
adopting/adapting these materials make sure their acknowledgement is
sufficient.  I am always excited to learn of new translations and promote them
to my students.

All the material for this course (web site, autograders, PowerPoint, textbook,
figures for the textbook, assignments, etc) is in this GitHub repository.  The
only material that is not in github are the videos and I can provide those as
well if they need to be hosted behind a firewall or in a country that has banned
YouTube.

You could also provide translations on the YouTube channel
https://www.youtube.com/playlist?list=PLlRFEj9H3Oj7Bp8-DfGpfAfDBiblRfl5p

My ultimate goal would a series of complete web sites at urls like es.py4e.com,
cn.py4e.com, it.py4e.com with completely translated user experiences that also function
as OER repositories for Python materials in those languages.  Of course you do not
need to use my urls, but I do want to promote the translations of this material
and am happy to point my subdomains at your servers or forward requests at those
subdomains to your servers.

I have set this up so you can fork my github repository and begin the translation
work. I will be happy to help you get your translated work up and available.
Do not feel the need to translate everything in the web site.  Many translations
simply translate the book.  Everything is helpful.

If you are translating the book or web site please let me know so I
can coordinate efforts and/or promote your work.

Thanks in advance

Translating the Book
--------------------

The source code for the book is in the *book3* folder.  There is a `README.md`
file in that folder that describes how to set up LaTeX and Pandoc so you can
run the build scripts to produce the PDF and HTML versions of the book.

I have an automatic build server for the text book that takes your
latest book in github and produces the PDF and EPUB and hosts it online at
http://do1.dr-chuck.com/pythonlearn/.

In terms of licensing, since the book is CC-NC-SA, you do not need
my permission to translate, produce, and distributed electronic copies
of the book.  You do need permission to sell printed copies of the
translated book - which I am happy to give as long as the translation
is complete and of high quality.

I have detailed instructions as to the copyright of the book at:

https://github.com/csev/py4e/blob/master/book3/AB-copyright.mkd

So far (and this is not required) those who have translated my book have given
me permission to publish their work on Amazon and give the profits to charity.
This works well because it makes these translations widely available.  Sometimes
it is important to separately publish the printed book in a country that is not
well served by Amazon - and I very much encourage this - you need my permission
and I do not ask for any fee as long as the pricing is reasonable.

Translating the Figures
-----------------------

The figures are in `OmniGraffle` format in the *figures* folder.   Yes OmniGraffle
if not free - but I don't have the talent to build figures in InkScape - believe
me - I tried.  You edit the figures in *figures* and then export both an SVG and
EPS version into the *images* folder.   The book publishing process reads from
the *images* folder.  The EPS versions drive the PDF version and the SVGs are
used for both the HTML and EPUB versions.

Translating the Sample Code
---------------------------

The book includes code snippets from the *code3* folder.   You can leave the
code snippets untranslated, translate the comments or translate variables and
prompts.   These files are included everytime you build the book (PDF, ePUB, or
HTML).

There are simple code unit tests that you can run and run via travis at every
check in.   There is a `unit.sh` script that you can run in the top level folder:

    bash unit.sh
    /Applications/MAMP/htdocs/py4e
    ======== Starting Python 3 Tests ==============
    Tests 3 passed: 84
    Tests 3 failed: 0
    Unit Test TODO: ['count1.py', 'count2.py', 'geojson.py',
    'mailcount.py', 'party3.py', 'party6.py', 'urlwords.py']
    Comparing outputs...

The expected outputs are in a folder `unit3/testout`  as you translate the code
unit tests will fail - you can fix them by simply copying the new output to the
expected oitput - assuming you did not actually introduce a bug:

    cp unit3/testtmp/re15.txt unit3/testout/re15.txt

Make sure to check it all back into github.

Translating / Cleaning up YouTube Captions
------------------------------------------

Generally all of the YouTube videos for the course have the "Allow Community
Translations" turned on so you shuol djust be able to go in and clean up the
captions for your language on YouTube - let me know if this does not work.


Translating the Web Site
------------------------

If you want to translate the web site, the first place to start is the lecture
slides in the *lectures3* folder.   Don't worry about keeping the English versions
of the files - just translate the PPTs in place.  If you want to change the names
of the files once they are translated, make sure to update the file names 
in the file `lessons.json` in the top-level folder to point to your new files.

The next thing to be translated are all the PHP files in the top level folder
as well as the text in `lessons.json` - this file drives what users see when they
go the the `/lessons` url.

The next place that needs translation is the autograder.  This code is in the folder
`tools\pythonauto` - go through all the PHP files.  Pay particular attention to
the `exercises3.php` file - it drives all the exercises.  You can ignore `exercises.php`
as it is just a holover from the Python2 version of the course that I will 
likely cleanup and remove January 1, 2001.

Hosting and Production
----------------------

If you want, you can host this on a PHP/MySQL hosting environment - but it is a little tricky
to get configured. Most folks look at how difficult it is to host and let Dr. Chuck host,
pay for, and support the site.

I am happy to build the site and set it up while you are translating so you can see it in action
and test it live.

There are one of two ways to do it in terms of github.   

* I can set a new organization that holds the translation and make you a co-admin and
then have the site pull from that repo.  Just because it is my site does not mean that
I have to approve every PR.  You can ask for my review or just approve your own PRs - it
is up to you.  The Spanish translation is set up this way:

        https://github.com/csev/py4e/      (Original English)
        https://github.com/csev-es/py4e/   (Chuck's Spanish Translation)
        https:/es.py4e.com                 (Spanish site)

* We can set the site to pull from your forked repo - and then everything you push to master 
just goes into production.  I will make a fork that I will use to follow your work and keep a
shadow copy updated.  The Italian translation is set up that way:

        https://github.com/csev/py4e/      (Original English)
        https://github.com/vittore/py4e/   (Italian translation)
        https://it.py4e.com                (Italian site)

In both cases the "forked" relationship between the original English and the translation
is in effect severed.  It is highly doubtful that there will be any pull requests from
`csev/py4e` to `csev-es/py4e`.  If there is a needed change it is easier to just re-apply it 
in the translated repo rather than sort it out from all the commits to the English repo.

No matter how you want to set it up, I stand ready to help and provide support.
