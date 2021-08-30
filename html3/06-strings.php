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
<h1 id="strings">Strings</h1>
<h2 id="a-string-is-a-sequence">A string is a sequence</h2>
<p>   </p>
<p>A string is a <em>sequence</em> of characters. You can access the characters one at a time with the bracket operator:</p>
<pre class="python"><code>&gt;&gt;&gt; fruit = &#39;banana&#39;
&gt;&gt;&gt; letter = fruit[1]</code></pre>
<p> </p>
<p>The second statement extracts the character at index position 1 from the <code>fruit</code> variable and assigns it to the <code>letter</code> variable.</p>
<p>The expression in brackets is called an <em>index</em>. The index indicates which character in the sequence you want (hence the name).</p>
<p>But you might not get what you expect:</p>
<pre class="python"><code>&gt;&gt;&gt; print(letter)
a</code></pre>
<p>For most people, the first letter of “banana” is “b”, not “a”. But in Python, the index is an offset from the beginning of the string, and the offset of the first letter is zero.</p>
<pre class="python"><code>&gt;&gt;&gt; letter = fruit[0]
&gt;&gt;&gt; print(letter)
b</code></pre>
<p>So “b” is the 0th letter (“zero-th”) of “banana”, “a” is the 1th letter (“one-th”), and “n” is the 2th (“two-th”) letter.</p>
<figure>
<img src="../images/string.svg" alt="String Indexes" style="height: 0.75in;"/>
<figcaption>
String Indexes
</figcaption>
</figure>
<p> </p>
<p>You can use any expression, including variables and operators, as an index, but the value of the index has to be an integer. Otherwise you get:</p>
<p>   </p>
<pre class="python"><code>&gt;&gt;&gt; letter = fruit[1.5]
TypeError: string indices must be integers</code></pre>
<h2 id="getting-the-length-of-a-string-using-len">Getting the length of a string using <code>len</code></h2>
<p> </p>
<p><code>len</code> is a built-in function that returns the number of characters in a string:</p>
<pre class="python"><code>&gt;&gt;&gt; fruit = &#39;banana&#39;
&gt;&gt;&gt; len(fruit)
6</code></pre>
<p>To get the last letter of a string, you might be tempted to try something like this:</p>
<p> </p>
<pre class="python"><code>&gt;&gt;&gt; length = len(fruit)
&gt;&gt;&gt; last = fruit[length]
IndexError: string index out of range</code></pre>
<p>The reason for the <code>IndexError</code> is that there is no letter in “banana” with the index 6. Since we started counting at zero, the six letters are numbered 0 to 5. To get the last character, you have to subtract 1 from <code>length</code>:</p>
<pre class="python"><code>&gt;&gt;&gt; last = fruit[length-1]
&gt;&gt;&gt; print(last)
a</code></pre>
<p>Alternatively, you can use negative indices, which count backward from the end of the string. The expression <code>fruit[-1]</code> yields the last letter, <code>fruit[-2]</code> yields the second to last, and so on.</p>
<p> </p>
<h2 id="traversal-through-a-string-with-a-loop">Traversal through a string with a loop</h2>
<p>     </p>
<p>A lot of computations involve processing a string one character at a time. Often they start at the beginning, select each character in turn, do something to it, and continue until the end. This pattern of processing is called a <em>traversal</em>. One way to write a traversal is with a <code>while</code> loop:</p>
<pre class="python"><code>index = 0
while index &lt; len(fruit):
    letter = fruit[index]
    print(letter)
    index = index + 1</code></pre>
<p>This loop traverses the string and displays each letter on a line by itself. The loop condition is <code>index &lt; len(fruit)</code>, so when <code>index</code> is equal to the length of the string, the condition is false, and the body of the loop is not executed. The last character accessed is the one with the index <code>len(fruit)-1</code>, which is the last character in the string.</p>
<p><strong>Exercise 1: Write a <code>while</code> loop that starts at the last character in the string and works its way backwards to the first character in the string, printing each letter on a separate line, except backwards.</strong></p>
<p>Another way to write a traversal is with a <code>for</code> loop:</p>
<pre class="python"><code>for char in fruit:
    print(char)</code></pre>
<p>Each time through the loop, the next character in the string is assigned to the variable <code>char</code>. The loop continues until no characters are left.</p>
<h2 id="string-slices">String slices</h2>
<p>    </p>
<p>A segment of a string is called a <em>slice</em>. Selecting a slice is similar to selecting a character:</p>
<pre class="python"><code>&gt;&gt;&gt; s = &#39;Monty Python&#39;
&gt;&gt;&gt; print(s[0:5])
Monty
&gt;&gt;&gt; print(s[6:12])
Python</code></pre>
<p>The operator returns the part of the string from the “n-th” character to the “m-th” character, including the first but excluding the last.</p>
<p>If you omit the first index (before the colon), the slice starts at the beginning of the string. If you omit the second index, the slice goes to the end of the string:</p>
<pre class="python"><code>&gt;&gt;&gt; fruit = &#39;banana&#39;
&gt;&gt;&gt; fruit[:3]
&#39;ban&#39;
&gt;&gt;&gt; fruit[3:]
&#39;ana&#39;</code></pre>
<p>If the first index is greater than or equal to the second the result is an <em>empty string</em>, represented by two quotation marks:</p>
<p></p>
<pre class="python"><code>&gt;&gt;&gt; fruit = &#39;banana&#39;
&gt;&gt;&gt; fruit[3:3]
&#39;&#39;</code></pre>
<p>An empty string contains no characters and has length 0, but other than that, it is the same as any other string.</p>
<p><strong>Exercise 2: Given that <code>fruit</code> is a string, what does <code>fruit[:]</code> mean?</strong></p>
<p> </p>
<h2 id="strings-are-immutable">Strings are immutable</h2>
<p>  </p>
<p>It is tempting to use the operator on the left side of an assignment, with the intention of changing a character in a string. For example:</p>
<p> </p>
<pre class="python"><code>&gt;&gt;&gt; greeting = &#39;Hello, world!&#39;
&gt;&gt;&gt; greeting[0] = &#39;J&#39;
TypeError: &#39;str&#39; object does not support item assignment</code></pre>
<p>The “object” in this case is the string and the “item” is the character you tried to assign. For now, an <em>object</em> is the same thing as a value, but we will refine that definition later. An <em>item</em> is one of the values in a sequence.</p>
<p>   </p>
<p>The reason for the error is that strings are <em>immutable</em>, which means you can’t change an existing string. The best you can do is create a new string that is a variation on the original:</p>
<pre class="python"><code>&gt;&gt;&gt; greeting = &#39;Hello, world!&#39;
&gt;&gt;&gt; new_greeting = &#39;J&#39; + greeting[1:]
&gt;&gt;&gt; print(new_greeting)
Jello, world!</code></pre>
<p>This example concatenates a new first letter onto a slice of <code>greeting</code>. It has no effect on the original string.</p>
<p></p>
<h2 id="looping-and-counting">Looping and counting</h2>
<p>   </p>
<p>The following program counts the number of times the letter “a” appears in a string:</p>
<pre class="python"><code>word = &#39;banana&#39;
count = 0
for letter in word:
    if letter == &#39;a&#39;:
        count = count + 1
print(count)</code></pre>
<p>This program demonstrates another pattern of computation called a <em>counter</em>. The variable <code>count</code> is initialized to 0 and then incremented each time an “a” is found. When the loop exits, <code>count</code> contains the result: the total number of a’s.</p>
<p></p>
<p><strong>Exercise 3: Encapsulate this code in a function named <code>count</code>, and generalize it so that it accepts the string and the letter as arguments.</strong></p>
<h2 id="the-in-operator">The <code>in</code> operator</h2>
<p>   </p>
<p>The word <code>in</code> is a boolean operator that takes two strings and returns <code>True</code> if the first appears as a substring in the second:</p>
<pre class="python"><code>&gt;&gt;&gt; &#39;a&#39; in &#39;banana&#39;
True
&gt;&gt;&gt; &#39;seed&#39; in &#39;banana&#39;
False</code></pre>
<h2 id="string-comparison">String comparison</h2>
<p> </p>
<p>The comparison operators work on strings. To see if two strings are equal:</p>
<pre class="python"><code>if word == &#39;banana&#39;:
    print(&#39;All right, bananas.&#39;)</code></pre>
<p>Other comparison operations are useful for putting words in alphabetical order:</p>
<pre class="python"><code>if word &lt; &#39;banana&#39;:
    print(&#39;Your word,&#39; + word + &#39;, comes before banana.&#39;)
elif word &gt; &#39;banana&#39;:
    print(&#39;Your word,&#39; + word + &#39;, comes after banana.&#39;)
else:
    print(&#39;All right, bananas.&#39;)</code></pre>
<p>Python does not handle uppercase and lowercase letters the same way that people do. All the uppercase letters come before all the lowercase letters, so:</p>
<pre><code>Your word, Pineapple, comes before banana.</code></pre>
<p>A common way to address this problem is to convert strings to a standard format, such as all lowercase, before performing the comparison. Keep that in mind in case you have to defend yourself against a man armed with a Pineapple.</p>
<h2 id="string-methods">String methods</h2>
<p>Strings are an example of Python <em>objects</em>. An object contains both data (the actual string itself) and <em>methods</em>, which are effectively functions that are built into the object and are available to any <em>instance</em> of the object.</p>
<p>Python has a function called <code>dir</code> which lists the methods available for an object. The <code>type</code> function shows the type of an object and the <code>dir</code> function shows the available methods.</p>
<pre class="python"><code>&gt;&gt;&gt; stuff = &#39;Hello world&#39;
&gt;&gt;&gt; type(stuff)
&lt;class &#39;str&#39;&gt;
&gt;&gt;&gt; dir(stuff)
[&#39;capitalize&#39;, &#39;casefold&#39;, &#39;center&#39;, &#39;count&#39;, &#39;encode&#39;,
&#39;endswith&#39;, &#39;expandtabs&#39;, &#39;find&#39;, &#39;format&#39;, &#39;format_map&#39;,
&#39;index&#39;, &#39;isalnum&#39;, &#39;isalpha&#39;, &#39;isdecimal&#39;, &#39;isdigit&#39;,
&#39;isidentifier&#39;, &#39;islower&#39;, &#39;isnumeric&#39;, &#39;isprintable&#39;,
&#39;isspace&#39;, &#39;istitle&#39;, &#39;isupper&#39;, &#39;join&#39;, &#39;ljust&#39;, &#39;lower&#39;,
&#39;lstrip&#39;, &#39;maketrans&#39;, &#39;partition&#39;, &#39;replace&#39;, &#39;rfind&#39;,
&#39;rindex&#39;, &#39;rjust&#39;, &#39;rpartition&#39;, &#39;rsplit&#39;, &#39;rstrip&#39;,
&#39;split&#39;, &#39;splitlines&#39;, &#39;startswith&#39;, &#39;strip&#39;, &#39;swapcase&#39;,
&#39;title&#39;, &#39;translate&#39;, &#39;upper&#39;, &#39;zfill&#39;]
&gt;&gt;&gt; help(str.capitalize)
Help on method_descriptor:

capitalize(...)
    S.capitalize() -&gt; str

    Return a capitalized version of S, i.e. make the first character
    have upper case and the rest lower case.
&gt;&gt;&gt;</code></pre>
<p>While the <code>dir</code> function lists the methods, and you can use <code>help</code> to get some simple documentation on a method, a better source of documentation for string methods would be <a href="https://docs.python.org/library/stdtypes.html#string-methods" class="uri">https://docs.python.org/library/stdtypes.html#string-methods</a>.</p>
<p>Calling a <em>method</em> is similar to calling a function (it takes arguments and returns a value) but the syntax is different. We call a method by appending the method name to the variable name using the period as a delimiter.</p>
<p>For example, the method <code>upper</code> takes a string and returns a new string with all uppercase letters:</p>
<p> </p>
<p>Instead of the function syntax <code>upper(word)</code>, it uses the method syntax <code>word.upper()</code>.</p>
<p></p>
<pre class="python"><code>&gt;&gt;&gt; word = &#39;banana&#39;
&gt;&gt;&gt; new_word = word.upper()
&gt;&gt;&gt; print(new_word)
BANANA</code></pre>
<p>This form of dot notation specifies the name of the method, <code>upper</code>, and the name of the string to apply the method to, <code>word</code>. The empty parentheses indicate that this method takes no argument.</p>
<p></p>
<p>A method call is called an <em>invocation</em>; in this case, we would say that we are invoking <code>upper</code> on the <code>word</code>.</p>
<p></p>
<p>For example, there is a string method named <code>find</code> that searches for the position of one string within another:</p>
<pre class="python"><code>&gt;&gt;&gt; word = &#39;banana&#39;
&gt;&gt;&gt; index = word.find(&#39;a&#39;)
&gt;&gt;&gt; print(index)
1</code></pre>
<p>In this example, we invoke <code>find</code> on <code>word</code> and pass the letter we are looking for as a parameter.</p>
<p>The <code>find</code> method can find substrings as well as characters:</p>
<pre class="python"><code>&gt;&gt;&gt; word.find(&#39;na&#39;)
2</code></pre>
<p>It can take as a second argument the index where it should start:</p>
<p> </p>
<pre class="python"><code>&gt;&gt;&gt; word.find(&#39;na&#39;, 3)
4</code></pre>
<p>One common task is to remove white space (spaces, tabs, or newlines) from the beginning and end of a string using the <code>strip</code> method:</p>
<pre class="python"><code>&gt;&gt;&gt; line = &#39;  Here we go  &#39;
&gt;&gt;&gt; line.strip()
&#39;Here we go&#39;</code></pre>
<p>Some methods such as <em>startswith</em> return boolean values.</p>
<pre class="python"><code>&gt;&gt;&gt; line = &#39;Have a nice day&#39;
&gt;&gt;&gt; line.startswith(&#39;Have&#39;)
True
&gt;&gt;&gt; line.startswith(&#39;h&#39;)
False</code></pre>
<p>You will note that <code>startswith</code> requires case to match, so sometimes we take a line and map it all to lowercase before we do any checking using the <code>lower</code> method.</p>
<pre class="python"><code>&gt;&gt;&gt; line = &#39;Have a nice day&#39;
&gt;&gt;&gt; line.startswith(&#39;h&#39;)
False
&gt;&gt;&gt; line.lower()
&#39;have a nice day&#39;
&gt;&gt;&gt; line.lower().startswith(&#39;h&#39;)
True</code></pre>
<p>In the last example, the method <code>lower</code> is called and then we use <code>startswith</code> to see if the resulting lowercase string starts with the letter “h”. As long as we are careful with the order, we can make multiple method calls in a single expression.</p>
<p> </p>
<p><strong>Exercise 4: There is a string method called <code>count</code> that is similar to the function in the previous exercise. Read the documentation of this method at:</strong></p>
<p><a href="https://docs.python.org/library/stdtypes.html#string-methods" class="uri">https://docs.python.org/library/stdtypes.html#string-methods</a></p>
<p><strong>Write an invocation that counts the number of times the letter a occurs in “banana”.</strong></p>
<h2 id="parsing-strings">Parsing strings</h2>
<p>Often, we want to look into a string and find a substring. For example if we were presented a series of lines formatted as follows:</p>
<p><code>From stephen.marquard@</code><em><code> uct.ac.za</code></em><code> Sat Jan  5 09:14:16 2008</code></p>
<p>and we wanted to pull out only the second half of the address (i.e., <code>uct.ac.za</code>) from each line, we can do this by using the <code>find</code> method and string slicing.</p>
<p>First, we will find the position of the at-sign in the string. Then we will find the position of the first space <em>after</em> the at-sign. And then we will use string slicing to extract the portion of the string which we are looking for.</p>
<pre class="python"><code>&gt;&gt;&gt; data = &#39;From stephen.marquard@uct.ac.za Sat Jan  5 09:14:16 2008&#39;
&gt;&gt;&gt; atpos = data.find(&#39;@&#39;)
&gt;&gt;&gt; print(atpos)
21
&gt;&gt;&gt; sppos = data.find(&#39; &#39;,atpos)
&gt;&gt;&gt; print(sppos)
31
&gt;&gt;&gt; host = data[atpos+1:sppos]
&gt;&gt;&gt; print(host)
uct.ac.za
&gt;&gt;&gt;</code></pre>
<p>We use a version of the <code>find</code> method which allows us to specify a position in the string where we want <code>find</code> to start looking. When we slice, we extract the characters from “one beyond the at-sign through up to <em>but not including</em> the space character”.</p>
<p>The documentation for the <code>find</code> method is available at</p>
<p><a href="https://docs.python.org/library/stdtypes.html#string-methods" class="uri">https://docs.python.org/library/stdtypes.html#string-methods</a>.</p>
<h2 id="format-operator">Format operator</h2>
<p> </p>
<p>The <em>format operator</em>, <code>%</code> allows us to construct strings, replacing parts of the strings with the data stored in variables. When applied to integers, <code>%</code> is the modulus operator. But when the first operand is a string, <code>%</code> is the format operator.</p>
<p></p>
<p>The first operand is the <em>format string</em>, which contains one or more <em>format sequences</em> that specify how the second operand is formatted. The result is a string.</p>
<p></p>
<p>For example, the format sequence <code>%d</code> means that the second operand should be formatted as an integer (“d” stands for “decimal”):</p>
<pre class="python"><code>&gt;&gt;&gt; camels = 42
&gt;&gt;&gt; &#39;%d&#39; % camels
&#39;42&#39;</code></pre>
<p>The result is the string ‘42’, which is not to be confused with the integer value 42.</p>
<p>A format sequence can appear anywhere in the string, so you can embed a value in a sentence:</p>
<pre class="python"><code>&gt;&gt;&gt; camels = 42
&gt;&gt;&gt; &#39;I have spotted %d camels.&#39; % camels
&#39;I have spotted 42 camels.&#39;</code></pre>
<p>If there is more than one format sequence in the string, the second argument has to be a tuple<a href="#fn1" class="footnote-ref" id="fnref1" role="doc-noteref"><sup>1</sup></a>. Each format sequence is matched with an element of the tuple, in order.</p>
<p>The following example uses <code>%d</code> to format an integer, <code>%g</code> to format a floating-point number (don’t ask why), and <code>%s</code> to format a string:</p>
<pre class="python"><code>&gt;&gt;&gt; &#39;In %d years I have spotted %g %s.&#39; % (3, 0.1, &#39;camels&#39;)
&#39;In 3 years I have spotted 0.1 camels.&#39;</code></pre>
<p>The number of elements in the tuple must match the number of format sequences in the string. The types of the elements also must match the format sequences:</p>
<p> </p>
<pre class="python"><code>&gt;&gt;&gt; &#39;%d %d %d&#39; % (1, 2)
TypeError: not enough arguments for format string
&gt;&gt;&gt; &#39;%d&#39; % &#39;dollars&#39;
TypeError: %d format: a number is required, not str</code></pre>
<p>In the first example, there aren’t enough elements; in the second, the element is the wrong type.</p>
<p>The format operator is powerful, but it can be difficult to use. You can read more about it at</p>
<p><a href="https://docs.python.org/library/stdtypes.html#printf-style-string-formatting" class="uri">https://docs.python.org/library/stdtypes.html#printf-style-string-formatting</a>.</p>
<h2 id="debugging">Debugging</h2>
<p></p>
<p>A skill that you should cultivate as you program is always asking yourself, “What could go wrong here?” or alternatively, “What crazy thing might our user do to crash our (seemingly) perfect program?”</p>
<p>For example, look at the program which we used to demonstrate the <code>while</code> loop in the chapter on iteration:</p>
<pre class="python"><code>while True:
    line = input(&#39;&gt; &#39;)
    if line[0] == &#39;#&#39;:
        continue
    if line == &#39;done&#39;:
        break
    print(line)
print(&#39;Done!&#39;)

# Code: http://www.py4e.com/code3/copytildone2.py</code></pre>
<p>Look what happens when the user enters an empty line of input:</p>
<pre class="python"><code>&gt; hello there
hello there
&gt; # don&#39;t print this
&gt; print this!
print this!
&gt;
Traceback (most recent call last):
  File &quot;copytildone.py&quot;, line 3, in &lt;module&gt;
    if line[0] == &#39;#&#39;:
IndexError: string index out of range</code></pre>
<p>The code works fine until it is presented an empty line. Then there is no zero-th character, so we get a traceback. There are two solutions to this to make line three “safe” even if the line is empty.</p>
<p>One possibility is to simply use the <code>startswith</code> method which returns <code>False</code> if the string is empty.</p>
<pre class="python"><code>if line.startswith(&#39;#&#39;):</code></pre>
<p> </p>
<p>Another way is to safely write the <code>if</code> statement using the <em>guardian</em> pattern and make sure the second logical expression is evaluated only where there is at least one character in the string.:</p>
<pre class="python"><code>if len(line) &gt; 0 and line[0] == &#39;#&#39;:</code></pre>
<h2 id="glossary">Glossary</h2>
<dl>
<dt>counter</dt>
<dd>A variable used to count something, usually initialized to zero and then incremented.
</dd>
<dt>empty string</dt>
<dd>A string with no characters and length 0, represented by two quotation marks.
</dd>
<dt>format operator</dt>
<dd>An operator, <code>%</code>, that takes a format string and a tuple and generates a string that includes the elements of the tuple formatted as specified by the format string.
</dd>
<dt>format sequence</dt>
<dd>A sequence of characters in a format string, like <code>%d</code>, that specifies how a value should be formatted.
</dd>
<dt>format string</dt>
<dd>A string, used with the format operator, that contains format sequences.
</dd>
<dt>flag</dt>
<dd>A boolean variable used to indicate whether a condition is true or false.
</dd>
<dt>invocation</dt>
<dd>A statement that calls a method.
</dd>
<dt>immutable</dt>
<dd>The property of a sequence whose items cannot be assigned.
</dd>
<dt>index</dt>
<dd>An integer value used to select an item in a sequence, such as a character in a string.
</dd>
<dt>item</dt>
<dd>One of the values in a sequence.
</dd>
<dt>method</dt>
<dd>A function that is associated with an object and called using dot notation.
</dd>
<dt>object</dt>
<dd>Something a variable can refer to. For now, you can use “object” and “value” interchangeably.
</dd>
<dt>search</dt>
<dd>A pattern of traversal that stops when it finds what it is looking for.
</dd>
<dt>sequence</dt>
<dd>An ordered set; that is, a set of values where each value is identified by an integer index.
</dd>
<dt>slice</dt>
<dd>A part of a string specified by a range of indices.
</dd>
<dt>traverse</dt>
<dd>To iterate through the items in a sequence, performing a similar operation on each.
</dd>
</dl>
<h2 id="exercises">Exercises</h2>
<p><strong>Exercise 5: Take the following Python code that stores a string:</strong></p>
<p><code>str = 'X-DSPAM-Confidence:</code><strong><code>0.8475</code></strong><code>'</code></p>
<p><strong>Use <code>find</code> and string slicing to extract the portion of the string after the colon character and then use the <code>float</code> function to convert the extracted string into a floating point number.</strong></p>
<p> </p>
<p><strong>Exercise 6: Read the documentation of the string methods at <a href="https://docs.python.org/library/stdtypes.html#string-methods" class="uri">https://docs.python.org/library/stdtypes.html#string-methods</a> You might want to experiment with some of them to make sure you understand how they work. <code>strip</code> and <code>replace</code> are particularly useful.</strong></p>
<p><strong>The documentation uses a syntax that might be confusing. For example, in <code>find(sub[, start[, end]])</code>, the brackets indicate optional arguments. So <code>sub</code> is required, but <code>start</code> is optional, and if you include <code>start</code>, then <code>end</code> is optional.</strong></p>
<section class="footnotes" role="doc-endnotes">
<hr />
<ol>
<li id="fn1" role="doc-endnote"><p>A tuple is a sequence of comma-separated values inside a pair of parenthesis. We will cover tuples in Chapter 10<a href="#fnref1" class="footnote-back" role="doc-backlink">↩︎</a></p></li>
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
