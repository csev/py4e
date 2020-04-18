<?php include("top.php"); ?>
<?php include("nav.php"); ?>
<h1>
Getting started with Python on a Macintosh
</h1>
<p>Python 2 and Python 3 are already installed on Macintosh OS/X operating system so all you need to add
is a programmer text editor.
</p>
<b>Installing the Atom Text Editor</b>
<p>Please download and install Atom from this site:
</p>
<p><a href="http://atom.io" target="_blank">http://atom.io</a>

<h1>Writing a Python 3 program with Atom on Macintosh</h1>
<p>
We have a short
<a href="https://www.youtube.com/watch?v=aIcLCww_kQM" target="_blank">
step-by-step video</a> showing how to use Atom and write your first Python 3 program.
<p>
<h1>Starting Terminal on Macintosh OS/X</h1>
<p>
The Terminal program on Macintosh is kind of buried under <b>Macintosh HD -> Applications -> Utilities -> Terminal</b>
<p>
There are several shortcuts that you might find helpful.   You can go into the upper-right of 
your screen and click on the Spotlight search button and type 
<b>terminal</b> and you can execute Terminal from the pop-up 
list of items.
<p>
You can get Terminal to stay in your dock once terminal is launched by clicking and 
holding on the Terminal icon in the dock and then selecting "Keep in Dock".  
Then you can quickly launch Terminal by clicking on the icon in the dock.

<h1>Where Are You?</h1>
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

<h1>Where can you go?</h1>
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
    -rw-r--r--  1 csev  staff   15 Sep 16 15:17 hello.py
    udhcp-macvpn-624:Desktop csev$ 
</pre>
Running Your Python Program in the Terminal
<p>
Start the Terminal program, navigate to the proper directory and type the following command:
<pre>
    python3 hello.py
</pre>
This loads the Python 3 interpreter and runs <b>firstprog.py</b>, showing the program output 
and/or errors in the Terminal window.
<p>
Some Cool Hints on The Macintosh Terminal Program
<p>
You can scroll back through previous commands by pressing the up and down arrows and re-execute 
commands using the enter key.  This can save a lot of typing.
If you like keeping your screen uncluttered, you can clear the scroll 
back buffer by pressing the Command key and the K key at the same time.
<?php include('footer.php');?>
