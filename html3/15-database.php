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
  <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv-printshiv.min.js"></script>
  <![endif]-->
</head>
<body>
<h1 id="using-databases-and-sql">Using Databases and SQL</h1>
<h2 id="what-is-a-database">What is a database?</h2>
<p></p>
<p>A <em>database</em> is a file that is organized for storing data.
Most databases are organized like a dictionary in the sense that they
map from keys to values. The biggest difference is that the database is
on disk (or other permanent storage), so it persists after the program
ends. Because a database is stored on permanent storage, it can store
far more data than a dictionary, which is limited to the size of the
memory in the computer.</p>
<p></p>
<p>Like a dictionary, database software is designed to keep the
inserting and accessing of data very fast, even for large amounts of
data. Database software maintains its performance by building
<em>indexes</em> as data is added to the database to allow the computer
to jump quickly to a particular entry.</p>
<p>There are many different database systems which are used for a wide
variety of purposes including: Oracle, MySQL, Microsoft SQL Server,
PostgreSQL, and SQLite. We focus on SQLite in this book because it is a
very common database and is already built into Python. SQLite is
designed to be <em>embedded</em> into other applications to provide
database support within the application. For example, the Firefox
browser also uses the SQLite database internally as do many other
products.</p>
<p><a href="http://sqlite.org/" class="uri">http://sqlite.org/</a></p>
<p>SQLite is well suited to some of the data manipulation problems that
we see in Informatics.</p>
<h2 id="database-concepts">Database concepts</h2>
<p>When you first look at a database it looks like a spreadsheet with
multiple sheets. The primary data structures in a database are:
<em>tables</em>, <em>rows</em>, and <em>columns</em>.</p>
<figure>
<img src="../images/relational.svg" alt="Relational Databases" style="height: 2.0in;"/>
<figcaption>
Relational Databases
</figcaption>
</figure>
<p>In technical descriptions of relational databases the concepts of
table, row, and column are more formally referred to as
<em>relation</em>, <em>tuple</em>, and <em>attribute</em>, respectively.
We will use the less formal terms in this chapter.</p>
<h2 id="database-browser-for-sqlite">Database Browser for SQLite</h2>
<p>While this chapter will focus on using Python to work with data in
SQLite database files, many operations can be done more conveniently
using software called the <em>Database Browser for SQLite</em> which is
freely available from:</p>
<p><a href="http://sqlitebrowser.org/"
class="uri">http://sqlitebrowser.org/</a></p>
<p>Using the browser you can easily create tables, insert data, edit
data, or run simple SQL queries on the data in the database.</p>
<p>In a sense, the database browser is similar to a text editor when
working with text files. When you want to do one or very few operations
on a text file, you can just open it in a text editor and make the
changes you want. When you have many changes that you need to do to a
text file, often you will write a simple Python program. You will find
the same pattern when working with databases. You will do simple
operations in the database manager and more complex operations will be
most conveniently done in Python.</p>
<h2 id="creating-a-database-table">Creating a database table</h2>
<p>Databases require more defined structure than Python lists or
dictionaries<a href="#fn1" class="footnote-ref" id="fnref1"
role="doc-noteref"><sup>1</sup></a>.</p>
<p>When we create a database <em>table</em> we must tell the database in
advance the names of each of the <em>columns</em> in the table and the
type of data which we are planning to store in each <em>column</em>.
When the database software knows the type of data in each column, it can
choose the most efficient way to store and look up the data based on the
type of data.</p>
<p>You can look at the various data types supported by SQLite at the
following url:</p>
<p><a href="http://www.sqlite.org/datatypes.html"
class="uri">http://www.sqlite.org/datatypes.html</a></p>
<p>Defining structure for your data up front may seem inconvenient at
the beginning, but the payoff is fast access to your data even when the
database contains a large amount of data.</p>
<p>The code to create a database file and a table named
<code>Track</code> with two columns in the database is as follows:</p>
<p> </p>
<pre class="python"><code>import sqlite3

conn = sqlite3.connect(&#39;music.sqlite&#39;)
cur = conn.cursor()

cur.execute(&#39;DROP TABLE IF EXISTS Track&#39;)
cur.execute(&#39;CREATE TABLE Track (title TEXT, plays INTEGER)&#39;)

conn.close()

# Code: http://www.py4e.com/code3/db1.py</code></pre>
<p> </p>
<p>The <code>connect</code> operation makes a “connection” to the
database stored in the file <code>music.sqlite</code> in the current
directory. If the file does not exist, it will be created. The reason
this is called a “connection” is that sometimes the database is stored
on a separate “database server” from the server on which we are running
our application. In our simple examples the database will just be a
local file in the same directory as the Python code we are running.</p>
<p>A <em>cursor</em> is like a file handle that we can use to perform
operations on the data stored in the database. Calling
<code>cursor()</code> is very similar conceptually to calling
<code>open()</code> when dealing with text files.</p>
<figure>
<img src="../images/cursor.svg" alt="A Database Cursor" style="height: 2.0in;"/>
<figcaption>
A Database Cursor
</figcaption>
</figure>
<p>Once we have the cursor, we can begin to execute commands on the
contents of the database using the <code>execute()</code> method.</p>
<p>Database commands are expressed in a special language that has been
standardized across many different database vendors to allow us to learn
a single database language. The database language is called
<em>Structured Query Language</em> or <em>SQL</em> for short.</p>
<p><a href="http://en.wikipedia.org/wiki/SQL"
class="uri">http://en.wikipedia.org/wiki/SQL</a></p>
<p>In our example, we are executing two SQL commands in our database. As
a convention, we will show the SQL keywords in uppercase and the parts
of the command that we are adding (such as the table and column names)
will be shown in lowercase.</p>
<p>The first SQL command removes the <code>Track</code> table from the
database if it exists. This pattern is simply to allow us to run the
same program to create the <code>Track</code> table over and over again
without causing an error. Note that the <code>DROP TABLE</code> command
deletes the table and all of its contents from the database (i.e., there
is no “undo”).</p>
<pre class="python"><code>cur.execute(&#39;DROP TABLE IF EXISTS Track &#39;)</code></pre>
<p>The second command creates a table named <code>Track</code> with a
text column named <code>title</code> and an integer column named
<code>plays</code>.</p>
<pre class="python"><code>cur.execute(&#39;CREATE TABLE Track (title TEXT, plays INTEGER)&#39;)</code></pre>
<p>Now that we have created a table named <code>Track</code>, we can put
some data into that table using the SQL <code>INSERT</code> operation.
Again, we begin by making a connection to the database and obtaining the
<code>cursor</code>. We can then execute SQL commands using the
cursor.</p>
<p>The SQL <code>INSERT</code> command indicates which table we are
using and then defines a new row by listing the fields we want to
include <code>(title, plays)</code> followed by the <code>VALUES</code>
we want placed in the new row. We specify the values as question marks
<code>(?, ?)</code> to indicate that the actual values are passed in as
a tuple <code>( 'My Way', 15 )</code> as the second parameter to the
<code>execute()</code> call.</p>
<pre class="python"><code>import sqlite3

conn = sqlite3.connect(&#39;music.sqlite&#39;)
cur = conn.cursor()

cur.execute(&#39;INSERT INTO Track (title, plays) VALUES (?, ?)&#39;,
    (&#39;Thunderstruck&#39;, 20))
cur.execute(&#39;INSERT INTO Track (title, plays) VALUES (?, ?)&#39;,
    (&#39;My Way&#39;, 15))
conn.commit()

print(&#39;Track:&#39;)
cur.execute(&#39;SELECT title, plays FROM Track&#39;)
for row in cur:
     print(row)

cur.execute(&#39;DELETE FROM Track WHERE plays &lt; 100&#39;)
conn.commit()

cur.close()

# Code: http://www.py4e.com/code3/db2.py</code></pre>
<p>First we <code>INSERT</code> two rows into our table and use
<code>commit()</code> to force the data to be written to the database
file.</p>
<figure>
<img src="../images/tracks.svg" alt="Rows in a Table" style="height: 1.5in;"/>
<figcaption>
Rows in a Table
</figcaption>
</figure>
<p>Then we use the <code>SELECT</code> command to retrieve the rows we
just inserted from the table. On the <code>SELECT</code> command, we
indicate which columns we would like <code>(title, plays)</code> and
indicate which table we want to retrieve the data from. After we execute
the <code>SELECT</code> statement, the cursor is something we can loop
through in a <code>for</code> statement. For efficiency, the cursor does
not read all of the data from the database when we execute the
<code>SELECT</code> statement. Instead, the data is read on demand as we
loop through the rows in the <code>for</code> statement.</p>
<p>The output of the program is as follows:</p>
<pre><code>Track:
(&#39;Thunderstruck&#39;, 20)
(&#39;My Way&#39;, 15)</code></pre>
<p></p>
<p>Our <code>for</code> loop finds two rows, and each row is a Python
tuple with the first value as the <code>title</code> and the second
value as the number of <code>plays</code>.</p>
<p><em>Note: You may see strings starting with <code>u'</code> in other
books or on the Internet. This was an indication in Python 2 that the
strings are </em>Unicode* strings that are capable of storing non-Latin
character sets. In Python 3, all strings are Unicode strings by
default.*</p>
<p>At the very end of the program, we execute an SQL command to
<code>DELETE</code> the rows we have just created so we can run the
program over and over. The <code>DELETE</code> command shows the use of
a <code>WHERE</code> clause that allows us to express a selection
criterion so that we can ask the database to apply the command to only
the rows that match the criterion. In this example the criterion happens
to apply to all the rows so we empty the table out so we can run the
program repeatedly. After the <code>DELETE</code> is performed, we also
call <code>commit()</code> to force the data to be removed from the
database.</p>
<h2 id="structured-query-language-summary">Structured Query Language
summary</h2>
<p> So far, we have been using the Structured Query Language in our
Python examples and have covered many of the basics of the SQL commands.
In this section, we look at the SQL language in particular and give an
overview of SQL syntax.</p>
<p>Since there are so many different database vendors, the Structured
Query Language (SQL) was standardized so we could communicate in a
portable manner to database systems from multiple vendors.</p>
<p>A relational database is made up of tables, rows, and columns. The
columns generally have a type such as text, numeric, or date data. When
we create a table, we indicate the names and types of the columns:</p>
<pre class="sql"><code>CREATE TABLE Track (title TEXT, plays INTEGER)</code></pre>
<p>To insert a row into a table, we use the SQL <code>INSERT</code>
command:</p>
<pre class="sql"><code>INSERT INTO Track (title, plays) VALUES (&#39;My Way&#39;, 15)</code></pre>
<p>The <code>INSERT</code> statement specifies the table name, then a
list of the fields/columns that you would like to set in the new row,
and then the keyword <code>VALUES</code> and a list of corresponding
values for each of the fields.</p>
<p>The SQL <code>SELECT</code> command is used to retrieve rows and
columns from a database. The <code>SELECT</code> statement lets you
specify which columns you would like to retrieve as well as a
<code>WHERE</code> clause to select which rows you would like to see. It
also allows an optional <code>ORDER BY</code> clause to control the
sorting of the returned rows.</p>
<pre class="sql"><code>SELECT * FROM Track WHERE title = &#39;My Way&#39;</code></pre>
<p>Using <code>*</code> indicates that you want the database to return
all of the columns for each row that matches the <code>WHERE</code>
clause.</p>
<p>Note, unlike in Python, in a SQL <code>WHERE</code> clause we use a
single equal sign to indicate a test for equality rather than a double
equal sign. Other logical operations allowed in a <code>WHERE</code>
clause include <code>&lt;</code>, <code>&gt;</code>, <code>&lt;=</code>,
<code>&gt;=</code>, <code>!=</code>, as well as <code>AND</code> and
<code>OR</code> and parentheses to build your logical expressions.</p>
<p>You can request that the returned rows be sorted by one of the fields
as follows:</p>
<pre class="sql"><code>SELECT title,plays FROM Track ORDER BY title</code></pre>
<p>To remove a row, you need a <code>WHERE</code> clause on an SQL
<code>DELETE</code> statement. The <code>WHERE</code> clause determines
which rows are to be deleted:</p>
<pre class="sql"><code>DELETE FROM Track WHERE title = &#39;My Way&#39;</code></pre>
<p>It is possible to <code>UPDATE</code> a column or columns within one
or more rows in a table using the SQL <code>UPDATE</code> statement as
follows:</p>
<pre class="sql"><code>UPDATE Track SET plays = 16 WHERE title = &#39;My Way&#39;</code></pre>
<p>The <code>UPDATE</code> statement specifies a table and then a list
of fields and values to change after the <code>SET</code> keyword and
then an optional <code>WHERE</code> clause to select the rows that are
to be updated. A single <code>UPDATE</code> statement will change all of
the rows that match the <code>WHERE</code> clause. If a
<code>WHERE</code> clause is not specified, it performs the
<code>UPDATE</code> on all of the rows in the table.</p>
<p> These four basic SQL commands (INSERT, SELECT, UPDATE, and DELETE)
allow the four basic operations needed to create and maintain data. We
use “CRUD” (Create, Read, Update, and Delete) to capture all these
concepts in a single term. <a href="#fn2" class="footnote-ref"
id="fnref2" role="doc-noteref"><sup>2</sup></a></p>
<h2 id="multiple-tables-and-basic-data-modeling">Multiple tables and
basic data modeling</h2>
<p> The real power of a relational database is when we create multiple
tables and make links between those tables. The act of deciding how to
break up your application data into multiple tables and establishing the
relationships between the tables is called <em>data modeling</em>. The
design document that shows the tables and their relationships is called
a <em>data model</em>.</p>
<p>Data modeling is a relatively sophisticated skill and we will only
introduce the most basic concepts of relational data modeling in this
section. For more detail on data modeling you can start with:</p>
<p><a href="http://en.wikipedia.org/wiki/Relational_model"
class="uri">http://en.wikipedia.org/wiki/Relational_model</a></p>
<p> Lets say for our tracks database we wanted to track the name of the
<code>artist</code> for each track in addition to the <code>title</code>
and number of plays for each track. A simple approach might be to simply
add another column to the database called <code>artist</code> and put
the name of the artist in the column as follows:</p>
<pre class="python"><code>DROP TABLE IF EXISTS Track;
CREATE TABLE Track (title TEXT, plays INTEGER, artist TEXT);</code></pre>
<p>Then we could insert a few tracks into our table.</p>
<pre class="sql"><code>INSERT INTO Track (title, plays, artist)
    VALUES (&#39;My Way&#39;, 15, &#39;Frank Sinatra&#39;);
INSERT INTO Track (title, plays, artist)
    VALUES (&#39;New York&#39;, 25, &#39;Frank Sinatra&#39;);</code></pre>
<p>If we were to look at our data with a
<code>SELECT * FROM Track</code> statement, it looks like we have done a
fine job.</p>
<pre><code>sqlite&gt; SELECT * FROM Track;
My Way|15|Frank Sinatra
New York|25|Frank Sinatra
sqlite&gt;</code></pre>
<p>We have made a <em>very bad error</em> in our data modeling. We have
violated the rules of <em>database normalization</em>.</p>
<p><a href="https://en.wikipedia.org/wiki/Database_normalization"
class="uri">https://en.wikipedia.org/wiki/Database_normalization</a></p>
<p> While database normalization seems very complex on the surface and
contains a lot of mathematical justifications, for now we can reduce it
all into one simple rule that we will follow.</p>
<p> We should never put the same string data in a column more than once.
If we need the data more than once, we create a numeric <em>key</em> for
the data and reference the actual data using this key. Especially if the
multiple entries refer to the same object.</p>
<p>To demonstrate the slippery slope we are going down by assigning
string columns to out database model, think about how we would change
the data model if we wanted to keep track of the eye color of our
artists? Would we do this?</p>
<pre class="sql"><code>DROP TABLE IF EXISTS Track;
CREATE TABLE Track (title TEXT, plays INTEGER,
    artist TEXT, eyes TEXT);
INSERT INTO Track (title, plays, artist, eyes)
    VALUES (&#39;My Way&#39;, 15, &#39;Frank Sinatra&#39;, &#39;Blue&#39;);
INSERT INTO Track (title, plays, artist, eyes)
    VALUES (&#39;New York&#39;, 25, &#39;Frank Sinatra&#39;, &#39;Blue&#39;);</code></pre>
<p>Since Frank Sinatra recorded over 1200 songs, are we really going to
put the string ‘Blue’ in 1200 rows in our <code>Track</code> table. And
what would happen if we decided his eye color was ‘Light Blue’?
Something just does not feel right. The right solution is to create a
table for the each <code>Artist</code> and store all the data about the
artist in that table. And then somehow we need to make a connection
between a row in the <code>Track</code> table to a row in the
<code>Artist</code> table. Perhaps we could call this “link” between two
“tables” a “relationship” between two tables. And that is exactly what
database experts decided to all these links.</p>
<p>Lets make an <code>Artist</code> table as follows:</p>
<pre class="sql"><code>DROP TABLE IF EXISTS Artist;
CREATE TABLE Artist (name TEXT, eyes TEXT);
INSERT INTO Artist (name, eyes)
   VALUES (&#39;Frank Sinatra&#39;, &#39;blue&#39;);</code></pre>
<p> Now we have two tables but we need a way to <em>link</em> rows in
the two tables. To do this, we need why we call ‘keys’. These keys will
just be integer numbers that we can use to lookup a row in different
table. If we are going to make links to rows inside of a table, we need
to add a <em>primary key</em> to the rows in the table. By convention we
usually name the primary key column ‘id’. So our
<code>Artist</code>table looks as follows:</p>
<pre class="sql"><code>DROP TABLE IF EXISTS Artist;
CREATE TABLE Artist (id INTEGER, name TEXT, eyes TEXT);
INSERT INTO Artist (id, name, eyes)
   VALUES (42, &#39;Frank Sinatra&#39;, &#39;blue&#39;);</code></pre>
<p>Now we have a row in the table for ‘Frank Sinatra’ (and his eye
color) and a primary key of ‘42’ to use to link our tracks to him. So we
alter our Track table as follows:</p>
<pre class="sql"><code>DROP TABLE IF EXISTS Track;
CREATE TABLE Track (title TEXT, plays INTEGER,
    artist_id INTEGER);
INSERT INTO Track (title, plays, artist_id)
    VALUES (&#39;My Way&#39;, 15, 42);
INSERT INTO Track (title, plays, artist_id)
    VALUES (&#39;New York&#39;, 25, 42);</code></pre>
<p> The <code>artist_id</code> column is an integer, and by naming
convention is a <em>foreign key</em> pointing at a <em>primary</em> key
in the <code>Artist</code> table. We call it a foreign key because it is
pointing to a row in a different table.</p>
<p> Now we are following the rules of database normalization, but when
we want to get data out of our database, we don’t want to see the 42, we
want to see the name and eye color of the artist. To do this we use the
<code>JOIN</code> keyword in our SELECT statement.</p>
<pre class="sql"><code>SELECT title, plays, name, eyes
FROM Track JOIN Artist
ON Track.artist_id = Artist.id;</code></pre>
<p>The <code>JOIN</code> clause includes an <code>ON</code> condition
that defines how the rows are to to be connected. For each row in
<code>Track</code> add the data from <code>Artist</code> from the row
where <code>artist_id</code> <code>Track</code> table matches the
<code>id</code> from the <code>Artist</code> table.</p>
<p>The output would be:</p>
<pre><code>My Way|15|Frank Sinatra|blue
New York|25|Frank Sinatra|blue</code></pre>
<p>While it might seem a little clunky and your instincts might tell you
that it would be faster just to keep the data in one table, it turns out
the the limit on database performance is how much data needs to be
scanned when retrieving a query. While they details are very complex,
integers are a lot smaller than strings (especially Unicode Strings) and
far quicker to to move and compare.</p>
<h2 id="data-model-diagrams">Data model diagrams</h2>
<p> While out <code>Track</code> and <code>Artist</code> database
design, is very simple with just two tables and a single one-to-many
relationship, these data models can get complicated quickly and are
easier to understand if we can make a graphical representation data
model.</p>
<figure>
<img src="../images/one-to-many-verbose.png" alt="A Verbose One-to-Many Data Model\label{figvrbo2m}" style="height: 1.5in;"/>
<figcaption>
A Verbose One-to-Many Data Model
</figcaption>
</figure>
<p> While there are many graphical representations of data models, we
will use one of the “classic” appraches, called “Crow’s Foot Diagrams”
as shown in Figure . Each table is shown as a box with the name of the
table and its columns. Then where there is a relationship between two
tables a line is drawn connecting the tables with a notation added to
the end of each line indicating the nature of the relationship.</p>
<p><a href="https://en.wikipedia.org/wiki/Entity-relationship_model"
class="uri">https://en.wikipedia.org/wiki/Entity-relationship_model</a></p>
<p>In this case, “many” tracks can be associated with each artist. So
the track end is shown with the crow’s foot spread out indicating it is
the” “many” end. The artist end is shown with a vertical like that
indicates “one”. There will be “many” artists in general, but the
important aspect is that for each artist there will be many tracks.</p>
<p> You will note that the column that holds the <em>foreign_key</em>
like <code>artist_id</code> is on the “many” end and the <em>primary
key</em> is at the “one” end.</p>
<p>Since the pattern of foreign and primary key placement is so
consistent and follows the “many” and “one” ends of the lines, in
reality we never include either the primary or foreign key columns in
our diagram of the data model as shown in the second diagram as showin
in Figure . The columns are thought of as “implementation detail” to
capture the nature of the relationship details and not an essential part
of the data being modeled.</p>
<figure>
<img src="../images/one-to-many.png" alt="A Succinct One-to-Many Data Model\label{figo2m}" style="height: 1.5in;"/>
<figcaption>
A Succinct One-to-Many Data Model
</figcaption>
</figure>
<h2 id="automatically-creating-primary-keys">Automatically creating
primary keys</h2>
<p> In the above example, we arbitrarily assigned Frank the primary key
of 42. However when we are inserting millions or rows, it is nice to
have the database automatically generate the values for the id column.
We do this by declaring the <code>id</code> column as a
<code>PRIMARY KEY</code> and leave out the <code>id</code> value when
inserting the row:</p>
<pre class="sql"><code>DROP TABLE IF EXISTS Artist;
CREATE TABLE Artist (id INTEGER PRIMARY KEY,
    name TEXT, eyes TEXT);
INSERT INTO Artist (name, eyes)
   VALUES (&#39;Frank Sinatra&#39;, &#39;blue&#39;);</code></pre>
<p>Now we have instructed the database to auto-assign us a unique value
to the Frank Sinatra row. But we then need a way to have the database
tell us the <code>id</code> value for the recently inserted row:</p>
<pre><code>sqlite&gt; DROP TABLE IF EXISTS Artist;
sqlite&gt; CREATE TABLE Artist (id INTEGER PRIMARY KEY,
   ...&gt;     name TEXT, eyes TEXT);
sqlite&gt; INSERT INTO Artist (name, eyes)
   ...&gt;    VALUES (&#39;Frank Sinatra&#39;, &#39;blue&#39;);
sqlite&gt; select last_insert_rowid();
1
sqlite&gt; SELECT * FROM Artist;
1|Frank Sinatra|blue
sqlite&gt;</code></pre>
<p>Once we know the <code>id</code> of our ‘Frank Sinatra’ row, we can
use it when we <code>INSERT</code> the tracks into the
<code>Track</code> table. As a general strategy, we add these
<code>id</code> columns to any table we create:</p>
<pre><code>sqlite&gt; DROP TABLE IF EXISTS Track;
sqlite&gt; CREATE TABLE Track (id INTEGER PRIMARY KEY,
   ...&gt;     title TEXT, plays INTEGER, artist_id INTEGER);</code></pre>
<p>Note that the <code>artist_id</code> value is the new auto-assigned
row in the <code>Artist</code> table and that while we added an
<code>INTEGER PRIMARY KEY</code> to the the <code>Track</code> table, we
did not include <code>id</code> in the list of fields on the
<code>INSERT</code> statements into the <code>Track</code> table. Again
this tells the database to choose a unique value for us for the
<code>id</code> column.</p>
<pre><code>sqlite&gt; INSERT INTO Track (title, plays, artist_id)
   ...&gt;     VALUES (&#39;My Way&#39;, 15, 1);
sqlite&gt; select last_insert_rowid();
1
sqlite&gt; INSERT INTO Track (title, plays, artist_id)
   ...&gt;     VALUES (&#39;New York&#39;, 25, 1);
sqlite&gt; select last_insert_rowid();
2
sqlite&gt;</code></pre>
<p> You can call <code>SELECT last_insert_rowid();</code> after each of
the inserts to retrieve the value that the database assigned to the
<code>id</code> of each newly created row. Later when we are coding in
Python, we can ask for the <code>id</code> value in our code and store
it in a variable for later use.</p>
<h2 id="logical-keys-for-fast-lookup">Logical keys for fast lookup</h2>
<p> If we had a table full of artists and a table full of tracks, each
with a foreign key link to a row in a table full of artists and we
wanted to list all the tracks that were sung by ‘Frank Sinatra’ as
follows:</p>
<pre><code>SELECT title, plays, name, eyes
FROM Track JOIN Artist
ON Track.artist_id = Artist.id
WHERE Artist.name = &#39;Frank Sinatra&#39;;</code></pre>
<p>Since we have two tables and a foreign key between the two tables,
our data is well-modeled, but if we are going to have millions of
records in the <code>Artist</code> table and going to do a lot of
lookups by artist name, we would benefit if we gave the database a hint
about our intended use of the <code>name</code> column.</p>
<p> We do this by adding an “index” to a text column that we intend to
use in <code>WHERE</code> clauses:</p>
<pre><code>CREATE INDEX artist_name ON Artist(name);</code></pre>
<p>When the database has been told that an index is needed on a column
in a table, it stores extra information to make it possible to look up a
row more quickly using the indexed field (<code>name</code> in this
example). Once you request that an index be created, there is nothing
special that is needed in the SQL to access the table. The database
keeps the index up to date as data is inserted, deleted, and updated,
and uses it automatically if it will increase the performance of a
database query.</p>
<p>These text columns that are used to find rows based on some
information in the “real world” like the name of an artist are called
<em>Logical keys</em>.</p>
<h2 id="adding-constraints-to-the-data-database">Adding constraints to
the data database</h2>
<p> We can also use an index to enforce a constraint (i.e. rules) on our
database operations. The most common constraint is a <em>uniqueness
constraint</em> which insists that all of the values in a column are
unique. We can add the optional <code>UNIQUE</code> keyword, to the
<code>CREATE INDEX</code> statement to tell the database that we would
like it to enforce the constraint on our SQL. We can drop and re-create
the <code>artist_name</code> index with a <code>UNIQUE</code> constraint
as follows.</p>
<pre><code>DROP INDEX artist_name;
CREATE UNIQUE INDEX artist_name ON Artist(name);</code></pre>
<p>If we try to insert ‘Frank Sinatra’ a second time, it will fail with
an error.</p>
<pre><code>sqlite&gt; SELECT * FROM Artist;
1|Frank Sinatra|blue
sqlite&gt; INSERT INTO Artist (name, eyes)
   ...&gt;    VALUES (&#39;Frank Sinatra&#39;, &#39;blue&#39;);
Runtime error: UNIQUE constraint failed: Artist.name (19)
sqlite&gt;</code></pre>
<p> We can tell the database to ignore any duplicate key errors by
adding the <code>IGNORE</code> keyword to the <code>INSERT</code>
statement as follows:</p>
<pre><code>sqlite&gt; INSERT OR IGNORE INTO Artist (name, eyes)
   ...&gt;     VALUES (&#39;Frank Sinatra&#39;, &#39;blue&#39;);
sqlite&gt; SELECT id FROM Artist WHERE name=&#39;Frank Sinatra&#39;;
1
sqlite&gt;</code></pre>
<p>By combining an <code>INSERT OR IGNORE</code> and a
<code>SELECT</code> we can insert a new record if the name is not
already there and whether or not the record is already there, retrieve
the <em>primary</em> key of the record regardless of whether it was
newly inserted or already present in the table.</p>
<pre><code>sqlite&gt; INSERT OR IGNORE INTO Artist (name, eyes)
   ...&gt;      VALUES (&#39;Elvis&#39;, &#39;blue&#39;);
sqlite&gt; SELECT id FROM Artist WHERE name=&#39;Elvis&#39;;
2
sqlite&gt; SELECT * FROM Artist;
1|Frank Sinatra|blue
2|Elvis|blue
sqlite&gt;</code></pre>
<p>Since we have not added a uniqueness constraint to the eye color
column, there is no problem having multiple ‘Blue’ values in the
<code>eye</code> column.</p>
<h2 id="sample-multi-table-application">Sample multi-table
application</h2>
<p>A sample application called <code>tracks_csv.py</code> shows how
these ideas can be combined to parse textual data and load it into
several tables using a proper data model with relational connections
between the tables:</p>
<p>This application reads and parses a comma-separated file
<code>tracks.csv</code> based on an export from Dr. Chuck’s iTunes
library.</p>
<pre><code>Another One Bites The Dust,Queen,Greatest Hits,55,100,217103
Asche Zu Asche,Rammstein,Herzeleid,79,100,231810
Beauty School Dropout,Various,Grease,48,100,239960
Black Dog,Led Zeppelin,IV,109,100,296620
...</code></pre>
<p>The columns in this file are: title, artist, album, number of plays,
rating (0-100) and length in milliseconds.</p>
<figure>
<img src="../images/tracks-albums-artists.png" alt="Tracks, Albums, and Artists\label{figtaa}" style="height: 1.5in;"/>
<figcaption>
Tracks, Albums, and Artists
</figcaption>
</figure>
<p>Our data model is shown in Figure and described in SQL as
follows:</p>
<pre class="sql"><code>DROP TABLE IF EXISTS Artist;
DROP TABLE IF EXISTS Album;
DROP TABLE IF EXISTS Track;

CREATE TABLE Artist (
    id INTEGER PRIMARY KEY,
    name TEXT UNIQUE
);

CREATE TABLE Album (
    id INTEGER PRIMARY KEY,
    artist_id  INTEGER,
    title TEXT UNIQUE
);

CREATE TABLE Track (
    id INTEGER PRIMARY KEY,
    title TEXT UNIQUE,
    album_id INTEGER,
    len INTEGER, rating INTEGER, count INTEGER
);</code></pre>
<p>We are adding the <code>UNIQUE</code> keyword to <code>TEXT</code>
columns that we would like to have a uniqueness constraint that w will
use in <code>INSERT IGNORE</code> statements. This is more succinct that
separate <code>CREATE INDEX</code> statements but has the same
effect.</p>
<p>With these tables in place, we write the following code
<code>tracks_csv.py</code> to parse the data and insert it into the
tables:</p>
<pre class="python"><code>import sqlite3

conn = sqlite3.connect(&#39;trackdb.sqlite&#39;)
cur = conn.cursor()

handle = open(&#39;tracks.csv&#39;)

for line in handle:
    line = line.strip();
    pieces = line.split(&#39;,&#39;)
    if len(pieces) != 6 : continue

    name = pieces[0]
    artist = pieces[1]
    album = pieces[2]
    count = pieces[3]
    rating = pieces[4]
    length = pieces[5]

    print(name, artist, album, count, rating, length)

    cur.execute(&#39;&#39;&#39;INSERT OR IGNORE INTO Artist (name)
        VALUES ( ? )&#39;&#39;&#39;, ( artist, ) )
    cur.execute(&#39;SELECT id FROM Artist WHERE name = ? &#39;, (artist, ))
    artist_id = cur.fetchone()[0]

    cur.execute(&#39;&#39;&#39;INSERT OR IGNORE INTO Album (title, artist_id)
        VALUES ( ?, ? )&#39;&#39;&#39;, ( album, artist_id ) )
    cur.execute(&#39;SELECT id FROM Album WHERE title = ? &#39;, (album, ))
    album_id = cur.fetchone()[0]

    cur.execute(&#39;&#39;&#39;INSERT OR REPLACE INTO Track
        (title, album_id, len, rating, count)
        VALUES ( ?, ?, ?, ?, ? )&#39;&#39;&#39;,
        ( name, album_id, length, rating, count ) )

    conn.commit()</code></pre>
<p>You can see that we are repeating the pattern of
<code>INSERT OR IGNORE</code> followed by a <code>SELECT</code> to get
the appropriate <code>artist_id</code> and <code>album_id</code> for use
in later <code>INSERT</code> statements. We start from
<code>Artist</code> because we need <code>artist_id</code> to insert the
<code>Album</code> and need the <code>album_id</code> to insert the
<code>Track</code>.</p>
<p> If we look at the <code>Album</code> table, we can see that the
entries were added and assigned a <em>primary</em> key as necessary as
the data was parsed. We can also see the <em>foreign key</em> pointing
to a row in the <code>Artist</code> table for each <code>Album</code>
row.</p>
<pre><code>sqlite&gt; .mode column
sqlite&gt; SELECT * FROM Album LIMIT 5;
id  artist_id  title
--  ---------  -----------------
1   1          Greatest Hits
2   2          Herzeleid
3   3          Grease
4   4          IV
5   5          The Wall [Disc 2]
sqlite&gt;</code></pre>
<p> We can reconstruct all of the <code>Track</code> data, following all
the relations using <code>JOIN / ON</code> clauses. You can see both
ends of each of the (2) relational connections in each row in the output
below:</p>
<pre><code>sqlite&gt; .mode line
sqlite&gt; SELECT * FROM Track
   ...&gt; JOIN Album ON Track.album_id = Album.id
   ...&gt; JOIN Artist ON Album.artist_id = Artist.id
   ...&gt; LIMIT 2;
       id = 1
    title = Another One Bites The Dust
 album_id = 1
      len = 217103
   rating = 100
    count = 55
       id = 1
artist_id = 1
    title = Greatest Hits
       id = 1
     name = Queen

       id = 2
    title = Asche Zu Asche
 album_id = 2
      len = 231810
   rating = 100
    count = 79
       id = 2
artist_id = 2
    title = Herzeleid
       id = 2
     name = Rammstein</code></pre>
<p>This example shows three tables and two <em>one-to-many</em>
relationships between the tables. It also shows how to use indexes and
uniqueness constraints to programmatically construct the tables and
their relationships.</p>
<p><a href="https://en.wikipedia.org/wiki/One-to-many_(data_model)"
class="uri">https://en.wikipedia.org/wiki/One-to-many_(data_model)</a></p>
<p>Up next we will look at the many-to-many relationships in data
models.</p>
<h2 id="many-to-many-relationships-in-databases">Many to many
relationships in databases</h2>
<p> Some data relationships cannot be modeled by a simple one-to-many
relationship. For example, lets say we are going to build a data model
for a course management system. There will be courses, users, and
rosters. A user can be on the roster for many courses and a course will
have many users on its roster.</p>
<figure>
<img src="../images/many-to-many.png" alt="A Many to Many Relationship\label{figm2m}" style="height: 1.5in;"/>
<figcaption>
A Many to Many Relationship
</figcaption>
</figure>
<p>It is pretty simple to <em>draw</em> a many-to-many relationship as
shown in Figure . We simply draw two tables and connect them with a line
that has the “many” indicator on both ends of the lines. The problem is
how to <em>implement</em> the raltionship using primary keys and foreign
keys.</p>
<p>Before we explore how we implement many-to-many relationships, lets
see if we could hack something up by extending a one-to many
relationship.</p>
<p>If SQL supported the notion of arrays, we might try to define
this:</p>
<pre class="sql"><code>CREATE TABLE Course (
    id     INTEGER PRIMARY KEY,
    title  TEXT UNIQUE
    student_ids ARRAY OF INTEGER;
);</code></pre>
<p>Sadly, while this is a tempting idea, SQL does not support arrays.<a
href="#fn3" class="footnote-ref" id="fnref3"
role="doc-noteref"><sup>3</sup></a></p>
<p>Or we could just make long string and concatenate all the
<code>User</code> primary keys into a long string separated by
commas.</p>
<pre class="sql"><code>CREATE TABLE Course (
    id     INTEGER PRIMARY KEY,
    title  TEXT UNIQUE
    student_ids ARRAY OF INTEGER;
);

INSERT INTO Course (title, student_ids)
VALUES( &#39;si311&#39;, &#39;1,3,4,5,6,9,14&#39;);</code></pre>
<p>This would be very inefficient because as the course roster grows in
size and the number of courses increases it becomes quite expensive to
figure out which courses have student 14 on their roster.</p>
<figure>
<img src="../images/many-to-many-verbose.png" alt="A Many to Many Connector Table\label{figm2mvrb}" style="height: 1.5in;"/>
<figcaption>
A Many to Many Connector Table
</figcaption>
</figure>
<p> Instead of either of these approaches, we model a many-to-many
relationship using an additional table that we call a “junction table”,
“through table”, “connector table”, or “join table” as shown in Figure .
The purpose of this table is to capture the <em>connection</em> between
<em>a</em> course and <em>a</em> student.</p>
<p>In a sense the table sits between the <code>Course</code> and
<code>User</code> table and has a one-to-many relationship to both
tables. By using an intermediate table we break a many-to-many
relationship into two one-to-many relationships. Databases are very good
at modeling and processing one-to-many relationships.</p>
<p>An example <code>Member</code> table would be as follows:</p>
<pre class="sql"><code>CREATE TABLE User (
    id     INTEGER PRIMARY KEY,
    name   TEXT UNIQUE
);

CREATE TABLE Course (
    id     INTEGER PRIMARY KEY,
    title  TEXT UNIQUE
);

CREATE TABLE Member (
    user_id     INTEGER,
    course_id   INTEGER,
    PRIMARY KEY (user_id, course_id)
);</code></pre>
<p>Following our naming convention, <code>Member.user_id</code> and
<code>Member.course_id</code> are foreign keys pointing at the
corresponding rows in the <code>User</code> and <code>Course</code>
tables. Each entry in the member table links a row in the
<code>User</code> table to a row in the <code>Course</code> table by
going <em>through</em> the <code>Member</code> table.</p>
<p> We indicate that the <em>combination</em> of <code>course_id</code>
and <code>user_id</code> is the <code>PRIMARY KEY</code> for the
<code>Member</code> table, also creating an uniqueness constraint for a
<code>course_id</code> / <code>user_id</code> combination.</p>
<p>Now lets say we need to insert a number of students into the rosters
of a number of courses. Lets assume the data comes to us in a
JSON-formatted file with records like this:</p>
<pre><code>[
  [ &quot;Charley&quot;, &quot;si110&quot;],
  [ &quot;Mea&quot;, &quot;si110&quot;],
  [ &quot;Hattie&quot;, &quot;si110&quot;],
  [ &quot;Keziah&quot;, &quot;si110&quot;],
  [ &quot;Rosa&quot;, &quot;si106&quot;],
  [ &quot;Mea&quot;, &quot;si106&quot;],
  [ &quot;Mairin&quot;, &quot;si106&quot;],
  [ &quot;Zendel&quot;, &quot;si106&quot;],
  [ &quot;Honie&quot;, &quot;si106&quot;],
  [ &quot;Rosa&quot;, &quot;si106&quot;],
...
]</code></pre>
<p> We could write code as follows to read the JSON file and insert the
members of each course roster into the database using the following
code:</p>
<pre class="python"><code>import json
import sqlite3

conn = sqlite3.connect(&#39;rosterdb.sqlite&#39;)
cur = conn.cursor()

str_data = open(&#39;roster_data_sample.json&#39;).read()
json_data = json.loads(str_data)

for entry in json_data:

    name = entry[0]
    title = entry[1]

    print((name, title))

    cur.execute(&#39;&#39;&#39;INSERT OR IGNORE INTO User (name)
        VALUES ( ? )&#39;&#39;&#39;, ( name, ) )
    cur.execute(&#39;SELECT id FROM User WHERE name = ? &#39;, (name, ))
    user_id = cur.fetchone()[0]

    cur.execute(&#39;&#39;&#39;INSERT OR IGNORE INTO Course (title)
        VALUES ( ? )&#39;&#39;&#39;, ( title, ) )
    cur.execute(&#39;SELECT id FROM Course WHERE title = ? &#39;, (title, ))
    course_id = cur.fetchone()[0]

    cur.execute(&#39;&#39;&#39;INSERT OR REPLACE INTO Member
        (user_id, course_id) VALUES ( ?, ? )&#39;&#39;&#39;,
        ( user_id, course_id ) )

    conn.commit()</code></pre>
<p>Like in a previous example, we first make sure that we have an entry
in the <code>User</code> table and know the primary key of the entry as
well as an entry in the <code>Course</code> table and know its primary
key. We use the ‘INSERT OR IGNORE’ and ‘SELECT’ patter so our code work
regardless of whether the record is in the table or not.</p>
<p>Our insert into the <code>Member</code> table is simply inserting the
two integers as a new or existing row depending on the constraint to
make sure we do not end up with duplicate entries in the
<code>Member</code> table for a particular <code>user_id</code> /
<code>course_id</code> combination.</p>
<p> To reconstruct our data across all three tables, we again use
<code>JOIN</code> / <code>ON</code> to construct a <code>SELECT</code>
query;</p>
<pre><code>sqlite&gt; SELECT * FROM Course
   ...&gt; JOIN Member ON Course.id = Member.course_id
   ...&gt; JOIN User ON Member.user_id = User.id;
+----+-------+---------+-----------+----+---------+
| id | title | user_id | course_id | id |  name   |
+----+-------+---------+-----------+----+---------+
| 1  | si110 | 1       | 1         | 1  | Charley |
| 1  | si110 | 2       | 1         | 2  | Mea     |
| 1  | si110 | 3       | 1         | 3  | Hattie  |
| 1  | si110 | 4       | 1         | 4  | Lyena   |
| 1  | si110 | 5       | 1         | 5  | Keziah  |
| 1  | si110 | 6       | 1         | 6  | Ellyce  |
| 1  | si110 | 7       | 1         | 7  | Thalia  |
| 1  | si110 | 8       | 1         | 8  | Meabh   |
| 2  | si106 | 2       | 2         | 2  | Mea     |
| 2  | si106 | 10      | 2         | 10 | Mairin  |
| 2  | si106 | 11      | 2         | 11 | Zendel  |
| 2  | si106 | 12      | 2         | 12 | Honie   |
| 2  | si106 | 9       | 2         | 9  | Rosa    |
+----+-------+---------+-----------+----+---------+
sqlite&gt;</code></pre>
<p>You can see the three tables from left to right -
<code>Course</code>, <code>Member</code>, and <code>User</code> and you
can see the connections between the primary keys and foreign keys in
each row of output.</p>
<h2 id="summary">Summary</h2>
<p>This chapter has covered a lot of ground to give you an overview of
the basics of using a database in Python. It is more complicated to
write the code to use a database to store data than Python dictionaries
or flat files so there is little reason to use a database unless your
application truly needs the capabilities of a database. The situations
where a database can be quite useful are: (1) when your application
needs to make many small random updates within a large data set, (2)
when your data is so large it cannot fit in a dictionary and you need to
look up information repeatedly, or (3) when you have a long-running
process that you want to be able to stop and restart and retain the data
from one run to the next.</p>
<p>You can build a simple database with a single table to suit many
application needs, but most problems will require several tables and
links/relationships between rows in different tables. When you start
making links between tables, it is important to do some thoughtful
design and follow the rules of database normalization to make the best
use of the database’s capabilities. Since the primary motivation for
using a database is that you have a large amount of data to deal with,
it is important to model your data efficiently so your programs run as
fast as possible.</p>
<h2 id="debugging">Debugging</h2>
<p>One common pattern when you are developing a Python program to
connect to an SQLite database will be to run a Python program and check
the results using the Database Browser for SQLite. The browser allows
you to quickly check to see if your program is working properly.</p>
<p>You must be careful because SQLite takes care to keep two programs
from changing the same data at the same time. For example, if you open a
database in the browser and make a change to the database and have not
yet pressed the “save” button in the browser, the browser “locks” the
database file and keeps any other program from accessing the file. In
particular, your Python program will not be able to access the file if
it is locked.</p>
<p>So a solution is to make sure to either close the database browser or
use the <em>File</em> menu to close the database in the browser before
you attempt to access the database from Python to avoid the problem of
your Python code failing because the database is locked.</p>
<h2 id="glossary">Glossary</h2>
<dl>
<dt>attribute</dt>
<dd>
One of the values within a tuple. More commonly called a “column” or
“field”.
</dd>
<dt>constraint</dt>
<dd>
When we tell the database to enforce a rule on a field or a row in a
table. A common constraint is to insist that there can be no duplicate
values in a particular field (i.e., all the values must be unique).
</dd>
<dt>cursor</dt>
<dd>
A cursor allows you to execute SQL commands in a database and retrieve
data from the database. A cursor is similar to a socket or file handle
for network connections and files, respectively.
</dd>
<dt>database browser</dt>
<dd>
A piece of software that allows you to directly connect to a database
and manipulate the database directly without writing a program.
</dd>
<dt>foreign key</dt>
<dd>
A numeric key that points to the primary key of a row in another table.
Foreign keys establish relationships between rows stored in different
tables.
</dd>
<dt>index</dt>
<dd>
Additional data that the database software maintains as rows and inserts
into a table to make lookups very fast.
</dd>
<dt>logical key</dt>
<dd>
A key that the “outside world” uses to look up a particular row. For
example in a table of user accounts, a person’s email address might be a
good candidate as the logical key for the user’s data.
</dd>
<dt>normalization</dt>
<dd>
Designing a data model so that no data is replicated. We store each item
of data at one place in the database and reference it elsewhere using a
foreign key.
</dd>
<dt>primary key</dt>
<dd>
A numeric key assigned to each row that is used to refer to one row in a
table from another table. Often the database is configured to
automatically assign primary keys as rows are inserted.
</dd>
<dt>relation</dt>
<dd>
An area within a database that contains tuples and attributes. More
typically called a “table”.
</dd>
<dt>tuple</dt>
<dd>
A single entry in a database table that is a set of attributes. More
typically called “row”.
</dd>
</dl>
<p></p>
<aside id="footnotes" class="footnotes footnotes-end-of-document"
role="doc-endnotes">
<hr />
<ol>
<li id="fn1"><p>SQLite actually does allow some flexibility in the type
of data stored in a column, but we will keep our data types strict in
this chapter so the concepts apply equally to other database systems
such as MySQL.<a href="#fnref1" class="footnote-back"
role="doc-backlink">↩︎</a></p></li>
<li id="fn2"><p>Yes there is a disconnect between “CRUD” term and the
first letters of the four SQL statements that implement “CRUD”. A
possible explanation might be to claim that “CRUD” is the “concept” and
SQL is the implementation. Another possible explanation is that “CRUD”
is more fun to say than “ISUD”.<a href="#fnref2" class="footnote-back"
role="doc-backlink">↩︎</a></p></li>
<li id="fn3"><p>Some SQL dialects support arrays but arrays do not scale
well. NoSQL databases use arrays and data replication but at a cost of
database integrity. NoSQL is a story for another course
https://www.pg4e.com/ <a href="#fnref3" class="footnote-back"
role="doc-backlink">↩︎</a></p></li>
</ol>
</aside>
</body>
</html>
<?php if ( file_exists("../bookfoot.php") ) {
  $HTML_FILE = basename(__FILE__);
  $HTML = ob_get_contents();
  ob_end_clean();
  require_once "../bookfoot.php";
}?>
