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
<h1 id="lists">Lists</h1>
<p> </p>
<h2 id="a-list-is-a-sequence">A list is a sequence</h2>
<p>Like a string, a <em>list</em> is a sequence of values. In a string, the values are characters; in a list, they can be any type. The values in list are called <em>elements</em> or sometimes <em>items</em>.</p>
<p>  </p>
<p>There are several ways to create a new list; the simplest is to enclose the elements in square brackets (“[” and ”]”):</p>
<pre class="python"><code>[10, 20, 30, 40]
[&#39;crunchy frog&#39;, &#39;ram bladder&#39;, &#39;lark vomit&#39;]</code></pre>
<p>The first example is a list of four integers. The second is a list of three strings. The elements of a list don’t have to be the same type. The following list contains a string, a float, an integer, and (lo!) another list:</p>
<pre class="python"><code>[&#39;spam&#39;, 2.0, 5, [10, 20]]</code></pre>
<p>A list within another list is <em>nested</em>.</p>
<p> </p>
<p>A list that contains no elements is called an empty list; you can create one with empty brackets, <code>[]</code>.</p>
<p> </p>
<p>As you might expect, you can assign list values to variables:</p>
<pre class="python trinket"><code>&gt;&gt;&gt; cheeses = [&#39;Cheddar&#39;, &#39;Edam&#39;, &#39;Gouda&#39;]
&gt;&gt;&gt; numbers = [17, 123]
&gt;&gt;&gt; empty = []
&gt;&gt;&gt; print(cheeses, numbers, empty)
[&#39;Cheddar&#39;, &#39;Edam&#39;, &#39;Gouda&#39;] [17, 123] []</code></pre>
<p></p>
<h2 id="lists-are-mutable">Lists are mutable</h2>
<p>     </p>
<p>The syntax for accessing the elements of a list is the same as for accessing the characters of a string: the bracket operator. The expression inside the brackets specifies the index. Remember that the indices start at 0:</p>
<pre class="python"><code>&gt;&gt;&gt; print(cheeses[0])
Cheddar</code></pre>
<p>Unlike strings, lists are mutable because you can change the order of items in a list or reassign an item in a list. When the bracket operator appears on the left side of an assignment, it identifies the element of the list that will be assigned.</p>
<p></p>
<pre class="python trinket"><code>&gt;&gt;&gt; numbers = [17, 123]
&gt;&gt;&gt; numbers[1] = 5
&gt;&gt;&gt; print(numbers)
[17, 5]</code></pre>
<p>The one-th element of <code>numbers</code>, which used to be 123, is now 5.</p>
<p> </p>
<p>You can think of a list as a relationship between indices and elements. This relationship is called a <em>mapping</em>; each index “maps to” one of the elements.</p>
<p> </p>
<p>List indices work the same way as string indices:</p>
<ul>
<li><p>Any integer expression can be used as an index.</p></li>
<li><p>If you try to read or write an element that does not exist, you get an <code>IndexError</code>.</p></li>
</ul>
<p> </p>
<ul>
<li>If an index has a negative value, it counts backward from the end of the list.</li>
</ul>
<p>    </p>
<p>The <code>in</code> operator also works on lists.</p>
<pre class="python trinket"><code>&gt;&gt;&gt; cheeses = [&#39;Cheddar&#39;, &#39;Edam&#39;, &#39;Gouda&#39;]
&gt;&gt;&gt; &#39;Edam&#39; in cheeses
True
&gt;&gt;&gt; &#39;Brie&#39; in cheeses
False</code></pre>
<h2 id="traversing-a-list">Traversing a list</h2>
<p>    </p>
<p>The most common way to traverse the elements of a list is with a <code>for</code> loop. The syntax is the same as for strings:</p>
<pre class="python"><code>for cheese in cheeses:
    print(cheese)</code></pre>
<p>This works well if you only need to read the elements of the list. But if you want to write or update the elements, you need the indices. A common way to do that is to combine the functions <code>range</code> and <code>len</code>:</p>
<p> </p>
<pre class="python"><code>for i in range(len(numbers)):
    numbers[i] = numbers[i] * 2</code></pre>
<p>This loop traverses the list and updates each element. <code>len</code> returns the number of elements in the list. <code>range</code> returns a list of indices from 0 to <span class="math inline"><em>n</em> − 1</span>, where <span class="math inline"><em>n</em></span> is the length of the list. Each time through the loop, <code>i</code> gets the index of the next element. The assignment statement in the body uses <code>i</code> to read the old value of the element and to assign the new value.</p>
<p> </p>
<p>A <code>for</code> loop over an empty list never executes the body:</p>
<pre class="python"><code>for x in empty:
    print(&#39;This never happens.&#39;)</code></pre>
<p>Although a list can contain another list, the nested list still counts as a single element. The length of this list is four:</p>
<p> </p>
<pre class="python"><code>[&#39;spam&#39;, 1, [&#39;Brie&#39;, &#39;Roquefort&#39;, &#39;Pol le Veq&#39;], [1, 2, 3]]</code></pre>
<h2 id="list-operations">List operations</h2>
<p></p>
<p>The <code>+</code> operator concatenates lists:</p>
<p> </p>
<pre class="python trinket"><code>&gt;&gt;&gt; a = [1, 2, 3]
&gt;&gt;&gt; b = [4, 5, 6]
&gt;&gt;&gt; c = a + b
&gt;&gt;&gt; print(c)
[1, 2, 3, 4, 5, 6]</code></pre>
<p>Similarly, the <code>*</code> operator repeats a list a given number of times:</p>
<p> </p>
<pre class="python trinket"><code>&gt;&gt;&gt; [0] * 4
[0, 0, 0, 0]
&gt;&gt;&gt; [1, 2, 3] * 3
[1, 2, 3, 1, 2, 3, 1, 2, 3]</code></pre>
<p>The first example repeats four times. The second example repeats the list three times.</p>
<h2 id="list-slices">List slices</h2>
<p>    </p>
<p>The slice operator also works on lists:</p>
<pre class="python trinket"><code>&gt;&gt;&gt; t = [&#39;a&#39;, &#39;b&#39;, &#39;c&#39;, &#39;d&#39;, &#39;e&#39;, &#39;f&#39;]
&gt;&gt;&gt; t[1:3]
[&#39;b&#39;, &#39;c&#39;]
&gt;&gt;&gt; t[:4]
[&#39;a&#39;, &#39;b&#39;, &#39;c&#39;, &#39;d&#39;]
&gt;&gt;&gt; t[3:]
[&#39;d&#39;, &#39;e&#39;, &#39;f&#39;]</code></pre>
<p>If you omit the first index, the slice starts at the beginning. If you omit the second, the slice goes to the end. So if you omit both, the slice is a copy of the whole list.</p>
<p>  </p>
<pre class="python"><code>&gt;&gt;&gt; t[:]
[&#39;a&#39;, &#39;b&#39;, &#39;c&#39;, &#39;d&#39;, &#39;e&#39;, &#39;f&#39;]</code></pre>
<p>Since lists are mutable, it is often useful to make a copy before performing operations that fold, spindle, or mutilate lists.</p>
<p></p>
<p>A slice operator on the left side of an assignment can update multiple elements:</p>
<p> </p>
<pre class="python trinket"><code>&gt;&gt;&gt; t = [&#39;a&#39;, &#39;b&#39;, &#39;c&#39;, &#39;d&#39;, &#39;e&#39;, &#39;f&#39;]
&gt;&gt;&gt; t[1:3] = [&#39;x&#39;, &#39;y&#39;]
&gt;&gt;&gt; print(t)
[&#39;a&#39;, &#39;x&#39;, &#39;y&#39;, &#39;d&#39;, &#39;e&#39;, &#39;f&#39;]</code></pre>
<h2 id="list-methods">List methods</h2>
<p> </p>
<p>Python provides methods that operate on lists. For example, <code>append</code> adds a new element to the end of a list:</p>
<p> </p>
<pre class="python trinket"><code>&gt;&gt;&gt; t = [&#39;a&#39;, &#39;b&#39;, &#39;c&#39;]
&gt;&gt;&gt; t.append(&#39;d&#39;)
&gt;&gt;&gt; print(t)
[&#39;a&#39;, &#39;b&#39;, &#39;c&#39;, &#39;d&#39;]</code></pre>
<p><code>extend</code> takes a list as an argument and appends all of the elements:</p>
<p> </p>
<pre class="python trinket"><code>&gt;&gt;&gt; t1 = [&#39;a&#39;, &#39;b&#39;, &#39;c&#39;]
&gt;&gt;&gt; t2 = [&#39;d&#39;, &#39;e&#39;]
&gt;&gt;&gt; t1.extend(t2)
&gt;&gt;&gt; print(t1)
[&#39;a&#39;, &#39;b&#39;, &#39;c&#39;, &#39;d&#39;, &#39;e&#39;]</code></pre>
<p>This example leaves <code>t2</code> unmodified.</p>
<p><code>sort</code> arranges the elements of the list from low to high:</p>
<p> </p>
<pre class="python trinket"><code>&gt;&gt;&gt; t = [&#39;d&#39;, &#39;c&#39;, &#39;e&#39;, &#39;b&#39;, &#39;a&#39;]
&gt;&gt;&gt; t.sort()
&gt;&gt;&gt; print(t)
[&#39;a&#39;, &#39;b&#39;, &#39;c&#39;, &#39;d&#39;, &#39;e&#39;]</code></pre>
<p>Most list methods are void; they modify the list and return <code>None</code>. If you accidentally write <code>t = t.sort()</code>, you will be disappointed with the result.</p>
<p>   </p>
<h2 id="deleting-elements">Deleting elements</h2>
<p> </p>
<p>There are several ways to delete elements from a list. If you know the index of the element you want, you can use <code>pop</code>:</p>
<p> </p>
<pre class="python trinket"><code>&gt;&gt;&gt; t = [&#39;a&#39;, &#39;b&#39;, &#39;c&#39;]
&gt;&gt;&gt; x = t.pop(1)
&gt;&gt;&gt; print(t)
[&#39;a&#39;, &#39;c&#39;]
&gt;&gt;&gt; print(x)
b</code></pre>
<p><code>pop</code> modifies the list and returns the element that was removed. If you don’t provide an index, it deletes and returns the last element.</p>
<p>If you don’t need the removed value, you can use the <code>del</code> operator:</p>
<p> </p>
<pre class="python trinket"><code>&gt;&gt;&gt; t = [&#39;a&#39;, &#39;b&#39;, &#39;c&#39;]
&gt;&gt;&gt; del t[1]
&gt;&gt;&gt; print(t)
[&#39;a&#39;, &#39;c&#39;]</code></pre>
<p>If you know the element you want to remove (but not the index), you can use <code>remove</code>:</p>
<p> </p>
<pre class="python trinket"><code>&gt;&gt;&gt; t = [&#39;a&#39;, &#39;b&#39;, &#39;c&#39;]
&gt;&gt;&gt; t.remove(&#39;b&#39;)
&gt;&gt;&gt; print(t)
[&#39;a&#39;, &#39;c&#39;]</code></pre>
<p>The return value from <code>remove</code> is <code>None</code>.</p>
<p> </p>
<p>To remove more than one element, you can use <code>del</code> with a slice index:</p>
<pre class="python trinket"><code>&gt;&gt;&gt; t = [&#39;a&#39;, &#39;b&#39;, &#39;c&#39;, &#39;d&#39;, &#39;e&#39;, &#39;f&#39;]
&gt;&gt;&gt; del t[1:5]
&gt;&gt;&gt; print(t)
[&#39;a&#39;, &#39;f&#39;]</code></pre>
<p>As usual, the slice selects all the elements up to, but not including, the second index.</p>
<h2 id="lists-and-functions">Lists and functions</h2>
<p>There are a number of built-in functions that can be used on lists that allow you to quickly look through a list without writing your own loops:</p>
<pre class="python trinket"><code>&gt;&gt;&gt; nums = [3, 41, 12, 9, 74, 15]
&gt;&gt;&gt; print(len(nums))
6
&gt;&gt;&gt; print(max(nums))
74
&gt;&gt;&gt; print(min(nums))
3
&gt;&gt;&gt; print(sum(nums))
154
&gt;&gt;&gt; print(sum(nums)/len(nums))
25</code></pre>
<p>The <code>sum()</code> function only works when the list elements are numbers. The other functions (<code>max()</code>, <code>len()</code>, etc.) work with lists of strings and other types that can be comparable.</p>
<p>We could rewrite an earlier program that computed the average of a list of numbers entered by the user using a list.</p>
<p>First, the program to compute an average without a list:</p>
<pre class="python"><code>total = 0
count = 0
while (True):
    inp = input(&#39;Enter a number: &#39;)
    if inp == &#39;done&#39;: break
    value = float(inp)
    total = total + value
    count = count + 1

average = total / count
print(&#39;Average:&#39;, average)

# Code: http://www.py4e.com/code3/avenum.py</code></pre>
<p>In this program, we have <code>count</code> and <code>total</code> variables to keep the number and running total of the user’s numbers as we repeatedly prompt the user for a number.</p>
<p>We could simply remember each number as the user entered it and use built-in functions to compute the sum and count at the end.</p>
<pre class="python"><code>numlist = list()
while (True):
    inp = input(&#39;Enter a number: &#39;)
    if inp == &#39;done&#39;: break
    value = float(inp)
    numlist.append(value)

average = sum(numlist) / len(numlist)
print(&#39;Average:&#39;, average)

# Code: http://www.py4e.com/code3/avelist.py</code></pre>
<p>We make an empty list before the loop starts, and then each time we have a number, we append it to the list. At the end of the program, we simply compute the sum of the numbers in the list and divide it by the count of the numbers in the list to come up with the average.</p>
<h2 id="lists-and-strings">Lists and strings</h2>
<p>  </p>
<p>A string is a sequence of characters and a list is a sequence of values, but a list of characters is not the same as a string. To convert from a string to a list of characters, you can use <code>list</code>:</p>
<p> </p>
<pre class="python trinket"><code>&gt;&gt;&gt; s = &#39;spam&#39;
&gt;&gt;&gt; t = list(s)
&gt;&gt;&gt; print(t)
[&#39;s&#39;, &#39;p&#39;, &#39;a&#39;, &#39;m&#39;]</code></pre>
<p>Because <code>list</code> is the name of a built-in function, you should avoid using it as a variable name. I also avoid the letter “l” because it looks too much like the number “1”. So that’s why I use “t”.</p>
<p>The <code>list</code> function breaks a string into individual letters. If you want to break a string into words, you can use the <code>split</code> method:</p>
<p> </p>
<pre class="python trinket"><code>&gt;&gt;&gt; s = &#39;pining for the fjords&#39;
&gt;&gt;&gt; t = s.split()
&gt;&gt;&gt; print(t)
[&#39;pining&#39;, &#39;for&#39;, &#39;the&#39;, &#39;fjords&#39;]
&gt;&gt;&gt; print(t[2])
the</code></pre>
<p>Once you have used <code>split</code> to break the string into a list of words, you can use the index operator (square bracket) to look at a particular word in the list.</p>
<p>You can call <code>split</code> with an optional argument called a <em>delimiter</em> that specifies which characters to use as word boundaries. The following example uses a hyphen as a delimiter:</p>
<p>  </p>
<pre class="python trinket"><code>&gt;&gt;&gt; s = &#39;spam-spam-spam&#39;
&gt;&gt;&gt; delimiter = &#39;-&#39;
&gt;&gt;&gt; s.split(delimiter)
[&#39;spam&#39;, &#39;spam&#39;, &#39;spam&#39;]</code></pre>
<p><code>join</code> is the inverse of <code>split</code>. It takes a list of strings and concatenates the elements. <code>join</code> is a string method, so you have to invoke it on the delimiter and pass the list as a parameter:</p>
<p>  </p>
<pre class="python trinket"><code>&gt;&gt;&gt; t = [&#39;pining&#39;, &#39;for&#39;, &#39;the&#39;, &#39;fjords&#39;]
&gt;&gt;&gt; delimiter = &#39; &#39;
&gt;&gt;&gt; delimiter.join(t)
&#39;pining for the fjords&#39;</code></pre>
<p>In this case the delimiter is a space character, so <code>join</code> puts a space between words. To concatenate strings without spaces, you can use the empty string, ““, as a delimiter.</p>
<p> </p>
<h2 id="parsing-lines">Parsing lines</h2>
<p>Usually when we are reading a file we want to do something to the lines other than just printing the whole line. Often we want to find the “interesting lines” and then <em>parse</em> the line to find some interesting <em>part</em> of the line. What if we wanted to print out the day of the week from those lines that start with “From”?</p>
<pre><code>From stephen.marquard@uct.ac.za Sat Jan  5 09:14:16 2008</code></pre>
<p>The <code>split</code> method is very effective when faced with this kind of problem. We can write a small program that looks for lines where the line starts with “From”, <code>split</code> those lines, and then print out the third word in the line:</p>
<pre class="python"><code>fhand = open(&#39;mbox-short.txt&#39;)
for line in fhand:
    line = line.rstrip()
    if not line.startswith(&#39;From &#39;): continue
    words = line.split()
    print(words[2])

# Code: http://www.py4e.com/code3/search5.py</code></pre>
<p>The program produces the following output:</p>
<pre><code>Sat
Fri
Fri
Fri
...</code></pre>
<p>Later, we will learn increasingly sophisticated techniques for picking the lines to work on and how we pull those lines apart to find the exact bit of information we are looking for.</p>
<h2 id="objects-and-values">Objects and values</h2>
<p> </p>
<p>If we execute these assignment statements:</p>
<pre class="python"><code>a = &#39;banana&#39;
b = &#39;banana&#39;</code></pre>
<p>we know that <code>a</code> and <code>b</code> both refer to a string, but we don’t know whether they refer to the <em>same</em> string. There are two possible states:</p>
<p></p>
<figure>
<img src="../images/list1.svg" alt="Variables and Objects" style="height: 0.5in;"/>
<figcaption>
Variables and Objects
</figcaption>
</figure>
<p>In one case, <code>a</code> and <code>b</code> refer to two different objects that have the same value. In the second case, they refer to the same object.</p>
<p> </p>
<p>To check whether two variables refer to the same object, you can use the <code>is</code> operator.</p>
<pre class="python trinket"><code>&gt;&gt;&gt; a = &#39;banana&#39;
&gt;&gt;&gt; b = &#39;banana&#39;
&gt;&gt;&gt; a is b
True</code></pre>
<p>In this example, Python only created one string object, and both <code>a</code> and <code>b</code> refer to it.</p>
<p>But when you create two lists, you get two objects:</p>
<pre class="python trinket"><code>&gt;&gt;&gt; a = [1, 2, 3]
&gt;&gt;&gt; b = [1, 2, 3]
&gt;&gt;&gt; a is b
False</code></pre>
<p>In this case we would say that the two lists are <em>equivalent</em>, because they have the same elements, but not <em>identical</em>, because they are not the same object. If two objects are identical, they are also equivalent, but if they are equivalent, they are not necessarily identical.</p>
<p> </p>
<p>Until now, we have been using “object” and “value” interchangeably, but it is more precise to say that an object has a value. If you execute <code>a = [1,2,3]</code>, <code>a</code> refers to a list object whose value is a particular sequence of elements. If another list has the same elements, we would say it has the same value.</p>
<p> </p>
<h2 id="aliasing">Aliasing</h2>
<p> </p>
<p>If <code>a</code> refers to an object and you assign <code>b = a</code>, then both variables refer to the same object:</p>
<pre class="python trinket"><code>&gt;&gt;&gt; a = [1, 2, 3]
&gt;&gt;&gt; b = a
&gt;&gt;&gt; b is a
True</code></pre>
<p>The association of a variable with an object is called a <em>reference</em>. In this example, there are two references to the same object.</p>
<p></p>
<p>An object with more than one reference has more than one name, so we say that the object is <em>aliased</em>.</p>
<p></p>
<p>If the aliased object is mutable, changes made with one alias affect the other:</p>
<pre class="python"><code>&gt;&gt;&gt; b[0] = 17
&gt;&gt;&gt; print(a)
[17, 2, 3]</code></pre>
<p>Although this behavior can be useful, it is error-prone. In general, it is safer to avoid aliasing when you are working with mutable objects.</p>
<p></p>
<p>For immutable objects like strings, aliasing is not as much of a problem. In this example:</p>
<pre class="python"><code>a = &#39;banana&#39;
b = &#39;banana&#39;</code></pre>
<p>it almost never makes a difference whether <code>a</code> and <code>b</code> refer to the same string or not.</p>
<h2 id="list-arguments">List arguments</h2>
<p>    </p>
<p>When you pass a list to a function, the function gets a reference to the list. If the function modifies a list parameter, the caller sees the change. For example, <code>delete_head</code> removes the first element from a list:</p>
<pre class="python"><code>def delete_head(t):
    del t[0]</code></pre>
<p>Here’s how it is used:</p>
<pre class="python trinket"><code>&gt;&gt;&gt; letters = [&#39;a&#39;, &#39;b&#39;, &#39;c&#39;]
&gt;&gt;&gt; delete_head(letters)
&gt;&gt;&gt; print(letters)
[&#39;b&#39;, &#39;c&#39;]</code></pre>
<p>The parameter <code>t</code> and the variable <code>letters</code> are aliases for the same object.</p>
<p>It is important to distinguish between operations that modify lists and operations that create new lists. For example, the <code>append</code> method modifies a list, but the <code>+</code> operator creates a new list:</p>
<p>   </p>
<pre class="python trinket"><code>&gt;&gt;&gt; t1 = [1, 2]
&gt;&gt;&gt; t2 = t1.append(3)
&gt;&gt;&gt; print(t1)
[1, 2, 3]
&gt;&gt;&gt; print(t2)
None

&gt;&gt;&gt; t3 = t1 + [3]
&gt;&gt;&gt; print(t3)
[1, 2, 3]
&gt;&gt;&gt; t2 is t3
False</code></pre>
<p>This difference is important when you write functions that are supposed to modify lists. For example, this function <em>does not</em> delete the head of a list:</p>
<pre class="python"><code>def bad_delete_head(t):
    t = t[1:]              # WRONG!</code></pre>
<p>The slice operator creates a new list and the assignment makes <code>t</code> refer to it, but none of that has any effect on the list that was passed as an argument.</p>
<p> </p>
<p>An alternative is to write a function that creates and returns a new list. For example, <code>tail</code> returns all but the first element of a list:</p>
<pre class="python"><code>def tail(t):
    return t[1:]</code></pre>
<p>This function leaves the original list unmodified. Here’s how it is used:</p>
<pre class="python trinket"><code>&gt;&gt;&gt; letters = [&#39;a&#39;, &#39;b&#39;, &#39;c&#39;]
&gt;&gt;&gt; rest = tail(letters)
&gt;&gt;&gt; print(rest)
[&#39;b&#39;, &#39;c&#39;]</code></pre>
<p><strong>Exercise 1: Write a function called <code>chop</code> that takes a list and modifies it, removing the first and last elements, and returns <code>None</code>. Then write a function called <code>middle</code> that takes a list and returns a new list that contains all but the first and last elements.</strong></p>
<h2 id="debugging">Debugging</h2>
<p></p>
<p>Careless use of lists (and other mutable objects) can lead to long hours of debugging. Here are some common pitfalls and ways to avoid them:</p>
<ol type="1">
<li><p>Don’t forget that most list methods modify the argument and return <code>None</code>. This is the opposite of the string methods, which return a new string and leave the original alone.</p>
<p>If you are used to writing string code like this:</p>
<pre class="python"><code>word = word.strip()</code></pre>
<p>It is tempting to write list code like this:</p>
<pre class="python"><code>t = t.sort()           # WRONG!</code></pre>
<p> </p>
<p>Because <code>sort</code> returns <code>None</code>, the next operation you perform with <code>t</code> is likely to fail.</p>
<p>Before using list methods and operators, you should read the documentation carefully and then test them in interactive mode. The methods and operators that lists share with other sequences (like strings) are documented at:</p>
<p><a href="https://docs.python.org/library/stdtypes.html#common-sequence-operations">docs.python.org/library/stdtypes.html#common-sequence-operations</a></p>
<p>The methods and operators that only apply to mutable sequences are documented at:</p>
<p><a href="https://docs.python.org/library/stdtypes.html#mutable-sequence-types">docs.python.org/library/stdtypes.html#mutable-sequence-types</a></p></li>
<li><p>Pick an idiom and stick with it.</p>
<p></p>
<p>Part of the problem with lists is that there are too many ways to do things. For example, to remove an element from a list, you can use <code>pop</code>, <code>remove</code>, <code>del</code>, or even a slice assignment.</p>
<p>To add an element, you can use the <code>append</code> method or the <code>+</code> operator. But don’t forget that these are right:</p>
<pre class="python"><code>t.append(x)
t = t + [x]</code></pre>
<p>And these are wrong:</p>
<pre class="python"><code>t.append([x])          # WRONG!
t = t.append(x)        # WRONG!
t + [x]                # WRONG!
t = t + x              # WRONG!</code></pre>
<p>Try out each of these examples in interactive mode to make sure you understand what they do. Notice that only the last one causes a runtime error; the other three are legal, but they do the wrong thing.</p></li>
<li><p>Make copies to avoid aliasing.</p>
<p> </p>
<p>If you want to use a method like <code>sort</code> that modifies the argument, but you need to keep the original list as well, you can make a copy.</p>
<pre class="python"><code>orig = t[:]
t.sort()</code></pre>
<p>In this example you could also use the built-in function <code>sorted</code>, which returns a new, sorted list and leaves the original alone. But in that case you should avoid using <code>sorted</code> as a variable name!</p></li>
<li><p>Lists, <code>split</code>, and files</p>
<p>When we read and parse files, there are many opportunities to encounter input that can crash our program so it is a good idea to revisit the <em>guardian</em> pattern when it comes writing programs that read through a file and look for a “needle in the haystack”.</p>
<p>Let’s revisit our program that is looking for the day of the week on the from lines of our file:</p>
<pre><code>From stephen.marquard@uct.ac.za Sat Jan  5 09:14:16 2008</code></pre>
<p>Since we are breaking this line into words, we could dispense with the use of <code>startswith</code> and simply look at the first word of the line to determine if we are interested in the line at all. We can use <code>continue</code> to skip lines that don’t have “From” as the first word as follows:</p>
<pre class="python"><code>fhand = open(&#39;mbox-short.txt&#39;)
for line in fhand:
    words = line.split()
    if words[0] != &#39;From&#39; : continue
    print(words[2])</code></pre>
<p>This looks much simpler and we don’t even need to do the <code>rstrip</code> to remove the newline at the end of the file. But is it better?</p>
<pre><code>python search8.py
Sat
Traceback (most recent call last):
  File &quot;search8.py&quot;, line 5, in &lt;module&gt;
    if words[0] != &#39;From&#39; : continue
IndexError: list index out of range</code></pre>
<p>It kind of works and we see the day from the first line (Sat), but then the program fails with a traceback error. What went wrong? What messed-up data caused our elegant, clever, and very Pythonic program to fail?</p>
<p>You could stare at it for a long time and puzzle through it or ask someone for help, but the quicker and smarter approach is to add a <code>print</code> statement. The best place to add the print statement is right before the line where the program failed and print out the data that seems to be causing the failure.</p>
<p>Now this approach may generate a lot of lines of output, but at least you will immediately have some clue as to the problem at hand. So we add a print of the variable <code>words</code> right before line five. We even add a prefix “Debug:” to the line so we can keep our regular output separate from our debug output.</p>
<pre class="python"><code>for line in fhand:
    words = line.split()
    print(&#39;Debug:&#39;, words)
    if words[0] != &#39;From&#39; : continue
    print(words[2])</code></pre>
<p>When we run the program, a lot of output scrolls off the screen but at the end, we see our debug output and the traceback so we know what happened just before the traceback.</p>
<pre><code>Debug: [&#39;X-DSPAM-Confidence:&#39;, &#39;0.8475&#39;]
Debug: [&#39;X-DSPAM-Probability:&#39;, &#39;0.0000&#39;]
Debug: []
Traceback (most recent call last):
  File &quot;search9.py&quot;, line 6, in &lt;module&gt;
    if words[0] != &#39;From&#39; : continue
IndexError: list index out of range</code></pre>
<p>Each debug line is printing the list of words which we get when we <code>split</code> the line into words. When the program fails, the list of words is empty <code>[]</code>. If we open the file in a text editor and look at the file, at that point it looks as follows:</p>
<pre><code>X-DSPAM-Result: Innocent
X-DSPAM-Processed: Sat Jan  5 09:14:16 2008
X-DSPAM-Confidence: 0.8475
X-DSPAM-Probability: 0.0000

Details: http://source.sakaiproject.org/viewsvn/?view=rev&amp;rev=39772</code></pre>
<p>The error occurs when our program encounters a blank line! Of course there are “zero words” on a blank line. Why didn’t we think of that when we were writing the code? When the code looks for the first word (<code>word[0]</code>) to check to see if it matches “From”, we get an “index out of range” error.</p>
<p>This of course is the perfect place to add some <em>guardian</em> code to avoid checking the first word if the first word is not there. There are many ways to protect this code; we will choose to check the number of words we have before we look at the first word:</p>
<pre class="python"><code>fhand = open(&#39;mbox-short.txt&#39;)
count = 0
for line in fhand:
    words = line.split()
    # print(&#39;Debug:&#39;, words)
    if len(words) == 0 : continue
    if words[0] != &#39;From&#39; : continue
    print(words[2])</code></pre>
<p>First we commented out the debug print statement instead of removing it, in case our modification fails and we need to debug again. Then we added a guardian statement that checks to see if we have zero words, and if so, we use <code>continue</code> to skip to the next line in the file.</p>
<p>We can think of the two <code>continue</code> statements as helping us refine the set of lines which are “interesting” to us and which we want to process some more. A line which has no words is “uninteresting” to us so we skip to the next line. A line which does not have “From” as its first word is uninteresting to us so we skip it.</p>
<p>The program as modified runs successfully, so perhaps it is correct. Our guardian statement does make sure that the <code>words[0]</code> will never fail, but perhaps it is not enough. When we are programming, we must always be thinking, “What might go wrong?”</p></li>
</ol>
<p><strong>Exercise 2: Figure out which line of the above program is still not properly guarded. See if you can construct a text file which causes the program to fail and then modify the program so that the line is properly guarded and test it to make sure it handles your new text file.</strong></p>
<p><strong>Exercise 3: Rewrite the guardian code in the above example without two <code>if</code> statements. Instead, use a compound logical expression using the <code>or</code> logical operator with a single <code>if</code> statement.</strong></p>
<h2 id="glossary">Glossary</h2>
<dl>
<dt>aliasing</dt>
<dd>A circumstance where two or more variables refer to the same object.
</dd>
<dt>delimiter</dt>
<dd>A character or string used to indicate where a string should be split.
</dd>
<dt>element</dt>
<dd>One of the values in a list (or other sequence); also called items.
</dd>
<dt>equivalent</dt>
<dd>Having the same value.
</dd>
<dt>index</dt>
<dd>An integer value that indicates an element in a list.
</dd>
<dt>identical</dt>
<dd>Being the same object (which implies equivalence).
</dd>
<dt>list</dt>
<dd>A sequence of values.
</dd>
<dt>list traversal</dt>
<dd>The sequential accessing of each element in a list.
</dd>
<dt>nested list</dt>
<dd>A list that is an element of another list.
</dd>
<dt>object</dt>
<dd>Something a variable can refer to. An object has a type and a value.
</dd>
<dt>reference</dt>
<dd>The association between a variable and its value.
</dd>
</dl>
<h2 id="exercises">Exercises</h2>
<p></p>
<p><strong>Exercise 4: Find all unique words in a file</strong></p>
<p><strong>Shakespeare used over 20,000 words in his works. But how would you determine that? How would you produce the list of all the words that Shakespeare used? Would you download all his work, read it and track all unique words by hand?</strong></p>
<p><strong>Let’s use Python to achieve that instead. List all unique words, sorted in alphabetical order, that are stored in a file <code>romeo.txt</code> containing a subset of Shakespeare’s work.</strong></p>
<p><strong>To get started, download a copy of the file</strong> <a href="http://www.py4e.com/code3/romeo.txt"><strong>www.py4e.com/code3/romeo.txt</strong></a><strong>. Create a list of unique words, which will contain the final result. Write a program to open the file <code>romeo.txt</code> and read it line by line. For each line, split the line into a list of words using the <code>split</code> function. For each word, check to see if the word is already in the list of unique words. If the word is not in the list of unique words, add it to the list. When the program completes, sort and print the list of unique words in alphabetical order.</strong></p>
<pre><code>Enter file: romeo.txt
[&#39;Arise&#39;, &#39;But&#39;, &#39;It&#39;, &#39;Juliet&#39;, &#39;Who&#39;, &#39;already&#39;,
&#39;and&#39;, &#39;breaks&#39;, &#39;east&#39;, &#39;envious&#39;, &#39;fair&#39;, &#39;grief&#39;,
&#39;is&#39;, &#39;kill&#39;, &#39;light&#39;, &#39;moon&#39;, &#39;pale&#39;, &#39;sick&#39;, &#39;soft&#39;,
&#39;sun&#39;, &#39;the&#39;, &#39;through&#39;, &#39;what&#39;, &#39;window&#39;,
&#39;with&#39;, &#39;yonder&#39;]</code></pre>
<p><strong>Exercise 5: Minimalist Email Client.</strong></p>
<p><strong>MBOX (mail box) is a popular file format to store and share a collection of emails. This was used by early email servers and desktop apps. Without getting into too many details, MBOX is a text file, which stores emails consecutively. Emails are separated by a special line which starts with <code>From</code> (notice the space). Importantly, lines starting with <code>From:</code> (notice the colon) describes the email itself and does not act as a separator. Imagine you wrote a minimalist email app, that lists the email of the senders in the user’s Inbox and counts the number of emails.</strong></p>
<p><strong>Write a program to read through the mail box data and when you find line that starts with “From”, you will split the line into words using the <code>split</code> function. We are interested in who sent the message, which is the second word on the From line.</strong></p>
<pre><code>From stephen.marquard@uct.ac.za Sat Jan 5 09:14:16 2008</code></pre>
<p><strong>You will parse the From line and print out the second word for each From line, then you will also count the number of From (not From:) lines and print out a count at the end. This is a good sample output with a few lines removed:</strong></p>
<pre><code>python fromcount.py
Enter a file name: mbox-short.txt
stephen.marquard@uct.ac.za
louis@media.berkeley.edu
zqian@umich.edu

[...some output removed...]

ray@media.berkeley.edu
cwen@iupui.edu
cwen@iupui.edu
cwen@iupui.edu
There were 27 lines in the file with From as the first word</code></pre>
<p><strong>Exercise 6: Rewrite the program that prompts the user for a list of numbers and prints out the maximum and minimum of the numbers at the end when the user enters “done”. Write the program to store the numbers the user enters in a list and use the <code>max()</code> and <code>min()</code> functions to compute the maximum and minimum numbers after the loop completes.</strong></p>
<pre><code>Enter a number: 6
Enter a number: 2
Enter a number: 9
Enter a number: 3
Enter a number: 5
Enter a number: done
Maximum: 9.0
Minimum: 2.0</code></pre>
</body>
</html>
<?php if ( file_exists("../bookfoot.php") ) {
  $HTML_FILE = basename(__FILE__);
  $HTML = ob_get_contents();
  ob_end_clean();
  require_once "../bookfoot.php";
}?>
