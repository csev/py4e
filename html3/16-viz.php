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
<h1 id="visualizing-data">Visualizing data</h1>
<p>So far we have been learning the Python language and then learning how to use Python, the network, and databases to manipulate data.</p>
<p>In this chapter, we take a look at three complete applications that bring all of these things together to manage and visualize data. You might use these applications as sample code to help get you started in solving a real-world problem.</p>
<p>Each of the applications is a ZIP file that you can download and extract onto your computer and execute.</p>
<h2 id="building-a-openstreetmap-from-geocoded-data">Building a OpenStreetMap from geocoded data</h2>
<p>  </p>
<p>In this project, we are using the OpenStreetMap geocoding API to clean up some user-entered geographic locations of university names and then placing the data on an actual OpenStreetMap.</p>
<figure>
<img src="../images/openstreet-map.png" alt="An OpenStreetMap" /><figcaption aria-hidden="true">An OpenStreetMap</figcaption>
</figure>
<p>To get started, download the application from:</p>
<p><a href="http://www.py4e.com/code3/opengeo.zip">www.py4e.com/code3/opengeo.zip</a></p>
<p>The first problem to solve is that these geocoding APIs are rate-limited to a certain number of requests per day. If you have a lot of data, you might need to stop and restart the lookup process several times. So we break the problem into two phases.</p>
<p></p>
<p>In the first phase we take our input “survey” data in the file <em>where.data</em> and read it one line at a time, and retrieve the geocoded information from Google and store it in a database <em>geodata.sqlite</em>. Before we use the geocoding API for each user-entered location, we simply check to see if we already have the data for that particular line of input. The database is functioning as a local “cache” of our geocoding data to make sure we never ask Google for the same data twice.</p>
<p>You can restart the process at any time by removing the file <em>geodata.sqlite</em>.</p>
<p>Run the <em>geoload.py</em> program. This program will read the input lines in <em>where.data</em> and for each line check to see if it is already in the database. If we don’t have the data for the location, it will call the geocoding API to retrieve the data and store it in the database.</p>
<p>Here is a sample run after there is already some data in the database:</p>
<pre><code>Found in database AGH University of Science and Technology

Found in database Academy of Fine Arts Warsaw Poland

Found in database American University in Cairo

Found in database Arizona State University

Found in database Athens Information Technology

Retrieving https://py4e-data.dr-chuck.net/
   opengeo?q=BITS+Pilani
Retrieved 794 characters {&quot;type&quot;:&quot;FeatureColl

Retrieving https://py4e-data.dr-chuck.net/
   opengeo?q=Babcock+University
Retrieved 760 characters {&quot;type&quot;:&quot;FeatureColl

Retrieving https://py4e-data.dr-chuck.net/
   opengeo?q=Banaras+Hindu+University
Retrieved 866 characters {&quot;type&quot;:&quot;FeatureColl
...</code></pre>
<p>The first five locations are already in the database and so they are skipped. The program scans to the point where it finds new locations and starts retrieving them.</p>
<p>The <em>geoload.py</em> program can be stopped at any time, and there is a counter that you can use to limit the number of calls to the geocoding API for each run. Given that the <em>where.data</em> only has a few hundred data items, you should not run into the daily rate limit, but if you had more data it might take several runs over several days to get your database to have all of the geocoded data for your input.</p>
<p>Once you have some data loaded into <em>geodata.sqlite</em>, you can visualize the data using the <em>geodump.py</em> program. This program reads the database and writes the file <em>where.js</em> with the location, latitude, and longitude in the form of executable JavaScript code.</p>
<p>A run of the <em>geodump.py</em> program is as follows:</p>
<pre><code>AGH University of Science and Technology, Czarnowiejska,
Czarna Wieś, Krowodrza, Kraków, Lesser Poland
Voivodeship, 31-126, Poland 50.0657 19.91895

Academy of Fine Arts, Krakowskie Przedmieście,
Northern Śródmieście, Śródmieście, Warsaw, Masovian
Voivodeship, 00-046, Poland 52.239 21.0155
...
260 lines were written to where.js
Open the where.html file in a web browser to view the data.</code></pre>
<p>The file <em>where.html</em> consists of HTML and JavaScript to visualize a Google map. It reads the most recent data in <em>where.js</em> to get the data to be visualized. Here is the format of the <em>where.js</em> file:</p>
<pre class="js"><code>myData = [
[50.0657,19.91895,
&#39;AGH University of Science and Technology, Czarnowiejska,
Czarna Wieś, Krowodrza, Kraków, Lesser Poland
Voivodeship, 31-126, Poland &#39;],
[52.239,21.0155,
&#39;Academy of Fine Arts, Krakowskie Przedmieściee,
Śródmieście Północne, Śródmieście, Warsaw,
Masovian Voivodeship, 00-046, Poland&#39;],
   ...
];</code></pre>
<p>This is a JavaScript variable that contains a list of lists. The syntax for JavaScript list constants is very similar to Python, so the syntax should be familiar to you.</p>
<p>Simply open <em>where.html</em> in a browser to see the locations. You can hover over each map pin to find the location that the geocoding API returned for the user-entered input. If you cannot see any data when you open the <em>where.html</em> file, you might want to check the JavaScript or developer console for your browser.</p>
<h2 id="visualizing-networks-and-interconnections">Visualizing networks and interconnections</h2>
<p>  </p>
<p>In this application, we will perform some of the functions of a search engine. We will first spider a small subset of the web and run a simplified version of the Google page rank algorithm to determine which pages are most highly connected, and then visualize the page rank and connectivity of our small corner of the web. We will use the D3 JavaScript visualization library <a href="http://d3js.org/" class="uri">http://d3js.org/</a> to produce the visualization output.</p>
<p>You can download and extract this application from:</p>
<p><a href="http://www.py4e.com/code3/pagerank.zip">www.py4e.com/code3/pagerank.zip</a></p>
<figure>
<img src="../images/pagerank.png" alt="A Page Ranking" style="height: 3.5in;"/>
<figcaption>
A Page Ranking
</figcaption>
</figure>
<p>The first program (<em>spider.py</em>) program crawls a web site and pulls a series of pages into the database (<em>spider.sqlite</em>), recording the links between pages. You can restart the process at any time by removing the <em>spider.sqlite</em> file and rerunning <em>spider.py</em>.</p>
<pre><code>Enter web url or enter: http://www.dr-chuck.com/
[&#39;http://www.dr-chuck.com&#39;]
How many pages:2
1 http://www.dr-chuck.com/ 12
2 http://www.dr-chuck.com/csev-blog/ 57
How many pages:</code></pre>
<p>In this sample run, we told it to crawl a website and retrieve two pages. If you restart the program and tell it to crawl more pages, it will not re-crawl any pages already in the database. Upon restart it goes to a random non-crawled page and starts there. So each successive run of <em>spider.py</em> is additive.</p>
<pre><code>Enter web url or enter: http://www.dr-chuck.com/
[&#39;http://www.dr-chuck.com&#39;]
How many pages:3
3 http://www.dr-chuck.com/csev-blog 57
4 http://www.dr-chuck.com/dr-chuck/resume/speaking.htm 1
5 http://www.dr-chuck.com/dr-chuck/resume/index.htm 13
How many pages:</code></pre>
<p>You can have multiple starting points in the same database—within the program, these are called “webs”. The spider chooses randomly amongst all non-visited links across all the webs as the next page to spider.</p>
<p>If you want to dump the contents of the <em>spider.sqlite</em> file, you can run <em>spdump.py</em> as follows:</p>
<pre><code>(5, None, 1.0, 3, &#39;http://www.dr-chuck.com/csev-blog&#39;)
(3, None, 1.0, 4, &#39;http://www.dr-chuck.com/dr-chuck/resume/speaking.htm&#39;)
(1, None, 1.0, 2, &#39;http://www.dr-chuck.com/csev-blog/&#39;)
(1, None, 1.0, 5, &#39;http://www.dr-chuck.com/dr-chuck/resume/index.htm&#39;)
4 rows.</code></pre>
<p>This shows the number of incoming links, the old page rank, the new page rank, the id of the page, and the url of the page. The <em>spdump.py</em> program only shows pages that have at least one incoming link to them.</p>
<p>Once you have a few pages in the database, you can run page rank on the pages using the <em>sprank.py</em> program. You simply tell it how many page rank iterations to run.</p>
<pre><code>How many iterations:2
1 0.546848992536
2 0.226714939664
[(1, 0.559), (2, 0.659), (3, 0.985), (4, 2.135), (5, 0.659)]</code></pre>
<p>You can dump the database again to see that page rank has been updated:</p>
<pre><code>(5, 1.0, 0.985, 3, &#39;http://www.dr-chuck.com/csev-blog&#39;)
(3, 1.0, 2.135, 4, &#39;http://www.dr-chuck.com/dr-chuck/resume/speaking.htm&#39;)
(1, 1.0, 0.659, 2, &#39;http://www.dr-chuck.com/csev-blog/&#39;)
(1, 1.0, 0.659, 5, &#39;http://www.dr-chuck.com/dr-chuck/resume/index.htm&#39;)
4 rows.</code></pre>
<p>You can run <em>sprank.py</em> as many times as you like and it will simply refine the page rank each time you run it. You can even run <em>sprank.py</em> a few times and then go spider a few more pages with <em>spider.py</em> and then run <em>sprank.py</em> to reconverge the page rank values. A search engine usually runs both the crawling and ranking programs all the time.</p>
<p>If you want to restart the page rank calculations without respidering the web pages, you can use <em>spreset.py</em> and then restart <em>sprank.py</em>.</p>
<pre><code>How many iterations:50
1 0.546848992536
2 0.226714939664
3 0.0659516187242
4 0.0244199333
5 0.0102096489546
6 0.00610244329379
...
42 0.000109076928206
43 9.91987599002e-05
44 9.02151706798e-05
45 8.20451504471e-05
46 7.46150183837e-05
47 6.7857770908e-05
48 6.17124694224e-05
49 5.61236959327e-05
50 5.10410499467e-05
[(512, 0.0296), (1, 12.79), (2, 28.93), (3, 6.808), (4, 13.46)]</code></pre>
<p>For each iteration of the page rank algorithm it prints the average change in page rank per page. The network initially is quite unbalanced and so the individual page rank values change wildly between iterations. But in a few short iterations, the page rank converges. You should run <em>sprank.py</em> long enough that the page rank values converge.</p>
<p>If you want to visualize the current top pages in terms of page rank, run <em>spjson.py</em> to read the database and write the data for the most highly linked pages in JSON format to be viewed in a web browser.</p>
<pre><code>Creating JSON output on spider.json...
How many nodes? 30
Open force.html in a browser to view the visualization</code></pre>
<p>You can view this data by opening the file <em>force.html</em> in your web browser. This shows an automatic layout of the nodes and links. You can click and drag any node and you can also double-click on a node to find the URL that is represented by the node.</p>
<p>If you rerun the other utilities, rerun <em>spjson.py</em> and press refresh in the browser to get the new data from <em>spider.json</em>.</p>
<h2 id="visualizing-mail-data">Visualizing mail data</h2>
<p>Up to this point in the book, you have become quite familiar with our <em>mbox-short.txt</em> and <em>mbox.txt</em> data files. Now it is time to take our analysis of email data to the next level.</p>
<p>In the real world, sometimes you have to pull down mail data from servers. That might take quite some time and the data might be inconsistent, error-filled, and need a lot of cleanup or adjustment. In this section, we work with an application that is the most complex so far and pull down nearly a gigabyte of data and visualize it.</p>
<figure>
<img src="../images/wordcloud.png" alt="A Word Cloud from the Sakai Developer List" style="height: 3.5in;"/>
<figcaption>
A Word Cloud from the Sakai Developer List
</figcaption>
</figure>
<p>You can download this application from:</p>
<p><a href="https://www.py4e.com/code3/gmane.zip">https://www.py4e.com/code3/gmane.zip</a></p>
<p>We will be using data from a free email list archiving service called <a href="http://www.gmane.org">http://www.gmane.org</a>. This service is very popular with open source projects because it provides a nice searchable archive of their email activity. They also have a very liberal policy regarding accessing their data through their API. They have no rate limits, but ask that you don’t overload their service and take only the data you need. You can read gmane’s terms and conditions at this page:</p>
<p><a href="http://www.gmane.org/export.php">http://www.gmane.org/export.php</a></p>
<p><em>It is very important that you make use of the gmane.org data responsibly by adding delays to your access of their services and spreading long-running jobs over a longer period of time. Do not abuse this free service and ruin it for the rest of us.</em></p>
<p>When the Sakai email data was spidered using this software, it produced nearly a Gigabyte of data and took a number of runs on several days. The file <em>README.txt</em> in the above ZIP may have instructions as to how you can download a pre-spidered copy of the <em>content.sqlite</em> file for a majority of the Sakai email corpus so you don’t have to spider for five days just to run the programs. If you download the pre-spidered content, you should still run the spidering process to catch up with more recent messages.</p>
<p>The first step is to spider the gmane repository. The base URL is hard-coded in the <em>gmane.py</em> and is hard-coded to the Sakai developer list. You can spider another repository by changing that base url. Make sure to delete the <em>content.sqlite</em> file if you switch the base url.</p>
<p>The <em>gmane.py</em> file operates as a responsible caching spider in that it runs slowly and retrieves one mail message per second so as to avoid getting throttled by gmane. It stores all of its data in a database and can be interrupted and restarted as often as needed. It may take many hours to pull all the data down. So you may need to restart several times.</p>
<p>Here is a run of <em>gmane.py</em> retrieving the last five messages of the Sakai developer list:</p>
<pre><code>How many messages:10
http://download.gmane.org/gmane.comp.cms.sakai.devel/51410/51411 9460
    nealcaidin@sakaifoundation.org 2013-04-05 re: [building ...
http://download.gmane.org/gmane.comp.cms.sakai.devel/51411/51412 3379
    samuelgutierrezjimenez@gmail.com 2013-04-06 re: [building ...
http://download.gmane.org/gmane.comp.cms.sakai.devel/51412/51413 9903
    da1@vt.edu 2013-04-05 [building sakai] melete 2.9 oracle ...
http://download.gmane.org/gmane.comp.cms.sakai.devel/51413/51414 349265
    m.shedid@elraed-it.com 2013-04-07 [building sakai] ...
http://download.gmane.org/gmane.comp.cms.sakai.devel/51414/51415 3481
    samuelgutierrezjimenez@gmail.com 2013-04-07 re: ...
http://download.gmane.org/gmane.comp.cms.sakai.devel/51415/51416 0

Does not start with From</code></pre>
<p>The program scans <em>content.sqlite</em> from one up to the first message number not already spidered and starts spidering at that message. It continues spidering until it has spidered the desired number of messages or it reaches a page that does not appear to be a properly formatted message.</p>
<p>Sometimes <strong>gmane.org</strong> is missing a message. Perhaps administrators can delete messages or perhaps they get lost. If your spider stops, and it seems it has hit a missing message, go into the SQLite Manager and add a row with the missing id leaving all the other fields blank and restart <em>gmane.py</em>. This will unstick the spidering process and allow it to continue. These empty messages will be ignored in the next phase of the process.</p>
<p>One nice thing is that once you have spidered all of the messages and have them in <em>content.sqlite</em>, you can run <em>gmane.py</em> again to get new messages as they are sent to the list.</p>
<p>The <em>content.sqlite</em> data is pretty raw, with an inefficient data model, and not compressed. This is intentional as it allows you to look at <em>content.sqlite</em> in the SQLite Manager to debug problems with the spidering process. It would be a bad idea to run any queries against this database, as they would be quite slow.</p>
<p>The second process is to run the program <em>gmodel.py</em>. This program reads the raw data from <em>content.sqlite</em> and produces a cleaned-up and well-modeled version of the data in the file <em>index.sqlite</em>. This file will be much smaller (often 10X smaller) than <em>content.sqlite</em> because it also compresses the header and body text.</p>
<p>Each time <em>gmodel.py</em> runs it deletes and rebuilds <em>index.sqlite</em>, allowing you to adjust its parameters and edit the mapping tables in <em>content.sqlite</em> to tweak the data cleaning process. This is a sample run of <em>gmodel.py</em>. It prints a line out each time 250 mail messages are processed so you can see some progress happening, as this program may run for a while processing nearly a Gigabyte of mail data.</p>
<pre><code>Loaded allsenders 1588 and mapping 28 dns mapping 1
1 2005-12-08T23:34:30-06:00 ggolden22@mac.com
251 2005-12-22T10:03:20-08:00 tpamsler@ucdavis.edu
501 2006-01-12T11:17:34-05:00 lance@indiana.edu
751 2006-01-24T11:13:28-08:00 vrajgopalan@ucmerced.edu
...</code></pre>
<p>The <em>gmodel.py</em> program handles a number of data cleaning tasks.</p>
<p>Domain names are truncated to two levels for .com, .org, .edu, and .net. Other domain names are truncated to three levels. So si.umich.edu becomes umich.edu and caret.cam.ac.uk becomes cam.ac.uk. Email addresses are also forced to lower case, and some of the <span class="citation" data-cites="gmane.org">@gmane.org</span> address like the following</p>
<pre><code>arwhyte-63aXycvo3TyHXe+LvDLADg@public.gmane.org</code></pre>
<p>are converted to the real address whenever there is a matching real email address elsewhere in the message corpus.</p>
<p>In the <em>mapping.sqlite</em> database there are two tables that allow you to map both domain names and individual email addresses that change over the lifetime of the email list. For example, Steve Githens used the following email addresses as he changed jobs over the life of the Sakai developer list:</p>
<pre><code>s-githens@northwestern.edu
sgithens@cam.ac.uk
swgithen@mtu.edu</code></pre>
<p>We can add two entries to the Mapping table in <em>mapping.sqlite</em> so <em>gmodel.py</em> will map all three to one address:</p>
<pre><code>s-githens@northwestern.edu -&gt;  swgithen@mtu.edu
sgithens@cam.ac.uk -&gt; swgithen@mtu.edu</code></pre>
<p>You can also make similar entries in the DNSMapping table if there are multiple DNS names you want mapped to a single DNS. The following mapping was added to the Sakai data:</p>
<pre><code>iupui.edu -&gt; indiana.edu</code></pre>
<p>so all the accounts from the various Indiana University campuses are tracked together.</p>
<p>You can rerun the <em>gmodel.py</em> over and over as you look at the data, and add mappings to make the data cleaner and cleaner. When you are done, you will have a nicely indexed version of the email in <em>index.sqlite</em>. This is the file to use to do data analysis. With this file, data analysis will be really quick.</p>
<p>The first, simplest data analysis is to determine “who sent the most mail?” and “which organization sent the most mail”? This is done using <em>gbasic.py</em>:</p>
<pre><code>How many to dump? 5
Loaded messages= 51330 subjects= 25033 senders= 1584

Top 5 Email list participants
steve.swinsburg@gmail.com 2657
azeckoski@unicon.net 1742
ieb@tfd.co.uk 1591
csev@umich.edu 1304
david.horwitz@uct.ac.za 1184

Top 5 Email list organizations
gmail.com 7339
umich.edu 6243
uct.ac.za 2451
indiana.edu 2258
unicon.net 2055</code></pre>
<p>Note how much more quickly <em>gbasic.py</em> runs compared to <em>gmane.py</em> or even <em>gmodel.py</em>. They are all working on the same data, but <em>gbasic.py</em> is using the compressed and normalized data in <em>index.sqlite</em>. If you have a lot of data to manage, a multistep process like the one in this application may take a little longer to develop, but will save you a lot of time when you really start to explore and visualize your data.</p>
<p>You can produce a simple visualization of the word frequency in the subject lines in the file <em>gword.py</em>:</p>
<pre><code>Range of counts: 33229 129
Output written to gword.js</code></pre>
<p>This produces the file <em>gword.js</em> which you can visualize using <em>gword.htm</em> to produce a word cloud similar to the one at the beginning of this section.</p>
<p>A second visualization is produced by <em>gline.py</em>. It computes email participation by organizations over time.</p>
<pre><code>Loaded messages= 51330 subjects= 25033 senders= 1584
Top 10 Oranizations
[&#39;gmail.com&#39;, &#39;umich.edu&#39;, &#39;uct.ac.za&#39;, &#39;indiana.edu&#39;,
&#39;unicon.net&#39;, &#39;tfd.co.uk&#39;, &#39;berkeley.edu&#39;, &#39;longsight.com&#39;,
&#39;stanford.edu&#39;, &#39;ox.ac.uk&#39;]
Output written to gline.js</code></pre>
<p>Its output is written to <em>gline.js</em> which is visualized using <em>gline.htm</em>.</p>
<figure>
<img src="../images/mailorg.png" alt="Sakai Mail Activity by Organization" /><figcaption aria-hidden="true">Sakai Mail Activity by Organization</figcaption>
</figure>
<p>This is a relatively complex and sophisticated application and has features to do some real data retrieval, cleaning, and visualization.</p>
</body>
</html>
<?php if ( file_exists("../bookfoot.php") ) {
  $HTML_FILE = basename(__FILE__);
  $HTML = ob_get_contents();
  ob_end_clean();
  require_once "../bookfoot.php";
}?>
