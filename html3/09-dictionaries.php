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
<h1 id="dictionaries">Dictionaries</h1>
<p> </p>
<p>    </p>
<p>A <em>dictionary</em> is like a list, but more general. In a list, the index positions have to be integers; in a dictionary, the indices can be (almost) any type.</p>
<p>You can think of a dictionary as a mapping between a set of indices (which are called <em>keys</em>) and a set of values. Each key maps to a value. The association of a key and a value is called a <em>key-value pair</em> or sometimes an <em>item</em>.</p>
<p>As an example, we’ll build a dictionary that maps from English to Spanish words, so the keys and the values are all strings.</p>
<p>The function <code>dict</code> creates a new dictionary with no items. Because <code>dict</code> is the name of a built-in function, you should avoid using it as a variable name.</p>
<p> </p>
<pre class="python trinket"><code>&gt;&gt;&gt; eng2sp = dict()
&gt;&gt;&gt; print(eng2sp)
{}</code></pre>
<p>The curly brackets, <code>{}</code>, represent an empty dictionary. To add items to the dictionary, you can use square brackets:</p>
<p> </p>
<pre class="python"><code>&gt;&gt;&gt; eng2sp[&#39;one&#39;] = &#39;uno&#39;</code></pre>
<p>This line creates an item that maps from the key <code>'one'</code> to the value “uno”. If we print the dictionary again, we see a key-value pair with a colon between the key and value:</p>
<pre class="python"><code>&gt;&gt;&gt; print(eng2sp)
{&#39;one&#39;: &#39;uno&#39;}</code></pre>
<p>This output format is also an input format. For example, you can create a new dictionary with three items. But if you print <code>eng2sp</code>, you might be surprised:</p>
<pre class="python"><code>&gt;&gt;&gt; eng2sp = {&#39;one&#39;: &#39;uno&#39;, &#39;two&#39;: &#39;dos&#39;, &#39;three&#39;: &#39;tres&#39;}
&gt;&gt;&gt; print(eng2sp)
{&#39;one&#39;: &#39;uno&#39;, &#39;three&#39;: &#39;tres&#39;, &#39;two&#39;: &#39;dos&#39;}</code></pre>
<p>The order of the key-value pairs is not the same. In fact, if you type the same example on your computer, you might get a different result. In general, the order of items in a dictionary is unpredictable.</p>
<p>But that’s not a problem because the elements of a dictionary are never indexed with integer indices. Instead, you use the keys to look up the corresponding values:</p>
<pre class="python"><code>&gt;&gt;&gt; print(eng2sp[&#39;two&#39;])
&#39;dos&#39;</code></pre>
<p>The key <code>'two'</code> always maps to the value “dos” so the order of the items doesn’t matter.</p>
<p>If the key isn’t in the dictionary, you get an exception:</p>
<p> </p>
<pre class="python"><code>&gt;&gt;&gt; print(eng2sp[&#39;four&#39;])
KeyError: &#39;four&#39;</code></pre>
<p>The <code>len</code> function works on dictionaries; it returns the number of key-value pairs:</p>
<p> </p>
<pre class="python"><code>&gt;&gt;&gt; len(eng2sp)
3</code></pre>
<p>The <code>in</code> operator works on dictionaries; it tells you whether something appears as a <em>key</em> in the dictionary (appearing as a value is not good enough).</p>
<p>  </p>
<pre class="python"><code>&gt;&gt;&gt; &#39;one&#39; in eng2sp
True
&gt;&gt;&gt; &#39;uno&#39; in eng2sp
False</code></pre>
<p>To see whether something appears as a value in a dictionary, you can use the method <code>values</code>, which returns the values as a type that can be converted to a list, and then use the <code>in</code> operator:</p>
<p> </p>
<pre class="python"><code>&gt;&gt;&gt; vals = list(eng2sp.values())
&gt;&gt;&gt; &#39;uno&#39; in vals
True</code></pre>
<p>The <code>in</code> operator uses different algorithms for lists and dictionaries. For lists, it uses a linear search algorithm. As the list gets longer, the search time gets longer in direct proportion to the length of the list. For dictionaries, Python uses an algorithm called a <em>hash table</em> that has a remarkable property: the <code>in</code> operator takes about the same amount of time no matter how many items there are in a dictionary. I won’t explain why hash functions are so magical, but you can read more about it at <a href="https://wikipedia.org/wiki/Hash_table">wikipedia.org/wiki/Hash_table</a>.</p>
<p>  </p>
<p><strong>Exercise 1: Download a copy of the file</strong> <a href="http://www.py4e.com/code3/words.txt">www.py4e.com/code3/words.txt</a></p>
<p><strong>Write a program that reads the words in <em>words.txt</em> and stores them as keys in a dictionary. It doesn’t matter what the values are. Then you can use the <code>in</code> operator as a fast way to check whether a string is in the dictionary.</strong></p>
<h2 id="dictionary-as-a-set-of-counters">Dictionary as a set of counters</h2>
<p></p>
<p>Suppose you are given a string and you want to count how many times each letter appears. There are several ways you could do it:</p>
<ol type="1">
<li><p>You could create 26 variables, one for each letter of the alphabet. Then you could traverse the string and, for each character, increment the corresponding counter, probably using a chained conditional.</p></li>
<li><p>You could create a list with 26 elements. Then you could convert each character to a number (using the built-in function <code>ord</code>), use the number as an index into the list, and increment the appropriate counter.</p></li>
<li><p>You could create a dictionary with characters as keys and counters as the corresponding values. The first time you see a character, you would add an item to the dictionary. After that you would increment the value of an existing item.</p></li>
</ol>
<p>Each of these options performs the same computation, but each of them implements that computation in a different way.</p>
<p></p>
<p>An <em>implementation</em> is a way of performing a computation; some implementations are better than others. For example, an advantage of the dictionary implementation is that we don’t have to know ahead of time which letters appear in the string and we only have to make room for the letters that do appear.</p>
<p>Here is what the code might look like:</p>
<pre class="python trinket"><code>word = &#39;brontosaurus&#39;
d = dict()
for c in word:
    if c not in d:
        d[c] = 1
    else:
        d[c] = d[c] + 1
print(d)</code></pre>
<p>We are effectively computing a <em>histogram</em>, which is a statistical term for a set of counters (or frequencies).</p>
<p>  </p>
<p>The <code>for</code> loop traverses the string. Each time through the loop, if the character <code>c</code> is not in the dictionary, we create a new item with key <code>c</code> and the initial value 1 (since we have seen this letter once). If <code>c</code> is already in the dictionary we increment <code>d[c]</code>.</p>
<p></p>
<p>Here’s the output of the program:</p>
<pre><code>{&#39;a&#39;: 1, &#39;b&#39;: 1, &#39;o&#39;: 2, &#39;n&#39;: 1, &#39;s&#39;: 2, &#39;r&#39;: 2, &#39;u&#39;: 2, &#39;t&#39;: 1}</code></pre>
<p>The histogram indicates that the letters “a” and “b” appear once; “o” appears twice, and so on.</p>
<p> </p>
<p>Dictionaries have a method called <code>get</code> that takes a key and a default value. If the key appears in the dictionary, <code>get</code> returns the corresponding value; otherwise it returns the default value. For example:</p>
<pre class="python trinket"><code>&gt;&gt;&gt; counts = { &#39;chuck&#39; : 1 , &#39;annie&#39; : 42, &#39;jan&#39;: 100}
&gt;&gt;&gt; print(counts.get(&#39;jan&#39;, 0))
100
&gt;&gt;&gt; print(counts.get(&#39;tim&#39;, 0))
0</code></pre>
<p>We can use <code>get</code> to write our histogram loop more concisely. Because the <code>get</code> method automatically handles the case where a key is not in a dictionary, we can reduce four lines down to one and eliminate the <code>if</code> statement.</p>
<pre class="python"><code>word = &#39;brontosaurus&#39;
d = dict()
for c in word:
    d[c] = d.get(c,0) + 1
print(d)</code></pre>
<p>The use of the <code>get</code> method to simplify this counting loop ends up being a very commonly used “idiom” in Python and we will use it many times in the rest of the book. So you should take a moment and compare the loop using the <code>if</code> statement and <code>in</code> operator with the loop using the <code>get</code> method. They do exactly the same thing, but one is more succinct.</p>
<p></p>
<h2 id="dictionaries-and-files">Dictionaries and files</h2>
<p>One of the common uses of a dictionary is to count the occurrence of words in a file with some written text. Let’s start with a very simple file of words taken from the text of <em>Romeo and Juliet</em>.</p>
<p>For the first set of examples, we will use a shortened and simplified version of the text with no punctuation. Later we will work with the text of the scene with punctuation included.</p>
<pre><code>But soft what light through yonder window breaks
It is the east and Juliet is the sun
Arise fair sun and kill the envious moon
Who is already sick and pale with grief</code></pre>
<p>We will write a Python program to read through the lines of the file, break each line into a list of words, and then loop through each of the words in the line and count each word using a dictionary.</p>
<p> </p>
<p>You will see that we have two <code>for</code> loops. The outer loop is reading the lines of the file and the inner loop is iterating through each of the words on that particular line. This is an example of a pattern called <em>nested loops</em> because one of the loops is the <em>outer</em> loop and the other loop is the <em>inner</em> loop.</p>
<p>Because the inner loop executes all of its iterations each time the outer loop makes a single iteration, we think of the inner loop as iterating “more quickly” and the outer loop as iterating more slowly.</p>
<p></p>
<p>The combination of the two nested loops ensures that we will count every word on every line of the input file.</p>
<pre class="python"><code>fname = input(&#39;Enter the file name: &#39;)
try:
    fhand = open(fname)
except:
    print(&#39;File cannot be opened:&#39;, fname)
    exit()

counts = dict()
for line in fhand:
    words = line.split()
    for word in words:
        if word not in counts:
            counts[word] = 1
        else:
            counts[word] += 1

print(counts)

# Code: http://www.py4e.com/code3/count1.py</code></pre>
<p>In our <code>else</code> statement, we use the more compact alternative for incrementing a variable. <code>counts[word] += 1</code> is equivalent to <code>counts[word] = counts[word] + 1</code>. Either method can be used to change the value of a variable by any desired amount. Similar alternatives exist for <code>-=</code>, <code>*=</code>, and <code>/=</code>.</p>
<p>When we run the program, we see a raw dump of all of the counts in unsorted hash order. (the <em>romeo.txt</em> file is available at <a href="http://www.py4e.com/code3/romeo.txt">www.py4e.com/code3/romeo.txt</a>)</p>
<pre><code>python count1.py
Enter the file name: romeo.txt
{&#39;and&#39;: 3, &#39;envious&#39;: 1, &#39;already&#39;: 1, &#39;fair&#39;: 1,
&#39;is&#39;: 3, &#39;through&#39;: 1, &#39;pale&#39;: 1, &#39;yonder&#39;: 1,
&#39;what&#39;: 1, &#39;sun&#39;: 2, &#39;Who&#39;: 1, &#39;But&#39;: 1, &#39;moon&#39;: 1,
&#39;window&#39;: 1, &#39;sick&#39;: 1, &#39;east&#39;: 1, &#39;breaks&#39;: 1,
&#39;grief&#39;: 1, &#39;with&#39;: 1, &#39;light&#39;: 1, &#39;It&#39;: 1, &#39;Arise&#39;: 1,
&#39;kill&#39;: 1, &#39;the&#39;: 3, &#39;soft&#39;: 1, &#39;Juliet&#39;: 1}</code></pre>
<p>It is a bit inconvenient to look through the dictionary to find the most common words and their counts, so we need to add some more Python code to get us the output that will be more helpful.</p>
<h2 id="looping-and-dictionaries">Looping and dictionaries</h2>
<p>  </p>
<p>If you use a dictionary as the sequence in a <code>for</code> statement, it traverses the keys of the dictionary. This loop prints each key and the corresponding value:</p>
<pre class="python"><code>counts = { &#39;chuck&#39; : 1 , &#39;annie&#39; : 42, &#39;jan&#39;: 100}
for key in counts:
    print(key, counts[key])</code></pre>
<p>Here’s what the output looks like:</p>
<pre><code>jan 100
chuck 1
annie 42</code></pre>
<p>Again, the keys are in no particular order.</p>
<p></p>
<p>We can use this pattern to implement the various loop idioms that we have described earlier. For example if we wanted to find all the entries in a dictionary with a value above ten, we could write the following code:</p>
<pre class="python"><code>counts = { &#39;chuck&#39; : 1 , &#39;annie&#39; : 42, &#39;jan&#39;: 100}
for key in counts:
    if counts[key] &gt; 10 :
        print(key, counts[key])</code></pre>
<p>The <code>for</code> loop iterates through the <em>keys</em> of the dictionary, so we must use the index operator to retrieve the corresponding <em>value</em> for each key. Here’s what the output looks like:</p>
<pre><code>jan 100
annie 42</code></pre>
<p>We see only the entries with a value above 10.</p>
<p> </p>
<p>If you want to print the keys in alphabetical order, you first make a list of the keys in the dictionary using the <code>keys</code> method available in dictionary objects, and then sort that list and loop through the sorted list, looking up each key and printing out key-value pairs in sorted order as follows:</p>
<pre class="python"><code>counts = { &#39;chuck&#39; : 1 , &#39;annie&#39; : 42, &#39;jan&#39;: 100}
lst = list(counts.keys())
print(lst)
lst.sort()
for key in lst:
    print(key, counts[key])</code></pre>
<p>Here’s what the output looks like:</p>
<pre><code>[&#39;jan&#39;, &#39;chuck&#39;, &#39;annie&#39;]
annie 42
chuck 1
jan 100</code></pre>
<p>First you see the list of keys in unsorted order that we get from the <code>keys</code> method. Then we see the key-value pairs in order from the <code>for</code> loop.</p>
<h2 id="advanced-text-parsing">Advanced text parsing</h2>
<p></p>
<p>In the above example using the file <em>romeo.txt</em>, we made the file as simple as possible by removing all punctuation by hand. The actual text has lots of punctuation, as shown below.</p>
<pre><code>But, soft! what light through yonder window breaks?
It is the east, and Juliet is the sun.
Arise, fair sun, and kill the envious moon,
Who is already sick and pale with grief,</code></pre>
<p>Since the Python <code>split</code> function looks for spaces and treats words as tokens separated by spaces, we would treat the words “soft!” and “soft” as <em>different</em> words and create a separate dictionary entry for each word.</p>
<p>Also since the file has capitalization, we would treat “who” and “Who” as different words with different counts.</p>
<p>We can solve both these problems by using the string methods <code>lower</code>, <code>punctuation</code>, and <code>translate</code>. The <code>translate</code> is the most subtle of the methods. Here is the documentation for <code>translate</code>:</p>
<p><code>line.translate(str.maketrans(fromstr, tostr, deletestr))</code></p>
<p><em>Replace the characters in <code>fromstr</code> with the character in the same position in <code>tostr</code> and delete all characters that are in <code>deletestr</code>. The <code>fromstr</code> and <code>tostr</code> can be empty strings and the <code>deletestr</code> parameter can be omitted.</em></p>
<p>We will not specify the <code>tostr</code> but we will use the <code>deletestr</code> parameter to delete all of the punctuation. We will even let Python tell us the list of characters that it considers “punctuation”:</p>
<pre class="python"><code>&gt;&gt;&gt; import string
&gt;&gt;&gt; string.punctuation
&#39;!&quot;#$%&amp;\&#39;()*+,-./:;&lt;=&gt;?@[\\]^_`{|}~&#39;</code></pre>
<p>The parameters used by <code>translate</code> were different in Python 2.0.</p>
<p>We make the following modifications to our program:</p>
<pre class="python"><code>import string

fname = input(&#39;Enter the file name: &#39;)
try:
    fhand = open(fname)
except:
    print(&#39;File cannot be opened:&#39;, fname)
    exit()

counts = dict()
for line in fhand:
    line = line.rstrip()
    line = line.translate(line.maketrans(&#39;&#39;, &#39;&#39;, string.punctuation))
    line = line.lower()
    words = line.split()
    for word in words:
        if word not in counts:
            counts[word] = 1
        else:
            counts[word] += 1

print(counts)

# Code: http://www.py4e.com/code3/count2.py</code></pre>
<p>Part of learning the “Art of Python” or “Thinking Pythonically” is realizing that Python often has built-in capabilities for many common data analysis problems. Over time, you will see enough example code and read enough of the documentation to know where to look to see if someone has already written something that makes your job much easier.</p>
<p>The following is an abbreviated version of the output:</p>
<pre><code>Enter the file name: romeo-full.txt
{&#39;swearst&#39;: 1, &#39;all&#39;: 6, &#39;afeard&#39;: 1, &#39;leave&#39;: 2, &#39;these&#39;: 2,
&#39;kinsmen&#39;: 2, &#39;what&#39;: 11, &#39;thinkst&#39;: 1, &#39;love&#39;: 24, &#39;cloak&#39;: 1,
a&#39;: 24, &#39;orchard&#39;: 2, &#39;light&#39;: 5, &#39;lovers&#39;: 2, &#39;romeo&#39;: 40,
&#39;maiden&#39;: 1, &#39;whiteupturned&#39;: 1, &#39;juliet&#39;: 32, &#39;gentleman&#39;: 1,
&#39;it&#39;: 22, &#39;leans&#39;: 1, &#39;canst&#39;: 1, &#39;having&#39;: 1, ...}</code></pre>
<p>Looking through this output is still unwieldy and we can use Python to give us exactly what we are looking for, but to do so, we need to learn about Python <em>tuples</em>. We will pick up this example once we learn about tuples.</p>
<h2 id="debugging">Debugging</h2>
<p></p>
<p>As you work with bigger datasets it can become unwieldy to debug by printing and checking data by hand. Here are some suggestions for debugging large datasets:</p>
<dl>
<dt>Scale down the input</dt>
<dd><p>If possible, reduce the size of the dataset. For example if the program reads a text file, start with just the first 10 lines, or with the smallest example you can find. You can either edit the files themselves, or (better) modify the program so it reads only the first <code>n</code> lines.</p>
<p>If there is an error, you can reduce <code>n</code> to the smallest value that manifests the error, and then increase it gradually as you find and correct errors.</p>
</dd>
<dt>Check summaries and types</dt>
<dd><p>Instead of printing and checking the entire dataset, consider printing summaries of the data: for example, the number of items in a dictionary or the total of a list of numbers.</p>
<p>A common cause of runtime errors is a value that is not the right type. For debugging this kind of error, it is often enough to print the type of a value.</p>
</dd>
<dt>Write self-checks</dt>
<dd><p>Sometimes you can write code to check for errors automatically. For example, if you are computing the average of a list of numbers, you could check that the result is not greater than the largest element in the list or less than the smallest. This is called a “sanity check” because it detects results that are “completely illogical”.  </p>
<p>Another kind of check compares the results of two different computations to see if they are consistent. This is called a “consistency check”.</p>
</dd>
<dt>Pretty print the output</dt>
<dd>Formatting debugging output can make it easier to spot an error.
</dd>
</dl>
<p>Again, time you spend building scaffolding can reduce the time you spend debugging. </p>
<h2 id="glossary">Glossary</h2>
<dl>
<dt>dictionary</dt>
<dd>A mapping from a set of keys to their corresponding values.
</dd>
<dt>hashtable</dt>
<dd>The algorithm used to implement Python dictionaries.
</dd>
<dt>hash function</dt>
<dd>A function used by a hashtable to compute the location for a key.
</dd>
<dt>histogram</dt>
<dd>A set of counters.
</dd>
<dt>implementation</dt>
<dd>A way of performing a computation.
</dd>
<dt>item</dt>
<dd>Another name for a key-value pair.
</dd>
<dt>key</dt>
<dd>An object that appears in a dictionary as the first part of a key-value pair.
</dd>
<dt>key-value pair</dt>
<dd>The representation of the mapping from a key to a value.
</dd>
<dt>lookup</dt>
<dd>A dictionary operation that takes a key and finds the corresponding value.
</dd>
<dt>nested loops</dt>
<dd>When there are one or more loops “inside” of another loop. The inner loop runs to completion each time the outer loop runs once.
</dd>
<dt>value</dt>
<dd>An object that appears in a dictionary as the second part of a key-value pair. This is more specific than our previous use of the word “value”.
</dd>
</dl>
<h2 id="exercises">Exercises</h2>
<p><strong>Exercise 2: Write a program that categorizes each mail message by which day of the week the commit was done. To do this look for lines that start with “From”, then look for the third word and keep a running count of each of the days of the week. At the end of the program print out the contents of your dictionary (order does not matter).</strong></p>
<p><strong>Sample Line:</strong></p>
<pre><code>From stephen.marquard@uct.ac.za Sat Jan  5 09:14:16 2008</code></pre>
<p><strong>Sample Execution:</strong></p>
<pre><code>python dow.py
Enter a file name: mbox-short.txt
{&#39;Fri&#39;: 20, &#39;Thu&#39;: 6, &#39;Sat&#39;: 1}</code></pre>
<p><strong>Exercise 3: Write a program to read through a mail log, build a histogram using a dictionary to count how many messages have come from each email address, and print the dictionary.</strong></p>
<pre><code>Enter file name: mbox-short.txt
{&#39;gopal.ramasammycook@gmail.com&#39;: 1, &#39;louis@media.berkeley.edu&#39;: 3,
&#39;cwen@iupui.edu&#39;: 5, &#39;antranig@caret.cam.ac.uk&#39;: 1,
&#39;rjlowe@iupui.edu&#39;: 2, &#39;gsilver@umich.edu&#39;: 3,
&#39;david.horwitz@uct.ac.za&#39;: 4, &#39;wagnermr@iupui.edu&#39;: 1,
&#39;zqian@umich.edu&#39;: 4, &#39;stephen.marquard@uct.ac.za&#39;: 2,
&#39;ray@media.berkeley.edu&#39;: 1}</code></pre>
<p><strong>Exercise 4: Add code to the above program to figure out who has the most messages in the file. After all the data has been read and the dictionary has been created, look through the dictionary using a maximum loop (see Chapter 5: Maximum and minimum loops) to find who has the most messages and print how many messages the person has.</strong></p>
<pre><code>Enter a file name: mbox-short.txt
cwen@iupui.edu 5

Enter a file name: mbox.txt
zqian@umich.edu 195</code></pre>
<p><strong>Exercise 5: This program records the domain name (instead of the address) where the message was sent from instead of who the mail came from (i.e., the whole email address). At the end of the program, print out the contents of your dictionary.</strong></p>
<pre><code>python schoolcount.py
Enter a file name: mbox-short.txt
{&#39;media.berkeley.edu&#39;: 4, &#39;uct.ac.za&#39;: 6, &#39;umich.edu&#39;: 7,
&#39;gmail.com&#39;: 1, &#39;caret.cam.ac.uk&#39;: 1, &#39;iupui.edu&#39;: 8}</code></pre>
</body>
</html>
<?php if ( file_exists("../bookfoot.php") ) {
  $HTML_FILE = basename(__FILE__);
  $HTML = ob_get_contents();
  ob_end_clean();
  require_once "../bookfoot.php";
}?>
