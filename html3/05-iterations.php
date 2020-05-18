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
<h1 id="iteration">Iteration</h1>
<p></p>
<h2 id="updating-variables">Updating variables</h2>
<p> </p>
<p>A common pattern in assignment statements is an assignment statement that updates a variable, where the new value of the variable depends on the old.</p>
<pre class="python"><code>x = x + 1</code></pre>
<p>This means “get the current value of <code>x</code>, add 1, and then update <code>x</code> with the new value.”</p>
<p>If you try to update a variable that doesn’t exist, you get an error, because Python evaluates the right side before it assigns a value to <code>x</code>:</p>
<pre class="python"><code>&gt;&gt;&gt; x = x + 1
NameError: name &#39;x&#39; is not defined</code></pre>
<p>Before you can update a variable, you have to <em>initialize</em> it, usually with a simple assignment:</p>
<p></p>
<pre class="python"><code>&gt;&gt;&gt; x = 0
&gt;&gt;&gt; x = x + 1</code></pre>
<p>Updating a variable by adding 1 is called an <em>increment</em>; subtracting 1 is called a <em>decrement</em>.</p>
<p> </p>
<h2 id="the-while-statement">The <code>while</code> statement</h2>
<p>   </p>
<p>Computers are often used to automate repetitive tasks. Repeating identical or similar tasks without making errors is something that computers do well and people do poorly. Because iteration is so common, Python provides several language features to make it easier.</p>
<p>One form of iteration in Python is the <code>while</code> statement. Here is a simple program that counts down from five and then says “Blastoff!”.</p>
<pre class="python"><code>n = 5
while n &gt; 0:
    print(n)
    n = n - 1
print(&#39;Blastoff!&#39;)</code></pre>
<p>You can almost read the <code>while</code> statement as if it were English. It means, “While <code>n</code> is greater than 0, display the value of <code>n</code> and then reduce the value of <code>n</code> by 1. When you get to 0, exit the <code>while</code> statement and display the word <code>Blastoff!</code>”</p>
<p></p>
<p>More formally, here is the flow of execution for a <code>while</code> statement:</p>
<ol type="1">
<li><p>Evaluate the condition, yielding <code>True</code> or <code>False</code>.</p></li>
<li><p>If the condition is false, exit the <code>while</code> statement and continue execution at the next statement.</p></li>
<li><p>If the condition is true, execute the body and then go back to step 1.</p></li>
</ol>
<p>This type of flow is called a <em>loop</em> because the third step loops back around to the top. We call each time we execute the body of the loop an <em>iteration</em>. For the above loop, we would say, “It had five iterations”, which means that the body of the loop was executed five times.</p>
<p>  </p>
<p>The body of the loop should change the value of one or more variables so that eventually the condition becomes false and the loop terminates. We call the variable that changes each time the loop executes and controls when the loop finishes the <em>iteration variable</em>. If there is no iteration variable, the loop will repeat forever, resulting in an <em>infinite loop</em>.</p>
<h2 id="infinite-loops">Infinite loops</h2>
<p>An endless source of amusement for programmers is the observation that the directions on shampoo, “Lather, rinse, repeat,” are an infinite loop because there is no <em>iteration variable</em> telling you how many times to execute the loop.</p>
<p> </p>
<p>In the case of <code>countdown</code>, we can prove that the loop terminates because we know that the value of <code>n</code> is finite, and we can see that the value of <code>n</code> gets smaller each time through the loop, so eventually we have to get to 0. Other times a loop is obviously infinite because it has no iteration variable at all.</p>
<p> </p>
<p>Sometimes you don’t know it’s time to end a loop until you get half way through the body. In that case you can write an infinite loop on purpose and then use the <code>break</code> statement to jump out of the loop.</p>
<p>This loop is obviously an <em>infinite loop</em> because the logical expression on the <code>while</code> statement is simply the logical constant <code>True</code>:</p>
<pre class="python"><code>n = 10
while True:
    print(n, end=&#39; &#39;)
    n = n - 1
print(&#39;Done!&#39;)</code></pre>
<p>If you make the mistake and run this code, you will learn quickly how to stop a runaway Python process on your system or find where the power-off button is on your computer. This program will run forever or until your battery runs out because the logical expression at the top of the loop is always true by virtue of the fact that the expression is the constant value <code>True</code>.</p>
<p>While this is a dysfunctional infinite loop, we can still use this pattern to build useful loops as long as we carefully add code to the body of the loop to explicitly exit the loop using <code>break</code> when we have reached the exit condition.</p>
<p>For example, suppose you want to take input from the user until they type <code>done</code>. You could write:</p>
<pre class="python"><code>while True:
    line = input(&#39;&gt; &#39;)
    if line == &#39;done&#39;:
        break
    print(line)
print(&#39;Done!&#39;)

# Code: http://www.py4e.com/code3/copytildone1.py</code></pre>
<p>The loop condition is <code>True</code>, which is always true, so the loop runs repeatedly until it hits the break statement.</p>
<p>Each time through, it prompts the user with an angle bracket. If the user types <code>done</code>, the <code>break</code> statement exits the loop. Otherwise the program echoes whatever the user types and goes back to the top of the loop. Here’s a sample run:</p>
<pre><code>&gt; hello there
hello there
&gt; finished
finished
&gt; done
Done!</code></pre>
<p>This way of writing <code>while</code> loops is common because you can check the condition anywhere in the loop (not just at the top) and you can express the stop condition affirmatively (“stop when this happens”) rather than negatively (“keep going until that happens.”).</p>
<h2 id="finishing-iterations-with-continue">Finishing iterations with <code>continue</code></h2>
<p> </p>
<p>Sometimes you are in an iteration of a loop and want to finish the current iteration and immediately jump to the next iteration. In that case you can use the <code>continue</code> statement to skip to the next iteration without finishing the body of the loop for the current iteration.</p>
<p>Here is an example of a loop that copies its input until the user types “done”, but treats lines that start with the hash character as lines not to be printed (kind of like Python comments).</p>
<pre class="python"><code>while True:
    line = input(&#39;&gt; &#39;)
    if line[0] == &#39;#&#39;:
        continue
    if line == &#39;done&#39;:
        break
    print(line)
print(&#39;Done!&#39;)

# Code: http://www.py4e.com/code3/copytildone2.py</code></pre>
<p>Here is a sample run of this new program with <code>continue</code> added.</p>
<pre><code>&gt; hello there
hello there
&gt; # don&#39;t print this
&gt; print this!
print this!
&gt; done
Done!</code></pre>
<p>All the lines are printed except the one that starts with the hash sign because when the <code>continue</code> is executed, it ends the current iteration and jumps back to the <code>while</code> statement to start the next iteration, thus skipping the <code>print</code> statement.</p>
<h2 id="definite-loops-using-for">Definite loops using <code>for</code></h2>
<p> </p>
<p>Sometimes we want to loop through a <em>set</em> of things such as a list of words, the lines in a file, or a list of numbers. When we have a list of things to loop through, we can construct a <em>definite</em> loop using a <code>for</code> statement. We call the <code>while</code> statement an <em>indefinite</em> loop because it simply loops until some condition becomes <code>False</code>, whereas the <code>for</code> loop is looping through a known set of items so it runs through as many iterations as there are items in the set.</p>
<p>The syntax of a <code>for</code> loop is similar to the <code>while</code> loop in that there is a <code>for</code> statement and a loop body:</p>
<pre class="python"><code>friends = [&#39;Joseph&#39;, &#39;Glenn&#39;, &#39;Sally&#39;]
for friend in friends:
    print(&#39;Happy New Year:&#39;, friend)
print(&#39;Done!&#39;)</code></pre>
<p>In Python terms, the variable <code>friends</code> is a list<a href="#fn1" class="footnote-ref" id="fnref1" role="doc-noteref"><sup>1</sup></a> of three strings and the <code>for</code> loop goes through the list and executes the body once for each of the three strings in the list resulting in this output:</p>
<pre class="python"><code>Happy New Year: Joseph
Happy New Year: Glenn
Happy New Year: Sally
Done!</code></pre>
<p>Translating this <code>for</code> loop to English is not as direct as the <code>while</code>, but if you think of friends as a <em>set</em>, it goes like this: “Run the statements in the body of the for loop once for each friend <em>in</em> the set named friends.”</p>
<p>Looking at the <code>for</code> loop, <em>for</em> and <em>in</em> are reserved Python keywords, and <code>friend</code> and <code>friends</code> are variables.</p>
<pre class="python"><code>for friend in friends:
    print(&#39;Happy New Year:&#39;, friend)</code></pre>
<p>In particular, <code>friend</code> is the <em>iteration variable</em> for the for loop. The variable <code>friend</code> changes for each iteration of the loop and controls when the <code>for</code> loop completes. The <em>iteration variable</em> steps successively through the three strings stored in the <code>friends</code> variable.</p>
<h2 id="loop-patterns">Loop patterns</h2>
<p>Often we use a <code>for</code> or <code>while</code> loop to go through a list of items or the contents of a file and we are looking for something such as the largest or smallest value of the data we scan through.</p>
<p>These loops are generally constructed by:</p>
<ul>
<li><p>Initializing one or more variables before the loop starts</p></li>
<li><p>Performing some computation on each item in the loop body, possibly changing the variables in the body of the loop</p></li>
<li><p>Looking at the resulting variables when the loop completes</p></li>
</ul>
<p>We will use a list of numbers to demonstrate the concepts and construction of these loop patterns.</p>
<h3 id="counting-and-summing-loops">Counting and summing loops</h3>
<p>For example, to count the number of items in a list, we would write the following <code>for</code> loop:</p>
<pre class="python"><code>count = 0
for itervar in [3, 41, 12, 9, 74, 15]:
    count = count + 1
print(&#39;Count: &#39;, count)</code></pre>
<p>We set the variable <code>count</code> to zero before the loop starts, then we write a <code>for</code> loop to run through the list of numbers. Our <em>iteration</em> variable is named <code>itervar</code> and while we do not use <code>itervar</code> in the loop, it does control the loop and cause the loop body to be executed once for each of the values in the list.</p>
<p>In the body of the loop, we add 1 to the current value of <code>count</code> for each of the values in the list. While the loop is executing, the value of <code>count</code> is the number of values we have seen “so far”.</p>
<p>Once the loop completes, the value of <code>count</code> is the total number of items. The total number “falls in our lap” at the end of the loop. We construct the loop so that we have what we want when the loop finishes.</p>
<p>Another similar loop that computes the total of a set of numbers is as follows:</p>
<pre class="python"><code>total = 0
for itervar in [3, 41, 12, 9, 74, 15]:
    total = total + itervar
print(&#39;Total: &#39;, total)</code></pre>
<p>In this loop we <em>do</em> use the <em>iteration variable</em>. Instead of simply adding one to the <code>count</code> as in the previous loop, we add the actual number (3, 41, 12, etc.) to the running total during each loop iteration. If you think about the variable <code>total</code>, it contains the “running total of the values so far”. So before the loop starts <code>total</code> is zero because we have not yet seen any values, during the loop <code>total</code> is the running total, and at the end of the loop <code>total</code> is the overall total of all the values in the list.</p>
<p>As the loop executes, <code>total</code> accumulates the sum of the elements; a variable used this way is sometimes called an <em>accumulator</em>.</p>
<p></p>
<p>Neither the counting loop nor the summing loop are particularly useful in practice because there are built-in functions <code>len()</code> and <code>sum()</code> that compute the number of items in a list and the total of the items in the list respectively.</p>
<h3 id="maximum-and-minimum-loops">Maximum and minimum loops</h3>
<p>   </p>
<p>To find the largest value in a list or sequence, we construct the following loop:</p>
<pre class="python"><code>largest = None
print(&#39;Before:&#39;, largest)
for itervar in [3, 41, 12, 9, 74, 15]:
    if largest is None or itervar &gt; largest :
        largest = itervar
    print(&#39;Loop:&#39;, itervar, largest)
print(&#39;Largest:&#39;, largest)</code></pre>
<p>When the program executes, the output is as follows:</p>
<pre><code>Before: None
Loop: 3 3
Loop: 41 41
Loop: 12 41
Loop: 9 41
Loop: 74 74
Loop: 15 74
Largest: 74</code></pre>
<p>The variable <code>largest</code> is best thought of as the “largest value we have seen so far”. Before the loop, we set <code>largest</code> to the constant <code>None</code>. <code>None</code> is a special constant value which we can store in a variable to mark the variable as “empty”.</p>
<p>Before the loop starts, the largest value we have seen so far is <code>None</code> since we have not yet seen any values. While the loop is executing, if <code>largest</code> is <code>None</code> then we take the first value we see as the largest so far. You can see in the first iteration when the value of <code>itervar</code> is 3, since <code>largest</code> is <code>None</code>, we immediately set <code>largest</code> to be 3.</p>
<p>After the first iteration, <code>largest</code> is no longer <code>None</code>, so the second part of the compound logical expression that checks <code>itervar &gt; largest</code> triggers only when we see a value that is larger than the “largest so far”. When we see a new “even larger” value we take that new value for <code>largest</code>. You can see in the program output that <code>largest</code> progresses from 3 to 41 to 74.</p>
<p>At the end of the loop, we have scanned all of the values and the variable <code>largest</code> now does contain the largest value in the list.</p>
<p>To compute the smallest number, the code is very similar with one small change:</p>
<pre class="python"><code>smallest = None
print(&#39;Before:&#39;, smallest)
for itervar in [3, 41, 12, 9, 74, 15]:
    if smallest is None or itervar &lt; smallest:
        smallest = itervar
    print(&#39;Loop:&#39;, itervar, smallest)
print(&#39;Smallest:&#39;, smallest)</code></pre>
<p>Again, <code>smallest</code> is the “smallest so far” before, during, and after the loop executes. When the loop has completed, <code>smallest</code> contains the minimum value in the list.</p>
<p>Again as in counting and summing, the built-in functions <code>max()</code> and <code>min()</code> make writing these exact loops unnecessary.</p>
<p>The following is a simple version of the Python built-in <code>min()</code> function:</p>
<pre class="python"><code>def min(values):
    smallest = None
    for value in values:
        if smallest is None or value &lt; smallest:
            smallest = value
    return smallest</code></pre>
<p>In the function version of the smallest code, we removed all of the <code>print</code> statements so as to be equivalent to the <code>min</code> function which is already built in to Python.</p>
<h2 id="debugging">Debugging</h2>
<p>As you start writing bigger programs, you might find yourself spending more time debugging. More code means more chances to make an error and more places for bugs to hide.</p>
<p> </p>
<p>One way to cut your debugging time is “debugging by bisection.” For example, if there are 100 lines in your program and you check them one at a time, it would take 100 steps.</p>
<p>Instead, try to break the problem in half. Look at the middle of the program, or near it, for an intermediate value you can check. Add a <code>print</code> statement (or something else that has a verifiable effect) and run the program.</p>
<p>If the mid-point check is incorrect, the problem must be in the first half of the program. If it is correct, the problem is in the second half.</p>
<p>Every time you perform a check like this, you halve the number of lines you have to search. After six steps (which is much less than 100), you would be down to one or two lines of code, at least in theory.</p>
<p>In practice it is not always clear what the “middle of the program” is and not always possible to check it. It doesn’t make sense to count lines and find the exact midpoint. Instead, think about places in the program where there might be errors and places where it is easy to put a check. Then choose a spot where you think the chances are about the same that the bug is before or after the check.</p>
<h2 id="glossary">Glossary</h2>
<dl>
<dt>accumulator</dt>
<dd>A variable used in a loop to add up or accumulate a result.
</dd>
<dt>counter</dt>
<dd>A variable used in a loop to count the number of times something happened. We initialize a counter to zero and then increment the counter each time we want to “count” something.
</dd>
<dt>decrement</dt>
<dd>An update that decreases the value of a variable.
</dd>
<dt>initialize</dt>
<dd>An assignment that gives an initial value to a variable that will be updated.
</dd>
<dt>increment</dt>
<dd>An update that increases the value of a variable (often by one).
</dd>
<dt>infinite loop</dt>
<dd>A loop in which the terminating condition is never satisfied or for which there is no terminating condition.
</dd>
<dt>iteration</dt>
<dd>Repeated execution of a set of statements using either a function that calls itself or a loop.
</dd>
</dl>
<h2 id="exercises">Exercises</h2>
<p><strong>Exercise 1: Write a program which repeatedly reads numbers until the user enters “done”. Once “done” is entered, print out the total, count, and average of the numbers. If the user enters anything other than a number, detect their mistake using <code>try</code> and <code>except</code> and print an error message and skip to the next number.</strong></p>
<pre><code>Enter a number: 4
Enter a number: 5
Enter a number: bad data
Invalid input
Enter a number: 7
Enter a number: done
16 3 5.333333333333333</code></pre>
<p><strong>Exercise 2: Write another program that prompts for a list of numbers as above and at the end prints out both the maximum and minimum of the numbers instead of the average.</strong></p>
<section class="footnotes" role="doc-endnotes">
<hr />
<ol>
<li id="fn1" role="doc-endnote"><p>We will examine lists in more detail in a later chapter.<a href="#fnref1" class="footnote-back" role="doc-backlink">↩︎</a></p></li>
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
