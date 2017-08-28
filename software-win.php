<?php include("top.php"); ?>
<?php include("nav.php"); ?>
<h1>Installing Python 3 On Windows 10</h1>
<p><b>Note:</b> Any reasonably recent version of Python is acceptible for this course.
If you have a verison of Python 3.x on your computer already you should be able to use it for this class.
</p>
<p>Please download and install Python 3.x from:</p>
<p><a href="http://www.python.org/download/" target="_blank">http://www.python.org/download/</a></p>
<b>Installing the Atom Text Editor</b>
<p>Please download and install Atom from this site:
</p>
<p><a href="http://atom.io" target="_blank">http://atom.io</a>

<h1>Writing a Python 3 program with Atom on Windows-10</h1>
<p>
We have a short 
<a href="https://www.youtube.com/watch?v=uZbaYeYGYRQ&index=1&list=PLlRFEj9H3Oj7Bp8-DfGpfAfDBiblRfl5p" target="_blank">
step-by-step video</a> showing how to install Python 3 and Atom and write your first program.
<p>
<h1>Windows Command Line Notes</h1>
<p>
When the command line starts <b style="color:black;background-color:#a0ffff">up</b>, you are in your "home" directory.  Your home directory 
is different for each of the operating systems.  
In each of these examples, your logged in account should be used instead of csev.
<pre>
    Windows XP:             C:\Documents and Settings\csev
    Windows Vista:          C:\Users\csev
    Windows 7:              C:\Users\csev
    Windows 10:             C:\Users\csev
</pre>
The command line prompt usually includes some clue as to 
where you are in the folder structure on your hard drive.
<p>
If you want to really figure out where you are, use the cd command with no parameters
<pre>
    C:\Users\csev> cd
    C:\Users\csev
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
<h1>Running Your Python Program in the Command Line</h1>
<p>
To run your program in the command line you type at the command line prompt.
Windows knows that files wthat end with a ".py" suffix are Python programs.
<pre>
    python firstprog.py
</pre>
or
<pre>
    firstprog.py
</pre>
Where firstprog.py is the name of the file containing your Python program.  
Make sure to use the cd command to be in the correct directory that contains your program file(s).
</p>
<p> 
You can run your program over and over again in the command window.  
Hint:  You can use the <b style="color:black;background-color:#a0ffff">up</b>-arrow key to scroll back through previous 
commands and re-execute them by pressing enter.  This allows you to quickly 
edit and rerun your program to make and test changes.
</p>
<?php include('footer.php');?>
