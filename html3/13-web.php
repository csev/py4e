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
        padding: 12px;
      }
      h1 {
        font-size: 1.8em;
      }
    }
    @media print {
      html {
        background-color: white;
      }
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
    svg {
      height: auto;
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
      font-family: Menlo, Monaco, Consolas, 'Lucida Console', monospace;
      font-size: 85%;
      margin: 0;
      hyphens: manual;
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
    #TOC ul {
      padding-left: 1.3em;
    }
    #TOC > ul {
      padding-left: 0;
    }
    #TOC a:not(:hover) {
      text-decoration: none;
    }
    code{white-space: pre-wrap;}
    span.smallcaps{font-variant: small-caps;}
    div.columns{display: flex; gap: min(4vw, 1.5em);}
    div.column{flex: auto; overflow-x: auto;}
    div.hanging-indent{margin-left: 1.5em; text-indent: -1.5em;}
    /* The extra [class] is a hack that increases specificity enough to
       override a similar rule in reveal.js */
    ul.task-list[class]{list-style: none;}
    ul.task-list li input[type="checkbox"] {
      font-size: inherit;
      width: 0.8em;
      margin: 0 0.8em 0.2em -1.6em;
      vertical-align: middle;
    }
    .display.math{display: block; text-align: center; margin: 0.5rem auto;}
  </style>
</head>
<body>
<h1 id="using-web-services">Using Web Services</h1>
<p>Once it became easy to retrieve documents and parse documents over
HTTP using programs, it did not take long to develop an approach where
we started producing documents that were specifically designed to be
consumed by other programs (i.e., not HTML to be displayed in a
browser).</p>
<p>There are two common formats that we use when exchanging data across
the web. eXtensible Markup Language (XML) has been in use for a very
long time and is best suited for exchanging document-style data. When
programs just want to exchange dictionaries, lists, or other internal
information with each other, they use JavaScript Object Notation (JSON)
(see <a href="http://www.json.org">www.json.org</a>). We will look at
both formats.</p>
<h2 id="extensible-markup-language---xml">eXtensible Markup Language -
XML</h2>
<p>XML looks very similar to HTML, but XML is more structured than HTML.
Here is a sample of an XML document:</p>
<pre class="xml"><code>&lt;person&gt;
  &lt;name&gt;Chuck&lt;/name&gt;
  &lt;phone type=&quot;intl&quot;&gt;
    +1 734 303 4456
  &lt;/phone&gt;
  &lt;email hide=&quot;yes&quot; /&gt;
&lt;/person&gt;</code></pre>
<p>Each pair of opening (e.g., <code>&lt;person&gt;</code>) and closing
tags (e.g., <code>&lt;/person&gt;</code>) represents a <em>element</em>
or <em>node</em> with the same name as the tag (e.g.,
<code>person</code>). Each element can have some text, some attributes
(e.g., <code>hide</code>), and other nested elements. If an XML element
is empty (i.e., has no content), then it may be depicted by a
self-closing tag (e.g., <code>&lt;email /&gt;</code>).</p>
<p>Often it is helpful to think of an XML document as a tree structure
where there is a top element (here: <code>person</code>), and other tags
(e.g., <code>phone</code>) are drawn as <em>children</em> of their
<em>parent</em> elements.</p>
<figure>
<img src="../images/xml-tree.svg" alt="A Tree Representation of XML" style="height: 2.0in;"/>
<figcaption>
A Tree Representation of XML
</figcaption>
</figure>
<h2 id="parsing-xml">Parsing XML</h2>
<p> </p>
<p>Here is a simple application that parses some XML and extracts some
data elements from the XML:</p>
<pre class="python"><code>import xml.etree.ElementTree as ET

data = &#39;&#39;&#39;
&lt;person&gt;
  &lt;name&gt;Chuck&lt;/name&gt;
  &lt;phone type=&quot;intl&quot;&gt;
    +1 734 303 4456
  &lt;/phone&gt;
  &lt;email hide=&quot;yes&quot; /&gt;
&lt;/person&gt;&#39;&#39;&#39;

tree = ET.fromstring(data)
print(&#39;Name:&#39;, tree.find(&#39;name&#39;).text)
print(&#39;Attr:&#39;, tree.find(&#39;email&#39;).get(&#39;hide&#39;))

# Code: https://www.py4e.com/code3/xml1.py</code></pre>
<p>The triple single quote (<code>'''</code>), as well as the triple
double quote (<code>"""</code>), allow for the creation of strings that
span multiple lines.</p>
<p>Calling <code>fromstring</code> converts the string representation of
the XML into a “tree” of XML elements. When the XML is in a tree, we
have a series of methods we can call to extract portions of data from
the XML string. The <code>find</code> function searches through the XML
tree and retrieves the element that matches the specified tag.</p>
<pre><code>Name: Chuck
Attr: yes</code></pre>
<p>Using an XML parser such as <code>ElementTree</code> has the
advantage that while the XML in this example is quite simple, it turns
out there are many rules regarding valid XML, and using
<code>ElementTree</code> allows us to extract data from XML without
worrying about the rules of XML syntax.</p>
<h2 id="looping-through-nodes">Looping through nodes</h2>
<p> </p>
<p>Often the XML has multiple nodes and we need to write a loop to
process all of the nodes. In the following program, we loop through all
of the <code>user</code> nodes:</p>
<pre class="python"><code>import xml.etree.ElementTree as ET

input = &#39;&#39;&#39;
&lt;stuff&gt;
  &lt;users&gt;
    &lt;user x=&quot;2&quot;&gt;
      &lt;id&gt;001&lt;/id&gt;
      &lt;name&gt;Chuck&lt;/name&gt;
    &lt;/user&gt;
    &lt;user x=&quot;7&quot;&gt;
      &lt;id&gt;009&lt;/id&gt;
      &lt;name&gt;Brent&lt;/name&gt;
    &lt;/user&gt;
  &lt;/users&gt;
&lt;/stuff&gt;&#39;&#39;&#39;

stuff = ET.fromstring(input)
lst = stuff.findall(&#39;users/user&#39;)
print(&#39;User count:&#39;, len(lst))

for item in lst:
    print(&#39;Name&#39;, item.find(&#39;name&#39;).text)
    print(&#39;Id&#39;, item.find(&#39;id&#39;).text)
    print(&#39;Attribute&#39;, item.get(&#39;x&#39;))

# Code: https://www.py4e.com/code3/xml2.py</code></pre>
<p>The <code>findall</code> method retrieves a Python list of subtrees
that represent the <code>user</code> structures in the XML tree. Then we
can write a <code>for</code> loop that looks at each of the user nodes,
and prints the <code>name</code> and <code>id</code> text elements as
well as the <code>x</code> attribute from the <code>user</code>
node.</p>
<pre><code>User count: 2
Name Chuck
Id 001
Attribute 2
Name Brent
Id 009
Attribute 7</code></pre>
<p>It is important to include all parent level elements in the
<code>findall</code> statement except for the top level element (e.g.,
<code>users/user</code>). Otherwise, Python will not find any desired
nodes.</p>
<pre class="python"><code>import xml.etree.ElementTree as ET

input = &#39;&#39;&#39;
&lt;stuff&gt;
  &lt;users&gt;
    &lt;user x=&quot;2&quot;&gt;
      &lt;id&gt;001&lt;/id&gt;
      &lt;name&gt;Chuck&lt;/name&gt;
    &lt;/user&gt;
    &lt;user x=&quot;7&quot;&gt;
      &lt;id&gt;009&lt;/id&gt;
      &lt;name&gt;Brent&lt;/name&gt;
    &lt;/user&gt;
  &lt;/users&gt;
&lt;/stuff&gt;&#39;&#39;&#39;

stuff = ET.fromstring(input)

lst = stuff.findall(&#39;users/user&#39;)
print(&#39;User count:&#39;, len(lst))

lst2 = stuff.findall(&#39;user&#39;)
print(&#39;User count:&#39;, len(lst2))</code></pre>
<p><code>lst</code> stores all <code>user</code> elements that are
nested within their <code>users</code> parent. <code>lst2</code> looks
for <code>user</code> elements that are not nested within the top level
<code>stuff</code> element where there are none.</p>
<pre><code>User count: 2
User count: 0</code></pre>
<h2 id="javascript-object-notation---json">JavaScript Object Notation -
JSON</h2>
<p> </p>
<p>The JSON format was inspired by the object and array format used in
the JavaScript language. But since Python was invented before
JavaScript, Python’s syntax for dictionaries and lists influenced the
syntax of JSON. So the format of JSON is nearly identical to a
combination of Python lists and dictionaries.</p>
<p>Here is a JSON encoding that is roughly equivalent to the simple XML
from above:</p>
<pre class="json"><code>{
  &quot;name&quot; : &quot;Chuck&quot;,
  &quot;phone&quot; : {
    &quot;type&quot; : &quot;intl&quot;,
    &quot;number&quot; : &quot;+1 734 303 4456&quot;
   },
   &quot;email&quot; : {
     &quot;hide&quot; : &quot;yes&quot;
   }
}</code></pre>
<p>You will notice some differences. First, in XML, we can add
attributes like “intl” to the “phone” tag. In JSON, we simply have
key-value pairs. Also the XML “person” tag is gone, replaced by a set of
outer curly braces.</p>
<p>In general, JSON structures are simpler than XML because JSON has
fewer capabilities than XML. But JSON has the advantage that it maps
<em>directly</em> to some combination of dictionaries and lists. And
since nearly all programming languages have something equivalent to
Python’s dictionaries and lists, JSON is a very natural format to have
two cooperating programs exchange data.</p>
<p>JSON is quickly becoming the format of choice for nearly all data
exchange between applications because of its relative simplicity
compared to XML.</p>
<h2 id="parsing-json">Parsing JSON</h2>
<p>We construct our JSON by nesting dictionaries and lists as needed. In
this example, we represent a list of users where each user is a set of
key-value pairs (i.e., a dictionary). So we have a list of
dictionaries.</p>
<p>In the following program, we use the built-in <code>json</code>
library to parse the JSON and read through the data. Compare this
closely to the equivalent XML data and code above. The JSON has less
detail, so we must know in advance that we are getting a list and that
the list is of users and each user is a set of key-value pairs. The JSON
is more succinct (an advantage) but also is less self-describing (a
disadvantage).</p>
<pre class="python"><code>import json

data = &#39;&#39;&#39;
[
  { &quot;id&quot; : &quot;001&quot;,
    &quot;x&quot; : &quot;2&quot;,
    &quot;name&quot; : &quot;Chuck&quot;
  } ,
  { &quot;id&quot; : &quot;009&quot;,
    &quot;x&quot; : &quot;7&quot;,
    &quot;name&quot; : &quot;Brent&quot;
  }
]&#39;&#39;&#39;

info = json.loads(data)
print(&#39;User count:&#39;, len(info))

for item in info:
    print(&#39;Name&#39;, item[&#39;name&#39;])
    print(&#39;Id&#39;, item[&#39;id&#39;])
    print(&#39;Attribute&#39;, item[&#39;x&#39;])

# Code: https://www.py4e.com/code3/json2.py</code></pre>
<p>If you compare the code to extract data from the parsed JSON and XML
you will see that what we get from <code>json.loads()</code> is a Python
list which we traverse with a <code>for</code> loop, and each item
within that list is a Python dictionary. Once the JSON has been parsed,
we can use the Python index operator to extract the various bits of data
for each user. We don’t have to use the JSON library to dig through the
parsed JSON, since the returned data is simply native Python
structures.</p>
<p>The output of this program is exactly the same as the XML version
above.</p>
<pre><code>User count: 2
Name Chuck
Id 001
Attribute 2
Name Brent
Id 009
Attribute 7</code></pre>
<p>In general, there is an industry trend away from XML and towards JSON
for web services. Because the JSON is simpler and more directly maps to
native data structures we already have in programming languages, the
parsing and data extraction code is usually simpler and more direct when
using JSON. But XML is more self-descriptive than JSON and so there are
some applications where XML retains an advantage. For example, most word
processors store documents internally using XML rather than JSON.</p>
<h2 id="application-programming-interfaces">Application Programming
Interfaces</h2>
<p>We now have the ability to exchange data between applications using
Hypertext Transport Protocol (HTTP) and a way to represent complex data
that we are sending back and forth between these applications using
eXtensible Markup Language (XML) or JavaScript Object Notation
(JSON).</p>
<p>The next step is to begin to define and document “contracts” between
applications using these techniques. The general name for these
application-to-application contracts is <em>Application Program
Interfaces</em> (APIs). When we use an API, generally one program makes
a set of <em>services</em> available for use by other applications and
publishes the APIs (i.e., the “rules”) that must be followed to access
the services provided by the program.</p>
<p>When we begin to build our programs where the functionality of our
program includes access to services provided by other programs, we call
the approach a <em>Service-oriented architecture</em> (SOA). An SOA
approach is one where our overall application makes use of the services
of other applications. A non-SOA approach is where the application is a
single standalone application which contains all of the code necessary
to implement the application.</p>
<p>We see many examples of SOA when we use the web. We can go to a
single web site and book air travel, hotels, and automobiles all from a
single site. The data for hotels is not stored on the airline computers.
Instead, the airline computers contact the services on the hotel
computers and retrieve the hotel data and present it to the user. When
the user agrees to make a hotel reservation using the airline site, the
airline site uses another web service on the hotel systems to actually
make the reservation. And when it comes time to charge your credit card
for the whole transaction, still other computers become involved in the
process.</p>
<figure>
<img src="../images/soa.svg" alt="Service-oriented architecture" style="height: 3.0in;"/>
<figcaption>
Service-oriented architecture
</figcaption>
</figure>
<p>A Service-oriented architecture has many advantages, including: (1)
we always maintain only one copy of data (this is particularly important
for things like hotel reservations where we do not want to over-commit)
and (2) the owners of the data can set the rules about the use of their
data. With these advantages, an SOA system must be carefully designed to
have good performance and meet the user’s needs.</p>
<p>When an application makes a set of services in its API available over
the web, we call these <em>web services</em>.</p>
<h2 id="security-and-api-usage">Security and API usage</h2>
<p> </p>
<p>It is quite common that you need an API key to make use of a vendor’s
API. The general idea is that they want to know who is using their
services and how much each user is using. Perhaps they have free and pay
tiers of their services or have a policy that limits the number of
requests that a single individual can make during a particular time
period.</p>
<p>Sometimes once you get your API key, you simply include the key as
part of POST data or perhaps as a parameter on the URL when calling the
API.</p>
<p>Other times, the vendor wants increased assurance of the source of
the requests and so they expect you to send cryptographically signed
messages using shared keys and secrets. A very common technology that is
used to sign requests over the Internet is called <em>OAuth</em>. You
can read more about the OAuth protocol at <a
href="http://www.oauth.net">www.oauth.net</a>.</p>
<p>Thankfully there are a number of convenient and free OAuth libraries
so you can avoid writing an OAuth implementation from scratch by reading
the specification. These libraries are of varying complexity and have
varying degrees of richness. The OAuth web site has information about
various OAuth libraries.</p>
<h2 id="glossary">Glossary</h2>
<dl>
<dt>API</dt>
<dd>
Application Program Interface - A contract between applications that
defines the patterns of interaction between two application components.
</dd>
<dt>ElementTree</dt>
<dd>
A built-in Python library used to parse XML data.
</dd>
<dt>JSON</dt>
<dd>
JavaScript Object Notation - A format that allows for the markup of
structured data based on the syntax of JavaScript Objects.
</dd>
<dt>SOA</dt>
<dd>
Service-Oriented Architecture - When an application is made of
components connected across a network.
</dd>
<dt>XML</dt>
<dd>
eXtensible Markup Language - A format that allows for the markup of
structured data.
</dd>
</dl>
</body>
</html>
<?php if ( file_exists("../bookfoot.php") ) {
  $HTML_FILE = basename(__FILE__);
  $HTML = ob_get_contents();
  ob_end_clean();
  require_once "../bookfoot.php";
}?>
