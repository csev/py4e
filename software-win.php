<?php include("top.php"); ?>
<?php include("nav.php"); ?>
<h1>Installing Python on Windows 11</h1>
<p><b>Note:</b> Any reasonably recent version of Python is acceptable for this course.
If you already have Python 3.x on your computer, you can use it for this class.</p>
<p>If you don't have Python installed, download it from:</p>
<p><a href="https://www.python.org/download/" target="_blank" rel="noopener noreferrer">https://www.python.org/download/</a></p>

<h2>Installing a Programming Text Editor</h2>
<p>If you have a programmer editor you like, you can use it. If not, we recommend these
free text editors for software development:</p>
<ul>
<li><a href="https://thonny.org/" target="_blank" rel="noopener noreferrer">Thonny</a> – Free, open source, simple</li>
<li><a href="https://phcode.io/" target="_blank" rel="noopener noreferrer">Phoenix Code</a> – Free, open source, more advanced</li>
<li><a href="https://code.visualstudio.com/" target="_blank" rel="noopener noreferrer">VS Code</a> – Free, feature-rich, includes AI assistance</li>
</ul>

<h2>Writing a Python Program on Windows 11</h2>
<p>We have a short
<a href="https://www.youtube.com/watch?v=70ZxCfUjkuw&index=1&list=PLlRFEj9H3Oj7Bp8-DfGpfAfDBiblRfl5p" target="_blank" rel="noopener noreferrer">step-by-step video</a>
showing how to install Python and write your first program.</p>

<h2>Windows Command Line Notes</h2>
<p>When the command line starts <b>up</b>, you are in your "home" directory. The path to your home directory varies by Windows version. In the examples below, replace <b>csev</b> with your own username.</p>
<pre>
    Windows 10:             C:\Users\csev
    Windows 10 OneDrive:    C:\Users\csev\OneDrive
    Windows 11:             C:\Users\csev
    Windows 11 OneDrive:    C:\Users\csev\OneDrive
</pre>
<p>The command prompt usually shows your current location in the folder structure.</p>
<p>To see exactly where you are, run <b>cd</b> with no parameters:</p>
<pre>
    C:\Users\csev> cd
    C:\Users\csev
</pre>

<h3>Navigating Folders</h3>
<p>When you open a command line, the first step is usually to move to the right folder. For example, to run a file from your desktop, use <b>cd Desktop</b> (or <b>cd OneDrive\Desktop</b>). Use <b>dir</b> to list files in the current directory and <b>cd ..</b> to go <b>up</b> one directory.</p>
<p><b>Tip:</b> When typing a path, you can type part of a folder name (like Desktop) and press Tab to auto-complete it, as long as you've typed enough for the system to guess correctly.</p>

<h3>If You Get Lost</h3>
<p>If you lose track of your location or can't find the folder you need, close the Command Line or Terminal window and open a new one. You'll start back in your home directory.</p>

<h3>Command Line Settings</h3>
<p>Click the icon in the upper-left of the command prompt window and select Preferences. You can customize various settings; a particularly useful one is to set the Command History Buffer Size to 999, so you can scroll back through many previous commands.</p>

<h2>Running Your Python Program in the Command Line</h2>
<p>To run your program, type at the command prompt:</p>
<pre>
    py firstprog.py
</pre>
<p>Or simply:</p>
<pre>
    firstprog.py
</pre>
<p>Replace <b>firstprog.py</b> with the name of your Python file. Make sure you're in the correct directory using the <b>cd</b> command first.</p>
<p>You can run your program repeatedly in the same command window. Use the <b>up</b>-arrow key to recall previous commands and press Enter to run them again—handy when you're editing and testing changes.</p>
<?php include('footer.php');?>
