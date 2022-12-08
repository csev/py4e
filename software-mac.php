<?php include("top.php"); ?>
<?php include("nav.php"); ?>
<h1>
Getting started with Python on a Macintosh
</h1>
<p>Python 2 and Python 3 are already installed on Macintosh OS/X operating system so all you need to add
is a programmer text editor.
</p>
<b>Installing A Programmer Text Editor</b>
<p>If you already have a programmer text editor like
<a href="https://code.visualstudio.com/" target="_blank">VS-Code</a> installed you can use it in the class
or you can install it on your system.
</p>
<p>
If the installation for VSCode looks a little too complex, we recommend the free and open source
<a href="https://brackets.io/" target="_blank">Brackets</a> text editor.  It is easy
to install and is very capable for your needs in the course.
</p>

<h1>Writing a Python 3 program on Macintosh</h1>
<p>
We have a short
<a href="https://www.youtube.com/watch?v=9lOdVSNUKfY" target="_blank">
step-by-step video</a> showing how to use a programmer editor and write your first Python 3 program.
This video uses the Bracket editor - which we suggest you to install and use, or the VS-Code, if you don't already have
a programming text editor.
</p>
<p>
<h1>Starting Terminal on Macintosh OS/X</h1>
<p>
The Terminal program on Macintosh is kind of buried under <b>Macintosh HD -> Applications -> Utilities -> Terminal</b>
</p>
<p>
There are several shortcuts that you might find helpful. You can go into the upper-right of 
your screen and click on the Spotlight search button and type 
<b>terminal</b> and you can execute Terminal from the pop-up 
list of items.
</p>
<p>
You can get Terminal to stay in your dock once terminal is launched by clicking and 
holding on the Terminal icon in the dock and then selecting "Keep in Dock".  
Then you can quickly launch Terminal by clicking on the icon in the dock.
</p>
<h1>Where Are You?</h1>
<p>
When the command line starts up, you are in your "home" directory.   
In each of these examples, your logged in account should be used instead of csev.
</p>
<pre>
    Macintosh Home Directory: 		/Users/csev
</pre>
<p>
    The command line prompt usually includes some clue as to where you are at 
    in the folder structure on your hard drive.  If you want to really figure out 
    where you are, on Macintosh use the <b>pwd</b> command.
</p>    
<pre>
    udhcp-macvpn-624:~ csev$ pwd
    /Users/csev
    udhcp-macvpn-624:~ csev$ 
</pre>

<h1>Where can you go?</h1>
<p>
Generally the first thing you want to do when you open a command line 
interface is to navigate to the right folder. Say you wanted to run a file from your desktop. The command is 
<b>cd Desktop</b></p>
<pre>
    udhcp-macvpn-624:~ csev$ pwd
    /Users/csev
    udhcp-macvpn-624:~ csev$ cd Desktop
    udhcp-macvpn-624:Desktop csev$ pwd
    /Users/csev/Desktop
    udhcp-macvpn-624:Desktop csev$
</pre>
<p>
    <b>Nifty Trick:</b>  On the cd command, you can partially type a folder name like Desktop 
    and then press the TAB key and the system will auto-complete the folder name 
    if you have typed enough that the system can accurately guess what you mean to type.
</p>
<p>Going Backwards (or Upwards)</p>
<p>
You can change directory to the parent folder (the folder "above" the folder you 
are in using the <b>cd ..</b> command.   It just says "go up one".
</p>    
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
</p>
<p>
What Files/Folders are Here?
<p>
You can list the contents of the current directory using the <b>ls -l</b>  command.</p>
<pre>
    udhcp-macvpn-624:Desktop csev$ pwd
    /Users/csev/Desktop
    udhcp-macvpn-624:Desktop csev$ ls -l 
    total 8
    -rw-r--r--  1 csev  staff   15 Sep 16 15:17 hello.py
    udhcp-macvpn-624:Desktop csev$ 
</pre>
<h1>Running Your Python Program in the Terminal</h1>
<p>
Start the Terminal program, navigate to the proper directory and type the following command:</p>
<pre>
    python3 hello.py
</pre>
<p>This loads the Python 3 interpreter and runs <b>firstprog.py</b>, showing the program output 
and/or errors in the Terminal window.</p>
<p>
<b>Some Cool Hints on The Macintosh Terminal Program</b></p>
<p>
You can scroll back through previous commands by pressing the up and down arrows and re-execute 
commands using the enter key.  This can save a lot of typing.
If you like keeping your screen uncluttered, you can clear the scroll 
back buffer by pressing the Command key and the K key at the same time.</p>
<?php include('footer.php');?>
