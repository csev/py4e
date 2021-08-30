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
<h1 id="tuples">Tuples</h1>
<h2 id="tuples-are-immutable">Tuples are immutable</h2>
<p>  </p>
<p>A tuple<a href="#fn1" class="footnote-ref" id="fnref1" role="doc-noteref"><sup>1</sup></a> is a sequence of values much like a list. The values stored in a tuple can be any type, and they are indexed by integers. The important difference is that tuples are <em>immutable</em>. Tuples are also <em>comparable</em> and <em>hashable</em> so we can sort lists of them and use tuples as key values in Python dictionaries.</p>
<p>   </p>
<p>Syntactically, a tuple is a comma-separated list of values:</p>
<pre class="python"><code>&gt;&gt;&gt; t = &#39;a&#39;, &#39;b&#39;, &#39;c&#39;, &#39;d&#39;, &#39;e&#39;</code></pre>
<p>Although it is not necessary, it is common to enclose tuples in parentheses to help us quickly identify tuples when we look at Python code:</p>
<p></p>
<pre class="python"><code>&gt;&gt;&gt; t = (&#39;a&#39;, &#39;b&#39;, &#39;c&#39;, &#39;d&#39;, &#39;e&#39;)</code></pre>
<p>To create a tuple with a single element, you have to include the final comma:</p>
<p> </p>
<pre class="python trinket"><code>&gt;&gt;&gt; t1 = (&#39;a&#39;,)
&gt;&gt;&gt; type(t1)
&lt;type &#39;tuple&#39;&gt;</code></pre>
<p>Without the comma Python treats <code>('a')</code> as an expression with a string in parentheses that evaluates to a string:</p>
<pre class="python"><code>&gt;&gt;&gt; t2 = (&#39;a&#39;)
&gt;&gt;&gt; type(t2)
&lt;type &#39;str&#39;&gt;</code></pre>
<p>Another way to construct a tuple is the built-in function <code>tuple</code>. With no argument, it creates an empty tuple:</p>
<p> </p>
<pre class="python trinket"><code>&gt;&gt;&gt; t = tuple()
&gt;&gt;&gt; print(t)
()</code></pre>
<p>If the argument is a sequence (string, list, or tuple), the result of the call to <code>tuple</code> is a tuple with the elements of the sequence:</p>
<pre class="python trinket"><code>&gt;&gt;&gt; t = tuple(&#39;lupins&#39;)
&gt;&gt;&gt; print(t)
(&#39;l&#39;, &#39;u&#39;, &#39;p&#39;, &#39;i&#39;, &#39;n&#39;, &#39;s&#39;)</code></pre>
<p>Because <code>tuple</code> is the name of a constructor, you should avoid using it as a variable name.</p>
<p>Most list operators also work on tuples. The bracket operator indexes an element:</p>
<p> </p>
<pre class="python trinket"><code>&gt;&gt;&gt; t = (&#39;a&#39;, &#39;b&#39;, &#39;c&#39;, &#39;d&#39;, &#39;e&#39;)
&gt;&gt;&gt; print(t[0])
&#39;a&#39;</code></pre>
<p>And the slice operator selects a range of elements.</p>
<p>   </p>
<pre class="python"><code>&gt;&gt;&gt; print(t[1:3])
(&#39;b&#39;, &#39;c&#39;)</code></pre>
<p>But if you try to modify one of the elements of the tuple, you get an error:</p>
<p>   </p>
<pre class="python"><code>&gt;&gt;&gt; t[0] = &#39;A&#39;
TypeError: object doesn&#39;t support item assignment</code></pre>
<p>You can’t modify the elements of a tuple, but you can replace one tuple with another:</p>
<pre class="python trinket"><code>&gt;&gt;&gt; t = (&#39;A&#39;,) + t[1:]
&gt;&gt;&gt; print(t)
(&#39;A&#39;, &#39;b&#39;, &#39;c&#39;, &#39;d&#39;, &#39;e&#39;)</code></pre>
<h2 id="comparing-tuples">Comparing tuples</h2>
<p>   </p>
<p>The comparison operators work with tuples and other sequences. Python starts by comparing the first element from each sequence. If they are equal, it goes on to the next element, and so on, until it finds elements that differ. Subsequent elements are not considered (even if they are really big).</p>
<pre class="python trinket"><code>&gt;&gt;&gt; (0, 1, 2) &lt; (0, 3, 4)
True
&gt;&gt;&gt; (0, 1, 2000000) &lt; (0, 3, 4)
True</code></pre>
<p>The <code>sort</code> function works the same way. It sorts primarily by first element, but in the case of a tie, it sorts by second element, and so on.</p>
<p>This feature lends itself to a pattern called <em>DSU</em> for</p>
<dl>
<dt>Decorate</dt>
<dd>a sequence by building a list of tuples with one or more sort keys preceding the elements from the sequence,
</dd>
<dt>Sort</dt>
<dd>the list of tuples using the Python built-in <code>sort</code>, and
</dd>
<dt>Undecorate</dt>
<dd>by extracting the sorted elements of the sequence.
</dd>
</dl>
<p>    </p>
<p>For example, suppose you have a list of words and you want to sort them from longest to shortest:</p>
<pre class="python"><code>txt = &#39;but soft what light in yonder window breaks&#39;
words = txt.split()
t = list()
for word in words:
    t.append((len(word), word))

t.sort(reverse=True)

res = list()
for length, word in t:
    res.append(word)

print(res)

# Code: http://www.py4e.com/code3/soft.py</code></pre>
<p>The first loop builds a list of tuples, where each tuple is a word preceded by its length.</p>
<p><code>sort</code> compares the first element, length, first, and only considers the second element to break ties. The keyword argument <code>reverse=True</code> tells <code>sort</code> to go in decreasing order.</p>
<p>  </p>
<p>The second loop traverses the list of tuples and builds a list of words in descending order of length. The four-character words are sorted in <em>reverse</em> alphabetical order, so “what” appears before “soft” in the following list.</p>
<p>The output of the program is as follows:</p>
<pre><code>[&#39;yonder&#39;, &#39;window&#39;, &#39;breaks&#39;, &#39;light&#39;, &#39;what&#39;,
&#39;soft&#39;, &#39;but&#39;, &#39;in&#39;]</code></pre>
<p>Of course the line loses much of its poetic impact when turned into a Python list and sorted in descending word length order.</p>
<h2 id="tuple-assignment">Tuple assignment</h2>
<p>   </p>
<p>One of the unique syntactic features of the Python language is the ability to have a tuple on the left side of an assignment statement. This allows you to assign more than one variable at a time when the left side is a sequence.</p>
<p>In this example we have a two-element list (which is a sequence) and assign the first and second elements of the sequence to the variables <code>x</code> and <code>y</code> in a single statement.</p>
<pre class="python trinket"><code>&gt;&gt;&gt; m = [ &#39;have&#39;, &#39;fun&#39; ]
&gt;&gt;&gt; x, y = m
&gt;&gt;&gt; x
&#39;have&#39;
&gt;&gt;&gt; y
&#39;fun&#39;
&gt;&gt;&gt;</code></pre>
<p>It is not magic, Python <em>roughly</em> translates the tuple assignment syntax to be the following:<a href="#fn2" class="footnote-ref" id="fnref2" role="doc-noteref"><sup>2</sup></a></p>
<pre class="python trinket"><code>&gt;&gt;&gt; m = [ &#39;have&#39;, &#39;fun&#39; ]
&gt;&gt;&gt; x = m[0]
&gt;&gt;&gt; y = m[1]
&gt;&gt;&gt; x
&#39;have&#39;
&gt;&gt;&gt; y
&#39;fun&#39;
&gt;&gt;&gt;</code></pre>
<p>Stylistically when we use a tuple on the left side of the assignment statement, we omit the parentheses, but the following is an equally valid syntax:</p>
<pre class="python"><code>&gt;&gt;&gt; m = [ &#39;have&#39;, &#39;fun&#39; ]
&gt;&gt;&gt; (x, y) = m
&gt;&gt;&gt; x
&#39;have&#39;
&gt;&gt;&gt; y
&#39;fun&#39;
&gt;&gt;&gt;</code></pre>
<p>A particularly clever application of tuple assignment allows us to <em>swap</em> the values of two variables in a single statement:</p>
<pre class="python"><code>&gt;&gt;&gt; a, b = b, a</code></pre>
<p>Both sides of this statement are tuples, but the left side is a tuple of variables; the right side is a tuple of expressions. Each value on the right side is assigned to its respective variable on the left side. All the expressions on the right side are evaluated before any of the assignments.</p>
<p>The number of variables on the left and the number of values on the right must be the same:</p>
<p> </p>
<pre class="python"><code>&gt;&gt;&gt; a, b = 1, 2, 3
ValueError: too many values to unpack</code></pre>
<p>More generally, the right side can be any kind of sequence (string, list, or tuple). For example, to split an email address into a user name and a domain, you could write:</p>
<p>  </p>
<pre class="python"><code>&gt;&gt;&gt; addr = &#39;monty@python.org&#39;
&gt;&gt;&gt; uname, domain = addr.split(&#39;@&#39;)</code></pre>
<p>The return value from <code>split</code> is a list with two elements; the first element is assigned to <code>uname</code>, the second to <code>domain</code>.</p>
<pre class="python"><code>&gt;&gt;&gt; print(uname)
monty
&gt;&gt;&gt; print(domain)
python.org</code></pre>
<h2 id="dictionaries-and-tuples">Dictionaries and tuples</h2>
<p>   </p>
<p>Dictionaries have a method called <code>items</code> that returns a list of tuples, where each tuple is a key-value pair:</p>
<pre class="python trinket"><code>&gt;&gt;&gt; d = {&#39;a&#39;:10, &#39;b&#39;:1, &#39;c&#39;:22}
&gt;&gt;&gt; t = list(d.items())
&gt;&gt;&gt; print(t)
[(&#39;b&#39;, 1), (&#39;a&#39;, 10), (&#39;c&#39;, 22)]</code></pre>
<p>As you should expect from a dictionary, the items are in no particular order.</p>
<p>However, since the list of tuples is a list, and tuples are comparable, we can now sort the list of tuples. Converting a dictionary to a list of tuples is a way for us to output the contents of a dictionary sorted by key:</p>
<pre class="python"><code>&gt;&gt;&gt; d = {&#39;a&#39;:10, &#39;b&#39;:1, &#39;c&#39;:22}
&gt;&gt;&gt; t = list(d.items())
&gt;&gt;&gt; t
[(&#39;b&#39;, 1), (&#39;a&#39;, 10), (&#39;c&#39;, 22)]
&gt;&gt;&gt; t.sort()
&gt;&gt;&gt; t
[(&#39;a&#39;, 10), (&#39;b&#39;, 1), (&#39;c&#39;, 22)]</code></pre>
<p>The new list is sorted in ascending alphabetical order by the key value.</p>
<h2 id="multiple-assignment-with-dictionaries">Multiple assignment with dictionaries</h2>
<p> </p>
<p>Combining <code>items</code>, tuple assignment, and <code>for</code>, you can see a nice code pattern for traversing the keys and values of a dictionary in a single loop:</p>
<pre class="python"><code>for key, val in list(d.items()):
    print(val, key)</code></pre>
<p>This loop has two <em>iteration variables</em> because <code>items</code> returns a list of tuples and <code>key, val</code> is a tuple assignment that successively iterates through each of the key-value pairs in the dictionary.</p>
<p>For each iteration through the loop, both <code>key</code> and <code>value</code> are advanced to the next key-value pair in the dictionary (still in hash order).</p>
<p>The output of this loop is:</p>
<pre><code>10 a
22 c
1 b</code></pre>
<p>Again, it is in hash key order (i.e., no particular order).</p>
<p>If we combine these two techniques, we can print out the contents of a dictionary sorted by the <em>value</em> stored in each key-value pair.</p>
<p>To do this, we first make a list of tuples where each tuple is <code>(value, key)</code>. The <code>items</code> method would give us a list of <code>(key, value)</code> tuples, but this time we want to sort by value, not key. Once we have constructed the list with the value-key tuples, it is a simple matter to sort the list in reverse order and print out the new, sorted list.</p>
<pre class="python"><code>&gt;&gt;&gt; d = {&#39;a&#39;:10, &#39;b&#39;:1, &#39;c&#39;:22}
&gt;&gt;&gt; l = list()
&gt;&gt;&gt; for key, val in d.items() :
...     l.append( (val, key) )
...
&gt;&gt;&gt; l
[(10, &#39;a&#39;), (22, &#39;c&#39;), (1, &#39;b&#39;)]
&gt;&gt;&gt; l.sort(reverse=True)
&gt;&gt;&gt; l
[(22, &#39;c&#39;), (10, &#39;a&#39;), (1, &#39;b&#39;)]
&gt;&gt;&gt;</code></pre>
<p>By carefully constructing the list of tuples to have the value as the first element of each tuple, we can sort the list of tuples and get our dictionary contents sorted by value.</p>
<h2 id="the-most-common-words">The most common words</h2>
<p></p>
<p>Coming back to our running example of the text from <em>Romeo and Juliet</em> Act 2, Scene 2, we can augment our program to use this technique to print the ten most common words in the text as follows:</p>
<pre class="python"><code>import string
fhand = open(&#39;romeo-full.txt&#39;)
counts = dict()
for line in fhand:
    line = line.translate(str.maketrans(&#39;&#39;, &#39;&#39;, string.punctuation))
    line = line.lower()
    words = line.split()
    for word in words:
        if word not in counts:
            counts[word] = 1
        else:
            counts[word] += 1

# Sort the dictionary by value
lst = list()
for key, val in list(counts.items()):
    lst.append((val, key))

lst.sort(reverse=True)

for key, val in lst[:10]:
    print(key, val)

# Code: http://www.py4e.com/code3/count3.py</code></pre>
<p>The first part of the program which reads the file and computes the dictionary that maps each word to the count of words in the document is unchanged. But instead of simply printing out <code>counts</code> and ending the program, we construct a list of <code>(val, key)</code> tuples and then sort the list in reverse order.</p>
<p>Since the value is first, it will be used for the comparisons. If there is more than one tuple with the same value, it will look at the second element (the key), so tuples where the value is the same will be further sorted by the alphabetical order of the key.</p>
<p>At the end we write a nice <code>for</code> loop which does a multiple assignment iteration and prints out the ten most common words by iterating through a slice of the list (<code>lst[:10]</code>).</p>
<p>So now the output finally looks like what we want for our word frequency analysis.</p>
<pre><code>61 i
42 and
40 romeo
34 to
34 the
32 thou
32 juliet
30 that
29 my
24 thee</code></pre>
<p>The fact that this complex data parsing and analysis can be done with an easy-to-understand 19-line Python program is one reason why Python is a good choice as a language for exploring information.</p>
<h2 id="using-tuples-as-keys-in-dictionaries">Using tuples as keys in dictionaries</h2>
<p> </p>
<p>Because tuples are <em>hashable</em> and lists are not, if we want to create a <em>composite</em> key to use in a dictionary we must use a tuple as the key.</p>
<p>We would encounter a composite key if we wanted to create a telephone directory that maps from last-name, first-name pairs to telephone numbers. Assuming that we have defined the variables <code>last</code>, <code>first</code>, and <code>number</code>, we could write a dictionary assignment statement as follows:</p>
<pre class="python"><code>directory[last,first] = number</code></pre>
<p>The expression in brackets is a tuple. We could use tuple assignment in a <code>for</code> loop to traverse this dictionary.</p>
<p></p>
<pre class="python"><code>for last, first in directory:
    print(first, last, directory[last,first])</code></pre>
<p>This loop traverses the keys in <code>directory</code>, which are tuples. It assigns the elements of each tuple to <code>last</code> and <code>first</code>, then prints the name and corresponding telephone number.</p>
<h2 id="sequences-strings-lists-and-tuples---oh-my">Sequences: strings, lists, and tuples - Oh My!</h2>
<p></p>
<p>I have focused on lists of tuples, but almost all of the examples in this chapter also work with lists of lists, tuples of tuples, and tuples of lists. To avoid enumerating the possible combinations, it is sometimes easier to talk about sequences of sequences.</p>
<p>In many contexts, the different kinds of sequences (strings, lists, and tuples) can be used interchangeably. So how and why do you choose one over the others?</p>
<p>    </p>
<p>To start with the obvious, strings are more limited than other sequences because the elements have to be characters. They are also immutable. If you need the ability to change the characters in a string (as opposed to creating a new string), you might want to use a list of characters instead.</p>
<p>Lists are more common than tuples, mostly because they are mutable. But there are a few cases where you might prefer tuples:</p>
<ol type="1">
<li><p>In some contexts, like a <code>return</code> statement, it is syntactically simpler to create a tuple than a list. In other contexts, you might prefer a list.</p></li>
<li><p>If you want to use a sequence as a dictionary key, you have to use an immutable type like a tuple or string.</p></li>
<li><p>If you are passing a sequence as an argument to a function, using tuples reduces the potential for unexpected behavior due to aliasing.</p></li>
</ol>
<p>Because tuples are immutable, they don’t provide methods like <code>sort</code> and <code>reverse</code>, which modify existing lists. However Python provides the built-in functions <code>sorted</code> and <code>reversed</code>, which take any sequence as a parameter and return a new sequence with the same elements in a different order.</p>
<p>   </p>
<h2 id="debugging">Debugging</h2>
<p>   </p>
<p>Lists, dictionaries and tuples are known generically as <em>data structures</em>; in this chapter we are starting to see compound data structures, like lists of tuples, and dictionaries that contain tuples as keys and lists as values. Compound data structures are useful, but they are prone to what I call <em>shape errors</em>; that is, errors caused when a data structure has the wrong type, size, or composition, or perhaps you write some code and forget the shape of your data and introduce an error. For example, if you are expecting a list with one integer and I give you a plain old integer (not in a list), it won’t work.</p>
<h2 id="glossary">Glossary</h2>
<dl>
<dt>comparable</dt>
<dd>A type where one value can be checked to see if it is greater than, less than, or equal to another value of the same type. Types which are comparable can be put in a list and sorted.
</dd>
<dt>data structure</dt>
<dd>A collection of related values, often organized in lists, dictionaries, tuples, etc.
</dd>
<dt>DSU</dt>
<dd>Abbreviation of “decorate-sort-undecorate”, a pattern that involves building a list of tuples, sorting, and extracting part of the result.
</dd>
<dt>gather</dt>
<dd>The operation of assembling a variable-length argument tuple.
</dd>
<dt>hashable</dt>
<dd>A type that has a hash function. Immutable types like integers, floats, and strings are hashable; mutable types like lists and dictionaries are not.
</dd>
<dt>scatter</dt>
<dd>The operation of treating a sequence as a list of arguments.
</dd>
<dt>shape (of a data structure)</dt>
<dd>A summary of the type, size, and composition of a data structure.
</dd>
<dt>singleton</dt>
<dd>A list (or other sequence) with a single element.
</dd>
<dt>tuple</dt>
<dd>An immutable sequence of elements.
</dd>
<dt>tuple assignment</dt>
<dd>An assignment with a sequence on the right side and a tuple of variables on the left. The right side is evaluated and then its elements are assigned to the variables on the left.
</dd>
</dl>
<h2 id="exercises">Exercises</h2>
<p><strong>Exercise 1: Revise a previous program as follows: Read and parse the “From” lines and pull out the addresses from the line. Count the number of messages from each person using a dictionary.</strong></p>
<p><strong>After all the data has been read, print the person with the most commits by creating a list of (count, email) tuples from the dictionary. Then sort the list in reverse order and print out the person who has the most commits.</strong></p>
<pre><code>Sample Line:
From stephen.marquard@uct.ac.za Sat Jan  5 09:14:16 2008

Enter a file name: mbox-short.txt
cwen@iupui.edu 5

Enter a file name: mbox.txt
zqian@umich.edu 195</code></pre>
<p><strong>Exercise 2: This program counts the distribution of the hour of the day for each of the messages. You can pull the hour from the “From” line by finding the time string and then splitting that string into parts using the colon character. Once you have accumulated the counts for each hour, print out the counts, one per line, sorted by hour as shown below.</strong></p>
<pre><code>python timeofday.py
Enter a file name: mbox-short.txt
04 3
06 1
07 1
09 2
10 3
11 6
14 1
15 2
16 4
17 2
18 1
19 1</code></pre>
<p><strong>Exercise 3: Write a program that reads a file and prints the <em>letters</em> in decreasing order of frequency. Your program should convert all the input to lower case and only count the letters a-z. Your program should not count spaces, digits, punctuation, or anything other than the letters a-z. Find text samples from several different languages and see how letter frequency varies between languages. Compare your results with the tables at <a href="https://wikipedia.org/wiki/Letter_frequencies" class="uri">https://wikipedia.org/wiki/Letter_frequencies</a>.</strong></p>
<p> </p>
<section class="footnotes" role="doc-endnotes">
<hr />
<ol>
<li id="fn1" role="doc-endnote"><p>Fun fact: The word “tuple” comes from the names given to sequences of numbers of varying lengths: single, double, triple, quadruple, quintuple, sextuple, septuple, etc.<a href="#fnref1" class="footnote-back" role="doc-backlink">↩︎</a></p></li>
<li id="fn2" role="doc-endnote"><p>Python does not translate the syntax literally. For example, if you try this with a dictionary, it will not work as you might expect.<a href="#fnref2" class="footnote-back" role="doc-backlink">↩︎</a></p></li>
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
