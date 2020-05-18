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
    code{white-space: pre-wrap;}
    span.smallcaps{font-variant: small-caps;}
    span.underline{text-decoration: underline;}
    div.column{display: inline-block; vertical-align: top; width: 50%;}
    div.hanging-indent{margin-left: 1.5em; text-indent: -1.5em;}
    ul.task-list{list-style: none;}
  </style>
  <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv-printshiv.min.js"></script>
  <![endif]-->
</head>
<body>
<h1 id="functions">Functions</h1>
<h2 id="function-calls">Function calls</h2>
<p></p>
<p>In the context of programming, a <em>function</em> is a named sequence of statements that performs a computation. When you define a function, you specify the name and the sequence of statements. Later, you can “call” the function by name. We have already seen one example of a <em>function call</em>:</p>
<pre class="python"><code>&gt;&gt;&gt; type(32)
&lt;class &#39;int&#39;&gt;</code></pre>
<p>The name of the function is <code>type</code>. The expression in parentheses is called the <em>argument</em> of the function. The argument is a value or variable that we are passing into the function as input to the function. The result, for the <code>type</code> function, is the type of the argument.</p>
<p></p>
<p>It is common to say that a function “takes” an argument and “returns” a result. The result is called the <em>return value</em>.</p>
<p> </p>
<h2 id="built-in-functions">Built-in functions</h2>
<p>Python provides a number of important built-in functions that we can use without needing to provide the function definition. The creators of Python wrote a set of functions to solve common problems and included them in Python for us to use.</p>
<p>The <code>max</code> and <code>min</code> functions give us the largest and smallest values in a list, respectively:</p>
<pre class="python"><code>&gt;&gt;&gt; max(&#39;Hello world&#39;)
&#39;w&#39;
&gt;&gt;&gt; min(&#39;Hello world&#39;)
&#39; &#39;
&gt;&gt;&gt;</code></pre>
<p>The <code>max</code> function tells us the “largest character” in the string (which turns out to be the letter “w”) and the <code>min</code> function shows us the smallest character (which turns out to be a space).</p>
<p>Another very common built-in function is the <code>len</code> function which tells us how many items are in its argument. If the argument to <code>len</code> is a string, it returns the number of characters in the string.</p>
<pre class="python"><code>&gt;&gt;&gt; len(&#39;Hello world&#39;)
11
&gt;&gt;&gt;</code></pre>
<p>These functions are not limited to looking at strings. They can operate on any set of values, as we will see in later chapters.</p>
<p>You should treat the names of built-in functions as reserved words (i.e., avoid using “max” as a variable name).</p>
<h2 id="type-conversion-functions">Type conversion functions</h2>
<p> </p>
<p>Python also provides built-in functions that convert values from one type to another. The <code>int</code> function takes any value and converts it to an integer, if it can, or complains otherwise:</p>
<p> </p>
<pre class="python"><code>&gt;&gt;&gt; int(&#39;32&#39;)
32
&gt;&gt;&gt; int(&#39;Hello&#39;)
ValueError: invalid literal for int() with base 10: &#39;Hello&#39;</code></pre>
<p><code>int</code> can convert floating-point values to integers, but it doesn’t round off; it chops off the fraction part:</p>
<pre class="python"><code>&gt;&gt;&gt; int(3.99999)
3
&gt;&gt;&gt; int(-2.3)
-2</code></pre>
<p><code>float</code> converts integers and strings to floating-point numbers:</p>
<p> </p>
<pre class="python"><code>&gt;&gt;&gt; float(32)
32.0
&gt;&gt;&gt; float(&#39;3.14159&#39;)
3.14159</code></pre>
<p>Finally, <code>str</code> converts its argument to a string:</p>
<p> </p>
<pre class="python"><code>&gt;&gt;&gt; str(32)
&#39;32&#39;
&gt;&gt;&gt; str(3.14159)
&#39;3.14159&#39;</code></pre>
<h2 id="math-functions">Math functions</h2>
<p>   </p>
<p>Python has a <code>math</code> module that provides most of the familiar mathematical functions. Before we can use the module, we have to import it:</p>
<pre class="python"><code>&gt;&gt;&gt; import math</code></pre>
<p>This statement creates a <em>module object</em> named math. If you print the module object, you get some information about it:</p>
<pre class="python"><code>&gt;&gt;&gt; print(math)
&lt;module &#39;math&#39; (built-in)&gt;</code></pre>
<p>The module object contains the functions and variables defined in the module. To access one of the functions, you have to specify the name of the module and the name of the function, separated by a dot (also known as a period). This format is called <em>dot notation</em>.</p>
<p></p>
<pre class="python"><code>&gt;&gt;&gt; ratio = signal_power / noise_power
&gt;&gt;&gt; decibels = 10 * math.log10(ratio)

&gt;&gt;&gt; radians = 0.7
&gt;&gt;&gt; height = math.sin(radians)</code></pre>
<p>The first example computes the logarithm base 10 of the signal-to-noise ratio. The math module also provides a function called <code>log</code> that computes logarithms base e.</p>
<p>     </p>
<p>The second example finds the sine of <code>radians</code>. The name of the variable is a hint that <code>sin</code> and the other trigonometric functions (<code>cos</code>, <code>tan</code>, etc.) take arguments in radians. To convert from degrees to radians, divide by 360 and multiply by <span class="math inline">2<em>π</em></span>:</p>
<pre class="python"><code>&gt;&gt;&gt; degrees = 45
&gt;&gt;&gt; radians = degrees / 360.0 * 2 * math.pi
&gt;&gt;&gt; math.sin(radians)
0.7071067811865476</code></pre>
<p>The expression <code>math.pi</code> gets the variable <code>pi</code> from the math module. The value of this variable is an approximation of <span class="math inline"><em>π</em></span>, accurate to about 15 digits.</p>
<p></p>
<p>If you know your trigonometry, you can check the previous result by comparing it to the square root of two divided by two:</p>
<p> </p>
<pre class="python"><code>&gt;&gt;&gt; math.sqrt(2) / 2.0
0.7071067811865476</code></pre>
<h2 id="random-numbers">Random numbers</h2>
<p>   </p>
<p>Given the same inputs, most computer programs generate the same outputs every time, so they are said to be <em>deterministic</em>. Determinism is usually a good thing, since we expect the same calculation to yield the same result. For some applications, though, we want the computer to be unpredictable. Games are an obvious example, but there are more.</p>
<p>Making a program truly nondeterministic turns out to be not so easy, but there are ways to make it at least seem nondeterministic. One of them is to use <em>algorithms</em> that generate <em>pseudorandom</em> numbers. Pseudorandom numbers are not truly random because they are generated by a deterministic computation, but just by looking at the numbers it is all but impossible to distinguish them from random.</p>
<p> </p>
<p>The <code>random</code> module provides functions that generate pseudorandom numbers (which I will simply call “random” from here on).</p>
<p> </p>
<p>The function <code>random</code> returns a random float between 0.0 and 1.0 (including 0.0 but not 1.0). Each time you call <code>random</code>, you get the next number in a long series. To see a sample, run this loop:</p>
<pre class="python"><code>import random

for i in range(10):
    x = random.random()
    print(x)</code></pre>
<p>This program produces the following list of 10 random numbers between 0.0 and up to but not including 1.0.</p>
<pre><code>0.11132867921152356
0.5950949227890241
0.04820265884996877
0.841003109276478
0.997914947094958
0.04842330803368111
0.7416295948208405
0.510535245390327
0.27447040171978143
0.028511805472785867</code></pre>
<p><strong>Exercise 1: Run the program on your system and see what numbers you get. Run the program more than once and see what numbers you get.</strong></p>
<p>The <code>random</code> function is only one of many functions that handle random numbers. The function <code>randint</code> takes the parameters <code>low</code> and <code>high</code>, and returns an integer between <code>low</code> and <code>high</code> (including both).</p>
<p> </p>
<pre class="python"><code>&gt;&gt;&gt; random.randint(5, 10)
5
&gt;&gt;&gt; random.randint(5, 10)
9</code></pre>
<p>To choose an element from a sequence at random, you can use <code>choice</code>:</p>
<p> </p>
<pre class="python"><code>&gt;&gt;&gt; t = [1, 2, 3]
&gt;&gt;&gt; random.choice(t)
2
&gt;&gt;&gt; random.choice(t)
3</code></pre>
<p>The <code>random</code> module also provides functions to generate random values from continuous distributions including Gaussian, exponential, gamma, and a few more.</p>
<h2 id="adding-new-functions">Adding new functions</h2>
<p>So far, we have only been using the functions that come with Python, but it is also possible to add new functions. A <em>function definition</em> specifies the name of a new function and the sequence of statements that execute when the function is called. Once we define a function, we can reuse the function over and over throughout our program.</p>
<p>  </p>
<p>Here is an example:</p>
<pre class="python"><code>def print_lyrics():
    print(&quot;I&#39;m a lumberjack, and I&#39;m okay.&quot;)
    print(&#39;I sleep all night and I work all day.&#39;)</code></pre>
<p><code>def</code> is a keyword that indicates that this is a function definition. The name of the function is <code>print_lyrics</code>. The rules for function names are the same as for variable names: letters, numbers and some punctuation marks are legal, but the first character can’t be a number. You can’t use a keyword as the name of a function, and you should avoid having a variable and a function with the same name.</p>
<p>  </p>
<p>The empty parentheses after the name indicate that this function doesn’t take any arguments. Later we will build functions that take arguments as their inputs.</p>
<p>    </p>
<p>The first line of the function definition is called the <em>header</em>; the rest is called the <em>body</em>. The header has to end with a colon and the body has to be indented. By convention, the indentation is always four spaces. The body can contain any number of statements.</p>
<p></p>
<p>If you type a function definition in interactive mode, the interpreter prints ellipses (<em>…</em>) to let you know that the definition isn’t complete:</p>
<pre class="python"><code>&gt;&gt;&gt; def print_lyrics():
...     print(&quot;I&#39;m a lumberjack, and I&#39;m okay.&quot;)
...     print(&#39;I sleep all night and I work all day.&#39;)
...</code></pre>
<p>To end the function, you have to enter an empty line (this is not necessary in a script).</p>
<p>Defining a function creates a variable with the same name.</p>
<pre class="python"><code>&gt;&gt;&gt; print(print_lyrics)
&lt;function print_lyrics at 0xb7e99e9c&gt;
&gt;&gt;&gt; print(type(print_lyrics))
&lt;class &#39;function&#39;&gt;</code></pre>
<p>The value of <code>print_lyrics</code> is a <em>function object</em>, which has type “function”.</p>
<p> </p>
<p>The syntax for calling the new function is the same as for built-in functions:</p>
<pre class="python"><code>&gt;&gt;&gt; print_lyrics()
I&#39;m a lumberjack, and I&#39;m okay.
I sleep all night and I work all day.</code></pre>
<p>Once you have defined a function, you can use it inside another function. For example, to repeat the previous refrain, we could write a function called <code>repeat_lyrics</code>:</p>
<pre class="python"><code>def repeat_lyrics():
    print_lyrics()
    print_lyrics()</code></pre>
<p>And then call <code>repeat_lyrics</code>:</p>
<pre class="python"><code>&gt;&gt;&gt; repeat_lyrics()
I&#39;m a lumberjack, and I&#39;m okay.
I sleep all night and I work all day.
I&#39;m a lumberjack, and I&#39;m okay.
I sleep all night and I work all day.</code></pre>
<p>But that’s not really how the song goes.</p>
<h2 id="definitions-and-uses">Definitions and uses</h2>
<p></p>
<p>Pulling together the code fragments from the previous section, the whole program looks like this:</p>
<pre class="python"><code>def print_lyrics():
    print(&quot;I&#39;m a lumberjack, and I&#39;m okay.&quot;)
    print(&#39;I sleep all night and I work all day.&#39;)


def repeat_lyrics():
    print_lyrics()
    print_lyrics()

repeat_lyrics()

# Code: http://www.py4e.com/code3/lyrics.py</code></pre>
<p>This program contains two function definitions: <code>print_lyrics</code> and <code>repeat_lyrics</code>. Function definitions get executed just like other statements, but the effect is to create function objects. The statements inside the function do not get executed until the function is called, and the function definition generates no output.</p>
<p></p>
<p>As you might expect, you have to create a function before you can execute it. In other words, the function definition has to be executed before the first time it is called.</p>
<p><strong>Exercise 2: Move the last line of this program to the top, so the function call appears before the definitions. Run the program and see what error message you get.</strong></p>
<p><strong>Exercise 3: Move the function call back to the bottom and move the definition of <code>print_lyrics</code> after the definition of <code>repeat_lyrics</code>. What happens when you run this program?</strong></p>
<h2 id="flow-of-execution">Flow of execution</h2>
<p></p>
<p>In order to ensure that a function is defined before its first use, you have to know the order in which statements are executed, which is called the <em>flow of execution</em>.</p>
<p>Execution always begins at the first statement of the program. Statements are executed one at a time, in order from top to bottom.</p>
<p>Function <em>definitions</em> do not alter the flow of execution of the program, but remember that statements inside the function are not executed until the function is called.</p>
<p>A function call is like a detour in the flow of execution. Instead of going to the next statement, the flow jumps to the body of the function, executes all the statements there, and then comes back to pick up where it left off.</p>
<p>That sounds simple enough, until you remember that one function can call another. While in the middle of one function, the program might have to execute the statements in another function. But while executing that new function, the program might have to execute yet another function!</p>
<p>Fortunately, Python is good at keeping track of where it is, so each time a function completes, the program picks up where it left off in the function that called it. When it gets to the end of the program, it terminates.</p>
<p>What’s the moral of this sordid tale? When you read a program, you don’t always want to read from top to bottom. Sometimes it makes more sense if you follow the flow of execution.</p>
<h2 id="parameters-and-arguments">Parameters and arguments</h2>
<p>   </p>
<p>Some of the built-in functions we have seen require arguments. For example, when you call <code>math.sin</code> you pass a number as an argument. Some functions take more than one argument: <code>math.pow</code> takes two, the base and the exponent.</p>
<p>Inside the function, the arguments are assigned to variables called <em>parameters</em>. Here is an example of a user-defined function that takes an argument:</p>
<p></p>
<pre class="python"><code>def print_twice(bruce):
    print(bruce)
    print(bruce)</code></pre>
<p>This function assigns the argument to a parameter named <code>bruce</code>. When the function is called, it prints the value of the parameter (whatever it is) twice.</p>
<p>This function works with any value that can be printed.</p>
<pre class="python"><code>&gt;&gt;&gt; print_twice(&#39;Spam&#39;)
Spam
Spam
&gt;&gt;&gt; print_twice(17)
17
17
&gt;&gt;&gt; import math
&gt;&gt;&gt; print_twice(math.pi)
3.141592653589793
3.141592653589793</code></pre>
<p>The same rules of composition that apply to built-in functions also apply to user-defined functions, so we can use any kind of expression as an argument for <code>print_twice</code>:</p>
<p></p>
<pre class="python"><code>&gt;&gt;&gt; print_twice(&#39;Spam &#39;*4)
Spam Spam Spam Spam
Spam Spam Spam Spam
&gt;&gt;&gt; print_twice(math.cos(math.pi))
-1.0
-1.0</code></pre>
<p>The argument is evaluated before the function is called, so in the examples the expressions <code>'Spam '*4</code> and <code>math.cos(math.pi)</code> are only evaluated once.</p>
<p></p>
<p>You can also use a variable as an argument:</p>
<pre class="python"><code>&gt;&gt;&gt; michael = &#39;Eric, the half a bee.&#39;
&gt;&gt;&gt; print_twice(michael)
Eric, the half a bee.
Eric, the half a bee.</code></pre>
<p>The name of the variable we pass as an argument (<code>michael</code>) has nothing to do with the name of the parameter (<code>bruce</code>). It doesn’t matter what the value was called back home (in the caller); here in <code>print_twice</code>, we call everybody <code>bruce</code>.</p>
<h2 id="fruitful-functions-and-void-functions">Fruitful functions and void functions</h2>
<p>   </p>
<p>Some of the functions we are using, such as the math functions, yield results; for lack of a better name, I call them <em>fruitful functions</em>. Other functions, like <code>print_twice</code>, perform an action but don’t return a value. They are called <em>void functions</em>.</p>
<p>When you call a fruitful function, you almost always want to do something with the result; for example, you might assign it to a variable or use it as part of an expression:</p>
<pre class="python"><code>x = math.cos(radians)
golden = (math.sqrt(5) + 1) / 2</code></pre>
<p>When you call a function in interactive mode, Python displays the result:</p>
<pre class="python"><code>&gt;&gt;&gt; math.sqrt(5)
2.23606797749979</code></pre>
<p>But in a script, if you call a fruitful function and do not store the result of the function in a variable, the return value vanishes into the mist!</p>
<pre class="python"><code>math.sqrt(5)</code></pre>
<p>This script computes the square root of 5, but since it doesn’t store the result in a variable or display the result, it is not very useful.</p>
<p> </p>
<p>Void functions might display something on the screen or have some other effect, but they don’t have a return value. If you try to assign the result to a variable, you get a special value called <code>None</code>.</p>
<p> </p>
<pre class="python"><code>&gt;&gt;&gt; result = print_twice(&#39;Bing&#39;)
Bing
Bing
&gt;&gt;&gt; print(result)
None</code></pre>
<p>The value <code>None</code> is not the same as the string “None”. It is a special value that has its own type:</p>
<pre class="python"><code>&gt;&gt;&gt; print(type(None))
&lt;class &#39;NoneType&#39;&gt;</code></pre>
<p>To return a result from a function, we use the <code>return</code> statement in our function. For example, we could make a very simple function called <code>addtwo</code> that adds two numbers together and returns a result.</p>
<pre class="python"><code>def addtwo(a, b):
    added = a + b
    return added

x = addtwo(3, 5)
print(x)

# Code: http://www.py4e.com/code3/addtwo.py</code></pre>
<p>When this script executes, the <code>print</code> statement will print out “8” because the <code>addtwo</code> function was called with 3 and 5 as arguments. Within the function, the parameters <code>a</code> and <code>b</code> were 3 and 5 respectively. The function computed the sum of the two numbers and placed it in the local function variable named <code>added</code>. Then it used the <code>return</code> statement to send the computed value back to the calling code as the function result, which was assigned to the variable <code>x</code> and printed out.</p>
<h2 id="why-functions">Why functions?</h2>
<p></p>
<p>It may not be clear why it is worth the trouble to divide a program into functions. There are several reasons:</p>
<ul>
<li><p>Creating a new function gives you an opportunity to name a group of statements, which makes your program easier to read, understand, and debug.</p></li>
<li><p>Functions can make a program smaller by eliminating repetitive code. Later, if you make a change, you only have to make it in one place.</p></li>
<li><p>Dividing a long program into functions allows you to debug the parts one at a time and then assemble them into a working whole.</p></li>
<li><p>Well-designed functions are often useful for many programs. Once you write and debug one, you can reuse it.</p></li>
</ul>
<p>Throughout the rest of the book, often we will use a function definition to explain a concept. Part of the skill of creating and using functions is to have a function properly capture an idea such as “find the smallest value in a list of values”. Later we will show you code that finds the smallest in a list of values and we will present it to you as a function named <code>min</code> which takes a list of values as its argument and returns the smallest value in the list.</p>
<h2 id="debugging">Debugging</h2>
<p></p>
<p>If you are using a text editor to write your scripts, you might run into problems with spaces and tabs. The best way to avoid these problems is to use spaces exclusively (no tabs). Most text editors that know about Python do this by default, but some don’t.</p>
<p></p>
<p>Tabs and spaces are usually invisible, which makes them hard to debug, so try to find an editor that manages indentation for you.</p>
<p>Also, don’t forget to save your program before you run it. Some development environments do this automatically, but some don’t. In that case, the program you are looking at in the text editor is not the same as the program you are running.</p>
<p>Debugging can take a long time if you keep running the same incorrect program over and over!</p>
<p>Make sure that the code you are looking at is the code you are running. If you’re not sure, put something like <code>print("hello")</code> at the beginning of the program and run it again. If you don’t see <code>hello</code>, you’re not running the right program!</p>
<h2 id="glossary">Glossary</h2>
<dl>
<dt>algorithm</dt>
<dd>A general process for solving a category of problems.
</dd>
<dt>argument</dt>
<dd>A value provided to a function when the function is called. This value is assigned to the corresponding parameter in the function.
</dd>
<dt>body</dt>
<dd>The sequence of statements inside a function definition.
</dd>
<dt>composition</dt>
<dd>Using an expression as part of a larger expression, or a statement as part of a larger statement.
</dd>
<dt>deterministic</dt>
<dd>Pertaining to a program that does the same thing each time it runs, given the same inputs.
</dd>
<dt>dot notation</dt>
<dd>The syntax for calling a function in another module by specifying the module name followed by a dot (period) and the function name.
</dd>
<dt>flow of execution</dt>
<dd>The order in which statements are executed during a program run.
</dd>
<dt>fruitful function</dt>
<dd>A function that returns a value.
</dd>
<dt>function</dt>
<dd>A named sequence of statements that performs some useful operation. Functions may or may not take arguments and may or may not produce a result.
</dd>
<dt>function call</dt>
<dd>A statement that executes a function. It consists of the function name followed by an argument list.
</dd>
<dt>function definition</dt>
<dd>A statement that creates a new function, specifying its name, parameters, and the statements it executes.
</dd>
<dt>function object</dt>
<dd>A value created by a function definition. The name of the function is a variable that refers to a function object.
</dd>
<dt>header</dt>
<dd>The first line of a function definition.
</dd>
<dt>import statement</dt>
<dd>A statement that reads a module file and creates a module object.
</dd>
<dt>module object</dt>
<dd>A value created by an <code>import</code> statement that provides access to the data and code defined in a module.
</dd>
<dt>parameter</dt>
<dd>A name used inside a function to refer to the value passed as an argument.
</dd>
<dt>pseudorandom</dt>
<dd>Pertaining to a sequence of numbers that appear to be random, but are generated by a deterministic program.
</dd>
<dt>return value</dt>
<dd>The result of a function. If a function call is used as an expression, the return value is the value of the expression.
</dd>
<dt>void function</dt>
<dd>A function that does not return a value.
</dd>
</dl>
<h2 id="exercises">Exercises</h2>
<p><strong>Exercise 4: What is the purpose of the “def” keyword in Python?</strong></p>
<p>a) It is slang that means “the following code is really cool”<br />
b) It indicates the start of a function<br />
c) It indicates that the following indented section of code is to be stored for later<br />
d) b and c are both true<br />
e) None of the above</p>
<p><strong>Exercise 5: What will the following Python program print out?</strong></p>
<pre class="python"><code>def fred():
   print(&quot;Zap&quot;)

def jane():
   print(&quot;ABC&quot;)

jane()
fred()
jane()</code></pre>
<p>a) Zap ABC jane fred jane<br />
b) Zap ABC Zap<br />
c) ABC Zap jane<br />
d) ABC Zap ABC<br />
e) Zap Zap Zap</p>
<p><strong>Exercise 6: Rewrite your pay computation with time-and-a-half for overtime and create a function called <code>computepay</code> which takes two parameters (<code>hours</code> and <code>rate</code>).</strong></p>
<pre><code>Enter Hours: 45
Enter Rate: 10
Pay: 475.0</code></pre>
<p><strong>Exercise 7: Rewrite the grade program from the previous chapter using a function called <code>computegrade</code> that takes a score as its parameter and returns a grade as a string.</strong></p>
<pre><code> Score   Grade
&gt;= 0.9     A
&gt;= 0.8     B
&gt;= 0.7     C
&gt;= 0.6     D
 &lt; 0.6     F</code></pre>
<pre><code>Enter score: 0.95
A</code></pre>
<pre><code>Enter score: perfect
Bad score</code></pre>
<pre><code>Enter score: 10.0
Bad score</code></pre>
<pre><code>Enter score: 0.75
C</code></pre>
<pre><code>Enter score: 0.5
F</code></pre>
<p>Run the program repeatedly to test the various different values for input.</p>
</body>
</html>
<?php if ( file_exists("../bookfoot.php") ) {
  $HTML_FILE = basename(__FILE__);
  $HTML = ob_get_contents();
  ob_end_clean();
  require_once "../bookfoot.php";
}?>
