<?php if ( file_exists("../booktop.php") ) {
  require_once "../booktop.php";
  ob_start();
}?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="" xml:lang="">
<head>
  <meta charset="utf-8" />
  <meta name="generator" content="pandoc" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
  <title>-</title>
  <style>
    html {
      line-height: 1.5;
      font-family: Georgia, serif;
      font-size: 20px;
      color: #1a1a1a;
      background-color: #fdfdfd;
    }
    body {
      margin: 0 auto;
      max-width: 36em;
      padding-left: 50px;
      padding-right: 50px;
      padding-top: 50px;
      padding-bottom: 50px;
      hyphens: auto;
      overflow-wrap: break-word;
      text-rendering: optimizeLegibility;
      font-kerning: normal;
    }
    @media (max-width: 600px) {
      body {
        font-size: 0.9em;
        padding: 1em;
      }
    }
    @media print {
      body {
        background-color: transparent;
        color: black;
        font-size: 12pt;
      }
      p, h2, h3 {
        orphans: 3;
        widows: 3;
      }
      h2, h3, h4 {
        page-break-after: avoid;
      }
    }
    p {
      margin: 1em 0;
    }
    a {
      color: #1a1a1a;
    }
    a:visited {
      color: #1a1a1a;
    }
    img {
      max-width: 100%;
    }
    h1, h2, h3, h4, h5, h6 {
      margin-top: 1.4em;
    }
    h5, h6 {
      font-size: 1em;
      font-style: italic;
    }
    h6 {
      font-weight: normal;
    }
    ol, ul {
      padding-left: 1.7em;
      margin-top: 1em;
    }
    li > ol, li > ul {
      margin-top: 0;
    }
    blockquote {
      margin: 1em 0 1em 1.7em;
      padding-left: 1em;
      border-left: 2px solid #e6e6e6;
      color: #606060;
    }
    code {
      font-family: Menlo, Monaco, 'Lucida Console', Consolas, monospace;
      font-size: 85%;
      margin: 0;
    }
    pre {
      margin: 1em 0;
      overflow: auto;
    }
    pre code {
      padding: 0;
      overflow: visible;
      overflow-wrap: normal;
    }
    .sourceCode {
     background-color: transparent;
     overflow: visible;
    }
    hr {
      background-color: #1a1a1a;
      border: none;
      height: 1px;
      margin: 1em 0;
    }
    table {
      margin: 1em 0;
      border-collapse: collapse;
      width: 100%;
      overflow-x: auto;
      display: block;
      font-variant-numeric: lining-nums tabular-nums;
    }
    table caption {
      margin-bottom: 0.75em;
    }
    tbody {
      margin-top: 0.5em;
      border-top: 1px solid #1a1a1a;
      border-bottom: 1px solid #1a1a1a;
    }
    th {
      border-top: 1px solid #1a1a1a;
      padding: 0.25em 0.5em 0.25em 0.5em;
    }
    td {
      padding: 0.125em 0.5em 0.25em 0.5em;
    }
    header {
      margin-bottom: 4em;
      text-align: center;
    }
    #TOC li {
      list-style: none;
    }
    #TOC a:not(:hover) {
      text-decoration: none;
    }
    code{white-space: pre-wrap;}
    span.smallcaps{font-variant: small-caps;}
    span.underline{text-decoration: underline;}
    div.column{display: inline-block; vertical-align: top; width: 50%;}
    div.hanging-indent{margin-left: 1.5em; text-indent: -1.5em;}
    ul.task-list{list-style: none;}
    .display.math{display: block; text-align: center; margin: 0.5rem auto;}
  </style>
  <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv-printshiv.min.js"></script>
  <![endif]-->
</head>
<body>
<h1 id="files">Files</h1>
<p> </p>
<h2 id="persistence">Persistence</h2>
<p> </p>
<p>So far, we have learned how to write programs and communicate our intentions to the <em>Central Processing Unit</em> using conditional execution, functions, and iterations. We have learned how to create and use data structures in the <em>Main Memory</em>. The CPU and memory are where our software works and runs. It is where all of the “thinking” happens.</p>
<p>But if you recall from our hardware architecture discussions, once the power is turned off, anything stored in either the CPU or main memory is erased. So up to now, our programs have just been transient fun exercises to learn Python.</p>
<figure>
<img src="../images/arch.svg" alt="Secondary Memory" style="height: 2.5in;"/>
<figcaption>
Secondary Memory
</figcaption>
</figure>
<p>In this chapter, we start to work with <em>Secondary Memory</em> (or files). Secondary memory is not erased when the power is turned off. Or in the case of a USB flash drive, the data we write from our programs can be removed from the system and transported to another system.</p>
<p>We will primarily focus on reading and writing text files such as those we create in a text editor. Later we will see how to work with database files which are binary files, specifically designed to be read and written through database software.</p>
<h2 id="opening-files">Opening files</h2>
<p>  </p>
<p>When we want to read or write a file (say on your hard drive), we first must <em>open</em> the file. Opening the file communicates with your operating system, which knows where the data for each file is stored. When you open a file, you are asking the operating system to find the file by name and make sure the file exists. In this example, we open the file <em>mbox.txt</em>, which should be stored in the same folder that you are in when you start Python. You can download this file from <a href="http://www.py4e.com/code3/mbox.txt">www.py4e.com/code3/mbox.txt</a></p>
<pre class="python"><code>&gt;&gt;&gt; fhand = open(&#39;mbox.txt&#39;)
&gt;&gt;&gt; print(fhand)
&lt;_io.TextIOWrapper name=&#39;mbox.txt&#39; mode=&#39;r&#39; encoding=&#39;cp1252&#39;&gt;</code></pre>
<p></p>
<p>If the <code>open</code> is successful, the operating system returns us a <em>file handle</em>. The file handle is not the actual data contained in the file, but instead it is a “handle” that we can use to read the data. You are given a handle if the requested file exists and you have the proper permissions to read the file.</p>
<figure>
<img src="../images/handle.svg" alt="A File Handle" style="height: 2.0in;"/>
<figcaption>
A File Handle
</figcaption>
</figure>
<p>If the file does not exist, <code>open</code> will fail with a traceback and you will not get a handle to access the contents of the file:</p>
<pre class="python"><code>&gt;&gt;&gt; fhand = open(&#39;stuff.txt&#39;)
Traceback (most recent call last):
File &quot;&lt;stdin&gt;&quot;, line 1, in &lt;module&gt;
FileNotFoundError: [Errno 2] No such file or directory: &#39;stuff.txt&#39;</code></pre>
<p>Later we will use <code>try</code> and <code>except</code> to deal more gracefully with the situation where we attempt to open a file that does not exist.</p>
<h2 id="text-files-and-lines">Text files and lines</h2>
<p>A text file can be thought of as a sequence of lines, much like a Python string can be thought of as a sequence of characters. For example, this is a sample of a text file which records mail activity from various individuals in an open source project development team:</p>
<pre><code>From stephen.marquard@uct.ac.za Sat Jan  5 09:14:16 2008
Return-Path: &lt;postmaster@collab.sakaiproject.org&gt;
Date: Sat, 5 Jan 2008 09:12:18 -0500
To: source@collab.sakaiproject.org
From: stephen.marquard@uct.ac.za
Subject: [sakai] svn commit: r39772 - content/branches/
Details: http://source.sakaiproject.org/viewsvn/?view=rev&amp;rev=39772
...</code></pre>
<p>The entire file of mail interactions is available from</p>
<p><a href="http://www.py4e.com/code3/mbox.txt">www.py4e.com/code3/mbox.txt</a></p>
<p>and a shortened version of the file is available from</p>
<p><a href="http://www.py4e.com/code3/mbox-short.txt">www.py4e.com/code3/mbox-short.txt</a></p>
<p>These files are in a standard format for a file containing multiple mail messages. The lines which start with “From” separate the messages and the lines which start with “From:” are part of the messages. For more information about the mbox format, see <a href="https://en.wikipedia.org/wiki/Mbox" class="uri">https://en.wikipedia.org/wiki/Mbox</a>.</p>
<p>To break the file into lines, there is a special character that represents the “end of the line” called the <em>newline</em> character.</p>
<p></p>
<p>In Python, we represent the <em>newline</em> character as a backslash-n in string constants. Even though this looks like two characters, it is actually a single character. When we look at the variable by entering “stuff” in the interpreter, it shows us the <code>\n</code> in the string, but when we use <code>print</code> to show the string, we see the string broken into two lines by the newline character.</p>
<pre class="python"><code>&gt;&gt;&gt; stuff = &#39;Hello\nWorld!&#39;
&gt;&gt;&gt; stuff
&#39;Hello\nWorld!&#39;
&gt;&gt;&gt; print(stuff)
Hello
World!
&gt;&gt;&gt; stuff = &#39;X\nY&#39;
&gt;&gt;&gt; print(stuff)
X
Y
&gt;&gt;&gt; len(stuff)
3</code></pre>
<p>You can also see that the length of the string <code>X\nY</code> is <em>three</em> characters because the newline character is a single character.</p>
<p>So when we look at the lines in a file, we need to <em>imagine</em> that there is a special invisible character called the newline at the end of each line that marks the end of the line.</p>
<p>So the newline character separates the characters in the file into lines.</p>
<h2 id="reading-files">Reading files</h2>
<p> </p>
<p>While the <em>file handle</em> does not contain the data for the file, it is quite easy to construct a <code>for</code> loop to read through and count each of the lines in a file:</p>
<pre class="python"><code>fhand = open(&#39;mbox-short.txt&#39;)
count = 0
for line in fhand:
    count = count + 1
print(&#39;Line Count:&#39;, count)

# Code: http://www.py4e.com/code3/open.py</code></pre>
<p>We can use the file handle as the sequence in our <code>for</code> loop. Our <code>for</code> loop simply counts the number of lines in the file and prints them out. The rough translation of the <code>for</code> loop into English is, “for each line in the file represented by the file handle, add one to the <code>count</code> variable.”</p>
<p>The reason that the <code>open</code> function does not read the entire file is that the file might be quite large with many gigabytes of data. The <code>open</code> statement takes the same amount of time regardless of the size of the file. The <code>for</code> loop actually causes the data to be read from the file.</p>
<p>When the file is read using a <code>for</code> loop in this manner, Python takes care of splitting the data in the file into separate lines using the newline character. Python reads each line through the newline and includes the newline as the last character in the <code>line</code> variable for each iteration of the <code>for</code> loop.</p>
<p>Because the <code>for</code> loop reads the data one line at a time, it can efficiently read and count the lines in very large files without running out of main memory to store the data. The above program can count the lines in any size file using very little memory since each line is read, counted, and then discarded.</p>
<p>If you know the file is relatively small compared to the size of your main memory, you can read the whole file into one string using the <code>read</code> method on the file handle.</p>
<pre class="python"><code>&gt;&gt;&gt; fhand = open(&#39;mbox-short.txt&#39;)
&gt;&gt;&gt; inp = fhand.read()
&gt;&gt;&gt; print(len(inp))
94626
&gt;&gt;&gt; print(inp[:20])
From stephen.marquar</code></pre>
<p>In this example, the entire contents (all 94,626 characters) of the file <em>mbox-short.txt</em> are read directly into the variable <code>inp</code>. We use string slicing to print out the first 20 characters of the string data stored in <code>inp</code>.</p>
<p>When the file is read in this manner, all the characters including all of the lines and newline characters are one big string in the variable <code>inp</code>. It is a good idea to store the output of <code>read</code> as a variable because each call to <code>read</code> exhausts the resource:</p>
<pre class="python"><code>&gt;&gt;&gt; fhand = open(&#39;mbox-short.txt&#39;)
&gt;&gt;&gt; print(len(fhand.read()))
94626
&gt;&gt;&gt; print(len(fhand.read()))
0</code></pre>
<p>Remember that this form of the <code>open</code> function should only be used if the file data will fit comfortably in the main memory of your computer. If the file is too large to fit in main memory, you should write your program to read the file in chunks using a <code>for</code> or <code>while</code> loop.</p>
<h2 id="searching-through-a-file">Searching through a file</h2>
<p>When you are searching through data in a file, it is a very common pattern to read through a file, ignoring most of the lines and only processing lines which meet a particular condition. We can combine the pattern for reading a file with string methods to build simple search mechanisms.</p>
<p> </p>
<p>For example, if we wanted to read a file and only print out lines which started with the prefix “From:”, we could use the string method <em>startswith</em> to select only those lines with the desired prefix:</p>
<pre class="python"><code>fhand = open(&#39;mbox-short.txt&#39;)
count = 0
for line in fhand:
    if line.startswith(&#39;From:&#39;):
        print(line)

# Code: http://www.py4e.com/code3/search1.py</code></pre>
<p>When this program runs, we get the following output:</p>
<pre><code>From: stephen.marquard@uct.ac.za

From: louis@media.berkeley.edu

From: zqian@umich.edu

From: rjlowe@iupui.edu
...</code></pre>
<p>The output looks great since the only lines we are seeing are those which start with “From:”, but why are we seeing the extra blank lines? This is due to that invisible <em>newline</em> character. Each of the lines ends with a newline, so the <code>print</code> statement prints the string in the variable <em>line</em> which includes a newline and then <code>print</code> adds <em>another</em> newline, resulting in the double spacing effect we see.</p>
<p>We could use line slicing to print all but the last character, but a simpler approach is to use the <em>rstrip</em> method which strips whitespace from the right side of a string as follows:</p>
<pre class="python"><code>fhand = open(&#39;mbox-short.txt&#39;)
for line in fhand:
    line = line.rstrip()
    if line.startswith(&#39;From:&#39;):
        print(line)

# Code: http://www.py4e.com/code3/search2.py</code></pre>
<p>When this program runs, we get the following output:</p>
<pre><code>From: stephen.marquard@uct.ac.za
From: louis@media.berkeley.edu
From: zqian@umich.edu
From: rjlowe@iupui.edu
From: zqian@umich.edu
From: rjlowe@iupui.edu
From: cwen@iupui.edu
...</code></pre>
<p>As your file processing programs get more complicated, you may want to structure your search loops using <code>continue</code>. The basic idea of the search loop is that you are looking for “interesting” lines and effectively skipping “uninteresting” lines. And then when we find an interesting line, we do something with that line.</p>
<p>We can structure the loop to follow the pattern of skipping uninteresting lines as follows:</p>
<pre class="python"><code>fhand = open(&#39;mbox-short.txt&#39;)
for line in fhand:
    line = line.rstrip()
    # Skip &#39;uninteresting lines&#39;
    if not line.startswith(&#39;From:&#39;):
        continue
    # Process our &#39;interesting&#39; line
    print(line)

# Code: http://www.py4e.com/code3/search3.py</code></pre>
<p>The output of the program is the same. In English, the uninteresting lines are those which do not start with “From:”, which we skip using <code>continue</code>. For the “interesting” lines (i.e., those that start with “From:”) we perform the processing on those lines.</p>
<p>We can use the <code>find</code> string method to simulate a text editor search that finds lines where the search string is anywhere in the line. Since <code>find</code> looks for an occurrence of a string within another string and either returns the position of the string or -1 if the string was not found, we can write the following loop to show lines which contain the string “<span class="citation" data-cites="uct.ac.za">@uct.ac.za</span>” (i.e., they come from the University of Cape Town in South Africa):</p>
<pre class="python"><code>fhand = open(&#39;mbox-short.txt&#39;)
for line in fhand:
    line = line.rstrip()
    if line.find(&#39;@uct.ac.za&#39;) == -1: continue
    print(line)

# Code: http://www.py4e.com/code3/search4.py</code></pre>
<p>Which produces the following output:</p>
<pre><code>From stephen.marquard@uct.ac.za Sat Jan  5 09:14:16 2008
X-Authentication-Warning: set sender to stephen.marquard@uct.ac.za using -f
From: stephen.marquard@uct.ac.za
Author: stephen.marquard@uct.ac.za
From david.horwitz@uct.ac.za Fri Jan  4 07:02:32 2008
X-Authentication-Warning: set sender to david.horwitz@uct.ac.za using -f
From: david.horwitz@uct.ac.za
Author: david.horwitz@uct.ac.za
...</code></pre>
<p>Here we also use the contracted form of the <code>if</code> statement where we put the <code>continue</code> on the same line as the <code>if</code>. This contracted form of the <code>if</code> functions the same as if the <code>continue</code> were on the next line and indented.</p>
<h2 id="letting-the-user-choose-the-file-name">Letting the user choose the file name</h2>
<p>We really do not want to have to edit our Python code every time we want to process a different file. It would be more usable to ask the user to enter the file name string each time the program runs so they can use our program on different files without changing the Python code.</p>
<p>This is quite simple to do by reading the file name from the user using <code>input</code> as follows:</p>
<pre class="python"><code>fname = input(&#39;Enter the file name: &#39;)
fhand = open(fname)
count = 0
for line in fhand:
    if line.startswith(&#39;Subject:&#39;):
        count = count + 1
print(&#39;There were&#39;, count, &#39;subject lines in&#39;, fname)

# Code: http://www.py4e.com/code3/search6.py</code></pre>
<p>We read the file name from the user and place it in a variable named <code>fname</code> and open that file. Now we can run the program repeatedly on different files.</p>
<pre><code>python search6.py
Enter the file name: mbox.txt
There were 1797 subject lines in mbox.txt

python search6.py
Enter the file name: mbox-short.txt
There were 27 subject lines in mbox-short.txt</code></pre>
<p>Before peeking at the next section, take a look at the above program and ask yourself, “What could go possibly wrong here?” or “What might our friendly user do that would cause our nice little program to ungracefully exit with a traceback, making us look not-so-cool in the eyes of our users?”</p>
<h2 id="using-try-except-and-open">Using <code>try, except,</code> and <code>open</code></h2>
<p>I told you not to peek. This is your last chance.</p>
<p>What if our user types something that is not a file name?</p>
<pre><code>python search6.py
Enter the file name: missing.txt
Traceback (most recent call last):
  File &quot;search6.py&quot;, line 2, in &lt;module&gt;
    fhand = open(fname)
FileNotFoundError: [Errno 2] No such file or directory: &#39;missing.txt&#39;

python search6.py
Enter the file name: na na boo boo
Traceback (most recent call last):
  File &quot;search6.py&quot;, line 2, in &lt;module&gt;
    fhand = open(fname)
FileNotFoundError: [Errno 2] No such file or directory: &#39;na na boo boo&#39;</code></pre>
<p>Do not laugh. Users will eventually do every possible thing they can do to break your programs, either on purpose or with malicious intent. As a matter of fact, an important part of any software development team is a person or group called <em>Quality Assurance</em> (or QA for short) whose very job it is to do the craziest things possible in an attempt to break the software that the programmer has created.</p>
<p> </p>
<p>The QA team is responsible for finding the flaws in programs before we have delivered the program to the end users who may be purchasing the software or paying our salary to write the software. So the QA team is the programmer’s best friend.</p>
<p>     </p>
<p>So now that we see the flaw in the program, we can elegantly fix it using the <code>try</code>/<code>except</code> structure. We need to assume that the <code>open</code> call might fail and add recovery code when the <code>open</code> fails as follows:</p>
<pre class="python"><code>fname = input(&#39;Enter the file name: &#39;)
try:
    fhand = open(fname)
except:
    print(&#39;File cannot be opened:&#39;, fname)
    exit()
count = 0
for line in fhand:
    if line.startswith(&#39;Subject:&#39;):
        count = count + 1
print(&#39;There were&#39;, count, &#39;subject lines in&#39;, fname)

# Code: http://www.py4e.com/code3/search7.py</code></pre>
<p>The <code>exit</code> function terminates the program. It is a function that we call that never returns. Now when our user (or QA team) types in silliness or bad file names, we “catch” them and recover gracefully:</p>
<pre><code>python search7.py
Enter the file name: mbox.txt
There were 1797 subject lines in mbox.txt

python search7.py
Enter the file name: na na boo boo
File cannot be opened: na na boo boo</code></pre>
<p></p>
<p>Protecting the <code>open</code> call is a good example of the proper use of <code>try</code> and <code>except</code> in a Python program. We use the term “Pythonic” when we are doing something the “Python way”. We might say that the above example is the Pythonic way to open a file.</p>
<p>Once you become more skilled in Python, you can engage in repartee with other Python programmers to decide which of two equivalent solutions to a problem is “more Pythonic”. The goal to be “more Pythonic” captures the notion that programming is part engineering and part art. We are not always interested in just making something work, we also want our solution to be elegant and to be appreciated as elegant by our peers.</p>
<h2 id="writing-files">Writing files</h2>
<p></p>
<p>To write a file, you have to open it with mode “w” as a second parameter:</p>
<pre class="python"><code>&gt;&gt;&gt; fout = open(&#39;output.txt&#39;, &#39;w&#39;)
&gt;&gt;&gt; print(fout)
&lt;_io.TextIOWrapper name=&#39;output.txt&#39; mode=&#39;w&#39; encoding=&#39;cp1252&#39;&gt;</code></pre>
<p>If the file already exists, opening it in write mode clears out the old data and starts fresh, so be careful! If the file doesn’t exist, a new one is created.</p>
<p>The <code>write</code> method of the file handle object puts data into the file, returning the number of characters written. The default write mode is text for writing (and reading) strings.</p>
<pre class="python"><code>&gt;&gt;&gt; line1 = &quot;This here&#39;s the wattle,\n&quot;
&gt;&gt;&gt; fout.write(line1)
24</code></pre>
<p></p>
<p>Again, the file object keeps track of where it is, so if you call <code>write</code> again, it adds the new data to the end.</p>
<p>We must make sure to manage the ends of lines as we write to the file by explicitly inserting the newline character when we want to end a line. The <code>print</code> statement automatically appends a newline, but the <code>write</code> method does not add the newline automatically.</p>
<pre class="python"><code>&gt;&gt;&gt; line2 = &#39;the emblem of our land.\n&#39;
&gt;&gt;&gt; fout.write(line2)
24</code></pre>
<p>When you are done writing, you have to close the file to make sure that the last bit of data is physically written to the disk so it will not be lost if the power goes off.</p>
<pre class="python"><code>&gt;&gt;&gt; fout.close()</code></pre>
<p>We could close the files which we open for read as well, but we can be a little sloppy if we are only opening a few files since Python makes sure that all open files are closed when the program ends. When we are writing files, we want to explicitly close the files so as to leave nothing to chance.</p>
<p> </p>
<h2 id="debugging">Debugging</h2>
<p> </p>
<p>When you are reading and writing files, you might run into problems with whitespace. These errors can be hard to debug because spaces, tabs, and newlines are normally invisible:</p>
<pre class="python"><code>&gt;&gt;&gt; s = &#39;1 2\t 3\n 4&#39;
&gt;&gt;&gt; print(s)
1 2  3
 4</code></pre>
<p>  </p>
<p>The built-in function <code>repr</code> can help. It takes any object as an argument and returns a string representation of the object. For strings, it represents whitespace characters with backslash sequences:</p>
<pre class="python"><code>&gt;&gt;&gt; print(repr(s))
&#39;1 2\t 3\n 4&#39;</code></pre>
<p>This can be helpful for debugging.</p>
<p>One other problem you might run into is that different systems use different characters to indicate the end of a line. Some systems use a newline, represented <code>\n</code>. Others use a return character, represented <code>\r</code>. Some use both. If you move files between different systems, these inconsistencies might cause problems.</p>
<p></p>
<p>For most systems, there are applications to convert from one format to another. You can find them (and read more about this issue) at <a href="https://wikipedia.org/wiki/Newline">https://www.wikipedia.org/wiki/Newline</a>. Or, of course, you could write one yourself.</p>
<h2 id="glossary">Glossary</h2>
<dl>
<dt>catch</dt>
<dd>To prevent an exception from terminating a program using the <code>try</code> and <code>except</code> statements.
</dd>
<dt>newline</dt>
<dd>A special character used in files and strings to indicate the end of a line.
</dd>
<dt>Pythonic</dt>
<dd>A technique that works elegantly in Python. “Using try and except is the <em>Pythonic</em> way to recover from missing files”.
</dd>
<dt>Quality Assurance</dt>
<dd>A person or team focused on insuring the overall quality of a software product. QA is often involved in testing a product and identifying problems before the product is released.
</dd>
<dt>text file</dt>
<dd>A sequence of characters stored in permanent storage like a hard drive.
</dd>
</dl>
<h2 id="exercises">Exercises</h2>
<p><strong>Exercise 1: Write a program to read through a file and print the contents of the file (line by line) all in upper case. Executing the program will look as follows:</strong></p>
<pre><code>python shout.py
Enter a file name: mbox-short.txt
FROM STEPHEN.MARQUARD@UCT.AC.ZA SAT JAN  5 09:14:16 2008
RETURN-PATH: &lt;POSTMASTER@COLLAB.SAKAIPROJECT.ORG&gt;
RECEIVED: FROM MURDER (MAIL.UMICH.EDU [141.211.14.90])
     BY FRANKENSTEIN.MAIL.UMICH.EDU (CYRUS V2.3.8) WITH LMTPA;
     SAT, 05 JAN 2008 09:14:16 -0500</code></pre>
<p><strong>You can download the file from</strong> <a href="http://www.py4e.com/code3/mbox-short.txt">www.py4e.com/code3/mbox-short.txt</a></p>
<p><strong>Exercise 2: Write a program to prompt for a file name, and then read through the file and look for lines of the form:</strong></p>
<pre><code>X-DSPAM-Confidence: 0.8475</code></pre>
<p><strong>When you encounter a line that starts with “X-DSPAM-Confidence:” pull apart the line to extract the floating-point number on the line. Count these lines and then compute the total of the spam confidence values from these lines. When you reach the end of the file, print out the average spam confidence.</strong></p>
<pre><code>Enter the file name: mbox.txt
Average spam confidence: 0.894128046745

Enter the file name: mbox-short.txt
Average spam confidence: 0.750718518519</code></pre>
<p><strong>Test your file on the <em>mbox.txt</em> and <em>mbox-short.txt</em> files.</strong></p>
<p><strong>Exercise 3: Sometimes when programmers get bored or want to have a bit of fun, they add a harmless <em>Easter Egg</em> to their program. Modify the program that prompts the user for the file name so that it prints a funny message when the user types in the exact file name “na na boo boo”. The program should behave normally for all other files which exist and don’t exist. Here is a sample execution of the program:</strong></p>
<pre><code>python egg.py
Enter the file name: mbox.txt
There were 1797 subject lines in mbox.txt

python egg.py
Enter the file name: missing.tyxt
File cannot be opened: missing.tyxt

python egg.py
Enter the file name: na na boo boo
NA NA BOO BOO TO YOU - You have been punk&#39;d!</code></pre>
<p><strong>We are not encouraging you to put Easter Eggs in your programs; this is just an exercise.</strong></p>
</body>
</html>
<?php if ( file_exists("../bookfoot.php") ) {
  $HTML_FILE = basename(__FILE__);
  $HTML = ob_get_contents();
  ob_end_clean();
  require_once "../bookfoot.php";
}?>
