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
  <meta name="author" content="Exploring Data Using Python 3" />
  <title>Python for Everybody</title>
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
<header id="title-block-header">
<h1 class="title">Python for Everybody</h1>
<p class="author">Exploring Data Using Python 3</p>
<p class="date">Dr. Charles R. Severance</p>
</header>
<h1 id="why-should-you-learn-to-write-programs">Why should you learn to write programs?</h1>
<p>Writing programs (or programming) is a very creative and rewarding activity. You can write programs for many reasons, ranging from making your living to solving a difficult data analysis problem to having fun to helping someone else solve a problem. This book assumes that <em>everyone</em> needs to know how to program, and that once you know how to program you will figure out what you want to do with your newfound skills.</p>
<p>We are surrounded in our daily lives with computers ranging from laptops to cell phones. We can think of these computers as our “personal assistants” who can take care of many things on our behalf. The hardware in our current-day computers is essentially built to continuously ask us the question, “What would you like me to do next?”</p>
<figure>
<img src="../images/pda.svg" alt="Personal Digital Assistant" style="height: 1.0in;"/>
<figcaption>
Personal Digital Assistant
</figcaption>
</figure>
<p>Programmers add an operating system and a set of applications to the hardware and we end up with a Personal Digital Assistant that is quite helpful and capable of helping us do many different things.</p>
<p>Our computers are fast and have vast amounts of memory and could be very helpful to us if we only knew the language to speak to explain to the computer what we would like it to “do next”. If we knew this language, we could tell the computer to do tasks on our behalf that were repetitive. Interestingly, the kinds of things computers can do best are often the kinds of things that we humans find boring and mind-numbing.</p>
<p>For example, look at the first three paragraphs of this chapter and tell me the most commonly used word and how many times the word is used. While you were able to read and understand the words in a few seconds, counting them is almost painful because it is not the kind of problem that human minds are designed to solve. For a computer, the opposite is true, reading and understanding text from a piece of paper is hard for a computer to do but counting the words and telling you how many times the most used word was used is very easy for the computer:</p>
<pre class="python"><code>python words.py
Enter file:words.txt
to 16</code></pre>
<p>Our “personal information analysis assistant” quickly told us that the word “to” was used sixteen times in the first three paragraphs of this chapter.</p>
<p>This very fact that computers are good at things that humans are not is why you need to become skilled at talking “computer language”. Once you learn this new language, you can delegate mundane tasks to your partner (the computer), leaving more time for you to do the things that you are uniquely suited for. You bring creativity, intuition, and inventiveness to this partnership.</p>
<h2 id="creativity-and-motivation">Creativity and motivation</h2>
<p>While this book is not intended for professional programmers, professional programming can be a very rewarding job both financially and personally. Building useful, elegant, and clever programs for others to use is a very creative activity. Your computer or Personal Digital Assistant (PDA) usually contains many different programs from many different groups of programmers, each competing for your attention and interest. They try their best to meet your needs and give you a great user experience in the process. In some situations, when you choose a piece of software, the programmers are directly compensated because of your choice.</p>
<p>If we think of programs as the creative output of groups of programmers, perhaps the following figure is a more sensible version of our PDA:</p>
<figure>
<img src="../images/pda2.svg" alt="Programmers Talking to You" style="height: 1.0in;"/>
<figcaption>
Programmers Talking to You
</figcaption>
</figure>
<p>For now, our primary motivation is not to make money or please end users, but instead for us to be more productive in handling the data and information that we will encounter in our lives. When you first start, you will be both the programmer and the end user of your programs. As you gain skill as a programmer and programming feels more creative to you, your thoughts may turn toward developing programs for others.</p>
<h2 id="computer-hardware-architecture">Computer hardware architecture</h2>
<p> </p>
<p>Before we start learning the language we speak to give instructions to computers to develop software, we need to learn a small amount about how computers are built. If you were to take apart your computer or cell phone and look deep inside, you would find the following parts:</p>
<figure>
<img src="../images/arch.svg" alt="Hardware Architecture" style="height: 1.75in;"/>
<figcaption>
Hardware Architecture
</figcaption>
</figure>
<p>The high-level definitions of these parts are as follows:</p>
<ul>
<li><p>The <em>Central Processing Unit</em> (or CPU) is the part of the computer that is built to be obsessed with “what is next?” If your computer is rated at 3.0 Gigahertz, it means that the CPU will ask “What next?” three billion times per second. You are going to have to learn how to talk fast to keep up with the CPU.</p></li>
<li><p>The <em>Main Memory</em> is used to store information that the CPU needs in a hurry. The main memory is nearly as fast as the CPU. But the information stored in the main memory vanishes when the computer is turned off.</p></li>
<li><p>The <em>Secondary Memory</em> is also used to store information, but it is much slower than the main memory. The advantage of the secondary memory is that it can store information even when there is no power to the computer. Examples of secondary memory are disk drives or flash memory (typically found in USB sticks and portable music players).</p></li>
<li><p>The <em>Input and Output Devices</em> are simply our screen, keyboard, mouse, microphone, speaker, touchpad, etc. They are all of the ways we interact with the computer.</p></li>
<li><p>These days, most computers also have a <em>Network Connection</em> to retrieve information over a network. We can think of the network as a very slow place to store and retrieve data that might not always be “up”. So in a sense, the network is a slower and at times unreliable form of <em>Secondary Memory</em>.</p></li>
</ul>
<p>While most of the detail of how these components work is best left to computer builders, it helps to have some terminology so we can talk about these different parts as we write our programs.</p>
<p>As a programmer, your job is to use and orchestrate each of these resources to solve the problem that you need to solve and analyze the data you get from the solution. As a programmer you will mostly be “talking” to the CPU and telling it what to do next. Sometimes you will tell the CPU to use the main memory, secondary memory, network, or the input/output devices.</p>
<figure>
<img src="../images/arch2.svg" alt="Where Are You?" style="height: 1.75in;"/>
<figcaption>
Where Are You?
</figcaption>
</figure>
<p>You need to be the person who answers the CPU’s “What next?” question. But it would be very uncomfortable to shrink you down to 5mm tall and insert you into the computer just so you could issue a command three billion times per second. So instead, you must write down your instructions in advance. We call these stored instructions a <em>program</em> and the act of writing these instructions down and getting the instructions to be correct <em>programming</em>.</p>
<h2 id="understanding-programming">Understanding programming</h2>
<p>In the rest of this book, we will try to turn you into a person who is skilled in the art of programming. In the end you will be a <em>programmer</em> - perhaps not a professional programmer, but at least you will have the skills to look at a data/information analysis problem and develop a program to solve the problem.</p>
<p></p>
<p>In a sense, you need two skills to be a programmer:</p>
<ul>
<li><p>First, you need to know the programming language (Python) - you need to know the vocabulary and the grammar. You need to be able to spell the words in this new language properly and know how to construct well-formed “sentences” in this new language.</p></li>
<li><p>Second, you need to “tell a story”. In writing a story, you combine words and sentences to convey an idea to the reader. There is a skill and art in constructing the story, and skill in story writing is improved by doing some writing and getting some feedback. In programming, our program is the “story” and the problem you are trying to solve is the “idea”.</p></li>
</ul>
<p>Once you learn one programming language such as Python, you will find it much easier to learn a second programming language such as JavaScript or C++. The new programming language has very different vocabulary and grammar but the problem-solving skills will be the same across all programming languages.</p>
<p>You will learn the “vocabulary” and “sentences” of Python pretty quickly. It will take longer for you to be able to write a coherent program to solve a brand-new problem. We teach programming much like we teach writing. We start reading and explaining programs, then we write simple programs, and then we write increasingly complex programs over time. At some point you “get your muse” and see the patterns on your own and can see more naturally how to take a problem and write a program that solves that problem. And once you get to that point, programming becomes a very pleasant and creative process.</p>
<p>We start with the vocabulary and structure of Python programs. Be patient as the simple examples remind you of when you started reading for the first time.</p>
<h2 id="words-and-sentences">Words and sentences</h2>
<p> </p>
<p>Unlike human languages, the Python vocabulary is actually pretty small. We call this “vocabulary” the “reserved words”. These are words that have very special meaning to Python. When Python sees these words in a Python program, they have one and only one meaning to Python. Later as you write programs you will make up your own words that have meaning to you called <em>variables</em>. You will have great latitude in choosing your names for your variables, but you cannot use any of Python’s reserved words as a name for a variable.</p>
<p>When we train a dog, we use special words like “sit”, “stay”, and “fetch”. When you talk to a dog and don’t use any of the reserved words, they just look at you with a quizzical look on their face until you say a reserved word. For example, if you say, “I wish more people would walk to improve their overall health”, what most dogs likely hear is, “blah blah blah <em>walk</em> blah blah blah blah.” That is because “walk” is a reserved word in dog language. Many might suggest that the language between humans and cats has no reserved words<a href="#fn1" class="footnote-ref" id="fnref1" role="doc-noteref"><sup>1</sup></a>.</p>
<p>The reserved words in the language where humans talk to Python include the following:</p>
<pre><code>and       del       global      not       with
as        elif      if          or        yield
assert    else      import      pass
break     except    in          raise
class     finally   is          return
continue  for       lambda      try
def       from      nonlocal    while    </code></pre>
<p>That is it, and unlike a dog, Python is already completely trained. When you say “try”, Python will try every time you say it without fail.</p>
<p>We will learn these reserved words and how they are used in good time, but for now we will focus on the Python equivalent of “speak” (in human-to-dog language). The nice thing about telling Python to speak is that we can even tell it what to say by giving it a message in quotes:</p>
<pre class="python"><code>print(&#39;Hello world!&#39;)</code></pre>
<p>And we have even written our first syntactically correct Python sentence. Our sentence starts with the function <em>print</em> followed by a string of text of our choosing enclosed in single quotes. The strings in the print statements are enclosed in quotes. Single quotes and double quotes do the same thing; most people use single quotes except in cases like this where a single quote (which is also an apostrophe) appears in the string.</p>
<h2 id="conversing-with-python">Conversing with Python</h2>
<p>Now that we have a word and a simple sentence that we know in Python, we need to know how to start a conversation with Python to test our new language skills.</p>
<p>Before you can converse with Python, you must first install the Python software on your computer and learn how to start Python on your computer. That is too much detail for this chapter so I suggest that you consult <a href="http://www.py4e.com">www.py4e.com</a> where I have detailed instructions and screencasts of setting up and starting Python on Macintosh and Windows systems. At some point, you will be in a terminal or command window and you will type <em>python</em> and the Python interpreter will start executing in interactive mode and appear somewhat as follows:</p>
<p></p>
<pre class="python"><code>Python 3.5.1 (v3.5.1:37a07cee5969, Dec  6 2015, 01:54:25)
[MSC v.1900 64 bit (AMD64)] on win32
Type &quot;help&quot;, &quot;copyright&quot;, &quot;credits&quot; or &quot;license&quot; for more
information.
&gt;&gt;&gt;</code></pre>
<p>The <code>&gt;&gt;&gt;</code> prompt is the Python interpreter’s way of asking you, “What do you want me to do next?” Python is ready to have a conversation with you. All you have to know is how to speak the Python language.</p>
<p>Let’s say for example that you did not know even the simplest Python language words or sentences. You might want to use the standard line that astronauts use when they land on a faraway planet and try to speak with the inhabitants of the planet:</p>
<pre class="python"><code>&gt;&gt;&gt; I come in peace, please take me to your leader
File &quot;&lt;stdin&gt;&quot;, line 1
  I come in peace, please take me to your leader
       ^
SyntaxError: invalid syntax
&gt;&gt;&gt;</code></pre>
<p>This is not going so well. Unless you think of something quickly, the inhabitants of the planet are likely to stab you with their spears, put you on a spit, roast you over a fire, and eat you for dinner.</p>
<p>Luckily you brought a copy of this book on your travels, and you thumb to this very page and try again:</p>
<pre class="python"><code>&gt;&gt;&gt; print(&#39;Hello world!&#39;)
Hello world!</code></pre>
<p>This is looking much better, so you try to communicate some more:</p>
<pre class="python"><code>&gt;&gt;&gt; print(&#39;You must be the legendary god that comes from the sky&#39;)
You must be the legendary god that comes from the sky
&gt;&gt;&gt; print(&#39;We have been waiting for you for a long time&#39;)
We have been waiting for you for a long time
&gt;&gt;&gt; print(&#39;Our legend says you will be very tasty with mustard&#39;)
Our legend says you will be very tasty with mustard
&gt;&gt;&gt; print &#39;We will have a feast tonight unless you say
File &quot;&lt;stdin&gt;&quot;, line 1
  print &#39;We will have a feast tonight unless you say
                                                   ^
SyntaxError: Missing parentheses in call to &#39;print&#39;
&gt;&gt;&gt;</code></pre>
<p>The conversation was going so well for a while and then you made the tiniest mistake using the Python language and Python brought the spears back out.</p>
<p>At this point, you should also realize that while Python is amazingly complex and powerful and very picky about the syntax you use to communicate with it, Python is <em>not</em> intelligent. You are really just having a conversation with yourself, but using proper syntax.</p>
<p>In a sense, when you use a program written by someone else the conversation is between you and those other programmers with Python acting as an intermediary. Python is a way for the creators of programs to express how the conversation is supposed to proceed. And in just a few more chapters, you will be one of those programmers using Python to talk to the users of your program.</p>
<p>Before we leave our first conversation with the Python interpreter, you should probably know the proper way to say “good-bye” when interacting with the inhabitants of Planet Python:</p>
<pre class="python"><code>&gt;&gt;&gt; good-bye
Traceback (most recent call last):
File &quot;&lt;stdin&gt;&quot;, line 1, in &lt;module&gt;
NameError: name &#39;good&#39; is not defined
&gt;&gt;&gt; if you don&#39;t mind, I need to leave
File &quot;&lt;stdin&gt;&quot;, line 1
  if you don&#39;t mind, I need to leave
           ^
SyntaxError: invalid syntax
&gt;&gt;&gt; quit()</code></pre>
<p>You will notice that the error is different for the first two incorrect attempts. The second error is different because <em>if</em> is a reserved word and Python saw the reserved word and thought we were trying to say something but got the syntax of the sentence wrong.</p>
<p>The proper way to say “good-bye” to Python is to enter <em>quit()</em> at the interactive chevron <code>&gt;&gt;&gt;</code> prompt. It would have probably taken you quite a while to guess that one, so having a book handy probably will turn out to be helpful.</p>
<h2 id="terminology-interpreter-and-compiler">Terminology: Interpreter and compiler</h2>
<p>Python is a <em>high-level</em> language intended to be relatively straightforward for humans to read and write and for computers to read and process. Other high-level languages include Java, C++, PHP, Ruby, Basic, Perl, JavaScript, and many more. The actual hardware inside the Central Processing Unit (CPU) does not understand any of these high-level languages.</p>
<p>The CPU understands a language we call <em>machine language</em>. Machine language is very simple and frankly very tiresome to write because it is represented all in zeros and ones:</p>
<pre><code>001010001110100100101010000001111
11100110000011101010010101101101
...</code></pre>
<p>Machine language seems quite simple on the surface, given that there are only zeros and ones, but its syntax is even more complex and far more intricate than Python. So very few programmers ever write machine language. Instead we build various translators to allow programmers to write in high-level languages like Python or JavaScript and these translators convert the programs to machine language for actual execution by the CPU.</p>
<p>Since machine language is tied to the computer hardware, machine language is not <em>portable</em> across different types of hardware. Programs written in high-level languages can be moved between different computers by using a different interpreter on the new machine or recompiling the code to create a machine language version of the program for the new machine.</p>
<p>These programming language translators fall into two general categories: (1) interpreters and (2) compilers.</p>
<p>An <em>interpreter</em> reads the source code of the program as written by the programmer, parses the source code, and interprets the instructions on the fly. Python is an interpreter and when we are running Python interactively, we can type a line of Python (a sentence) and Python processes it immediately and is ready for us to type another line of Python.</p>
<p>Some of the lines of Python tell Python that you want it to remember some value for later. We need to pick a name for that value to be remembered and we can use that symbolic name to retrieve the value later. We use the term <em>variable</em> to refer to the labels we use to refer to this stored data.</p>
<pre class="python"><code>&gt;&gt;&gt; x = 6
&gt;&gt;&gt; print(x)
6
&gt;&gt;&gt; y = x * 7
&gt;&gt;&gt; print(y)
42
&gt;&gt;&gt;</code></pre>
<p>In this example, we ask Python to remember the value six and use the label <em>x</em> so we can retrieve the value later. We verify that Python has actually remembered the value using <em>print</em>. Then we ask Python to retrieve <em>x</em> and multiply it by seven and put the newly computed value in <em>y</em>. Then we ask Python to print out the value currently in <em>y</em>.</p>
<p>Even though we are typing these commands into Python one line at a time, Python is treating them as an ordered sequence of statements with later statements able to retrieve data created in earlier statements. We are writing our first simple paragraph with four sentences in a logical and meaningful order.</p>
<p>It is the nature of an <em>interpreter</em> to be able to have an interactive conversation as shown above. A <em>compiler</em> needs to be handed the entire program in a file, and then it runs a process to translate the high-level source code into machine language and then the compiler puts the resulting machine language into a file for later execution.</p>
<p>If you have a Windows system, often these executable machine language programs have a suffix of “.exe” or “.dll” which stand for “executable” and “dynamic link library” respectively. In Linux and Macintosh, there is no suffix that uniquely marks a file as executable.</p>
<p>If you were to open an executable file in a text editor, it would look completely crazy and be unreadable:</p>
<pre><code>^?ELF^A^A^A^@^@^@^@^@^@^@^@^@^B^@^C^@^A^@^@^@\xa0\x82
^D^H4^@^@^@\x90^]^@^@^@^@^@^@4^@ ^@^G^@(^@$^@!^@^F^@
^@^@4^@^@^@4\x80^D^H4\x80^D^H\xe0^@^@^@\xe0^@^@^@^E
^@^@^@^D^@^@^@^C^@^@^@^T^A^@^@^T\x81^D^H^T\x81^D^H^S
^@^@^@^S^@^@^@^D^@^@^@^A^@^@^@^A\^D^HQVhT\x83^D^H\xe8
....</code></pre>
<p>It is not easy to read or write machine language, so it is nice that we have <em>interpreters</em> and <em>compilers</em> that allow us to write in high-level languages like Python or C.</p>
<p>Now at this point in our discussion of compilers and interpreters, you should be wondering a bit about the Python interpreter itself. What language is it written in? Is it written in a compiled language? When we type “python”, what exactly is happening?</p>
<p>The Python interpreter is written in a high-level language called “C”. You can look at the actual source code for the Python interpreter by going to <a href="http://www.python.org">www.python.org</a> and working your way to their source code. So Python is a program itself and it is compiled into machine code. When you installed Python on your computer (or the vendor installed it), you copied a machine-code copy of the translated Python program onto your system. In Windows, the executable machine code for Python itself is likely in a file with a name like:</p>
<pre><code>C:\Python35\python.exe</code></pre>
<p>That is more than you really need to know to be a Python programmer, but sometimes it pays to answer those little nagging questions right at the beginning.</p>
<h2 id="writing-a-program">Writing a program</h2>
<p>Typing commands into the Python interpreter is a great way to experiment with Python’s features, but it is not recommended for solving more complex problems.</p>
<p>When we want to write a program, we use a text editor to write the Python instructions into a file, which is called a <em>script</em>. By convention, Python scripts have names that end with <code>.py</code>.</p>
<p></p>
<p>To execute the script, you have to tell the Python interpreter the name of the file. In a command window, you would type <code>python hello.py</code> as follows:</p>
<pre class="bash"><code>$ cat hello.py
print(&#39;Hello world!&#39;)
$ python hello.py
Hello world!</code></pre>
<p>The “$” is the operating system prompt, and the “cat hello.py” is showing us that the file “hello.py” has a one-line Python program to print a string.</p>
<p>We call the Python interpreter and tell it to read its source code from the file “hello.py” instead of prompting us for lines of Python code interactively.</p>
<p>You will notice that there was no need to have <em>quit()</em> at the end of the Python program in the file. When Python is reading your source code from a file, it knows to stop when it reaches the end of the file.</p>
<h2 id="what-is-a-program">What is a program?</h2>
<p>The definition of a <em>program</em> at its most basic is a sequence of Python statements that have been crafted to do something. Even our simple <em>hello.py</em> script is a program. It is a one-line program and is not particularly useful, but in the strictest definition, it is a Python program.</p>
<p>It might be easiest to understand what a program is by thinking about a problem that a program might be built to solve, and then looking at a program that would solve that problem.</p>
<p>Lets say you are doing Social Computing research on Facebook posts and you are interested in the most frequently used word in a series of posts. You could print out the stream of Facebook posts and pore over the text looking for the most common word, but that would take a long time and be very mistake prone. You would be smart to write a Python program to handle the task quickly and accurately so you can spend the weekend doing something fun.</p>
<p>For example, look at the following text about a clown and a car. Look at the text and figure out the most common word and how many times it occurs.</p>
<pre><code>the clown ran after the car and the car ran into the tent
and the tent fell down on the clown and the car</code></pre>
<p>Then imagine that you are doing this task looking at millions of lines of text. Frankly it would be quicker for you to learn Python and write a Python program to count the words than it would be to manually scan the words.</p>
<p>The even better news is that I already came up with a simple program to find the most common word in a text file. I wrote it, tested it, and now I am giving it to you to use so you can save some time.</p>
<pre class="python"><code>name = input(&#39;Enter file:&#39;)
handle = open(name, &#39;r&#39;)
counts = dict()

for line in handle:
    words = line.split()
    for word in words:
        counts[word] = counts.get(word, 0) + 1

bigcount = None
bigword = None
for word, count in list(counts.items()):
    if bigcount is None or count &gt; bigcount:
        bigword = word
        bigcount = count

print(bigword, bigcount)

# Code: http://www.py4e.com/code3/words.py</code></pre>
<p>You don’t even need to know Python to use this program. You will need to get through Chapter 10 of this book to fully understand the awesome Python techniques that were used to make the program. You are the end user, you simply use the program and marvel at its cleverness and how it saved you so much manual effort. You simply type the code into a file called <em>words.py</em> and run it or you download the source code from <a href="http://www.py4e.com/code3/" class="uri">http://www.py4e.com/code3/</a> and run it.</p>
<p></p>
<p>This is a good example of how Python and the Python language are acting as an intermediary between you (the end user) and me (the programmer). Python is a way for us to exchange useful instruction sequences (i.e., programs) in a common language that can be used by anyone who installs Python on their computer. So neither of us are talking <em>to Python</em>, instead we are communicating with each other <em>through</em> Python.</p>
<h2 id="the-building-blocks-of-programs">The building blocks of programs</h2>
<p>In the next few chapters, we will learn more about the vocabulary, sentence structure, paragraph structure, and story structure of Python. We will learn about the powerful capabilities of Python and how to compose those capabilities together to create useful programs.</p>
<p>There are some low-level conceptual patterns that we use to construct programs. These constructs are not just for Python programs, they are part of every programming language from machine language up to the high-level languages.</p>
<dl>
<dt>input</dt>
<dd>Get data from the “outside world”. This might be reading data from a file, or even some kind of sensor like a microphone or GPS. In our initial programs, our input will come from the user typing data on the keyboard.
</dd>
<dt>output</dt>
<dd>Display the results of the program on a screen or store them in a file or perhaps write them to a device like a speaker to play music or speak text.
</dd>
<dt>sequential execution</dt>
<dd>Perform statements one after another in the order they are encountered in the script.
</dd>
<dt>conditional execution</dt>
<dd>Check for certain conditions and then execute or skip a sequence of statements.
</dd>
<dt>repeated execution</dt>
<dd>Perform some set of statements repeatedly, usually with some variation.
</dd>
<dt>reuse</dt>
<dd>Write a set of instructions once and give them a name and then reuse those instructions as needed throughout your program.
</dd>
</dl>
<p>It sounds almost too simple to be true, and of course it is never so simple. It is like saying that walking is simply “putting one foot in front of the other”. The “art” of writing a program is composing and weaving these basic elements together many times over to produce something that is useful to its users.</p>
<p>The word counting program above directly uses all of these patterns except for one.</p>
<h2 id="what-could-possibly-go-wrong">What could possibly go wrong?</h2>
<p>As we saw in our earliest conversations with Python, we must communicate very precisely when we write Python code. The smallest deviation or mistake will cause Python to give up looking at your program.</p>
<p>Beginning programmers often take the fact that Python leaves no room for errors as evidence that Python is mean, hateful, and cruel. While Python seems to like everyone else, Python knows them personally and holds a grudge against them. Because of this grudge, Python takes our perfectly written programs and rejects them as “unfit” just to torment us.</p>
<pre class="python"><code>&gt;&gt;&gt; primt &#39;Hello world!&#39;
File &quot;&lt;stdin&gt;&quot;, line 1
  primt &#39;Hello world!&#39;
                     ^
SyntaxError: invalid syntax
&gt;&gt;&gt; primt (&#39;Hello world&#39;)
Traceback (most recent call last):
File &quot;&lt;stdin&gt;&quot;, line 1, in &lt;module&gt;
NameError: name &#39;primt&#39; is not defined

&gt;&gt;&gt; I hate you Python!
File &quot;&lt;stdin&gt;&quot;, line 1
  I hate you Python!
       ^
SyntaxError: invalid syntax
&gt;&gt;&gt; if you come out of there, I would teach you a lesson
File &quot;&lt;stdin&gt;&quot;, line 1
  if you come out of there, I would teach you a lesson
            ^
SyntaxError: invalid syntax
&gt;&gt;&gt;</code></pre>
<p>There is little to be gained by arguing with Python. It is just a tool. It has no emotions and it is happy and ready to serve you whenever you need it. Its error messages sound harsh, but they are just Python’s call for help. It has looked at what you typed, and it simply cannot understand what you have entered.</p>
<p>Python is much more like a dog, loving you unconditionally, having a few key words that it understands, looking you with a sweet look on its face (<code>&gt;&gt;&gt;</code>), and waiting for you to say something it understands. When Python says “SyntaxError: invalid syntax”, it is simply wagging its tail and saying, “You seemed to say something but I just don’t understand what you meant, but please keep talking to me (<code>&gt;&gt;&gt;</code>).”</p>
<p>As your programs become increasingly sophisticated, you will encounter three general types of errors:</p>
<dl>
<dt>Syntax errors</dt>
<dd>These are the first errors you will make and the easiest to fix. A syntax error means that you have violated the “grammar” rules of Python. Python does its best to point right at the line and character where it noticed it was confused. The only tricky bit of syntax errors is that sometimes the mistake that needs fixing is actually earlier in the program than where Python <em>noticed</em> it was confused. So the line and character that Python indicates in a syntax error may just be a starting point for your investigation.
</dd>
<dt>Logic errors</dt>
<dd>A logic error is when your program has good syntax but there is a mistake in the order of the statements or perhaps a mistake in how the statements relate to one another. A good example of a logic error might be, “take a drink from your water bottle, put it in your backpack, walk to the library, and then put the top back on the bottle.”
</dd>
<dt>Semantic errors</dt>
<dd>A semantic error is when your description of the steps to take is syntactically perfect and in the right order, but there is simply a mistake in the program. The program is perfectly correct but it does not do what you <em>intended</em> for it to do. A simple example would be if you were giving a person directions to a restaurant and said, “…when you reach the intersection with the gas station, turn left and go one mile and the restaurant is a red building on your left.” Your friend is very late and calls you to tell you that they are on a farm and walking around behind a barn, with no sign of a restaurant. Then you say “did you turn left or right at the gas station?” and they say, “I followed your directions perfectly, I have them written down, it says turn left and go one mile at the gas station.” Then you say, “I am very sorry, because while my instructions were syntactically correct, they sadly contained a small but undetected semantic error.”.
</dd>
</dl>
<p>Again in all three types of errors, Python is merely trying its hardest to do exactly what you have asked.</p>
<h2 id="debugging">Debugging</h2>
<p></p>
<p>When Python spits out an error or even when it gives you a result that is different from what you had intended, then begins the hunt for the cause of the error. Debugging is the process of finding the cause of the error in your code. When you are debugging a program, and especially if you are working on a hard bug, there are four things to try:</p>
<dl>
<dt>reading</dt>
<dd>Examine your code, read it back to yourself, and check that it says what you meant to say.
</dd>
<dt>running</dt>
<dd>Experiment by making changes and running different versions. Often if you display the right thing at the right place in the program, the problem becomes obvious, but sometimes you have to spend some time to build scaffolding.
</dd>
<dt>ruminating</dt>
<dd>Take some time to think! What kind of error is it: syntax, runtime, semantic? What information can you get from the error messages, or from the output of the program? What kind of error could cause the problem you’re seeing? What did you change last, before the problem appeared?
</dd>
<dt>retreating</dt>
<dd>At some point, the best thing to do is back off, undoing recent changes, until you get back to a program that works and that you understand. Then you can start rebuilding.
</dd>
</dl>
<p>Beginning programmers sometimes get stuck on one of these activities and forget the others. Finding a hard bug requires reading, running, ruminating, and sometimes retreating. If you get stuck on one of these activities, try the others. Each activity comes with its own failure mode.</p>
<p></p>
<p>For example, reading your code might help if the problem is a typographical error, but not if the problem is a conceptual misunderstanding. If you don’t understand what your program does, you can read it 100 times and never see the error, because the error is in your head.</p>
<p></p>
<p>Running experiments can help, especially if you run small, simple tests. But if you run experiments without thinking or reading your code, you might fall into a pattern I call “random walk programming”, which is the process of making random changes until the program does the right thing. Needless to say, random walk programming can take a long time.</p>
<p> </p>
<p>You have to take time to think. Debugging is like an experimental science. You should have at least one hypothesis about what the problem is. If there are two or more possibilities, try to think of a test that would eliminate one of them.</p>
<p>Taking a break helps with the thinking. So does talking. If you explain the problem to someone else (or even to yourself), you will sometimes find the answer before you finish asking the question.</p>
<p>But even the best debugging techniques will fail if there are too many errors, or if the code you are trying to fix is too big and complicated. Sometimes the best option is to retreat, simplifying the program until you get to something that works and that you understand.</p>
<p>Beginning programmers are often reluctant to retreat because they can’t stand to delete a line of code (even if it’s wrong). If it makes you feel better, copy your program into another file before you start stripping it down. Then you can paste the pieces back in a little bit at a time.</p>
<h2 id="the-learning-journey">The learning journey</h2>
<p>As you progress through the rest of the book, don’t be afraid if the concepts don’t seem to fit together well the first time. When you were learning to speak, it was not a problem for your first few years that you just made cute gurgling noises. And it was OK if it took six months for you to move from simple vocabulary to simple sentences and took 5-6 more years to move from sentences to paragraphs, and a few more years to be able to write an interesting complete short story on your own.</p>
<p>We want you to learn Python much more rapidly, so we teach it all at the same time over the next few chapters. But it is like learning a new language that takes time to absorb and understand before it feels natural. That leads to some confusion as we visit and revisit topics to try to get you to see the big picture while we are defining the tiny fragments that make up that big picture. While the book is written linearly, and if you are taking a course it will progress in a linear fashion, don’t hesitate to be very nonlinear in how you approach the material. Look forwards and backwards and read with a light touch. By skimming more advanced material without fully understanding the details, you can get a better understanding of the “why?” of programming. By reviewing previous material and even redoing earlier exercises, you will realize that you actually learned a lot of material even if the material you are currently staring at seems a bit impenetrable.</p>
<p>Usually when you are learning your first programming language, there are a few wonderful “Ah Hah!” moments where you can look up from pounding away at some rock with a hammer and chisel and step away and see that you are indeed building a beautiful sculpture.</p>
<p>If something seems particularly hard, there is usually no value in staying up all night and staring at it. Take a break, take a nap, have a snack, explain what you are having a problem with to someone (or perhaps your dog), and then come back to it with fresh eyes. I assure you that once you learn the programming concepts in the book you will look back and see that it was all really easy and elegant and it simply took you a bit of time to absorb it.</p>
<h2 id="glossary">Glossary</h2>
<dl>
<dt>bug</dt>
<dd>An error in a program.
</dd>
<dt>central processing unit</dt>
<dd>The heart of any computer. It is what runs the software that we write; also called “CPU” or “the processor”.
</dd>
<dt>compile</dt>
<dd>To translate a program written in a high-level language into a low-level language all at once, in preparation for later execution.
</dd>
<dt>high-level language</dt>
<dd>A programming language like Python that is designed to be easy for humans to read and write.
</dd>
<dt>interactive mode</dt>
<dd>A way of using the Python interpreter by typing commands and expressions at the prompt.
</dd>
<dt>interpret</dt>
<dd>To execute a program in a high-level language by translating it one line at a time.
</dd>
<dt>low-level language</dt>
<dd>A programming language that is designed to be easy for a computer to execute; also called “machine code” or “assembly language”.
</dd>
<dt>machine code</dt>
<dd>The lowest-level language for software, which is the language that is directly executed by the central processing unit (CPU).
</dd>
<dt>main memory</dt>
<dd>Stores programs and data. Main memory loses its information when the power is turned off.
</dd>
<dt>parse</dt>
<dd>To examine a program and analyze the syntactic structure.
</dd>
<dt>portability</dt>
<dd>A property of a program that can run on more than one kind of computer.
</dd>
<dt>print function</dt>
<dd>An instruction that causes the Python interpreter to display a value on the screen.
</dd>
<dt>problem solving</dt>
<dd>The process of formulating a problem, finding a solution, and expressing the solution.
</dd>
<dt>program</dt>
<dd>A set of instructions that specifies a computation.
</dd>
<dt>prompt</dt>
<dd>When a program displays a message and pauses for the user to type some input to the program.
</dd>
<dt>secondary memory</dt>
<dd>Stores programs and data and retains its information even when the power is turned off. Generally slower than main memory. Examples of secondary memory include disk drives and flash memory in USB sticks.
</dd>
<dt>semantics</dt>
<dd>The meaning of a program.
</dd>
<dt>semantic error</dt>
<dd>An error in a program that makes it do something other than what the programmer intended.
</dd>
<dt>source code</dt>
<dd>A program in a high-level language.
</dd>
</dl>
<h2 id="exercises">Exercises</h2>
<p><strong>Exercise 1: What is the function of the secondary memory in a computer?</strong></p>
<p>a) Execute all of the computation and logic of the program<br />
b) Retrieve web pages over the Internet<br />
c) Store information for the long term, even beyond a power cycle<br />
d) Take input from the user</p>
<p><strong>Exercise 2: What is a program?</strong></p>
<p><strong>Exercise 3: What is the difference between a compiler and an interpreter?</strong></p>
<p><strong>Exercise 4: Which of the following contains “machine code”?</strong></p>
<p>a) The Python interpreter<br />
b) The keyboard<br />
c) Python source file<br />
d) A word processing document</p>
<p><strong>Exercise 5: What is wrong with the following code:</strong></p>
<pre class="python"><code>&gt;&gt;&gt; primt &#39;Hello world!&#39;
File &quot;&lt;stdin&gt;&quot;, line 1
  primt &#39;Hello world!&#39;
                     ^
SyntaxError: invalid syntax
&gt;&gt;&gt;</code></pre>
<p><strong>Exercise 6: Where in the computer is a variable such as “x” stored after the following Python line finishes?</strong></p>
<pre class="python"><code>x = 123</code></pre>
<p>a) Central processing unit<br />
b) Main Memory<br />
c) Secondary Memory<br />
d) Input Devices<br />
e) Output Devices</p>
<p><strong>Exercise 7: What will the following program print out:</strong></p>
<pre class="python"><code>x = 43
x = x + 1
print(x)</code></pre>
<p>a) 43<br />
b) 44<br />
c) x + 1<br />
d) Error because x = x + 1 is not possible mathematically</p>
<p><strong>Exercise 8: Explain each of the following using an example of a human capability: (1) Central processing unit, (2) Main Memory, (3) Secondary Memory, (4) Input Device, and (5) Output Device. For example, “What is the human equivalent to a Central Processing Unit”?</strong></p>
<p><strong>Exercise 9: How do you fix a “Syntax Error”?</strong></p>
<section class="footnotes" role="doc-endnotes">
<hr />
<ol>
<li id="fn1" role="doc-endnote"><p><a href="http://xkcd.com/231/" class="uri">http://xkcd.com/231/</a><a href="#fnref1" class="footnote-back" role="doc-backlink">↩︎</a></p></li>
</ol>
</section>
</body>
</html>
<?php if ( file_exists("../bookfoot.php") ) {
  $HTML_FILE = basename(__FILE__);
  $HTML = ob_get_contents();
  ob_end_clean();
  require_once "../bookfoot.php";
}?>
