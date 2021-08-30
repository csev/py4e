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
<h1 id="networked-programs">Networked programs</h1>
<p>While many of the examples in this book have focused on reading files and looking for data in those files, there are many different sources of information when one considers the Internet.</p>
<p>In this chapter we will pretend to be a web browser and retrieve web pages using the Hypertext Transfer Protocol (HTTP). Then we will read through the web page data and parse it.</p>
<h2 id="hypertext-transfer-protocol---http">Hypertext Transfer Protocol - HTTP</h2>
<p>The network protocol that powers the web is actually quite simple and there is built-in support in Python called <code>socket</code> which makes it very easy to make network connections and retrieve data over those sockets in a Python program.</p>
<p>A <em>socket</em> is much like a file, except that a single socket provides a two-way connection between two programs. You can both read from and write to the same socket. If you write something to a socket, it is sent to the application at the other end of the socket. If you read from the socket, you are given the data which the other application has sent.</p>
<p>But if you try to read a socket when the program on the other end of the socket has not sent any data, you just sit and wait. If the programs on both ends of the socket simply wait for some data without sending anything, they will wait for a very long time, so an important part of programs that communicate over the Internet is to have some sort of protocol.</p>
<p>A protocol is a set of precise rules that determine who is to go first, what they are to do, and then what the responses are to that message, and who sends next, and so on. In a sense the two applications at either end of the socket are doing a dance and making sure not to step on each other’s toes.</p>
<p>There are many documents that describe these network protocols. The Hypertext Transfer Protocol is described in the following document:</p>
<p><a href="https://www.w3.org/Protocols/rfc2616/rfc2616.txt" class="uri">https://www.w3.org/Protocols/rfc2616/rfc2616.txt</a></p>
<p>This is a long and complex 176-page document with a lot of detail. If you find it interesting, feel free to read it all. But if you take a look around page 36 of RFC2616 you will find the syntax for the GET request. To request a document from a web server, we make a connection to the <code>www.pr4e.org</code> server on port 80, and then send a line of the form</p>
<p><code>GET http://data.pr4e.org/romeo.txt HTTP/1.0</code></p>
<p>where the second parameter is the web page we are requesting, and then we also send a blank line. The web server will respond with some header information about the document and a blank line followed by the document content.</p>
<h2 id="the-worlds-simplest-web-browser">The world’s simplest web browser</h2>
<p>Perhaps the easiest way to show how the HTTP protocol works is to write a very simple Python program that makes a connection to a web server and follows the rules of the HTTP protocol to request a document and display what the server sends back.</p>
<pre class="python"><code>import socket

mysock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
mysock.connect((&#39;data.pr4e.org&#39;, 80))
cmd = &#39;GET http://data.pr4e.org/romeo.txt HTTP/1.0\r\n\r\n&#39;.encode()
mysock.send(cmd)

while True:
    data = mysock.recv(512)
    if len(data) &lt; 1:
        break
    print(data.decode(),end=&#39;&#39;)

mysock.close()

# Code: http://www.py4e.com/code3/socket1.py</code></pre>
<p>First the program makes a connection to port 80 on the server <a href="http://www.py4e.com">www.py4e.com</a>. Since our program is playing the role of the “web browser”, the HTTP protocol says we must send the GET command followed by a blank line. <code>\r\n</code> signifies an EOL (end of line), so <code>\r\n\r\n</code> signifies nothing between two EOL sequences. That is the equivalent of a blank line.</p>
<figure>
<img src="../images/socket.svg" alt="A Socket Connection" style="height: 2.0in;"/>
<figcaption>
A Socket Connection
</figcaption>
</figure>
<p>Once we send that blank line, we write a loop that receives data in 512-character chunks from the socket and prints the data out until there is no more data to read (i.e., the recv() returns an empty string).</p>
<p>The program produces the following output:</p>
<pre><code>HTTP/1.1 200 OK
Date: Wed, 11 Apr 2018 18:52:55 GMT
Server: Apache/2.4.7 (Ubuntu)
Last-Modified: Sat, 13 May 2017 11:22:22 GMT
ETag: &quot;a7-54f6609245537&quot;
Accept-Ranges: bytes
Content-Length: 167
Cache-Control: max-age=0, no-cache, no-store, must-revalidate
Pragma: no-cache
Expires: Wed, 11 Jan 1984 05:00:00 GMT
Connection: close
Content-Type: text/plain

But soft what light through yonder window breaks
It is the east and Juliet is the sun
Arise fair sun and kill the envious moon
Who is already sick and pale with grief</code></pre>
<p>The output starts with headers which the web server sends to describe the document. For example, the <code>Content-Type</code> header indicates that the document is a plain text document (<code>text/plain</code>).</p>
<p>After the server sends us the headers, it adds a blank line to indicate the end of the headers, and then sends the actual data of the file <em>romeo.txt</em>.</p>
<p>This example shows how to make a low-level network connection with sockets. Sockets can be used to communicate with a web server or with a mail server or many other kinds of servers. All that is needed is to find the document which describes the protocol and write the code to send and receive the data according to the protocol.</p>
<p>However, since the protocol that we use most commonly is the HTTP web protocol, Python has a special library specifically designed to support the HTTP protocol for the retrieval of documents and data over the web.</p>
<p>One of the requirements for using the HTTP protocol is the need to send and receive data as bytes objects, instead of strings. In the preceding example, the <code>encode()</code> and <code>decode()</code> methods convert strings into bytes objects and back again.</p>
<p>The next example uses <code>b''</code> notation to specify that a variable should be stored as a bytes object. <code>encode()</code> and <code>b''</code> are equivalent.</p>
<pre><code>&gt;&gt;&gt; b&#39;Hello world&#39;
b&#39;Hello world&#39;
&gt;&gt;&gt; &#39;Hello world&#39;.encode()
b&#39;Hello world&#39;</code></pre>
<h2 id="retrieving-an-image-over-http">Retrieving an image over HTTP</h2>
<p>  </p>
<p>In the above example, we retrieved a plain text file which had newlines in the file and we simply copied the data to the screen as the program ran. We can use a similar program to retrieve an image across using HTTP. Instead of copying the data to the screen as the program runs, we accumulate the data in a string, trim off the headers, and then save the image data to a file as follows:</p>
<pre class="python"><code>import socket
import time

HOST = &#39;data.pr4e.org&#39;
PORT = 80
mysock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
mysock.connect((HOST, PORT))
mysock.sendall(b&#39;GET http://data.pr4e.org/cover3.jpg HTTP/1.0\r\n\r\n&#39;)
count = 0
picture = b&quot;&quot;

while True:
    data = mysock.recv(5120)
    if len(data) &lt; 1: break
    #time.sleep(0.25)
    count = count + len(data)
    print(len(data), count)
    picture = picture + data

mysock.close()

# Look for the end of the header (2 CRLF)
pos = picture.find(b&quot;\r\n\r\n&quot;)
print(&#39;Header length&#39;, pos)
print(picture[:pos].decode())

# Skip past the header and save the picture data
picture = picture[pos+4:]
fhand = open(&quot;stuff.jpg&quot;, &quot;wb&quot;)
fhand.write(picture)
fhand.close()

# Code: http://www.py4e.com/code3/urljpeg.py</code></pre>
<p>When the program runs, it produces the following output:</p>
<pre><code>$ python urljpeg.py
5120 5120
5120 10240
4240 14480
5120 19600
...
5120 214000
3200 217200
5120 222320
5120 227440
3167 230607
Header length 393
HTTP/1.1 200 OK
Date: Wed, 11 Apr 2018 18:54:09 GMT
Server: Apache/2.4.7 (Ubuntu)
Last-Modified: Mon, 15 May 2017 12:27:40 GMT
ETag: &quot;38342-54f8f2e5b6277&quot;
Accept-Ranges: bytes
Content-Length: 230210
Vary: Accept-Encoding
Cache-Control: max-age=0, no-cache, no-store, must-revalidate
Pragma: no-cache
Expires: Wed, 11 Jan 1984 05:00:00 GMT
Connection: close
Content-Type: image/jpeg</code></pre>
<p>You can see that for this url, the <code>Content-Type</code> header indicates that body of the document is an image (<code>image/jpeg</code>). Once the program completes, you can view the image data by opening the file <code>stuff.jpg</code> in an image viewer.</p>
<p>As the program runs, you can see that we don’t get 5120 characters each time we call the <code>recv()</code> method. We get as many characters as have been transferred across the network to us by the web server at the moment we call <code>recv()</code>. In this example, we either get as few as 3200 characters each time we request up to 5120 characters of data.</p>
<p>Your results may be different depending on your network speed. Also note that on the last call to <code>recv()</code> we get 3167 bytes, which is the end of the stream, and in the next call to <code>recv()</code> we get a zero-length string that tells us that the server has called <code>close()</code> on its end of the socket and there is no more data forthcoming.</p>
<p> </p>
<p>We can slow down our successive <code>recv()</code> calls by uncommenting the call to <code>time.sleep()</code>. This way, we wait a quarter of a second after each call so that the server can “get ahead” of us and send more data to us before we call <code>recv()</code> again. With the delay, in place the program executes as follows:</p>
<pre><code>$ python urljpeg.py
5120 5120
5120 10240
5120 15360
...
5120 225280
5120 230400
207 230607
Header length 393
HTTP/1.1 200 OK
Date: Wed, 11 Apr 2018 21:42:08 GMT
Server: Apache/2.4.7 (Ubuntu)
Last-Modified: Mon, 15 May 2017 12:27:40 GMT
ETag: &quot;38342-54f8f2e5b6277&quot;
Accept-Ranges: bytes
Content-Length: 230210
Vary: Accept-Encoding
Cache-Control: max-age=0, no-cache, no-store, must-revalidate
Pragma: no-cache
Expires: Wed, 11 Jan 1984 05:00:00 GMT
Connection: close
Content-Type: image/jpeg</code></pre>
<p>Now other than the first and last calls to <code>recv()</code>, we now get 5120 characters each time we ask for new data.</p>
<p>There is a buffer between the server making <code>send()</code> requests and our application making <code>recv()</code> requests. When we run the program with the delay in place, at some point the server might fill up the buffer in the socket and be forced to pause until our program starts to empty the buffer. The pausing of either the sending application or the receiving application is called “flow control.”</p>
<p></p>
<h2 id="retrieving-web-pages-with-urllib">Retrieving web pages with <code>urllib</code></h2>
<p>While we can manually send and receive data over HTTP using the socket library, there is a much simpler way to perform this common task in Python by using the <code>urllib</code> library.</p>
<p>Using <code>urllib</code>, you can treat a web page much like a file. You simply indicate which web page you would like to retrieve and <code>urllib</code> handles all of the HTTP protocol and header details.</p>
<p>The equivalent code to read the <em>romeo.txt</em> file from the web using <code>urllib</code> is as follows:</p>
<pre class="python"><code>import urllib.request

fhand = urllib.request.urlopen(&#39;http://data.pr4e.org/romeo.txt&#39;)
for line in fhand:
    print(line.decode().strip())

# Code: http://www.py4e.com/code3/urllib1.py</code></pre>
<p>Once the web page has been opened with <code>urllib.urlopen</code>, we can treat it like a file and read through it using a <code>for</code> loop.</p>
<p>When the program runs, we only see the output of the contents of the file. The headers are still sent, but the <code>urllib</code> code consumes the headers and only returns the data to us.</p>
<pre><code>But soft what light through yonder window breaks
It is the east and Juliet is the sun
Arise fair sun and kill the envious moon
Who is already sick and pale with grief</code></pre>
<p>As an example, we can write a program to retrieve the data for <code>romeo.txt</code> and compute the frequency of each word in the file as follows:</p>
<pre class="python"><code>import urllib.request, urllib.parse, urllib.error

fhand = urllib.request.urlopen(&#39;http://data.pr4e.org/romeo.txt&#39;)

counts = dict()
for line in fhand:
    words = line.decode().split()
    for word in words:
        counts[word] = counts.get(word, 0) + 1
print(counts)

# Code: http://www.py4e.com/code3/urlwords.py</code></pre>
<p>Again, once we have opened the web page, we can read it like a local file.</p>
<h2 id="reading-binary-files-using-urllib">Reading binary files using <code>urllib</code></h2>
<p>Sometimes you want to retrieve a non-text (or binary) file such as an image or video file. The data in these files is generally not useful to print out, but you can easily make a copy of a URL to a local file on your hard disk using <code>urllib</code>.</p>
<p></p>
<p>The pattern is to open the URL and use <code>read</code> to download the entire contents of the document into a string variable (<code>img</code>) then write that information to a local file as follows:</p>
<pre class="python"><code>import urllib.request, urllib.parse, urllib.error

img = urllib.request.urlopen(&#39;http://data.pr4e.org/cover3.jpg&#39;).read()
fhand = open(&#39;cover3.jpg&#39;, &#39;wb&#39;)
fhand.write(img)
fhand.close()

# Code: http://www.py4e.com/code3/curl1.py</code></pre>
<p>This program reads all of the data in at once across the network and stores it in the variable <code>img</code> in the main memory of your computer, then opens the file <code>cover.jpg</code> and writes the data out to your disk. The <code>wb</code> argument for <code>open()</code> opens a binary file for writing only. This program will work if the size of the file is less than the size of the memory of your computer.</p>
<p>However if this is a large audio or video file, this program may crash or at least run extremely slowly when your computer runs out of memory. In order to avoid running out of memory, we retrieve the data in blocks (or buffers) and then write each block to your disk before retrieving the next block. This way the program can read any size file without using up all of the memory you have in your computer.</p>
<pre class="python"><code>import urllib.request, urllib.parse, urllib.error

img = urllib.request.urlopen(&#39;http://data.pr4e.org/cover3.jpg&#39;)
fhand = open(&#39;cover3.jpg&#39;, &#39;wb&#39;)
size = 0
while True:
    info = img.read(100000)
    if len(info) &lt; 1: break
    size = size + len(info)
    fhand.write(info)

print(size, &#39;characters copied.&#39;)
fhand.close()

# Code: http://www.py4e.com/code3/curl2.py</code></pre>
<p>In this example, we read only 100,000 characters at a time and then write those characters to the <code>cover.jpg</code> file before retrieving the next 100,000 characters of data from the web.</p>
<p>This program runs as follows:</p>
<pre><code>python curl2.py
230210 characters copied.</code></pre>
<h2 id="parsing-html-and-scraping-the-web">Parsing HTML and scraping the web</h2>
<p> </p>
<p>One of the common uses of the <code>urllib</code> capability in Python is to <em>scrape</em> the web. Web scraping is when we write a program that pretends to be a web browser and retrieves pages, then examines the data in those pages looking for patterns.</p>
<p>As an example, a search engine such as Google will look at the source of one web page and extract the links to other pages and retrieve those pages, extracting links, and so on. Using this technique, Google <em>spiders</em> its way through nearly all of the pages on the web.</p>
<p>Google also uses the frequency of links from pages it finds to a particular page as one measure of how “important” a page is and how high the page should appear in its search results.</p>
<h2 id="parsing-html-using-regular-expressions">Parsing HTML using regular expressions</h2>
<p>One simple way to parse HTML is to use regular expressions to repeatedly search for and extract substrings that match a particular pattern.</p>
<p>Here is a simple web page:</p>
<pre class="html"><code>&lt;h1&gt;The First Page&lt;/h1&gt;
&lt;p&gt;
If you like, you can switch to the
&lt;a href=&quot;http://www.dr-chuck.com/page2.htm&quot;&gt;
Second Page&lt;/a&gt;.
&lt;/p&gt;</code></pre>
<p>We can construct a well-formed regular expression to match and extract the link values from the above text as follows:</p>
<pre><code>href=&quot;http[s]?://.+?&quot;</code></pre>
<p>Our regular expression looks for strings that start with “href="http://” or “href="https://”, followed by one or more characters (<code>.+?</code>), followed by another double quote. The question mark behind the <code>[s]?</code> indicates to search for the string “http” followed by zero or one “s”.</p>
<p>The question mark added to the <code>.+?</code> indicates that the match is to be done in a “non-greedy” fashion instead of a “greedy” fashion. A non-greedy match tries to find the <em>smallest</em> possible matching string and a greedy match tries to find the <em>largest</em> possible matching string.</p>
<p> </p>
<p>We add parentheses to our regular expression to indicate which part of our matched string we would like to extract, and produce the following program:</p>
<p> </p>
<pre class="python"><code># Search for link values within URL input
import urllib.request, urllib.parse, urllib.error
import re
import ssl

# Ignore SSL certificate errors
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

url = input(&#39;Enter - &#39;)
html = urllib.request.urlopen(url, context=ctx).read()
links = re.findall(b&#39;href=&quot;(http[s]?://.*?)&quot;&#39;, html)
for link in links:
    print(link.decode())

# Code: http://www.py4e.com/code3/urlregex.py</code></pre>
<p>The <code>ssl</code> library allows this program to access web sites that strictly enforce HTTPS. The <code>read</code> method returns HTML source code as a bytes object instead of returning an HTTPResponse object. The <code>findall</code> regular expression method will give us a list of all of the strings that match our regular expression, returning only the link text between the double quotes.</p>
<p>When we run the program and input a URL, we get the following output:</p>
<pre><code>Enter - https://docs.python.org
https://docs.python.org/3/index.html
https://www.python.org/
https://docs.python.org/3.8/
https://docs.python.org/3.7/
https://docs.python.org/3.5/
https://docs.python.org/2.7/
https://www.python.org/doc/versions/
https://www.python.org/dev/peps/
https://wiki.python.org/moin/BeginnersGuide
https://wiki.python.org/moin/PythonBooks
https://www.python.org/doc/av/
https://www.python.org/
https://www.python.org/psf/donations/
http://sphinx.pocoo.org/</code></pre>
<p>Regular expressions work very nicely when your HTML is well formatted and predictable. But since there are a lot of “broken” HTML pages out there, a solution only using regular expressions might either miss some valid links or end up with bad data.</p>
<p>This can be solved by using a robust HTML parsing library.</p>
<h2 id="parsing-html-using-beautifulsoup">Parsing HTML using BeautifulSoup</h2>
<p></p>
<p>Even though HTML looks like XML<a href="#fn1" class="footnote-ref" id="fnref1" role="doc-noteref"><sup>1</sup></a> and some pages are carefully constructed to be XML, most HTML is generally broken in ways that cause an XML parser to reject the entire page of HTML as improperly formed.</p>
<p>There are a number of Python libraries which can help you parse HTML and extract data from the pages. Each of the libraries has its strengths and weaknesses and you can pick one based on your needs.</p>
<p>As an example, we will simply parse some HTML input and extract links using the <em>BeautifulSoup</em> library. BeautifulSoup tolerates highly flawed HTML and still lets you easily extract the data you need. You can download and install the BeautifulSoup code from:</p>
<p><a href="https://pypi.python.org/pypi/beautifulsoup4" class="uri">https://pypi.python.org/pypi/beautifulsoup4</a></p>
<p>Information on installing BeautifulSoup with the Python Package Index tool <code>pip</code> is available at:</p>
<p><a href="https://packaging.python.org/tutorials/installing-packages/" class="uri">https://packaging.python.org/tutorials/installing-packages/</a></p>
<p>We will use <code>urllib</code> to read the page and then use <code>BeautifulSoup</code> to extract the <code>href</code> attributes from the anchor (<code>a</code>) tags.</p>
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
<p>The program prompts for a web address, then opens the web page, reads the data and passes the data to the BeautifulSoup parser, and then retrieves all of the anchor tags and prints out the <code>href</code> attribute for each tag.</p>
<p>When the program runs, it produces the following output:</p>
<pre><code>Enter - https://docs.python.org
genindex.html
py-modindex.html
https://www.python.org/
#
whatsnew/3.6.html
whatsnew/index.html
tutorial/index.html
library/index.html
reference/index.html
using/index.html
howto/index.html
installing/index.html
distributing/index.html
extending/index.html
c-api/index.html
faq/index.html
py-modindex.html
genindex.html
glossary.html
search.html
contents.html
bugs.html
about.html
license.html
copyright.html
download.html
https://docs.python.org/3.8/
https://docs.python.org/3.7/
https://docs.python.org/3.5/
https://docs.python.org/2.7/
https://www.python.org/doc/versions/
https://www.python.org/dev/peps/
https://wiki.python.org/moin/BeginnersGuide
https://wiki.python.org/moin/PythonBooks
https://www.python.org/doc/av/
genindex.html
py-modindex.html
https://www.python.org/
#
copyright.html
https://www.python.org/psf/donations/
bugs.html
http://sphinx.pocoo.org/</code></pre>
<p>This list is much longer because some HTML anchor tags are relative paths (e.g., tutorial/index.html) or in-page references (e.g., ‘#’) that do not include “http://” or “https://”, which was a requirement in our regular expression.</p>
<p>You can use also BeautifulSoup to pull out various parts of each tag:</p>
<pre class="python"><code># To run this, download the BeautifulSoup zip file
# http://www.py4e.com/code3/bs4.zip
# and unzip it in the same directory as this file

from urllib.request import urlopen
from bs4 import BeautifulSoup
import ssl

# Ignore SSL certificate errors
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

url = input(&#39;Enter - &#39;)
html = urlopen(url, context=ctx).read()
soup = BeautifulSoup(html, &quot;html.parser&quot;)

# Retrieve all of the anchor tags
tags = soup(&#39;a&#39;)
for tag in tags:
    # Look at the parts of a tag
    print(&#39;TAG:&#39;, tag)
    print(&#39;URL:&#39;, tag.get(&#39;href&#39;, None))
    print(&#39;Contents:&#39;, tag.contents[0])
    print(&#39;Attrs:&#39;, tag.attrs)

# Code: http://www.py4e.com/code3/urllink2.py</code></pre>
<pre><code>python urllink2.py
Enter - http://www.dr-chuck.com/page1.htm
TAG: &lt;a href=&quot;http://www.dr-chuck.com/page2.htm&quot;&gt;
Second Page&lt;/a&gt;
URL: http://www.dr-chuck.com/page2.htm
Content: [&#39;\nSecond Page&#39;]
Attrs: [(&#39;href&#39;, &#39;http://www.dr-chuck.com/page2.htm&#39;)]</code></pre>
<p><code>html.parser</code> is the HTML parser included in the standard Python 3 library. Information on other HTML parsers is available at:</p>
<p><a href="http://www.crummy.com/software/BeautifulSoup/bs4/doc/#installing-a-parser" class="uri">http://www.crummy.com/software/BeautifulSoup/bs4/doc/#installing-a-parser</a></p>
<p>These examples only begin to show the power of BeautifulSoup when it comes to parsing HTML.</p>
<h2 id="bonus-section-for-unix-linux-users">Bonus section for Unix / Linux users</h2>
<p>If you have a Linux, Unix, or Macintosh computer, you probably have commands built in to your operating system that retrieves both plain text and binary files using the HTTP or File Transfer (FTP) protocols. One of these commands is <code>curl</code>:</p>
<p></p>
<pre class="bash"><code>$ curl -O http://www.py4e.com/cover.jpg</code></pre>
<p>The command <code>curl</code> is short for “copy URL” and so the two examples listed earlier to retrieve binary files with <code>urllib</code> are cleverly named <code>curl1.py</code> and <code>curl2.py</code> on <a href="http://www.py4e.com/code3">www.py4e.com/code3</a> as they implement similar functionality to the <code>curl</code> command. There is also a <code>curl3.py</code> sample program that does this task a little more effectively, in case you actually want to use this pattern in a program you are writing.</p>
<p>A second command that functions very similarly is <code>wget</code>:</p>
<p></p>
<pre class="bash"><code>$ wget http://www.py4e.com/cover.jpg</code></pre>
<p>Both of these commands make retrieving webpages and remote files a simple task.</p>
<h2 id="glossary">Glossary</h2>
<dl>
<dt>BeautifulSoup</dt>
<dd>A Python library for parsing HTML documents and extracting data from HTML documents that compensates for most of the imperfections in the HTML that browsers generally ignore. You can download the BeautifulSoup code from <a href="http://www.crummy.com">www.crummy.com</a>.
</dd>
<dt>port</dt>
<dd>A number that generally indicates which application you are contacting when you make a socket connection to a server. As an example, web traffic usually uses port 80 while email traffic uses port 25.
</dd>
<dt>scrape</dt>
<dd>When a program pretends to be a web browser and retrieves a web page, then looks at the web page content. Often programs are following the links in one page to find the next page so they can traverse a network of pages or a social network.
</dd>
<dt>socket</dt>
<dd>A network connection between two applications where the applications can send and receive data in either direction.
</dd>
<dt>spider</dt>
<dd>The act of a web search engine retrieving a page and then all the pages linked from a page and so on until they have nearly all of the pages on the Internet which they use to build their search index.
</dd>
</dl>
<h2 id="exercises">Exercises</h2>
<p><strong>Exercise 1: Change the socket program <code>socket1.py</code> to prompt the user for the URL so it can read any web page. You can use <code>split('/')</code> to break the URL into its component parts so you can extract the host name for the socket <code>connect</code> call. Add error checking using <code>try</code> and <code>except</code> to handle the condition where the user enters an improperly formatted or non-existent URL.</strong></p>
<p><strong>Exercise 2: Change your socket program so that it counts the number of characters it has received and stops displaying any text after it has shown 3000 characters. The program should retrieve the entire document and count the total number of characters and display the count of the number of characters at the end of the document.</strong></p>
<p><strong>Exercise 3: Use <code>urllib</code> to replicate the previous exercise of (1) retrieving the document from a URL, (2) displaying up to 3000 characters, and (3) counting the overall number of characters in the document. Don’t worry about the headers for this exercise, simply show the first 3000 characters of the document contents.</strong></p>
<p><strong>Exercise 4: Change the <code>urllinks.py</code> program to extract and count paragraph (p) tags from the retrieved HTML document and display the count of the paragraphs as the output of your program. Do not display the paragraph text, only count them. Test your program on several small web pages as well as some larger web pages.</strong></p>
<p><strong>Exercise 5: (Advanced) Change the socket program so that it only shows data after the headers and a blank line have been received. Remember that <code>recv</code> receives characters (newlines and all), not lines.</strong></p>
<section class="footnotes" role="doc-endnotes">
<hr />
<ol>
<li id="fn1" role="doc-endnote"><p>The XML format is described in the next chapter.<a href="#fnref1" class="footnote-back" role="doc-backlink">↩︎</a></p></li>
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
