<?php include("top.php"); ?>
<?php include("nav.php"); ?>
<h1>
Using Python on PythonAnywhere
</h1>
<p>
PythonAnywhere</a>
(<a href="https://www.pythonanywhere.com" target="_blank">www.pythonanywhere.com</a>)
is a free online service that gives you a way to develop and run Python programs
inside a browser.   This is a full-featured Linux environment with a browser-based text
editor with syntax highlighting.  To use Pythonanywhere for this class - all you need
to write and run Python code is a web browser. There is nothing to install at all.
</p>
<p>
This means that you can do this course on a "locked-down" environment on systems
like Apple's iPad, iPhone, Android, ChromeBooks, or Windows 10 Home S.  You can
also use PythonAnywhere if you are using a work or school computer that does not
allow any software into be installed.
</p>
<h2>Sign up for an account</h2>
<p>
You will need to sign up for an account to use PythonAnywhere.   They have a free
level that will cover all of your needs for this course through Chapter 15.
</p>
<p>
PythonAnywhere is committed to letting you have a free account forever as long as you
keep logging in and extending it.  They have low cost paid plans if you want more disk
space or compute power for your own projects or more flexibility or features.  But
rest assured that their free plan is sufficient for this course.
</p>
<h2>Writing Your First Program on PythonAnywhere</h2>
<p>
Once you can log in to PythonAnywhere, go into the files tab and create a new file called <b>hello.py</b>
in your home folder (should be something like <b>/home/drchuck</b>.  Put the following line in the file:
<pre>
print('Hello world')
</pre>
Save the file and press <b>Run</b> and you should see:
<pre>
Hello world
&gt;&gt;&gt;
</pre>
Then change the text to 'Hello PY4E world', press <b>Save</b> and press <b>Run</b> and it should run your modified
program.
</pre>
</p>
<p>
While the <b>Run</b> button works for programs that are a few lines, once you start working on more complex
programs you will need to use a Linux shell (command line).  It might feel a little strange at the beginning
but learning a little bit of Linux is a great idea as it is the dominant system that is used for servers.
</p>
<h2>Using the Linux Shell on PythonAnywhere</h2>
<p>
This works best if you can have two tabs open at the same time in the browser.  One tab should be navigated to
the <b>Files</b> screen and another should be nagivated to the <b>Consoles</b> screen.  If you already have a 
bash console running you can go back to it - otherwise start a new <b>Bash</b> console.  After it starts up, 
you should see something like:
<pre>
14:12 ~ $
</pre>
This is the Linux command prompt.  Lets run your 'hello.py' program from the command line:
<pre>
14:12 ~ $ cd
14:14 ~ $ pwd
/home/drchuck
14:15 ~ $ ls -l
-rw-rw-r--  1 drchuck registered_users   27 Mar 29 14:15 hello.py
14:16 ~ $ python3 hello.py
Hello PY4E world
14:16 ~ $
</pre>
Here is what the commands are doing:
<ul>
<li><b>cd</b> - Change directory into my home folder - we do this just to make sure we are starting in the 
right place in the folder hierarchy.</li>
<li><b>pwd</b> - Print Working Directory - this command tells you where you are at in the folder
hierarchy.  We are in our home folder.  Linux is a multi-user system and each user has their own 'home'
directory.  You can build a folder hirearchy from your home folder on down.</li>
<li><b>ls -l</b> list the files and subfolders in the current folder.  The <b>-l</b> option
shows details like permissions, modification date and file size.</li>
<li><b>python3 hello.py</b> runs Python on your file</li>
</ul>
We recommend that you start using the Linux bash shell to run your code from the very beginning
because eventually you will need to use bash to run more complex programs.
</p>
<p>
<h2>Some Cool Hints on the bash console</h2>
<p>
You can scroll back through previous commands by pressing the up and down arrows and re-execute 
commands using the enter key.  This can save a lot of typing.
If you like keeping your screen uncluttered, you can clear the scroll 
back buffer by pressing the <b>Command key</b> and the <b>K</b> key at the same time.

<h2>Editing Files on PythonAnywhere</h2>
<p>
There are three ways to edit files in your PythonAnywhere environment, ranging from the easiest
to the coolest.  You only have to edit the file one of these ways.
<ol>
<li>
Go to the main PythonAnywhere dashboard, browse files, navigate to the correct folder and edit the file.
</li><li>
Or in the command line:
<pre>
cd ~
nano hello.py
</pre>
Save the File by pressing <b>CTRL-X</b>, <b>Y</b>, and Enter.
</li><li>
Don't try this most difficult and most cool way to edit files on Linux without a helper
if it is your first time with the <b>vi</b> text editor.
<pre>
cd ~
vi hello.py
</pre>
Once you have opened <b>vi</b>, cursor down where you want to make a change, and press the
<b>i</b> key to go into 'INSERT' mode, then type your new text and press
the <b>esc</b> key when you are done.  To save the file, you type <b>:wq</b>
followed by <b>enter</b>.  If you get lost press <b>esc</b> <b>:q!</b>
<b>enter</b> to get out of the file without saving.
</li>
</ol>
If you aleady know some _other_ command line text editor in Linux, you can use it to edit files.  In general,
you will find that it often quicker and easier to make small edits to files in the command line
rather than a full screen UI.  And once you start deploying real applications in production
environments like Google, Amazon, Microsoft, etc.. all you will have is command line.

<?php include('footer.php');?>
