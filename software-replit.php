<?php include("top.php"); ?>
<?php include("nav.php"); ?>
<h1>
Using Python on Replit
</h1>
<p>
Replit</a>
(<a href="https://www.replit.com" target="_blank">www.replit.com</a>)
is a free online service that gives you a way to develop and run programs
inside a browser.   This is a full-featured environment with a browser-based text
editor with syntax highlighting.  To use Replit for this class - all you need
to write and run Python code is a web browser. There is nothing to install at all.
</p>
<p>
You save some time by using Dr. Chuck's PY4E Replit template by starting at:
<a href="https://replit.com/@ChuckSeverance/PY4E?v=1" target="_blank">
https://replit.com/@ChuckSeverance/PY4E?v=1
</a>.  This includes the files you will use for the course and sample code.
</p>
<p>
This means that you can do this course on a "locked-down" environment on systems
like Apple's iPad, iPhone, Android, ChromeBooks, or Windows 10 Home S.  You can
also use Replit if you are using a work or school computer that does not
allow any software into be installed.
</p>
<h2>Sign up for an account</h2>
<p>
You will need to sign up for an account to use Replit.   They have a free
level that will cover all of your needs for this course through Chapter 15.
</p>
<h2>Writing Your First Program on Replit</h2>
<p>
Once you can log in to Replit, go into the files tab and create a new file called <b>hello.py</b>
in your home folder (should be something like <b>/home/home/runner/PY4E</b>).  Put the following line in the file:
<pre>
print('Hello world')
</pre>
Save the file and press <b>Run</b> and you should see:
<pre>
Hello world
</pre>
Then change the text to 'Hello PY4E world', and press <b>Run</b> and it should run your modified
program.
</pre>
</p>
<p>
While the <b>Run</b> button works for programs that are a few lines, once you start working on more complex
programs you may need to use a Linux shell (command line).  It might feel a little strange at the beginning
but learning a little bit of Linux is a great idea as it is the dominant system that is used for servers.
</p>
<h2>Using the Shell on Replit</h2>
<p>
After you switch from the console to the shell in the right panel,
you should see something like:
<pre>
~/PY4E$
</pre>
This is the Linux command prompt.  Lets run your 'hello.py' program from the command line:
<pre>
~/PY4E$ cd
~/PY4E$ pwd
/home/runner/PY4E
~/PY4E$ ls -l
total 80
-rw-r--r-- 1 runner runner    21 Jul 25 18:16 hello.py
-rw-r--r-- 1 runner runner    20 Jul 25 16:12 main.py
-rw-r--r-- 1 runner runner 62849 Jun 19 04:40 poetry.lock
-rw-r--r-- 1 runner runner   327 Jun 19 04:39 pyproject.toml
-rw-r--r-- 1 runner runner   382 Jul  9 17:22 replit.nix
drwxr-xr-x 1 runner runner    56 Oct 26  2021 venv
~/PY4E$ python3 hello.py
Hello world
</pre>
Here is what the Linux Shell commands we are typing are doing:
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
We recommend that you get familiar with the Linux bash shell to run your code from the very beginning
because eventually you will need to the shell to run more complex programs.
</p>
<h2>Some Cool Hints on the bash console</h2>
<p>
You can scroll back through previous commands by pressing the up and down arrows and re-execute 
commands using the enter key.  This can save a lot of typing.
If you like keeping your screen uncluttered, you can clear the scroll 
back buffer by pressing the <b>Command key</b> and the <b>K</b> key at the same time.</p>

<h2>Editing Files on Replit</h2>
<p>
There are three ways to edit files in your Replit environment, ranging from the easiest
to the coolest.  You only have to edit the file one of these ways.</p>
<ol>
<li>
Go to the main Replit file panel, browse files, navigate to the correct folder and edit the file.
</li><li>
<p>Or in the command line:</p>
<pre>
cd ~
nano hello.py
</pre>
<p>(The first time you run nano, Replit might need to install it for you)</p>
<p>Save the File by pressing <b>CTRL-X</b>, <b>Y</b>, and Enter.</p>
</li><li>
Don't try this most difficult and most cool way to edit files on Linux without a helper
if it is your first time with the <b>vim</b> text editor.
<pre>
cd ~
vim hello.py
</pre>
<p>(The first time you run vim, Replit might need to install it for you)</p>
<p>
Once you have opened <b>vim</b>, cursor down where you want to make a change, and press the
<b>i</b> key to go into 'INSERT' mode, then type your new text and press
the <b>esc</b> key when you are done.  To save the file, you type <b>:wq</b>
followed by <b>enter</b>.  If you get lost press <b>esc</b> <b>:q!</b>
<b>enter</b> to get out of the file without saving.
</li>
</ol>
Once you start deploying real applications in production
environments like Google, Amazon, Microsoft, etc.. all you will have is command line.</p>

<?php include('footer.php');?>
