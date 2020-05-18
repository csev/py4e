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
<h1 id="regular-expressions">Regular expressions</h1>
<p>So far we have been reading through files, looking for patterns and extracting various bits of lines that we find interesting. We have been</p>
<p>using string methods like <code>split</code> and <code>find</code> and using lists and string slicing to extract portions of the lines.</p>
<p>  </p>
<p>This task of searching and extracting is so common that Python has a very powerful library called <em>regular expressions</em> that handles many of these tasks quite elegantly. The reason we have not introduced regular expressions earlier in the book is because while they are very powerful, they are a little complicated and their syntax takes some getting used to.</p>
<p>Regular expressions are almost their own little programming language for searching and parsing strings. As a matter of fact, entire books have been written on the topic of regular expressions. In this chapter, we will only cover the basics of regular expressions. For more detail on regular expressions, see:</p>
<p><a href="https://en.wikipedia.org/wiki/Regular_expression" class="uri">https://en.wikipedia.org/wiki/Regular_expression</a></p>
<p><a href="https://docs.python.org/library/re.html" class="uri">https://docs.python.org/library/re.html</a></p>
<p>The regular expression library <code>re</code> must be imported into your program before you can use it. The simplest use of the regular expression library is the <code>search()</code> function. The following program demonstrates a trivial use of the search function.</p>
<p></p>
<pre class="python"><code># Search for lines that contain &#39;From&#39;
import re
hand = open(&#39;mbox-short.txt&#39;)
for line in hand:
    line = line.rstrip()
    if re.search(&#39;From:&#39;, line):
        print(line)

# Code: http://www.py4e.com/code3/re01.py</code></pre>
<p>We open the file, loop through each line, and use the regular expression <code>search()</code> to only print out lines that contain the string “From:”. This program does not use the real power of regular expressions, since we could have just as easily used <code>line.find()</code> to accomplish the same result.</p>
<p></p>
<p>The power of the regular expressions comes when we add special characters to the search string that allow us to more precisely control which lines match the string. Adding these special characters to our regular expression allow us to do sophisticated matching and extraction while writing very little code.</p>
<p>For example, the caret character is used in regular expressions to match “the beginning” of a line. We could change our program to only match lines where “From:” was at the beginning of the line as follows:</p>
<pre class="python"><code># Search for lines that start with &#39;From&#39;
import re
hand = open(&#39;mbox-short.txt&#39;)
for line in hand:
    line = line.rstrip()
    if re.search(&#39;^From:&#39;, line):
        print(line)

# Code: http://www.py4e.com/code3/re02.py</code></pre>
<p>Now we will only match lines that <em>start with</em> the string “From:”. This is still a very simple example that we could have done equivalently with the <code>startswith()</code> method from the string library. But it serves to introduce the notion that regular expressions contain special action characters that give us more control as to what will match the regular expression.</p>
<p></p>
<h2 id="character-matching-in-regular-expressions">Character matching in regular expressions</h2>
<p>There are a number of other special characters that let us build even more powerful regular expressions. The most commonly used special character is the period or full stop, which matches any character.</p>
<p> </p>
<p>In the following example, the regular expression <code>F..m:</code> would match any of the strings “From:”, “Fxxm:”, “F12m:”, or “F!<span class="citation" data-cites="m">@m</span>:” since the period characters in the regular expression match any character.</p>
<pre class="python"><code># Search for lines that start with &#39;F&#39;, followed by
# 2 characters, followed by &#39;m:&#39;
import re
hand = open(&#39;mbox-short.txt&#39;)
for line in hand:
    line = line.rstrip()
    if re.search(&#39;^F..m:&#39;, line):
        print(line)

# Code: http://www.py4e.com/code3/re03.py</code></pre>
<p>This is particularly powerful when combined with the ability to indicate that a character can be repeated any number of times using the <code>*</code> or <code>+</code> characters in your regular expression. These special characters mean that instead of matching a single character in the search string, they match zero-or-more characters (in the case of the asterisk) or one-or-more of the characters (in the case of the plus sign).</p>
<p>We can further narrow down the lines that we match using a repeated <em>wild card</em> character in the following example:</p>
<pre class="python"><code># Search for lines that start with From and have an at sign
import re
hand = open(&#39;mbox-short.txt&#39;)
for line in hand:
    line = line.rstrip()
    if re.search(&#39;^From:.+@&#39;, line):
        print(line)

# Code: http://www.py4e.com/code3/re04.py</code></pre>
<p>The search string <code>^From:.+@</code> will successfully match lines that start with “From:”, followed by one or more characters (<code>.+</code>), followed by an at-sign. So this will match the following line:</p>
<pre><code>From: stephen.marquard@uct.ac.za</code></pre>
<p>You can think of the <code>.+</code> wildcard as expanding to match all the characters between the colon character and the at-sign.</p>
<pre><code>From:.+@</code></pre>
<p>It is good to think of the plus and asterisk characters as “pushy”. For example, the following string would match the last at-sign in the string as the <code>.+</code> pushes outwards, as shown below:</p>
<pre><code>From: stephen.marquard@uct.ac.za, csev@umich.edu, and cwen @iupui.edu</code></pre>
<p>It is possible to tell an asterisk or plus sign not to be so “greedy” by adding another character. See the detailed documentation for information on turning off the greedy behavior.</p>
<p></p>
<h2 id="extracting-data-using-regular-expressions">Extracting data using regular expressions</h2>
<p>If we want to extract data from a string in Python we can use the <code>findall()</code> method to extract all of the substrings which match a regular expression. Let’s use the example of wanting to extract anything that looks like an email address from any line regardless of format. For example, we want to pull the email addresses from each of the following lines:</p>
<pre><code>From stephen.marquard@uct.ac.za Sat Jan  5 09:14:16 2008
Return-Path: &lt;postmaster@collab.sakaiproject.org&gt;
          for &lt;source@collab.sakaiproject.org&gt;;
Received: (from apache@localhost)
Author: stephen.marquard@uct.ac.za</code></pre>
<p>We don’t want to write code for each of the types of lines, splitting and slicing differently for each line. This following program uses <code>findall()</code> to find the lines with email addresses in them and extract one or more addresses from each of those lines.</p>
<p> </p>
<pre class="python"><code>import re
s = &#39;A message from csev@umich.edu to cwen@iupui.edu about meeting @2PM&#39;
lst = re.findall(&#39;\S+@\S+&#39;, s)
print(lst)

# Code: http://www.py4e.com/code3/re05.py</code></pre>
<p>The <code>findall()</code> method searches the string in the second argument and returns a list of all of the strings that look like email addresses. We are using a two-character sequence that matches a non-whitespace character (<code>\S</code>).</p>
<p>The output of the program would be:</p>
<pre><code>[&#39;csev@umich.edu&#39;, &#39;cwen@iupui.edu&#39;]</code></pre>
<p>Translating the regular expression, we are looking for substrings that have at least one non-whitespace character, followed by an at-sign, followed by at least one more non-whitespace character. The <code>\S+</code> matches as many non-whitespace characters as possible.</p>
<p>The regular expression would match twice (csev@umich.edu and cwen@iupui.edu), but it would not match the string “<span class="citation" data-cites="2PM">@2PM</span>” because there are no non-blank characters <em>before</em> the at-sign. We can use this regular expression in a program to read all the lines in a file and print out anything that looks like an email address as follows:</p>
<pre class="python"><code># Search for lines that have an at sign between characters
import re
hand = open(&#39;mbox-short.txt&#39;)
for line in hand:
    line = line.rstrip()
    x = re.findall(&#39;\S+@\S+&#39;, line)
    if len(x) &gt; 0:
        print(x)

# Code: http://www.py4e.com/code3/re06.py</code></pre>
<p>We read each line and then extract all the substrings that match our regular expression. Since <code>findall()</code> returns a list, we simply check if the number of elements in our returned list is more than zero to print only lines where we found at least one substring that looks like an email address.</p>
<p>If we run the program on <em>mbox.txt</em> we get the following output:</p>
<pre><code>[&#39;wagnermr@iupui.edu&#39;]
[&#39;cwen@iupui.edu&#39;]
[&#39;&lt;postmaster@collab.sakaiproject.org&gt;&#39;]
[&#39;&lt;200801032122.m03LMFo4005148@nakamura.uits.iupui.edu&gt;&#39;]
[&#39;&lt;source@collab.sakaiproject.org&gt;;&#39;]
[&#39;&lt;source@collab.sakaiproject.org&gt;;&#39;]
[&#39;&lt;source@collab.sakaiproject.org&gt;;&#39;]
[&#39;apache@localhost)&#39;]
[&#39;source@collab.sakaiproject.org;&#39;]</code></pre>
<p>Some of our email addresses have incorrect characters like “&lt;” or “;” at the beginning or end. Let’s declare that we are only interested in the portion of the string that starts and ends with a letter or a number.</p>
<p>To do this, we use another feature of regular expressions. Square brackets are used to indicate a set of multiple acceptable characters we are willing to consider matching. In a sense, the <code>\S</code> is asking to match the set of “non-whitespace characters”. Now we will be a little more explicit in terms of the characters we will match.</p>
<p>Here is our new regular expression:</p>
<pre><code>[a-zA-Z0-9]\S*@\S*[a-zA-Z]</code></pre>
<p>This is getting a little complicated and you can begin to see why regular expressions are their own little language unto themselves. Translating this regular expression, we are looking for substrings that start with a <em>single</em> lowercase letter, uppercase letter, or number “[a-zA-Z0-9]”, followed by zero or more non-blank characters (<code>\S*</code>), followed by an at-sign, followed by zero or more non-blank characters (<code>\S*</code>), followed by an uppercase or lowercase letter. Note that we switched from <code>+</code> to <code>*</code> to indicate zero or more non-blank characters since <code>[a-zA-Z0-9]</code> is already one non-blank character. Remember that the <code>*</code> or <code>+</code> applies to the single character immediately to the left of the plus or asterisk.</p>
<p></p>
<p>If we use this expression in our program, our data is much cleaner:</p>
<pre class="python"><code># Search for lines that have an at sign between characters
# The characters must be a letter or number
import re
hand = open(&#39;mbox-short.txt&#39;)
for line in hand:
    line = line.rstrip()
    x = re.findall(&#39;[a-zA-Z0-9]\S+@\S+[a-zA-Z]&#39;, line)
    if len(x) &gt; 0:
        print(x)

# Code: http://www.py4e.com/code3/re07.py</code></pre>
<pre><code>...
[&#39;wagnermr@iupui.edu&#39;]
[&#39;cwen@iupui.edu&#39;]
[&#39;postmaster@collab.sakaiproject.org&#39;]
[&#39;200801032122.m03LMFo4005148@nakamura.uits.iupui.edu&#39;]
[&#39;source@collab.sakaiproject.org&#39;]
[&#39;source@collab.sakaiproject.org&#39;]
[&#39;source@collab.sakaiproject.org&#39;]
[&#39;apache@localhost&#39;]</code></pre>
<p>Notice that on the <code>source@collab.sakaiproject.org</code> lines, our regular expression eliminated two letters at the end of the string (“&gt;;”). This is because when we append <code>[a-zA-Z]</code> to the end of our regular expression, we are demanding that whatever string the regular expression parser finds must end with a letter. So when it sees the “&gt;” at the end of “sakaiproject.org&gt;;” it simply stops at the last “matching” letter it found (i.e., the “g” was the last good match).</p>
<p>Also note that the output of the program is a Python list that has a string as the single element in the list.</p>
<h2 id="combining-searching-and-extracting">Combining searching and extracting</h2>
<p>If we want to find numbers on lines that start with the string “X-” such as:</p>
<pre><code>X-DSPAM-Confidence: 0.8475
X-DSPAM-Probability: 0.0000</code></pre>
<p>we don’t just want any floating-point numbers from any lines. We only want to extract numbers from lines that have the above syntax.</p>
<p>We can construct the following regular expression to select the lines:</p>
<pre><code>^X-.*: [0-9.]+</code></pre>
<p>Translating this, we are saying, we want lines that start with <code>X-</code>, followed by zero or more characters (<code>.*</code>), followed by a colon (<code>:</code>) and then a space. After the space we are looking for one or more characters that are either a digit (0-9) or a period <code>[0-9.]+</code>. Note that inside the square brackets, the period matches an actual period (i.e., it is not a wildcard between the square brackets).</p>
<p>This is a very tight expression that will pretty much match only the lines we are interested in as follows:</p>
<pre class="python"><code># Search for lines that start with &#39;X&#39; followed by any non
# whitespace characters and &#39;:&#39;
# followed by a space and any number.
# The number can include a decimal.
import re
hand = open(&#39;mbox-short.txt&#39;)
for line in hand:
    line = line.rstrip()
    if re.search(&#39;^X\S*: [0-9.]+&#39;, line):
        print(line)

# Code: http://www.py4e.com/code3/re10.py</code></pre>
<p>When we run the program, we see the data nicely filtered to show only the lines we are looking for.</p>
<pre><code>X-DSPAM-Confidence: 0.8475
X-DSPAM-Probability: 0.0000
X-DSPAM-Confidence: 0.6178
X-DSPAM-Probability: 0.0000</code></pre>
<p>But now we have to solve the problem of extracting the numbers. While it would be simple enough to use <code>split</code>, we can use another feature of regular expressions to both search and parse the line at the same time.</p>
<p></p>
<p>Parentheses are another special character in regular expressions. When you add parentheses to a regular expression, they are ignored when matching the string. But when you are using <code>findall()</code>, parentheses indicate that while you want the whole expression to match, you only are interested in extracting a portion of the substring that matches the regular expression.</p>
<p> </p>
<p>So we make the following change to our program:</p>
<pre class="python"><code># Search for lines that start with &#39;X&#39; followed by any
# non whitespace characters and &#39;:&#39; followed by a space
# and any number. The number can include a decimal.
# Then print the number if it is greater than zero.
import re
hand = open(&#39;mbox-short.txt&#39;)
for line in hand:
    line = line.rstrip()
    x = re.findall(&#39;^X\S*: ([0-9.]+)&#39;, line)
    if len(x) &gt; 0:
        print(x)

# Code: http://www.py4e.com/code3/re11.py</code></pre>
<p>Instead of calling <code>search()</code>, we add parentheses around the part of the regular expression that represents the floating-point number to indicate we only want <code>findall()</code> to give us back the floating-point number portion of the matching string.</p>
<p>The output from this program is as follows:</p>
<pre><code>[&#39;0.8475&#39;]
[&#39;0.0000&#39;]
[&#39;0.6178&#39;]
[&#39;0.0000&#39;]
[&#39;0.6961&#39;]
[&#39;0.0000&#39;]
..</code></pre>
<p>The numbers are still in a list and need to be converted from strings to floating point, but we have used the power of regular expressions to both search and extract the information we found interesting.</p>
<p>As another example of this technique, if you look at the file there are a number of lines of the form:</p>
<pre><code>Details: http://source.sakaiproject.org/viewsvn/?view=rev&amp;rev=39772</code></pre>
<p>If we wanted to extract all of the revision numbers (the integer number at the end of these lines) using the same technique as above, we could write the following program:</p>
<pre class="python"><code># Search for lines that start with &#39;Details: rev=&#39;
# followed by numbers and &#39;.&#39;
# Then print the number if it is greater than zero
import re
hand = open(&#39;mbox-short.txt&#39;)
for line in hand:
    line = line.rstrip()
    x = re.findall(&#39;^Details:.*rev=([0-9.]+)&#39;, line)
    if len(x) &gt; 0:
        print(x)

# Code: http://www.py4e.com/code3/re12.py</code></pre>
<p>Translating our regular expression, we are looking for lines that start with <code>Details:</code>, followed by any number of characters (<code>.*</code>), followed by <code>rev=</code>, and then by one or more digits. We want to find lines that match the entire expression but we only want to extract the integer number at the end of the line, so we surround <code>[0-9]+</code> with parentheses.</p>
<p>When we run the program, we get the following output:</p>
<pre><code>[&#39;39772&#39;]
[&#39;39771&#39;]
[&#39;39770&#39;]
[&#39;39769&#39;]
...</code></pre>
<p>Remember that the <code>[0-9]+</code> is “greedy” and it tries to make as large a string of digits as possible before extracting those digits. This “greedy” behavior is why we get all five digits for each number. The regular expression library expands in both directions until it encounters a non-digit, or the beginning or the end of a line.</p>
<p>Now we can use regular expressions to redo an exercise from earlier in the book where we were interested in the time of day of each mail message. We looked for lines of the form:</p>
<pre><code>From stephen.marquard@uct.ac.za Sat Jan  5 09:14:16 2008</code></pre>
<p>and wanted to extract the hour of the day for each line. Previously we did this with two calls to <code>split</code>. First the line was split into words and then we pulled out the fifth word and split it again on the colon character to pull out the two characters we were interested in.</p>
<p>While this worked, it actually results in pretty brittle code that is assuming the lines are nicely formatted. If you were to add enough error checking (or a big try/except block) to insure that your program never failed when presented with incorrectly formatted lines, the code would balloon to 10-15 lines of code that was pretty hard to read.</p>
<p>We can do this in a far simpler way with the following regular expression:</p>
<pre><code>^From .* [0-9][0-9]:</code></pre>
<p>The translation of this regular expression is that we are looking for lines that start with <code>From</code> (note the space), followed by any number of characters (<code>.*</code>), followed by a space, followed by two digits <code>[0-9][0-9]</code>, followed by a colon character. This is the definition of the kinds of lines we are looking for.</p>
<p>In order to pull out only the hour using <code>findall()</code>, we add parentheses around the two digits as follows:</p>
<pre><code>^From .* ([0-9][0-9]):</code></pre>
<p>This results in the following program:</p>
<pre class="python"><code># Search for lines that start with From and a character
# followed by a two digit number between 00 and 99 followed by &#39;:&#39;
# Then print the number if it is greater than zero
import re
hand = open(&#39;mbox-short.txt&#39;)
for line in hand:
    line = line.rstrip()
    x = re.findall(&#39;^From .* ([0-9][0-9]):&#39;, line)
    if len(x) &gt; 0: print(x)

# Code: http://www.py4e.com/code3/re13.py</code></pre>
<p>When the program runs, it produces the following output:</p>
<pre><code>[&#39;09&#39;]
[&#39;18&#39;]
[&#39;16&#39;]
[&#39;15&#39;]
...</code></pre>
<h2 id="escape-character">Escape character</h2>
<p>Since we use special characters in regular expressions to match the beginning or end of a line or specify wild cards, we need a way to indicate that these characters are “normal” and we want to match the actual character such as a dollar sign or caret.</p>
<p>We can indicate that we want to simply match a character by prefixing that character with a backslash. For example, we can find money amounts with the following regular expression.</p>
<pre class="python"><code>import re
x = &#39;We just received $10.00 for cookies.&#39;
y = re.findall(&#39;\$[0-9.]+&#39;,x)</code></pre>
<p>Since we prefix the dollar sign with a backslash, it actually matches the dollar sign in the input string instead of matching the “end of line”, and the rest of the regular expression matches one or more digits or the period character. <em>Note:</em> Inside square brackets, characters are not “special”. So when we say <code>[0-9.]</code>, it really means digits or a period. Outside of square brackets, a period is the “wild-card” character and matches any character. Inside square brackets, the period is a period.</p>
<h2 id="summary">Summary</h2>
<p>While this only scratched the surface of regular expressions, we have learned a bit about the language of regular expressions. They are search strings with special characters in them that communicate your wishes to the regular expression system as to what defines “matching” and what is extracted from the matched strings. Here are some of those special characters and character sequences:</p>
<p><code>^</code> Matches the beginning of the line.</p>
<p><code>$</code> Matches the end of the line.</p>
<p><code>.</code> Matches any character (a wildcard).</p>
<p><code>\s</code> Matches a whitespace character.</p>
<p><code>\S</code> Matches a non-whitespace character (opposite of \s).</p>
<p><code>*</code> Applies to the immediately preceding character(s) and indicates to match zero or more times.</p>
<p><code>*?</code> Applies to the immediately preceding character(s) and indicates to match zero or more times in “non-greedy mode”.</p>
<p><code>+</code> Applies to the immediately preceding character(s) and indicates to match one or more times.</p>
<p><code>+?</code> Applies to the immediately preceding character(s) and indicates to match one or more times in “non-greedy mode”.</p>
<p><code>?</code> Applies to the immediately preceding character(s) and indicates to match zero or one time.</p>
<p><code>??</code> Applies to the immediately preceding character(s) and indicates to match zero or one time in “non-greedy mode”.</p>
<p><code>[aeiou]</code> Matches a single character as long as that character is in the specified set. In this example, it would match “a”, “e”, “i”, “o”, or “u”, but no other characters.</p>
<p><code>[a-z0-9]</code> You can specify ranges of characters using the minus sign. This example is a single character that must be a lowercase letter or a digit.</p>
<p><code>[^A-Za-z]</code> When the first character in the set notation is a caret, it inverts the logic. This example matches a single character that is anything <em>other than</em> an uppercase or lowercase letter.</p>
<p><code>( )</code> When parentheses are added to a regular expression, they are ignored for the purpose of matching, but allow you to extract a particular subset of the matched string rather than the whole string when using <code>findall()</code>.</p>
<p><code>\b</code> Matches the empty string, but only at the start or end of a word.</p>
<p><code>\B</code> Matches the empty string, but not at the start or end of a word.</p>
<p><code>\d</code> Matches any decimal digit; equivalent to the set [0-9].</p>
<p><code>\D</code> Matches any non-digit character; equivalent to the set [^0-9].</p>
<h2 id="bonus-section-for-unix-linux-users">Bonus section for Unix / Linux users</h2>
<p>Support for searching files using regular expressions was built into the Unix operating system since the 1960s and it is available in nearly all programming languages in one form or another.</p>
<p></p>
<p>As a matter of fact, there is a command-line program built into Unix called <em>grep</em> (Generalized Regular Expression Parser) that does pretty much the same as the <code>search()</code> examples in this chapter. So if you have a Macintosh or Linux system, you can try the following commands in your command-line window.</p>
<pre class="bash"><code>$ grep &#39;^From:&#39; mbox-short.txt
From: stephen.marquard@uct.ac.za
From: louis@media.berkeley.edu
From: zqian@umich.edu
From: rjlowe@iupui.edu</code></pre>
<p>This tells <code>grep</code> to show you lines that start with the string “From:” in the file <em>mbox-short.txt</em>. If you experiment with the <code>grep</code> command a bit and read the documentation for <code>grep</code>, you will find some subtle differences between the regular expression support in Python and the regular expression support in <code>grep</code>. As an example, <code>grep</code> does not support the non-blank character <code>\S</code> so you will need to use the slightly more complex set notation <code>[^ ]</code>, which simply means match a character that is anything other than a space.</p>
<h2 id="debugging">Debugging</h2>
<p>Python has some simple and rudimentary built-in documentation that can be quite helpful if you need a quick refresher to trigger your memory about the exact name of a particular method. This documentation can be viewed in the Python interpreter in interactive mode.</p>
<p>You can bring up an interactive help system using <code>help()</code>.</p>
<pre class="python"><code>&gt;&gt;&gt; help()

help&gt; modules</code></pre>
<p>If you know what module you want to use, you can use the <code>dir()</code> command to find the methods in the module as follows:</p>
<pre class="python trinket"><code>&gt;&gt;&gt; import re
&gt;&gt;&gt; dir(re)
[.. &#39;compile&#39;, &#39;copy_reg&#39;, &#39;error&#39;, &#39;escape&#39;, &#39;findall&#39;,
&#39;finditer&#39;, &#39;match&#39;, &#39;purge&#39;, &#39;search&#39;, &#39;split&#39;, &#39;sre_compile&#39;,
&#39;sre_parse&#39;, &#39;sub&#39;, &#39;subn&#39;, &#39;sys&#39;, &#39;template&#39;]</code></pre>
<p>You can also get a small amount of documentation on a particular method using the dir command.</p>
<pre class="python trinket"><code>&gt;&gt;&gt; help (re.search)
Help on function search in module re:

search(pattern, string, flags=0)
    Scan through string looking for a match to the pattern, returning
    a match object, or None if no match was found.
&gt;&gt;&gt;</code></pre>
<p>The built-in documentation is not very extensive, but it can be helpful when you are in a hurry or don’t have access to a web browser or search engine.</p>
<h2 id="glossary">Glossary</h2>
<dl>
<dt>brittle code</dt>
<dd>Code that works when the input data is in a particular format but is prone to breakage if there is some deviation from the correct format. We call this “brittle code” because it is easily broken.
</dd>
<dt>greedy matching</dt>
<dd>The notion that the <code>+</code> and <code>*</code> characters in a regular expression expand outward to match the largest possible string.
</dd>
<dt>grep</dt>
<dd>A command available in most Unix systems that searches through text files looking for lines that match regular expressions. The command name stands for “Generalized Regular Expression Parser”.
</dd>
<dt>regular expression</dt>
<dd>A language for expressing more complex search strings. A regular expression may contain special characters that indicate that a search only matches at the beginning or end of a line or many other similar capabilities.
</dd>
<dt>wild card</dt>
<dd>A special character that matches any character. In regular expressions the wild-card character is the period.
</dd>
</dl>
<h2 id="exercises">Exercises</h2>
<p><strong>Exercise 1: Write a simple program to simulate the operation of the <code>grep</code> command on Unix. Ask the user to enter a regular expression and count the number of lines that matched the regular expression:</strong></p>
<pre><code>$ python grep.py
Enter a regular expression: ^Author
mbox.txt had 1798 lines that matched ^Author

$ python grep.py
Enter a regular expression: ^X-
mbox.txt had 14368 lines that matched ^X-

$ python grep.py
Enter a regular expression: java$
mbox.txt had 4175 lines that matched java$</code></pre>
<p><strong>Exercise 2: Write a program to look for lines of the form:</strong></p>
<pre><code>New Revision: 39772</code></pre>
<p><strong>Extract the number from each of the lines using a regular expression and the <code>findall()</code> method. Compute the average of the numbers and print out the average as an integer.</strong></p>
<pre><code>Enter file:mbox.txt
38549

Enter file:mbox-short.txt
39756</code></pre>
</body>
</html>
<?php if ( file_exists("../bookfoot.php") ) {
  $HTML_FILE = basename(__FILE__);
  $HTML = ob_get_contents();
  ob_end_clean();
  require_once "../bookfoot.php";
}?>
