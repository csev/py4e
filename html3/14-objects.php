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
<h1 id="object-oriented-programming">Object-oriented programming</h1>
<h2 id="managing-larger-programs">Managing larger programs</h2>
<p></p>
<p>At the beginning of this book, we came up with four basic programming patterns which we use to construct programs:</p>
<ul>
<li>Sequential code</li>
<li>Conditional code (if statements)</li>
<li>Repetitive code (loops)</li>
<li>Store and reuse (functions)</li>
</ul>
<p>In later chapters, we explored simple variables as well as collection data structures like lists, tuples, and dictionaries.</p>
<p>As we build programs, we design data structures and write code to manipulate those data structures. There are many ways to write programs and by now, you probably have written some programs that are “not so elegant” and other programs that are “more elegant”. Even though your programs may be small, you are starting to see how there is a bit of art and aesthetic to writing code.</p>
<p>As programs get to be millions of lines long, it becomes increasingly important to write code that is easy to understand. If you are working on a million-line program, you can never keep the entire program in your mind at the same time. We need ways to break large programs into multiple smaller pieces so that we have less to look at when solving a problem, fix a bug, or add a new feature.</p>
<p>In a way, object oriented programming is a way to arrange your code so that you can zoom into 50 lines of the code and understand it while ignoring the other 999,950 lines of code for the moment.</p>
<h2 id="getting-started">Getting started</h2>
<p>Like many aspects of programming, it is necessary to learn the concepts of object oriented programming before you can use them effectively. You should approach this chapter as a way to learn some terms and concepts and work through a few simple examples to lay a foundation for future learning.</p>
<p>The key outcome of this chapter is to have a basic understanding of how objects are constructed and how they function and most importantly how we make use of the capabilities of objects that are provided to us by Python and Python libraries.</p>
<h2 id="using-objects">Using objects</h2>
<p>As it turns out, we have been using objects all along in this book. Python provides us with many built-in objects. Here is some simple code where the first few lines should feel very simple and natural to you.</p>
<p></p>
<pre class="python"><code>stuff = list()
stuff.append(&#39;python&#39;)
stuff.append(&#39;chuck&#39;)
stuff.sort()
print (stuff[0])
print (stuff.__getitem__(0))
print (list.__getitem__(stuff,0))

# Code: http://www.py4e.com/code3/party1.py</code></pre>
<p>Instead of focusing on what these lines accomplish, let’s look at what is really happening from the point of view of object-oriented programming. Don’t worry if the following paragraphs don’t make any sense the first time you read them because we have not yet defined all of these terms.</p>
<p>The first line <em>constructs</em> an object of type <code>list</code>, the second and third lines <em>call</em> the <code>append()</code> <em>method</em>, the fourth line calls the <code>sort()</code> method, and the fifth line <em>retrieves</em> the item at position 0.</p>
<p>The sixth line calls the <code>__getitem__()</code> method in the <code>stuff</code> list with a parameter of zero.</p>
<pre class="python"><code>print (stuff.__getitem__(0))</code></pre>
<p>The seventh line is an even more verbose way of retrieving the 0th item in the list.</p>
<pre class="python"><code>print (list.__getitem__(stuff,0))</code></pre>
<p>In this code, we call the <code>__getitem__</code> method in the <code>list</code> class and <em>pass</em> the list and the item we want retrieved from the list as parameters.</p>
<p>The last three lines of the program are equivalent, but it is more convenient to simply use the square bracket syntax to look up an item at a particular position in a list.</p>
<p>We can take a look at the capabilities of an object by looking at the output of the <code>dir()</code> function:</p>
<pre><code>&gt;&gt;&gt; stuff = list()
&gt;&gt;&gt; dir(stuff)
[&#39;__add__&#39;, &#39;__class__&#39;, &#39;__contains__&#39;, &#39;__delattr__&#39;,
&#39;__delitem__&#39;, &#39;__dir__&#39;, &#39;__doc__&#39;, &#39;__eq__&#39;,
&#39;__format__&#39;, &#39;__ge__&#39;, &#39;__getattribute__&#39;, &#39;__getitem__&#39;,
&#39;__gt__&#39;, &#39;__hash__&#39;, &#39;__iadd__&#39;, &#39;__imul__&#39;, &#39;__init__&#39;,
&#39;__iter__&#39;, &#39;__le__&#39;, &#39;__len__&#39;, &#39;__lt__&#39;, &#39;__mul__&#39;,
&#39;__ne__&#39;, &#39;__new__&#39;, &#39;__reduce__&#39;, &#39;__reduce_ex__&#39;,
&#39;__repr__&#39;, &#39;__reversed__&#39;, &#39;__rmul__&#39;, &#39;__setattr__&#39;,
&#39;__setitem__&#39;, &#39;__sizeof__&#39;, &#39;__str__&#39;, &#39;__subclasshook__&#39;,
&#39;append&#39;, &#39;clear&#39;, &#39;copy&#39;, &#39;count&#39;, &#39;extend&#39;, &#39;index&#39;,
&#39;insert&#39;, &#39;pop&#39;, &#39;remove&#39;, &#39;reverse&#39;, &#39;sort&#39;]
&gt;&gt;&gt;</code></pre>
<p>The rest of this chapter will define all of the above terms so make sure to come back after you finish the chapter and re-read the above paragraphs to check your understanding.</p>
<h2 id="starting-with-programs">Starting with programs</h2>
<p>A program in its most basic form takes some input, does some processing, and produces some output. Our elevator conversion program demonstrates a very short but complete program showing all three of these steps.</p>
<pre class="python"><code>usf = input(&#39;Enter the US Floor Number: &#39;)
wf = int(usf) - 1
print(&#39;Non-US Floor Number is&#39;,wf)

# Code: http://www.py4e.com/code3/elev.py</code></pre>
<p>If we think a bit more about this program, there is the “outside world” and the program. The input and output aspects are where the program interacts with the outside world. Within the program we have code and data to accomplish the task the program is designed to solve.</p>
<figure>
<img src="../images/program.svg" alt="" /><figcaption>A Program</figcaption>
</figure>
<p>One way to think about object-oriented programming is that it separates our program into multiple “zones.” Each zone contains some code and data (like a program) and has well defined interactions with the outside world and the other zones within the program.</p>
<p>If we look back at the link extraction application where we used the BeautifulSoup library, we can see a program that is constructed by connecting different objects together to accomplish a task:</p>
<p>  </p>
<pre class="python"><code># To run this, download the BeautifulSoup zip file
# http://www.py4e.com/code3/bs4.zip
# and unzip it in the same directory as this file

import urllib.request, urllib.parse, urllib.error
from bs4 import BeautifulSoup
import ssl

# Ignore SSL certificate errors
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

url = input(&#39;Enter - &#39;)
html = urllib.request.urlopen(url, context=ctx).read()
soup = BeautifulSoup(html, &#39;html.parser&#39;)

# Retrieve all of the anchor tags
tags = soup(&#39;a&#39;)
for tag in tags:
    print(tag.get(&#39;href&#39;, None))

# Code: http://www.py4e.com/code3/urllinks.py</code></pre>
<p>We read the URL into a string and then pass that into <code>urllib</code> to retrieve the data from the web. The <code>urllib</code> library uses the <code>socket</code> library to make the actual network connection to retrieve the data. We take the string that <code>urllib</code> returns and hand it to BeautifulSoup for parsing. BeautifulSoup makes use of the object <code>html.parser</code><a href="#fn1" class="footnote-ref" id="fnref1" role="doc-noteref"><sup>1</sup></a> and returns an object. We call the <code>tags()</code> method on the returned object that returns a dictionary of tag objects. We loop through the tags and call the <code>get()</code> method for each tag to print out the <code>href</code> attribute.</p>
<p>We can draw a picture of this program and how the objects work together.</p>
<figure>
<img src="../images/program-oo.svg" alt="" /><figcaption>A Program as Network of Objects</figcaption>
</figure>
<p>The key here is not to understand perfectly how this program works but to see how we build a network of interacting objects and orchestrate the movement of information between the objects to create a program. It is also important to note that when you looked at that program several chapters back, you could fully understand what was going on in the program without even realizing that the program was “orchestrating the movement of data between objects.” It was just lines of code that got the job done.</p>
<h2 id="subdividing-a-problem">Subdividing a problem</h2>
<p>One of the advantages of the object-oriented approach is that it can hide complexity. For example, while we need to know how to use the <code>urllib</code> and BeautifulSoup code, we do not need to know how those libraries work internally. This allows us to focus on the part of the problem we need to solve and ignore the other parts of the program.</p>
<figure>
<img src="../images/program-oo-code.svg" alt="" /><figcaption>Ignoring Detail When Using an Object</figcaption>
</figure>
<p>This ability to focus exclusively on the part of a program that we care about and ignore the rest is also helpful to the developers of the objects that we use. For example, the programmers developing BeautifulSoup do not need to know or care about how we retrieve our HTML page, what parts we want to read, or what we plan to do with the data we extract from the web page.</p>
<figure>
<img src="../images/program-oo-bs4.svg" alt="" /><figcaption>Ignoring Detail When Building an Object</figcaption>
</figure>
<h2 id="our-first-python-object">Our first Python object</h2>
<p>At a basic level, an object is simply some code plus data structures that are smaller than a whole program. Defining a function allows us to store a bit of code and give it a name and then later invoke that code using the name of the function.</p>
<p>An object can contain a number of functions (which we call <em>methods</em>) as well as data that is used by those functions. We call data items that are part of the object <em>attributes</em>.</p>
<p></p>
<p>We use the <code>class</code> keyword to define the data and code that will make up each of the objects. The class keyword includes the name of the class and begins an indented block of code where we include the attributes (data) and methods (code).</p>
<pre class="python"><code>class PartyAnimal:
   x = 0

   def party(self) :
     self.x = self.x + 1
     print(&quot;So far&quot;,self.x)

an = PartyAnimal()
an.party()
an.party()
an.party()
PartyAnimal.party(an)

# Code: http://www.py4e.com/code3/party2.py</code></pre>
<p>Each method looks like a function, starting with the <code>def</code> keyword and consisting of an indented block of code. This object has one attribute (<code>x</code>) and one method (<code>party</code>). The methods have a special first parameter that we name by convention <code>self</code>.</p>
<p>Just as the <code>def</code> keyword does not cause function code to be executed, the <code>class</code> keyword does not create an object. Instead, the <code>class</code> keyword defines a template indicating what data and code will be contained in each object of type <code>PartyAnimal</code>. The class is like a cookie cutter and the objects created using the class are the cookies<a href="#fn2" class="footnote-ref" id="fnref2" role="doc-noteref"><sup>2</sup></a>. You don’t put frosting on the cookie cutter; you put frosting on the cookies, and you can put different frosting on each cookie.</p>
<figure>
<img src="../photos/cookie_cutter_flickr_Didriks.png" alt="" /><figcaption>A Class and Two Objects</figcaption>
</figure>
<p>If we continue through this sample program, we see the first executable line of code:</p>
<pre class="python"><code>an = PartyAnimal()</code></pre>
<p>   </p>
<p>This is where we instruct Python to construct (i.e., create) an <em>object</em> or <em>instance</em> of the class <code>PartyAnimal</code>. It looks like a function call to the class itself. Python constructs the object with the right data and methods and returns the object which is then assigned to the variable <code>an</code>. In a way this is quite similar to the following line which we have been using all along:</p>
<pre class="python"><code>counts = dict()</code></pre>
<p>Here we instruct Python to construct an object using the <code>dict</code> template (already present in Python), return the instance of dictionary, and assign it to the variable <code>counts</code>.</p>
<p>When the <code>PartyAnimal</code> class is used to construct an object, the variable <code>an</code> is used to point to that object. We use <code>an</code> to access the code and data for that particular instance of the <code>PartyAnimal</code> class.</p>
<p>Each Partyanimal object/instance contains within it a variable <code>x</code> and a method/function named <code>party</code>. We call the <code>party</code> method in this line:</p>
<pre class="python"><code>an.party()</code></pre>
<p>When the <code>party</code> method is called, the first parameter (which we call by convention <code>self</code>) points to the particular instance of the PartyAnimal object that <code>party</code> is called from. Within the <code>party</code> method, we see the line:</p>
<pre class="python"><code>self.x = self.x + 1</code></pre>
<p>This syntax using the <em>dot</em> operator is saying ‘the x within self.’ Each time <code>party()</code> is called, the internal <code>x</code> value is incremented by 1 and the value is printed out.</p>
<p>The following line is another way to call the <code>party</code> method within the <code>an</code> object:</p>
<pre class="python"><code>PartyAnimal.party(an)</code></pre>
<p>In this variation, we access the code from within the class and explicitly pass the object pointer <code>an</code> as the first parameter (i.e., <code>self</code> within the method). You can think of <code>an.party()</code> as shorthand for the above line.</p>
<p>When the program executes, it produces the following output:</p>
<pre><code>So far 1
So far 2
So far 3
So far 4</code></pre>
<p>The object is constructed, and the <code>party</code> method is called four times, both incrementing and printing the value for <code>x</code> within the <code>an</code> object.</p>
<h2 id="classes-as-types">Classes as types</h2>
<p> </p>
<p>As we have seen, in Python all variables have a type. We can use the built-in <code>dir</code> function to examine the capabilities of a variable. We can also use <code>type</code> and <code>dir</code> with the classes that we create.</p>
<pre class="python"><code>class PartyAnimal:
   x = 0

   def party(self) :
     self.x = self.x + 1
     print(&quot;So far&quot;,self.x)

an = PartyAnimal()
print (&quot;Type&quot;, type(an))
print (&quot;Dir &quot;, dir(an))
print (&quot;Type&quot;, type(an.x))
print (&quot;Type&quot;, type(an.party))

# Code: http://www.py4e.com/code3/party3.py</code></pre>
<p>When this program executes, it produces the following output:</p>
<pre><code>Type &lt;class &#39;__main__.PartyAnimal&#39;&gt;
Dir  [&#39;__class__&#39;, &#39;__delattr__&#39;, ...
&#39;__sizeof__&#39;, &#39;__str__&#39;, &#39;__subclasshook__&#39;,
&#39;__weakref__&#39;, &#39;party&#39;, &#39;x&#39;]
Type &lt;class &#39;int&#39;&gt;
Type &lt;class &#39;method&#39;&gt;</code></pre>
<p>You can see that using the <code>class</code> keyword, we have created a new type. From the <code>dir</code> output, you can see both the <code>x</code> integer attribute and the <code>party</code> method are available in the object.</p>
<h2 id="object-lifecycle">Object lifecycle</h2>
<p>  </p>
<p>In the previous examples, we define a class (template), use that class to create an instance of that class (object), and then use the instance. When the program finishes, all of the variables are discarded. Usually, we don’t think much about the creation and destruction of variables, but often as our objects become more complex, we need to take some action within the object to set things up as the object is constructed and possibly clean things up as the object is discarded.</p>
<p>If we want our object to be aware of these moments of construction and destruction, we add specially named methods to our object:</p>
<pre class="python"><code>class PartyAnimal:
   x = 0

   def __init__(self):
     print(&#39;I am constructed&#39;)

   def party(self) :
     self.x = self.x + 1
     print(&#39;So far&#39;,self.x)

   def __del__(self):
     print(&#39;I am destructed&#39;, self.x)

an = PartyAnimal()
an.party()
an.party()
an = 42
print(&#39;an contains&#39;,an)

# Code: http://www.py4e.com/code3/party4.py</code></pre>
<p>When this program executes, it produces the following output:</p>
<pre><code>I am constructed
So far 1
So far 2
I am destructed 2
an contains 42</code></pre>
<p>As Python constructs our object, it calls our <code>__init__</code> method to give us a chance to set up some default or initial values for the object. When Python encounters the line:</p>
<pre><code>an = 42</code></pre>
<p>It actually “thows our object away” so it can reuse the <code>an</code> variable to store the value <code>42</code>. Just at the moment when our <code>an</code> object is being “destroyed” our destructor code (<code>__del__</code>) is called. We cannot stop our variable from being destroyed, but we can do any necessary cleanup right before our object no longer exists.</p>
<p>When developing objects, it is quite common to add a constructor to an object to set up initial values for the object. It is relatively rare to need a destructor for an object.</p>
<h2 id="multiple-instances">Multiple instances</h2>
<p>So far, we have defined a class, constructed a single object, used that object, and then thrown the object away. However, the real power in object-oriented programming happens when we construct multiple instances of our class.</p>
<p>When we construct multiple objects from our class, we might want to set up different initial values for each of the objects. We can pass data to the constructors to give each object a different initial value:</p>
<pre class="python"><code>class PartyAnimal:
   x = 0
   name = &#39;&#39;
   def __init__(self, nam):
     self.name = nam
     print(self.name,&#39;constructed&#39;)

   def party(self) :
     self.x = self.x + 1
     print(self.name,&#39;party count&#39;,self.x)

s = PartyAnimal(&#39;Sally&#39;)
j = PartyAnimal(&#39;Jim&#39;)

s.party()
j.party()
s.party()

# Code: http://www.py4e.com/code3/party5.py</code></pre>
<p>The constructor has both a <code>self</code> parameter that points to the object instance and additional parameters that are passed into the constructor as the object is constructed:</p>
<pre><code>s = PartyAnimal(&#39;Sally&#39;)</code></pre>
<p>Within the constructor, the second line copies the parameter (<code>nam</code>) that is passed into the <code>name</code> attribute within the object instance.</p>
<pre><code>self.name = nam</code></pre>
<p>The output of the program shows that each of the objects (<code>s</code> and <code>j</code>) contain their own independent copies of <code>x</code> and <code>nam</code>:</p>
<pre><code>Sally constructed
Jim constructed
Sally party count 1
Jim party count 1
Sally party count 2</code></pre>
<h2 id="inheritance">Inheritance</h2>
<p>Another powerful feature of object-oriented programming is the ability to create a new class by extending an existing class. When extending a class, we call the original class the <em>parent class</em> and the new class the <em>child class</em>.</p>
<p>For this example, we move our <code>PartyAnimal</code> class into its own file. Then, we can ‘import’ the <code>PartyAnimal</code> class in a new file and extend it, as follows:</p>
<pre class="python"><code>from party import PartyAnimal

class CricketFan(PartyAnimal):
   points = 0
   def six(self):
      self.points = self.points + 6
      self.party()
      print(self.name,&quot;points&quot;,self.points)

s = PartyAnimal(&quot;Sally&quot;)
s.party()
j = CricketFan(&quot;Jim&quot;)
j.party()
j.six()
print(dir(j))

# Code: http://www.py4e.com/code3/party6.py</code></pre>
<p>When we define the <code>CricketFan</code> class, we indicate that we are extending the <code>PartyAnimal</code> class. This means that all of the variables (<code>x</code>) and methods (<code>party</code>) from the <code>PartyAnimal</code> class are <em>inherited</em> by the <code>CricketFan</code> class. For example, within the <code>six</code> method in the <code>CricketFan</code> class, we call the <code>party</code> method from the <code>PartyAnimal</code> class.</p>
<p>As the program executes, we create <code>s</code> and <code>j</code> as independent instances of <code>PartyAnimal</code> and <code>CricketFan</code>. The <code>j</code> object has additional capabilities beyond the <code>s</code> object.</p>
<pre><code>Sally constructed
Sally party count 1
Jim constructed
Jim party count 1
Jim party count 2
Jim points 6
[&#39;__class__&#39;, &#39;__delattr__&#39;, ... &#39;__weakref__&#39;,
&#39;name&#39;, &#39;party&#39;, &#39;points&#39;, &#39;six&#39;, &#39;x&#39;]</code></pre>
<p>In the <code>dir</code> output for the <code>j</code> object (instance of the <code>CricketFan</code> class), we see that it has the attributes and methods of the parent class, as well as the attributes and methods that were added when the class was extended to create the <code>CricketFan</code> class.</p>
<h2 id="summary">Summary</h2>
<p>This is a very quick introduction to object-oriented programming that focuses mainly on terminology and the syntax of defining and using objects. Let’s quickly review the code that we looked at in the beginning of the chapter. At this point you should fully understand what is going on.</p>
<pre class="python"><code>stuff = list()
stuff.append(&#39;python&#39;)
stuff.append(&#39;chuck&#39;)
stuff.sort()
print (stuff[0])
print (stuff.__getitem__(0))
print (list.__getitem__(stuff,0))

# Code: http://www.py4e.com/code3/party1.py</code></pre>
<p>The first line constructs a <code>list</code> <em>object</em>. When Python creates the <code>list</code> object, it calls the <em>constructor</em> method (named <code>__init__</code>) to set up the internal data attributes that will be used to store the list data. We have not passed any parameters to the <em>constructor</em>. When the constructor returns, we use the variable <code>stuff</code> to point to the returned instance of the <code>list</code> class.</p>
<p>The second and third lines call the <code>append</code> method with one parameter to add a new item at the end of the list by updating the attributes within <code>stuff</code>. Then in the fourth line, we call the <code>sort</code> method with no parameters to sort the data within the <code>stuff</code> object.</p>
<p>We then print out the first item in the list using the square brackets which are a shortcut to calling the <code>__getitem__</code> method within the <code>stuff</code>. This is equivalent to calling the <code>__getitem__</code> method in the <code>list</code> <em>class</em> and passing the <code>stuff</code> object as the first parameter and the position we are looking for as the second parameter.</p>
<p>At the end of the program, the <code>stuff</code> object is discarded but not before calling the <em>destructor</em> (named <code>__del__</code>) so that the object can clean up any loose ends as necessary.</p>
<p>Those are the basics of object-oriented programming. There are many additional details as to how to best use object-oriented approaches when developing large applications and libraries that are beyond the scope of this chapter.<a href="#fn3" class="footnote-ref" id="fnref3" role="doc-noteref"><sup>3</sup></a></p>
<h2 id="glossary">Glossary</h2>
<dl>
<dt>attribute</dt>
<dd>A variable that is part of a class.
</dd>
<dt>class</dt>
<dd>A template that can be used to construct an object. Defines the attributes and methods that will make up the object.
</dd>
<dt>child class</dt>
<dd>A new class created when a parent class is extended. The child class inherits all of the attributes and methods of the parent class.
</dd>
<dt>constructor</dt>
<dd>An optional specially named method (<code>__init__</code>) that is called at the moment when a class is being used to construct an object. Usually this is used to set up initial values for the object.
</dd>
<dt>destructor</dt>
<dd>An optional specially named method (<code>__del__</code>) that is called at the moment just before an object is destroyed. Destructors are rarely used.
</dd>
<dt>inheritance</dt>
<dd>When we create a new class (child) by extending an existing class (parent). The child class has all the attributes and methods of the parent class plus additional attributes and methods defined by the child class.
</dd>
<dt>method</dt>
<dd>A function that is contained within a class and the objects that are constructed from the class. Some object-oriented patterns use ‘message’ instead of ‘method’ to describe this concept.
</dd>
<dt>object</dt>
<dd>A constructed instance of a class. An object contains all of the attributes and methods that were defined by the class. Some object-oriented documentation uses the term ‘instance’ interchangeably with ‘object’.
</dd>
<dt>parent class</dt>
<dd>The class which is being extended to create a new child class. The parent class contributes all of its methods and attributes to the new child class.
</dd>
</dl>
<section class="footnotes" role="doc-endnotes">
<hr />
<ol>
<li id="fn1" role="doc-endnote"><p>https://docs.python.org/3/library/html.parser.html<a href="#fnref1" class="footnote-back" role="doc-backlink">↩︎</a></p></li>
<li id="fn2" role="doc-endnote"><p>Cookie image copyright CC-BY https://www.flickr.com/photos/dinnerseries/23570475099<a href="#fnref2" class="footnote-back" role="doc-backlink">↩︎</a></p></li>
<li id="fn3" role="doc-endnote"><p>If you are curious about where the <code>list</code> class is defined, take a look at (hopefully the URL won’t change) https://github.com/python/cpython/blob/master/Objects/listobject.c - the list class is written in a language called “C”. If you take a look at that source code and find it curious you might want to explore a few Computer Science courses.<a href="#fnref3" class="footnote-back" role="doc-backlink">↩︎</a></p></li>
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
