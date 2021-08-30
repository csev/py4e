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
<h1 id="conditional-execution">Conditional execution</h1>
<h2 id="boolean-expressions">Boolean expressions</h2>
<p>   </p>
<p>A <em>boolean expression</em> is an expression that is either true or false. The following examples use the operator <code>==</code>, which compares two operands and produces <code>True</code> if they are equal and <code>False</code> otherwise:</p>
<pre class="python trinket"><code>&gt;&gt;&gt; 5 == 5
True
&gt;&gt;&gt; 5 == 6
False</code></pre>
<p><code>True</code> and <code>False</code> are special values that belong to the class <code>bool</code>; they are not strings:</p>
<p>     </p>
<pre class="python"><code>&gt;&gt;&gt; type(True)
&lt;class &#39;bool&#39;&gt;
&gt;&gt;&gt; type(False)
&lt;class &#39;bool&#39;&gt;</code></pre>
<p>The <code>==</code> operator is one of the <em>comparison operators</em>; the others are:</p>
<pre class="python"><code>x != y               # x is not equal to y
x &gt; y                # x is greater than y
x &lt; y                # x is less than y
x &gt;= y               # x is greater than or equal to y
x &lt;= y               # x is less than or equal to y
x is y               # x is the same as y
x is not y           # x is not the same as y</code></pre>
<p>Although these operations are probably familiar to you, the Python symbols are different from the mathematical symbols for the same operations. A common error is to use a single equal sign (<code>=</code>) instead of a double equal sign (<code>==</code>). Remember that <code>=</code> is an assignment operator and <code>==</code> is a comparison operator. There is no such thing as <code>=&lt;</code> or <code>=&gt;</code>.</p>
<p> </p>
<h2 id="logical-operators">Logical operators</h2>
<p> </p>
<p>There are three <em>logical operators</em>: <code>and</code>, <code>or</code>, and <code>not</code>. The semantics (meaning) of these operators is similar to their meaning in English. For example,</p>
<p><code>x &gt; 0 and x &lt; 10</code></p>
<p>is true only if <code>x</code> is greater than 0 <em>and</em> less than 10.</p>
<p>     </p>
<p><code>n%2 == 0 or n%3 == 0</code> is true if <em>either</em> of the conditions is true, that is, if the number is divisible by 2 <em>or</em> 3.</p>
<p>Finally, the <code>not</code> operator negates a boolean expression, so <code>not (x &gt; y)</code> is true if <code>x &gt; y</code> is false; that is, if <code>x</code> is less than or equal to <code>y</code>.</p>
<p>Strictly speaking, the operands of the logical operators should be boolean expressions, but Python is not very strict. Any nonzero number is interpreted as “true.”</p>
<pre class="python"><code>&gt;&gt;&gt; 17 and True
True</code></pre>
<p>This flexibility can be useful, but there are some subtleties to it that might be confusing. You might want to avoid it until you are sure you know what you are doing.</p>
<h2 id="conditional-execution-1">Conditional execution</h2>
<p>    </p>
<p>In order to write useful programs, we almost always need the ability to check conditions and change the behavior of the program accordingly. <em>Conditional statements</em> give us this ability. The simplest form is the <code>if</code> statement:</p>
<pre class="python"><code>if x &gt; 0 :
    print(&#39;x is positive&#39;)</code></pre>
<p>The boolean expression after the <code>if</code> statement is called the <em>condition</em>. We end the <code>if</code> statement with a colon character (:) and the line(s) after the if statement are indented.</p>
<figure>
<img src="../images/if.svg" alt="If Logic" style="height: 1.5in;"/>
<figcaption>
If Logic
</figcaption>
</figure>
<p>If the logical condition is true, then the indented statement gets executed. If the logical condition is false, the indented statement is skipped.</p>
<p>  </p>
<p><code>if</code> statements have the same structure as function definitions or <code>for</code> loops<a href="#fn1" class="footnote-ref" id="fnref1" role="doc-noteref"><sup>1</sup></a>. The statement consists of a header line that ends with the colon character (:) followed by an indented block. Statements like this are called <em>compound statements</em> because they stretch across more than one line.</p>
<p>There is no limit on the number of statements that can appear in the body, but there must be at least one. Occasionally, it is useful to have a body with no statements (usually as a place holder for code you haven’t written yet). In that case, you can use the <code>pass</code> statement, which does nothing.</p>
<p> </p>
<pre class="python"><code>if x &lt; 0 :
    pass          # need to handle negative values!</code></pre>
<p>If you enter an <code>if</code> statement in the Python interpreter, the prompt will change from three chevrons to three dots to indicate you are in the middle of a block of statements, as shown below:</p>
<pre class="python"><code>&gt;&gt;&gt; x = 3
&gt;&gt;&gt; if x &lt; 10:
...    print(&#39;Small&#39;)
...
Small
&gt;&gt;&gt;</code></pre>
<p>When using the Python interpreter, you must leave a blank line at the end of a block, otherwise Python will return an error:</p>
<pre class="python"><code>&gt;&gt;&gt; x = 3
&gt;&gt;&gt; if x &lt; 10:
...    print(&#39;Small&#39;)
... print(&#39;Done&#39;)
  File &quot;&lt;stdin&gt;&quot;, line 3
    print(&#39;Done&#39;)
        ^
SyntaxError: invalid syntax</code></pre>
<p>A blank line at the end of a block of statements is not necessary when writing and executing a script, but it may improve readability of your code.</p>
<h2 id="alternative-execution">Alternative execution</h2>
<p>  </p>
<p>A second form of the <code>if</code> statement is <em>alternative execution</em>, in which there are two possibilities and the condition determines which one gets executed. The syntax looks like this:</p>
<pre class="python"><code>if x%2 == 0 :
    print(&#39;x is even&#39;)
else :
    print(&#39;x is odd&#39;)</code></pre>
<p>If the remainder when <code>x</code> is divided by 2 is 0, then we know that <code>x</code> is even, and the program displays a message to that effect. If the condition is false, the second set of statements is executed.</p>
<figure>
<img src="../images/if-else.svg" alt="If-Then-Else Logic" style="height: 1.5in;"/>
<figcaption>
If-Then-Else Logic
</figcaption>
</figure>
<p>Since the condition must either be true or false, exactly one of the alternatives will be executed. The alternatives are called <em>branches</em>, because they are branches in the flow of execution.</p>
<p></p>
<h2 id="chained-conditionals">Chained conditionals</h2>
<p> </p>
<p>Sometimes there are more than two possibilities and we need more than two branches. One way to express a computation like that is a <em>chained conditional</em>:</p>
<pre class="python"><code>if x &lt; y:
    print(&#39;x is less than y&#39;)
elif x &gt; y:
    print(&#39;x is greater than y&#39;)
else:
    print(&#39;x and y are equal&#39;)</code></pre>
<p><code>elif</code> is an abbreviation of “else if.” Again, exactly one branch will be executed.</p>
<figure>
<img src="../images/elif.svg" alt="If-Then-ElseIf Logic" style="height: 2.0in;"/>
<figcaption>
If-Then-ElseIf Logic
</figcaption>
</figure>
<p>There is no limit on the number of <code>elif</code> statements. If there is an <code>else</code> clause, it has to be at the end, but there doesn’t have to be one.</p>
<p> </p>
<pre class="python"><code>if choice == &#39;a&#39;:
    print(&#39;Bad guess&#39;)
elif choice == &#39;b&#39;:
    print(&#39;Good guess&#39;)
elif choice == &#39;c&#39;:
    print(&#39;Close, but not correct&#39;)</code></pre>
<p>Each condition is checked in order. If the first is false, the next is checked, and so on. If one of them is true, the corresponding branch executes, and the statement ends. Even if more than one condition is true, only the first true branch executes.</p>
<h2 id="nested-conditionals">Nested conditionals</h2>
<p> </p>
<p>One conditional can also be nested within another. We could have written the three-branch example like this:</p>
<pre class="python"><code>if x == y:
    print(&#39;x and y are equal&#39;)
else:
    if x &lt; y:
        print(&#39;x is less than y&#39;)
    else:
        print(&#39;x is greater than y&#39;)</code></pre>
<p>The outer conditional contains two branches. The first branch contains a simple statement. The second branch contains another <code>if</code> statement, which has two branches of its own. Those two branches are both simple statements, although they could have been conditional statements as well.</p>
<figure>
<img src="../images/nested.svg" alt="Nested If Statements" style="height: 2.0in;"/>
<figcaption>
Nested If Statements
</figcaption>
</figure>
<p>Although the indentation of the statements makes the structure apparent, <em>nested conditionals</em> become difficult to read very quickly. In general, it is a good idea to avoid them when you can.</p>
<p>Logical operators often provide a way to simplify nested conditional statements. For example, we can rewrite the following code using a single conditional:</p>
<pre class="python"><code>if 0 &lt; x:
    if x &lt; 10:
        print(&#39;x is a positive single-digit number.&#39;)</code></pre>
<p>The <code>print</code> statement is executed only if we make it past both conditionals, so we can get the same effect with the <code>and</code> operator:</p>
<pre class="python"><code>if 0 &lt; x and x &lt; 10:
    print(&#39;x is a positive single-digit number.&#39;)</code></pre>
<h2 id="catching-exceptions-using-try-and-except">Catching exceptions using try and except</h2>
<p>Earlier we saw a code segment where we used the <code>input</code> and <code>int</code> functions to read and parse an integer number entered by the user. We also saw how treacherous doing this could be:</p>
<pre class="python"><code>&gt;&gt;&gt; prompt = &quot;What is the air velocity of an unladen swallow?\n&quot;
&gt;&gt;&gt; speed = input(prompt)
What is the air velocity of an unladen swallow?
What do you mean, an African or a European swallow?
&gt;&gt;&gt; int(speed)
ValueError: invalid literal for int() with base 10:
&gt;&gt;&gt;</code></pre>
<p>When we are executing these statements in the Python interpreter, we get a new prompt from the interpreter, think “oops”, and move on to our next statement.</p>
<p>However if you place this code in a Python script and this error occurs, your script immediately stops in its tracks with a traceback. It does not execute the following statement.</p>
<p></p>
<p>Here is a sample program to convert a Fahrenheit temperature to a Celsius temperature:</p>
<p>  </p>
<pre class="python"><code>inp = input(&#39;Enter Fahrenheit Temperature: &#39;)
fahr = float(inp)
cel = (fahr - 32.0) * 5.0 / 9.0
print(cel)

# Code: http://www.py4e.com/code3/fahren.py</code></pre>
<p>If we execute this code and give it invalid input, it simply fails with an unfriendly error message:</p>
<pre><code>python fahren.py
Enter Fahrenheit Temperature:72
22.22222222222222</code></pre>
<pre><code>python fahren.py
Enter Fahrenheit Temperature:fred
Traceback (most recent call last):
  File &quot;fahren.py&quot;, line 2, in &lt;module&gt;
    fahr = float(inp)
ValueError: could not convert string to float: &#39;fred&#39;</code></pre>
<p>There is a conditional execution structure built into Python to handle these types of expected and unexpected errors called “try / except”. The idea of <code>try</code> and <code>except</code> is that you know that some sequence of instruction(s) may have a problem and you want to add some statements to be executed if an error occurs. These extra statements (the except block) are ignored if there is no error.</p>
<p>You can think of the <code>try</code> and <code>except</code> feature in Python as an “insurance policy” on a sequence of statements.</p>
<p>We can rewrite our temperature converter as follows:</p>
<pre class="python"><code>inp = input(&#39;Enter Fahrenheit Temperature:&#39;)
try:
    fahr = float(inp)
    cel = (fahr - 32.0) * 5.0 / 9.0
    print(cel)
except:
    print(&#39;Please enter a number&#39;)

# Code: http://www.py4e.com/code3/fahren2.py</code></pre>
<p>Python starts by executing the sequence of statements in the <code>try</code> block. If all goes well, it skips the <code>except</code> block and proceeds. If an exception occurs in the <code>try</code> block, Python jumps out of the <code>try</code> block and executes the sequence of statements in the <code>except</code> block.</p>
<pre><code>python fahren2.py
Enter Fahrenheit Temperature:72
22.22222222222222</code></pre>
<pre><code>python fahren2.py
Enter Fahrenheit Temperature:fred
Please enter a number</code></pre>
<p>Handling an exception with a <code>try</code> statement is called <em>catching</em> an exception. In this example, the <code>except</code> clause prints an error message. In general, catching an exception gives you a chance to fix the problem, or try again, or at least end the program gracefully.</p>
<h2 id="short-circuit-evaluation-of-logical-expressions">Short-circuit evaluation of logical expressions</h2>
<p></p>
<p>When Python is processing a logical expression such as <code>x &gt;= 2 and (x/y) &gt; 2</code>, it evaluates the expression from left to right. Because of the definition of <code>and</code>, if <code>x</code> is less than 2, the expression <code>x &gt;= 2</code> is <code>False</code> and so the whole expression is <code>False</code> regardless of whether <code>(x/y) &gt; 2</code> evaluates to <code>True</code> or <code>False</code>.</p>
<p>When Python detects that there is nothing to be gained by evaluating the rest of a logical expression, it stops its evaluation and does not do the computations in the rest of the logical expression. When the evaluation of a logical expression stops because the overall value is already known, it is called <em>short-circuiting</em> the evaluation.</p>
<p> </p>
<p>While this may seem like a fine point, the short-circuit behavior leads to a clever technique called the <em>guardian pattern</em>. Consider the following code sequence in the Python interpreter:</p>
<pre class="python"><code>&gt;&gt;&gt; x = 6
&gt;&gt;&gt; y = 2
&gt;&gt;&gt; x &gt;= 2 and (x/y) &gt; 2
True
&gt;&gt;&gt; x = 1
&gt;&gt;&gt; y = 0
&gt;&gt;&gt; x &gt;= 2 and (x/y) &gt; 2
False
&gt;&gt;&gt; x = 6
&gt;&gt;&gt; y = 0
&gt;&gt;&gt; x &gt;= 2 and (x/y) &gt; 2
Traceback (most recent call last):
  File &quot;&lt;stdin&gt;&quot;, line 1, in &lt;module&gt;
ZeroDivisionError: division by zero
&gt;&gt;&gt;</code></pre>
<p>The third calculation failed because Python was evaluating <code>(x/y)</code> and <code>y</code> was zero, which causes a runtime error. But the first and the second examples did <em>not</em> fail because in the first calculation <code>y</code> was non zero and in the second one the first part of these expressions <code>x &gt;= 2</code> evaluated to <code>False</code> so the <code>(x/y)</code> was not ever executed due to the <em>short-circuit</em> rule and there was no error.</p>
<p>We can construct the logical expression to strategically place a <em>guard</em> evaluation just before the evaluation that might cause an error as follows:</p>
<pre class="python"><code>&gt;&gt;&gt; x = 1
&gt;&gt;&gt; y = 0
&gt;&gt;&gt; x &gt;= 2 and y != 0 and (x/y) &gt; 2
False
&gt;&gt;&gt; x = 6
&gt;&gt;&gt; y = 0
&gt;&gt;&gt; x &gt;= 2 and y != 0 and (x/y) &gt; 2
False
&gt;&gt;&gt; x &gt;= 2 and (x/y) &gt; 2 and y != 0
Traceback (most recent call last):
  File &quot;&lt;stdin&gt;&quot;, line 1, in &lt;module&gt;
ZeroDivisionError: division by zero
&gt;&gt;&gt;</code></pre>
<p>In the first logical expression, <code>x &gt;= 2</code> is <code>False</code> so the evaluation stops at the <code>and</code>. In the second logical expression, <code>x &gt;= 2</code> is <code>True</code> but <code>y != 0</code> is <code>False</code> so we never reach <code>(x/y)</code>.</p>
<p>In the third logical expression, the <code>y != 0</code> is <em>after</em> the <code>(x/y)</code> calculation so the expression fails with an error.</p>
<p>In the second expression, we say that <code>y != 0</code> acts as a <em>guard</em> to insure that we only execute <code>(x/y)</code> if <code>y</code> is non-zero.</p>
<h2 id="debugging">Debugging</h2>
<p> </p>
<p>The traceback Python displays when an error occurs contains a lot of information, but it can be overwhelming. The most useful parts are usually:</p>
<ul>
<li><p>What kind of error it was, and</p></li>
<li><p>Where it occurred.</p></li>
</ul>
<p>Syntax errors are usually easy to find, but there are a few gotchas. Whitespace errors can be tricky because spaces and tabs are invisible and we are used to ignoring them.</p>
<p></p>
<pre class="python"><code>&gt;&gt;&gt; x = 5
&gt;&gt;&gt;  y = 6
  File &quot;&lt;stdin&gt;&quot;, line 1
    y = 6
    ^
IndentationError: unexpected indent</code></pre>
<p>In this example, the problem is that the second line is indented by one space. But the error message points to <code>y</code>, which is misleading. In general, error messages indicate where the problem was discovered, but the actual error might be earlier in the code, sometimes on a previous line.</p>
<p>In general, error messages tell you where the problem was discovered, but that is often not where it was caused.</p>
<h2 id="glossary">Glossary</h2>
<dl>
<dt>body</dt>
<dd>The sequence of statements within a compound statement.
</dd>
<dt>boolean expression</dt>
<dd>An expression whose value is either <code>True</code> or <code>False</code>.
</dd>
<dt>branch</dt>
<dd>One of the alternative sequences of statements in a conditional statement.
</dd>
<dt>chained conditional</dt>
<dd>A conditional statement with a series of alternative branches.
</dd>
<dt>comparison operator</dt>
<dd>One of the operators that compares its operands: <code>==</code>, <code>!=</code>, <code>&gt;</code>, <code>&lt;</code>, <code>&gt;=</code>, and <code>&lt;=</code>.
</dd>
<dt>conditional statement</dt>
<dd>A statement that controls the flow of execution depending on some condition.
</dd>
<dt>condition</dt>
<dd>The boolean expression in a conditional statement that determines which branch is executed.
</dd>
<dt>compound statement</dt>
<dd>A statement that consists of a header and a body. The header ends with a colon (:). The body is indented relative to the header.
</dd>
<dt>guardian pattern</dt>
<dd>Where we construct a logical expression with additional comparisons to take advantage of the short-circuit behavior.
</dd>
<dt>logical operator</dt>
<dd>One of the operators that combines boolean expressions: <code>and</code>, <code>or</code>, and <code>not</code>.
</dd>
<dt>nested conditional</dt>
<dd>A conditional statement that appears in one of the branches of another conditional statement.
</dd>
<dt>traceback</dt>
<dd>A list of the functions that are executing, printed when an exception occurs.
</dd>
<dt>short circuit</dt>
<dd>When Python is part-way through evaluating a logical expression and stops the evaluation because Python knows the final value for the expression without needing to evaluate the rest of the expression.
</dd>
</dl>
<h2 id="exercises">Exercises</h2>
<p><strong>Exercise 1: Rewrite your pay computation to give the employee 1.5 times the hourly rate for hours worked above 40 hours.</strong></p>
<pre><code>Enter Hours: 45
Enter Rate: 10
Pay: 475.0</code></pre>
<p><strong>Exercise 2: Rewrite your pay program using <code>try</code> and <code>except</code> so that your program handles non-numeric input gracefully by printing a message and exiting the program. The following shows two executions of the program:</strong></p>
<pre><code>Enter Hours: 20
Enter Rate: nine
Error, please enter numeric input</code></pre>
<pre><code>Enter Hours: forty
Error, please enter numeric input</code></pre>
<p><strong>Exercise 3: Write a program to prompt for a score between 0.0 and 1.0. If the score is out of range, print an error message. If the score is between 0.0 and 1.0, print a grade using the following table:</strong></p>
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
<p>Run the program repeatedly as shown above to test the various different values for input.</p>
<section class="footnotes" role="doc-endnotes">
<hr />
<ol>
<li id="fn1" role="doc-endnote"><p>We will learn about functions in Chapter 4 and loops in Chapter 5.<a href="#fnref1" class="footnote-back" role="doc-backlink">↩︎</a></p></li>
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
