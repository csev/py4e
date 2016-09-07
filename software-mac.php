<?php include("top.php"); ?>
<?php include("nav.php"); ?>
<div class="hide-for-large" id="mobile-support"></div>
<div id="first-row" class="row">
<div class="small-12 columns">
<h3>
Setting up the PythonLearn Environment on a Macintosh
</h3>
<p>Python is already installed on Macintosh OS/X operating system so all you need to add
is a programmer text editor.
</p>
<h3>Pre-Requisite: TextWrangler</h3>
<p>Please download and install TextWrangler from this site.  
</p>
<p><a href="http://www.barebones.com/products/TextWrangler/download.html" target="_new">http://www.barebones.com/products/TextWrangler/download.html</a>

<p>
<b>Important:</b> Before you create your first program, you need to make one small change in the 
Preferences for TextWrangler.  This will save you lots of "Python indent errors" anguish later.
Under <b> TextWrangler -> Preferences -> Editor Defaults</b> tick the check box
for "Expand Tabs" and close the dialog box 
(<a href="textwrangler_tabs_prefs.png" target="_new">Screenshot</a>).

<h3>Editing With TextWrangler</h3>
<p>
<b>Note:</b> We have a screen cast for the use of TextWrangler.  You can either view this on
<!-- Note to self - Vimeo cannot handle these files - so YouTube is what we get -->
<a href="http://www.youtube.com/watch?v=et2vjUAz9-k" target="_new">YouTube</a> or you can 
download the high-quality 
<a href="http://www-personal.umich.edu/~csev/courses/shared/podcasts/mac-python-textwrangler.mov"
target="_new">QuickTime version</a> of the screen cast.  
You will need Apple QuickTime installed to view this video.
</p>
<p>
Go into the upper-right of your screen and click on the Spotlight search button and type <b>textwrangler</b>. 

<p>
Then create your first Python program.
<pre>
    print "Hello World"
</pre>
<p>Save your program as firstprog.py onto your Desktop.
You will notice that after you save the file, TextWrangler will color your code based on the Python syntax rules.
Syntax coloring is a very helpful feature as it gives you visual feedback about your program and can help you track down syntax errors more easily.  TextWrangler only knows that your file is a Python file after you save it with a ".py" suffix.  
</p>

<h3>Running Python Using the Built-In TextWrangler Shortcut</h3>
<p>
TextWrangler has a built-in way to run a Python program directly from 
the TextWrangler user interface.  In TextWrangler go to the menu item <b>#! -> Run in Terminal </b>
<p>
TextWrangler will bring up a terminal window and automatically execute Python on your program.
You will have to look closely to pick out the output from your program amongst the rest of the output in the terminal window.
<p>
In general, you can use the TextWrangler shortcut for very simple programs but once you start 
reading and writing files in your Python programs you should open and use the terminal program 
so you know what directory your program is running in - so you can open and read files.

<h3>Starting Terminal on Macintosh OS/X</h3>
<p>
The Terminal program on Macintosh is kind of buried under <b>Macintosh HD -> Applications -> Utilities -> Terminal</b>
<p>
There are several shortcuts that you might find helpful.   You can go into the upper-right of 
your screen and click on the Spotlight search button and type 
<b>terminal</b> and you can execute Terminal from the pop-up 
list of items.
<p>
You can get Terminal to stay in your dock once terminal is launched by clicking and 
holding on the Terminal icon in the dock and then selecting Keep in Dock.  
Then you can quickly launch Terminal by clicking on the icon in the dock.

<h3>Where Are You?</h3>
<p>
When the command line starts up, you are in your "home" directory.   
In each of these examples, your logged in account should be used instead of csev.
<pre>
    Macintosh Home Directory: 		/Users/csev
</pre>
The command line prompt usually includes some clue as to where you are at 
in the folder structure on your hard drive.  If you want to really figure out 
where you are, on Macintosh use the <b>pwd</b> command.
<pre>
    udhcp-macvpn-624:~ csev$ pwd
    /Users/csev
    udhcp-macvpn-624:~ csev$ 
</pre>

<h3>Where can you go?</h3>
<p>
Generally the first thing you want to do when you open a command line 
interface is to navigate to the right folder.  Say you wanted to run a file from your desktop.   The command is 
<b>cd Desktop </b>
<pre>
    udhcp-macvpn-624:~ csev$ pwd
    /Users/csev
    udhcp-macvpn-624:~ csev$ cd Desktop
    udhcp-macvpn-624:Desktop csev$ pwd
    /Users/csev/Desktop
    udhcp-macvpn-624:Desktop csev$
</pre>
Nifty Trick:  On the cd command, you can partially type a folder name like Desktop 
and then press the TAB key and the system will auto-complete the folder name 
if you have typed enough that the system can accurately guess what you mean to type.
<p>
Going Backwards (or Upwards)
<p>
You can change directory to the parent folder (the folder "above" the folder you 
are in using the <b>cd ..</b> command.   It just says "go up one".
<pre>
    udhcp-macvpn-624:Desktop csev$ pwd
    /Users/csev/Desktop
    udhcp-macvpn-624:Desktop csev$ cd ..
    udhcp-macvpn-624:~ csev$ pwd
    /Users/csev
    udhcp-macvpn-624:~ csev$ 
</pre>
If you get Lost...
<p>
If you can't figure out what folder you are in and/or cannot figure 
out how to get to the folder you want to get to "home" simply close and 
re-open the Command Line / Terminal window.  
<p>
What Files/Folders are Here?
<p>
You can list the contents of the current directory using the <b>ls -l</b>  command.
<pre>
    udhcp-macvpn-624:Desktop csev$ pwd
    /Users/csev/Desktop
    udhcp-macvpn-624:Desktop csev$ ls -l 
    total 8
    -rw-r--r--  1 csev  staff   15 Sep 16 15:17 firstprog.py
    udhcp-macvpn-624:Desktop csev$ 
</pre>
Running Your Python Program in the Terminal
<p>
Start the Terminal program, navigate to the proper directory and type the following command:
<pre>
    python firstprog.py
</pre>
This loads the Python interpreter and runs <b>firstprog.py</b>, showing the program output and/or errors 
in the Terminal window.
<p>
Some Cool Hints on The Macintosh Terminal Program
<p>
You can scroll back through previous commands by pressing the up and down arrows and re-execute 
commands using the enter key.  This can save a lot of typing.
If you like keeping your screen uncluttered, you can clear the scroll 
back buffer by pressing the Command key and the K key at the same time.
</div>
</div>
<?php include('footer.php');?>
