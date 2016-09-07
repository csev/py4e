<?php include("top.php"); ?>
<?php include("nav.php"); ?>
<div class="hide-for-large" id="mobile-support"></div>
<div id="first-row" class="row">
<div class="small-12 columns">
<h3>Pre-Requisite: Python</h3>
<p><b>Note:</b> If you have a Python 2.x that is 2.6 or later - you can use 
the Python you already have on your system.</p>
<p>Please download and install Python 2.7.5 from:</p>
<p><a href="http://www.python.org/download/releases/2.7.5/" target="_new">http://www.python.org/download/releases/2.7.5/</a></p>
<p>Download and install the file <b>python-2.7.5.msi</b> - when the install process
asks you which directory to use - make sure to keep the
default directory of C:\Python27\ (or C:\Python26\). 
If you are not sure if your Windows is 64-bit - install the 32-bit 
version of Python.</p>
<p>
<b>Note:</b> Make sure that you install the latest version of Python 2.x - do not install
Python 3.x.  There are signficant differences between Python 2 and Python 3 and this book/site
is still Python 2.
</p>
<b>Pre-Requisite: NotePad++</b>
<p>Please download and install NotePad++ from this site.  Look for the ".exe" 
installer file to download and then run to install NotePad++.
</p>
<p><a href="http://notepad-plus-plus.org/download/v6.7.3.html" target="_new">http://notepad-plus-plus.org/download/v6.7.3.html</a>

<p>
<b>Important:</b> Before you create your first program, you need to make one small change in the
Preferences for NotePad++.  This will save you lots of "Python indent errors" anguish later.
Under 
<b> Settings -> Preferences -> Language Menu/Tab Settings</b> or
<b> Settings -> Preferences -> Edit Components </b> tick the check box
for "Replace by space" leaving the value at "4" and press the "Close" button
(<a href="notepad-plus-expand-tabs.png" target="_new">Screenshot</a>).

<h3>Editing With NotePad++</h3>
<p>
<b>Note:</b> We have a screen cast for the use of NotePad++.  You can either view this on
<!-- Note to self - Vimeo cannot handle these files - so YouTube is what we get -->
<a href="http://www.youtube.com/watch?v=o0X-VHX6ls0" target="_new">YouTube</a> or you can 
download the high-quality
<a href="http://www-personal.umich.edu/~csev/courses/shared/podcasts/windows-python-notepad-plus.mov"
target="_new">QuickTime version</a> of the screen cast.  
You will need Apple QuickTime installed to view this video.
</p>

<p>Start NotePad++ from either a Desktop icon or from the Start Programs menu and enter your first Python program into NotePad++:
<pre>
    print "Hello World"
</pre>
<p>Save your program as firstprog.py onto your Desktop.
You will notice that after you save the file, NotePad++ will color your code based on the Python syntax rules.
Syntax coloring is a very helpful feature as it gives you visual feedback about your program and can help you track down syntax errors more easily.  NotePad++ only knows that your file is a Python file after you save it with a ".py" suffix.  
</p>

<h3>Starting Command Line on Windows Vista and Windows 7</h3>
<p>
Press Start (the round Window icon in the lower right) and in the space 
called Start Search type in the word <b>command</b> - Windows will 
find the "Command Prompt" - select and launch the Command Prompt.

<h3>Starting Command Line on Windows XP</h3>
<p>
To start the command line interface to Windows XP,  do Start -> Run -> <b>cmd</b> -> OK 

<h3>Command Line</h3>
<p>
When the command line starts <b style="color:black;background-color:#a0ffff">up</b>, you are in your "home" directory.  Your home directory 
is different for each of the operating systems.  
In each of these examples, your logged in account should be used instead of csev.
<pre>
    Windows XP:             C:\Documents and Settings\csev
    Windows Vista:          C:\Users\csev
    Windows 7:              C:\Users\csev
</pre>
The command line prompt usually includes some clue as to 
where you are in the folder structure on your hard drive.
<p>
If you want to really figure out where you are, use the cd command with no parameters
<pre>
    C:\Documents and Settings\csev> cd
    C:\Documents and Settings\csev
</pre>
<p>
Where can you go?
</p>
<p>
Generally the first thing you want to do when you open a command line 
interface is to navigate to the right folder.  Say you wanted to run a 
file from your desktop.   The command is <b>cd Desktop</b> to get into the 
folder that is your Desktop.  You can use the <b>dir</b> command to see 
which files are in the current directory and the 
<b>cd ..</b> command to go "<b style="color:black;background-color:#a0ffff">up</b>" a directory
</p>
<p> 
<b>Nifty Trick:</b>  On the cd command, you can partially type a folder name like
Desktop and then press the TAB key and the system will auto-complete the folder name 
if you have typed enough that the system can accurately guess what you mean to type.
<p>
If you get Lost...
<p>
If you can't figure out what folder you are in and/or cannot figure out how 
to get to the folder you want to get to - simply close and re-open 
the Command Line / Terminal window.  You will be back to 
your "home" directory - so you can start from a known location.
<p>
Some Cool Hints on the Windows Command Line Interface
<p>
If you click on the little icon in the upper-left of the command prompt window 
and select Preferences - you can set many things about the command line - probably 
the most important is to set the Command History Buffer Size to be 999.
<p>
<h3>Running Your Python Program in the Command Line</h3>
<p>
To run your program in the command line you type at the command line prompt.
Windows knows that files wthat end with a ".py" suffix are Python programs.
<pre>
    firstprog.py
</pre>
Where firstprog.py is the name of the file containing your Python program.  
Make sure to use the cd command to be in the correct directory that contains your program file(s).
<p> 
You can run your program over and over again in the command window.  
Hint:  You can use the <b style="color:black;background-color:#a0ffff">up</b>-arrow key to scroll back through previous 
commands and re-execute them by pressing enter.  This allows you to quickly 
edit and rerun your program to make and test changes.
</p>
<p>
Also, if you know how to update the PATH information in your Control Panel, you can add the 
C:\Python27 folder to your path and then you should be able to start Python form the 
command line by by simply typing "python".   While setting the PATH information is not
hard, it is a little different on each version of the Windows operating systems.  You
might want to get someone to help you set your PATH information so you don't have to type
the full path each time you want to start Python.
</p>
</div>
</div>
<?php include('footer.php');?>
