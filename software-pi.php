<?php include("top.php"); ?>
<?php include("nav.php"); ?>
<div class="hide-for-large" id="mobile-support"></div>
<div id="first-row" class="row">
<div class="small-12 columns">
<h3>
Editing and Running Python Programs on the Rasberry Pi
</h3>
<p>
The <a href="http://www.raspberrypi.org" target="_new">Raspberry Pi</a> is a low-cost ($5 to $35US) complete Linux computer.  It is a great platform for writing
Python programs and learning about computers in general.
</p>
<p>
We won't cover getting a RasPi up and running here - but the nice thing is that
once it is up and running there is nothing else needed to develop the 
programs for this class.
</p>
<h3>Writing "Hello World" on the Raspberry Pi</h3>
<p>
You can either view screen cast for these instructions on
<a href="http://www.youtube.com/watch?v=wfX8NRCeX3A" target="_new">YouTube</a> or you can 
download the high-quality 
<a href="http://www-personal.umich.edu/~csev/courses/shared/podcasts/raspi-hello-world.mp4"
target="_new">MP4 version</a> of the screen cast.  
You will need Apple QuickTime or some other MP4 viewer 
installed to view this video.  The quality is much higher and the
details are easier to read on the MP4 version.
</p>
<p>
Go to the lower-right of your screen and click on the Start icon and then
go to <b> Accessories -> Leafpad</b>.  Leafpad is the text editor.
</p>
<p>
Then create your first Python program.
<pre>
    print "Hello World"
</pre>
<p>Save your program as firstprog.py onto your Desktop.

<h3>Starting Terminal </h3>
<p>
While there are many ways to run a Python program under Linux, we will prefer 
using the terminal program.
There are several terminal programs on the Raspian Linux - my favourite is at
</p>
<b>Start -> Accessories -> LXTerminal</b>
</p>
LXTerminal has a nice preferences feature to allow you to change the 
size and color of the text.
<h3>Where Are You?</h3>
<p>
When LXTerminal starts up, you are in your "home" directory.   
In each of these examples, your logged in account should be used 
instead of csev.
<pre>
    Home Directory: 		/home/csev
</pre>
The command line prompt usually includes some clue as to where you are at 
in the folder structure on your hard drive.  If you want to really figure out 
where you are, on Linux use the <b>pwd</b> command.
<pre>
    csev@rasberrypi:~$ pwd
    /home/csev
    csev@rasberrypi:~$ 
</pre>

<h3>Where can you go?</h3>
<p>
Generally the first thing you want to do when you open a terminal program
is to navigate to the correct folder.  
Say you wanted to run a file from your Desktop.   The command is 
<b>cd Desktop </b>
<pre>
    csev@rasberrypi:~$ pwd
    /home/csev
    csev@rasberrypi:~$ cd Desktop
    csev@rasberrypi:~$ pwd
    /home/csev/Desktop
    csev@rasberrypi:~$ 
</pre>
Nifty Trick:  On the cd command, you can partially type a folder 
name like Desktop 
and then press the TAB key and the system will auto-complete 
the folder name if you have typed enough that the system can 
accurately guess what you mean to type.
<p>
Going Backwards (or Upwards)
<p>
You can change directory to the parent folder 
(the folder "above" the folder you 
are in using the <b>cd ..</b> command.   It just says "go up one".
<pre>
    csev@rasberrypi:~$ pwd
    /home/csev/Desktop
    csev@rasberrypi:~$ cd ..
    csev@rasberrypi:~$ pwd
    /home/csev
    csev@rasberrypi:~$ 
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
    csev@rasberrypi:~$ pwd
    /home/csev/Desktop
    csev@rasberrypi:~$ ls -l
    total 4
    -rw-r--r--  1 csev  csev   15 Jan  9 15:17 firstprog.py
    csev@rasberrypi:~$ 
</pre>
<h3>Running Your Python Program in the Terminal</h3>
<p>
Start the Terminal program, navigate to the proper directory and 
type the following command:
<pre>
    csev@rasberrypi:~$ python firstprog.py
</pre>
This loads the Python interpreter and runs 
<b>firstprog.py</b>, showing the program output and/or errors 
in the Terminal window.
<p>
<h3>Some Cool Hints on The Terminal Program</h3>
<p>
You can scroll back through previous commands by pressing the 
up and down arrows and re-execute 
commands using the enter key.  This can save a lot of typing.
</div>
</div>
<?php include('footer.php');?>
