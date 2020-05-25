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
<h1 id="using-databases-and-sql">Using Databases and SQL</h1>
<h2 id="what-is-a-database">What is a database?</h2>
<p></p>
<p>A <em>database</em> is a file that is organized for storing data. Most databases are organized like a dictionary in the sense that they map from keys to values. The biggest difference is that the database is on disk (or other permanent storage), so it persists after the program ends. Because a database is stored on permanent storage, it can store far more data than a dictionary, which is limited to the size of the memory in the computer.</p>
<p></p>
<p>Like a dictionary, database software is designed to keep the inserting and accessing of data very fast, even for large amounts of data. Database software maintains its performance by building <em>indexes</em> as data is added to the database to allow the computer to jump quickly to a particular entry.</p>
<p>There are many different database systems which are used for a wide variety of purposes including: Oracle, MySQL, Microsoft SQL Server, PostgreSQL, and SQLite. We focus on SQLite in this book because it is a very common database and is already built into Python. SQLite is designed to be <em>embedded</em> into other applications to provide database support within the application. For example, the Firefox browser also uses the SQLite database internally as do many other products.</p>
<p><a href="http://sqlite.org/" class="uri">http://sqlite.org/</a></p>
<p>SQLite is well suited to some of the data manipulation problems that we see in Informatics such as the Twitter spidering application that we describe in this chapter.</p>
<h2 id="database-concepts">Database concepts</h2>
<p>When you first look at a database it looks like a spreadsheet with multiple sheets. The primary data structures in a database are: <em>tables</em>, <em>rows</em>, and <em>columns</em>.</p>
<figure>
<img src="../images/relational.svg" alt="" /><figcaption>Relational Databases</figcaption>
</figure>
<p>In technical descriptions of relational databases the concepts of table, row, and column are more formally referred to as <em>relation</em>, <em>tuple</em>, and <em>attribute</em>, respectively. We will use the less formal terms in this chapter.</p>
<h2 id="database-browser-for-sqlite">Database Browser for SQLite</h2>
<p>While this chapter will focus on using Python to work with data in SQLite database files, many operations can be done more conveniently using software called the <em>Database Browser for SQLite</em> which is freely available from:</p>
<p><a href="http://sqlitebrowser.org/" class="uri">http://sqlitebrowser.org/</a></p>
<p>Using the browser you can easily create tables, insert data, edit data, or run simple SQL queries on the data in the database.</p>
<p>In a sense, the database browser is similar to a text editor when working with text files. When you want to do one or very few operations on a text file, you can just open it in a text editor and make the changes you want. When you have many changes that you need to do to a text file, often you will write a simple Python program. You will find the same pattern when working with databases. You will do simple operations in the database manager and more complex operations will be most conveniently done in Python.</p>
<h2 id="creating-a-database-table">Creating a database table</h2>
<p>Databases require more defined structure than Python lists or dictionaries<a href="#fn1" class="footnote-ref" id="fnref1" role="doc-noteref"><sup>1</sup></a>.</p>
<p>When we create a database <em>table</em> we must tell the database in advance the names of each of the <em>columns</em> in the table and the type of data which we are planning to store in each <em>column</em>. When the database software knows the type of data in each column, it can choose the most efficient way to store and look up the data based on the type of data.</p>
<p>You can look at the various data types supported by SQLite at the following url:</p>
<p><a href="http://www.sqlite.org/datatypes.html" class="uri">http://www.sqlite.org/datatypes.html</a></p>
<p>Defining structure for your data up front may seem inconvenient at the beginning, but the payoff is fast access to your data even when the database contains a large amount of data.</p>
<p>The code to create a database file and a table named <code>Tracks</code> with two columns in the database is as follows:</p>
<p> </p>
<pre class="python"><code>import sqlite3

conn = sqlite3.connect(&#39;music.sqlite&#39;)
cur = conn.cursor()

cur.execute(&#39;DROP TABLE IF EXISTS Tracks&#39;)
cur.execute(&#39;CREATE TABLE Tracks (title TEXT, plays INTEGER)&#39;)

conn.close()

# Code: http://www.py4e.com/code3/db1.py</code></pre>
<p>   </p>
<p>The <code>connect</code> operation makes a “connection” to the database stored in the file <code>music.sqlite</code> in the current directory. If the file does not exist, it will be created. The reason this is called a “connection” is that sometimes the database is stored on a separate “database server” from the server on which we are running our application. In our simple examples the database will just be a local file in the same directory as the Python code we are running.</p>
<p>A <em>cursor</em> is like a file handle that we can use to perform operations on the data stored in the database. Calling <code>cursor()</code> is very similar conceptually to calling <code>open()</code> when dealing with text files.</p>
<figure>
<img src="../images/cursor.svg" alt="" /><figcaption>A Database Cursor</figcaption>
</figure>
<p>Once we have the cursor, we can begin to execute commands on the contents of the database using the <code>execute()</code> method.</p>
<p>Database commands are expressed in a special language that has been standardized across many different database vendors to allow us to learn a single database language. The database language is called <em>Structured Query Language</em> or <em>SQL</em> for short.</p>
<p><a href="http://en.wikipedia.org/wiki/SQL" class="uri">http://en.wikipedia.org/wiki/SQL</a></p>
<p>In our example, we are executing two SQL commands in our database. As a convention, we will show the SQL keywords in uppercase and the parts of the command that we are adding (such as the table and column names) will be shown in lowercase.</p>
<p>The first SQL command removes the <code>Tracks</code> table from the database if it exists. This pattern is simply to allow us to run the same program to create the <code>Tracks</code> table over and over again without causing an error. Note that the <code>DROP TABLE</code> command deletes the table and all of its contents from the database (i.e., there is no “undo”).</p>
<pre class="python"><code>cur.execute(&#39;DROP TABLE IF EXISTS Tracks &#39;)</code></pre>
<p>The second command creates a table named <code>Tracks</code> with a text column named <code>title</code> and an integer column named <code>plays</code>.</p>
<pre class="python"><code>cur.execute(&#39;CREATE TABLE Tracks (title TEXT, plays INTEGER)&#39;)</code></pre>
<p>Now that we have created a table named <code>Tracks</code>, we can put some data into that table using the SQL <code>INSERT</code> operation. Again, we begin by making a connection to the database and obtaining the <code>cursor</code>. We can then execute SQL commands using the cursor.</p>
<p>The SQL <code>INSERT</code> command indicates which table we are using and then defines a new row by listing the fields we want to include <code>(title, plays)</code> followed by the <code>VALUES</code> we want placed in the new row. We specify the values as question marks <code>(?, ?)</code> to indicate that the actual values are passed in as a tuple <code>( 'My Way', 15 )</code> as the second parameter to the <code>execute()</code> call.</p>
<pre class="python"><code>import sqlite3

conn = sqlite3.connect(&#39;music.sqlite&#39;)
cur = conn.cursor()

cur.execute(&#39;INSERT INTO Tracks (title, plays) VALUES (?, ?)&#39;,
    (&#39;Thunderstruck&#39;, 20))
cur.execute(&#39;INSERT INTO Tracks (title, plays) VALUES (?, ?)&#39;,
    (&#39;My Way&#39;, 15))
conn.commit()

print(&#39;Tracks:&#39;)
cur.execute(&#39;SELECT title, plays FROM Tracks&#39;)
for row in cur:
     print(row)

cur.execute(&#39;DELETE FROM Tracks WHERE plays &lt; 100&#39;)
conn.commit()

cur.close()

# Code: http://www.py4e.com/code3/db2.py</code></pre>
<p>First we <code>INSERT</code> two rows into our table and use <code>commit()</code> to force the data to be written to the database file.</p>
<figure>
<img src="../images/tracks.svg" alt="" /><figcaption>Rows in a Table</figcaption>
</figure>
<p>Then we use the <code>SELECT</code> command to retrieve the rows we just inserted from the table. On the <code>SELECT</code> command, we indicate which columns we would like <code>(title, plays)</code> and indicate which table we want to retrieve the data from. After we execute the <code>SELECT</code> statement, the cursor is something we can loop through in a <code>for</code> statement. For efficiency, the cursor does not read all of the data from the database when we execute the <code>SELECT</code> statement. Instead, the data is read on demand as we loop through the rows in the <code>for</code> statement.</p>
<p>The output of the program is as follows:</p>
<pre><code>Tracks:
(&#39;Thunderstruck&#39;, 20)
(&#39;My Way&#39;, 15)</code></pre>
<p></p>
<p>Our <code>for</code> loop finds two rows, and each row is a Python tuple with the first value as the <code>title</code> and the second value as the number of <code>plays</code>.</p>
<p><em>Note: You may see strings starting with <code>u'</code> in other books or on the Internet. This was an indication in Python 2 that the strings are </em>Unicode* strings that are capable of storing non-Latin character sets. In Python 3, all strings are unicode strings by default.*</p>
<p>At the very end of the program, we execute an SQL command to <code>DELETE</code> the rows we have just created so we can run the program over and over. The <code>DELETE</code> command shows the use of a <code>WHERE</code> clause that allows us to express a selection criterion so that we can ask the database to apply the command to only the rows that match the criterion. In this example the criterion happens to apply to all the rows so we empty the table out so we can run the program repeatedly. After the <code>DELETE</code> is performed, we also call <code>commit()</code> to force the data to be removed from the database.</p>
<h2 id="structured-query-language-summary">Structured Query Language summary</h2>
<p>So far, we have been using the Structured Query Language in our Python examples and have covered many of the basics of the SQL commands. In this section, we look at the SQL language in particular and give an overview of SQL syntax.</p>
<p>Since there are so many different database vendors, the Structured Query Language (SQL) was standardized so we could communicate in a portable manner to database systems from multiple vendors.</p>
<p>A relational database is made up of tables, rows, and columns. The columns generally have a type such as text, numeric, or date data. When we create a table, we indicate the names and types of the columns:</p>
<pre class="sql"><code>CREATE TABLE Tracks (title TEXT, plays INTEGER)</code></pre>
<p>To insert a row into a table, we use the SQL <code>INSERT</code> command:</p>
<pre class="sql"><code>INSERT INTO Tracks (title, plays) VALUES (&#39;My Way&#39;, 15)</code></pre>
<p>The <code>INSERT</code> statement specifies the table name, then a list of the fields/columns that you would like to set in the new row, and then the keyword <code>VALUES</code> and a list of corresponding values for each of the fields.</p>
<p>The SQL <code>SELECT</code> command is used to retrieve rows and columns from a database. The <code>SELECT</code> statement lets you specify which columns you would like to retrieve as well as a <code>WHERE</code> clause to select which rows you would like to see. It also allows an optional <code>ORDER BY</code> clause to control the sorting of the returned rows.</p>
<pre class="sql"><code>SELECT * FROM Tracks WHERE title = &#39;My Way&#39;</code></pre>
<p>Using <code>*</code> indicates that you want the database to return all of the columns for each row that matches the <code>WHERE</code> clause.</p>
<p>Note, unlike in Python, in a SQL <code>WHERE</code> clause we use a single equal sign to indicate a test for equality rather than a double equal sign. Other logical operations allowed in a <code>WHERE</code> clause include <code>&lt;</code>, <code>&gt;</code>, <code>&lt;=</code>, <code>&gt;=</code>, <code>!=</code>, as well as <code>AND</code> and <code>OR</code> and parentheses to build your logical expressions.</p>
<p>You can request that the returned rows be sorted by one of the fields as follows:</p>
<pre class="sql"><code>SELECT title,plays FROM Tracks ORDER BY title</code></pre>
<p>To remove a row, you need a <code>WHERE</code> clause on an SQL <code>DELETE</code> statement. The <code>WHERE</code> clause determines which rows are to be deleted:</p>
<pre class="sql"><code>DELETE FROM Tracks WHERE title = &#39;My Way&#39;</code></pre>
<p>It is possible to <code>UPDATE</code> a column or columns within one or more rows in a table using the SQL <code>UPDATE</code> statement as follows:</p>
<pre class="sql"><code>UPDATE Tracks SET plays = 16 WHERE title = &#39;My Way&#39;</code></pre>
<p>The <code>UPDATE</code> statement specifies a table and then a list of fields and values to change after the <code>SET</code> keyword and then an optional <code>WHERE</code> clause to select the rows that are to be updated. A single <code>UPDATE</code> statement will change all of the rows that match the <code>WHERE</code> clause. If a <code>WHERE</code> clause is not specified, it performs the <code>UPDATE</code> on all of the rows in the table.</p>
<p>These four basic SQL commands (INSERT, SELECT, UPDATE, and DELETE) allow the four basic operations needed to create and maintain data.</p>
<h2 id="spidering-twitter-using-a-database">Spidering Twitter using a database</h2>
<p>In this section, we will create a simple spidering program that will go through Twitter accounts and build a database of them. <em>Note: Be very careful when running this program. You do not want to pull too much data or run the program for too long and end up having your Twitter access shut off.</em></p>
<p>One of the problems of any kind of spidering program is that it needs to be able to be stopped and restarted many times and you do not want to lose the data that you have retrieved so far. You don’t want to always restart your data retrieval at the very beginning so we want to store data as we retrieve it so our program can start back up and pick up where it left off.</p>
<p>We will start by retrieving one person’s Twitter friends and their statuses, looping through the list of friends, and adding each of the friends to a database to be retrieved in the future. After we process one person’s Twitter friends, we check in our database and retrieve one of the friends of the friend. We do this over and over, picking an “unvisited” person, retrieving their friend list, and adding friends we have not seen to our list for a future visit.</p>
<p>We also track how many times we have seen a particular friend in the database to get some sense of their “popularity”.</p>
<p>By storing our list of known accounts and whether we have retrieved the account or not, and how popular the account is in a database on the disk of the computer, we can stop and restart our program as many times as we like.</p>
<p>This program is a bit complex. It is based on the code from the exercise earlier in the book that uses the Twitter API.</p>
<p>Here is the source code for our Twitter spidering application:</p>
<pre class="python"><code>from urllib.request import urlopen
import urllib.error
import twurl
import json
import sqlite3
import ssl

TWITTER_URL = &#39;https://api.twitter.com/1.1/friends/list.json&#39;

conn = sqlite3.connect(&#39;spider.sqlite&#39;)
cur = conn.cursor()

cur.execute(&#39;&#39;&#39;
            CREATE TABLE IF NOT EXISTS Twitter
            (name TEXT, retrieved INTEGER, friends INTEGER)&#39;&#39;&#39;)

# Ignore SSL certificate errors
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

while True:
    acct = input(&#39;Enter a Twitter account, or quit: &#39;)
    if (acct == &#39;quit&#39;): break
    if (len(acct) &lt; 1):
        cur.execute(&#39;SELECT name FROM Twitter WHERE retrieved = 0 LIMIT 1&#39;)
        try:
            acct = cur.fetchone()[0]
        except:
            print(&#39;No unretrieved Twitter accounts found&#39;)
            continue

    url = twurl.augment(TWITTER_URL, {&#39;screen_name&#39;: acct, &#39;count&#39;: &#39;20&#39;})
    print(&#39;Retrieving&#39;, url)
    connection = urlopen(url, context=ctx)
    data = connection.read().decode()
    headers = dict(connection.getheaders())

    print(&#39;Remaining&#39;, headers[&#39;x-rate-limit-remaining&#39;])
    js = json.loads(data)
    # Debugging
    # print json.dumps(js, indent=4)

    cur.execute(&#39;UPDATE Twitter SET retrieved=1 WHERE name = ?&#39;, (acct, ))

    countnew = 0
    countold = 0
    for u in js[&#39;users&#39;]:
        friend = u[&#39;screen_name&#39;]
        print(friend)
        cur.execute(&#39;SELECT friends FROM Twitter WHERE name = ? LIMIT 1&#39;,
                    (friend, ))
        try:
            count = cur.fetchone()[0]
            cur.execute(&#39;UPDATE Twitter SET friends = ? WHERE name = ?&#39;,
                        (count+1, friend))
            countold = countold + 1
        except:
            cur.execute(&#39;&#39;&#39;INSERT INTO Twitter (name, retrieved, friends)
                        VALUES (?, 0, 1)&#39;&#39;&#39;, (friend, ))
            countnew = countnew + 1
    print(&#39;New accounts=&#39;, countnew, &#39; revisited=&#39;, countold)
    conn.commit()

cur.close()

# Code: http://www.py4e.com/code3/twspider.py</code></pre>
<p>Our database is stored in the file <code>spider.sqlite</code> and it has one table named <code>Twitter</code>. Each row in the <code>Twitter</code> table has a column for the account name, whether we have retrieved the friends of this account, and how many times this account has been “friended”.</p>
<p>In the main loop of the program, we prompt the user for a Twitter account name or “quit” to exit the program. If the user enters a Twitter account, we retrieve the list of friends and statuses for that user and add each friend to the database if not already in the database. If the friend is already in the list, we add 1 to the <code>friends</code> field in the row in the database.</p>
<p>If the user presses enter, we look in the database for the next Twitter account that we have not yet retrieved, retrieve the friends and statuses for that account, add them to the database or update them, and increase their <code>friends</code> count.</p>
<p>Once we retrieve the list of friends and statuses, we loop through all of the <code>user</code> items in the returned JSON and retrieve the <code>screen_name</code> for each user. Then we use the <code>SELECT</code> statement to see if we already have stored this particular <code>screen_name</code> in the database and retrieve the friend count (<code>friends</code>) if the record exists.</p>
<pre class="python"><code>countnew = 0
countold = 0
for u in js[&#39;users&#39;] :
    friend = u[&#39;screen_name&#39;]
    print(friend)
    cur.execute(&#39;SELECT friends FROM Twitter WHERE name = ? LIMIT 1&#39;,
        (friend, ) )
    try:
        count = cur.fetchone()[0]
        cur.execute(&#39;UPDATE Twitter SET friends = ? WHERE name = ?&#39;,
            (count+1, friend) )
        countold = countold + 1
    except:
        cur.execute(&#39;&#39;&#39;INSERT INTO Twitter (name, retrieved, friends)
            VALUES ( ?, 0, 1 )&#39;&#39;&#39;, ( friend, ) )
        countnew = countnew + 1
print(&#39;New accounts=&#39;,countnew,&#39; revisited=&#39;,countold)
conn.commit()</code></pre>
<p>Once the cursor executes the <code>SELECT</code> statement, we must retrieve the rows. We could do this with a <code>for</code> statement, but since we are only retrieving one row (<code>LIMIT 1</code>), we can use the <code>fetchone()</code> method to fetch the first (and only) row that is the result of the <code>SELECT</code> operation. Since <code>fetchone()</code> returns the row as a <em>tuple</em> (even though there is only one field), we take the first value from the tuple using to get the current friend count into the variable <code>count</code>.</p>
<p>If this retrieval is successful, we use the SQL <code>UPDATE</code> statement with a <code>WHERE</code> clause to add 1 to the <code>friends</code> column for the row that matches the friend’s account. Notice that there are two placeholders (i.e., question marks) in the SQL, and the second parameter to the <code>execute()</code> is a two-element tuple that holds the values to be substituted into the SQL in place of the question marks.</p>
<p>If the code in the <code>try</code> block fails, it is probably because no record matched the <code>WHERE name = ?</code> clause on the SELECT statement. So in the <code>except</code> block, we use the SQL <code>INSERT</code> statement to add the friend’s <code>screen_name</code> to the table with an indication that we have not yet retrieved the <code>screen_name</code> and set the friend count to one.</p>
<p>So the first time the program runs and we enter a Twitter account, the program runs as follows:</p>
<pre><code>Enter a Twitter account, or quit: drchuck
Retrieving http://api.twitter.com/1.1/friends ...
New accounts= 20  revisited= 0
Enter a Twitter account, or quit: quit</code></pre>
<p>Since this is the first time we have run the program, the database is empty and we create the database in the file <code>spider.sqlite</code> and add a table named <code>Twitter</code> to the database. Then we retrieve some friends and add them all to the database since the database is empty.</p>
<p>At this point, we might want to write a simple database dumper to take a look at what is in our <code>spider.sqlite</code> file:</p>
<pre class="python"><code>import sqlite3

conn = sqlite3.connect(&#39;spider.sqlite&#39;)
cur = conn.cursor()
cur.execute(&#39;SELECT * FROM Twitter&#39;)
count = 0
for row in cur:
    print(row)
    count = count + 1
print(count, &#39;rows.&#39;)
cur.close()

# Code: http://www.py4e.com/code3/twdump.py</code></pre>
<p>This program simply opens the database and selects all of the columns of all of the rows in the table <code>Twitter</code>, then loops through the rows and prints out each row.</p>
<p>If we run this program after the first execution of our Twitter spider above, its output will be as follows:</p>
<pre><code>(&#39;opencontent&#39;, 0, 1)
(&#39;lhawthorn&#39;, 0, 1)
(&#39;steve_coppin&#39;, 0, 1)
(&#39;davidkocher&#39;, 0, 1)
(&#39;hrheingold&#39;, 0, 1)
...
20 rows.</code></pre>
<p>We see one row for each <code>screen_name</code>, that we have not retrieved the data for that <code>screen_name</code>, and everyone in the database has one friend.</p>
<p>Now our database reflects the retrieval of the friends of our first Twitter account (<em>drchuck</em>). We can run the program again and tell it to retrieve the friends of the next “unprocessed” account by simply pressing enter instead of a Twitter account as follows:</p>
<pre><code>Enter a Twitter account, or quit:
Retrieving http://api.twitter.com/1.1/friends ...
New accounts= 18  revisited= 2
Enter a Twitter account, or quit:
Retrieving http://api.twitter.com/1.1/friends ...
New accounts= 17  revisited= 3
Enter a Twitter account, or quit: quit</code></pre>
<p>Since we pressed enter (i.e., we did not specify a Twitter account), the following code is executed:</p>
<pre class="python"><code>if ( len(acct) &lt; 1 ) :
    cur.execute(&#39;SELECT name FROM Twitter WHERE retrieved = 0 LIMIT 1&#39;)
    try:
        acct = cur.fetchone()[0]
    except:
        print(&#39;No unretrieved twitter accounts found&#39;)
        continue</code></pre>
<p>We use the SQL <code>SELECT</code> statement to retrieve the name of the first (<code>LIMIT 1</code>) user who still has their “have we retrieved this user” value set to zero. We also use the <code>fetchone()[0]</code> pattern within a try/except block to either extract a <code>screen_name</code> from the retrieved data or put out an error message and loop back up.</p>
<p>If we successfully retrieved an unprocessed <code>screen_name</code>, we retrieve their data as follows:</p>
<pre class="python"><code>url=twurl.augment(TWITTER_URL,{&#39;screen_name&#39;: acct,&#39;count&#39;: &#39;20&#39;})
print(&#39;Retrieving&#39;, url)
connection = urllib.urlopen(url)
data = connection.read()
js = json.loads(data)

cur.execute(&#39;UPDATE Twitter SET retrieved=1 WHERE name = ?&#39;,(acct, ))</code></pre>
<p>Once we retrieve the data successfully, we use the <code>UPDATE</code> statement to set the <code>retrieved</code> column to 1 to indicate that we have completed the retrieval of the friends of this account. This keeps us from retrieving the same data over and over and keeps us progressing forward through the network of Twitter friends.</p>
<p>If we run the friend program and press enter twice to retrieve the next unvisited friend’s friends, then run the dumping program, it will give us the following output:</p>
<pre><code>(&#39;opencontent&#39;, 1, 1)
(&#39;lhawthorn&#39;, 1, 1)
(&#39;steve_coppin&#39;, 0, 1)
(&#39;davidkocher&#39;, 0, 1)
(&#39;hrheingold&#39;, 0, 1)
...
(&#39;cnxorg&#39;, 0, 2)
(&#39;knoop&#39;, 0, 1)
(&#39;kthanos&#39;, 0, 2)
(&#39;LectureTools&#39;, 0, 1)
...
55 rows.</code></pre>
<p>We can see that we have properly recorded that we have visited <code>lhawthorn</code> and <code>opencontent</code>. Also the accounts <code>cnxorg</code> and <code>kthanos</code> already have two followers. Since we now have retrieved the friends of three people (<code>drchuck</code>, <code>opencontent</code>, and <code>lhawthorn</code>) our table has 55 rows of friends to retrieve.</p>
<p>Each time we run the program and press enter it will pick the next unvisited account (e.g., the next account will be <code>steve_coppin</code>), retrieve their friends, mark them as retrieved, and for each of the friends of <code>steve_coppin</code> either add them to the end of the database or update their friend count if they are already in the database.</p>
<p>Since the program’s data is all stored on disk in a database, the spidering activity can be suspended and resumed as many times as you like with no loss of data.</p>
<h2 id="basic-data-modeling">Basic data modeling</h2>
<p>The real power of a relational database is when we create multiple tables and make links between those tables. The act of deciding how to break up your application data into multiple tables and establishing the relationships between the tables is called <em>data modeling</em>. The design document that shows the tables and their relationships is called a <em>data model</em>.</p>
<p>Data modeling is a relatively sophisticated skill and we will only introduce the most basic concepts of relational data modeling in this section. For more detail on data modeling you can start with:</p>
<p><a href="http://en.wikipedia.org/wiki/Relational_model" class="uri">http://en.wikipedia.org/wiki/Relational_model</a></p>
<p>Let’s say for our Twitter spider application, instead of just counting a person’s friends, we wanted to keep a list of all of the incoming relationships so we could find a list of everyone who is following a particular account.</p>
<p>Since everyone will potentially have many accounts that follow them, we cannot simply add a single column to our <code>Twitter</code> table. So we create a new table that keeps track of pairs of friends. The following is a simple way of making such a table:</p>
<pre class="sql"><code>CREATE TABLE Pals (from_friend TEXT, to_friend TEXT)</code></pre>
<p>Each time we encounter a person who <code>drchuck</code> is following, we would insert a row of the form:</p>
<pre class="sql"><code>INSERT INTO Pals (from_friend,to_friend) VALUES (&#39;drchuck&#39;, &#39;lhawthorn&#39;)</code></pre>
<p>As we are processing the 20 friends from the <code>drchuck</code> Twitter feed, we will insert 20 records with “drchuck” as the first parameter so we will end up duplicating the string many times in the database.</p>
<p>This duplication of string data violates one of the best practices for <em>database normalization</em> which basically states that we should never put the same string data in the database more than once. If we need the data more than once, we create a numeric <em>key</em> for the data and reference the actual data using this key.</p>
<p>In practical terms, a string takes up a lot more space than an integer on the disk and in the memory of our computer, and takes more processor time to compare and sort. If we only have a few hundred entries, the storage and processor time hardly matters. But if we have a million people in our database and a possibility of 100 million friend links, it is important to be able to scan data as quickly as possible.</p>
<p>We will store our Twitter accounts in a table named <code>People</code> instead of the <code>Twitter</code> table used in the previous example. The <code>People</code> table has an additional column to store the numeric key associated with the row for this Twitter user. SQLite has a feature that automatically adds the key value for any row we insert into a table using a special type of data column (<code>INTEGER PRIMARY KEY</code>).</p>
<p>We can create the <code>People</code> table with this additional <code>id</code> column as follows:</p>
<pre class="sql"><code>CREATE TABLE People
    (id INTEGER PRIMARY KEY, name TEXT UNIQUE, retrieved INTEGER)</code></pre>
<p>Notice that we are no longer maintaining a friend count in each row of the <code>People</code> table. When we select <code>INTEGER PRIMARY KEY</code> as the type of our <code>id</code> column, we are indicating that we would like SQLite to manage this column and assign a unique numeric key to each row we insert automatically. We also add the keyword <code>UNIQUE</code> to indicate that we will not allow SQLite to insert two rows with the same value for <code>name</code>.</p>
<p>Now instead of creating the table <code>Pals</code> above, we create a table called <code>Follows</code> with two integer columns <code>from_id</code> and <code>to_id</code> and a constraint on the table that the <em>combination</em> of <code>from_id</code> and <code>to_id</code> must be unique in this table (i.e., we cannot insert duplicate rows) in our database.</p>
<pre class="sql"><code>CREATE TABLE Follows
    (from_id INTEGER, to_id INTEGER, UNIQUE(from_id, to_id) )</code></pre>
<p>When we add <code>UNIQUE</code> clauses to our tables, we are communicating a set of rules that we are asking the database to enforce when we attempt to insert records. We are creating these rules as a convenience in our programs, as we will see in a moment. The rules both keep us from making mistakes and make it simpler to write some of our code.</p>
<p>In essence, in creating this <code>Follows</code> table, we are modelling a “relationship” where one person “follows” someone else and representing it with a pair of numbers indicating that (a) the people are connected and (b) the direction of the relationship.</p>
<figure>
<img src="figs2/twitter.svg" alt="" /><figcaption>Relationships Between Tables</figcaption>
</figure>
<h2 id="programming-with-multiple-tables">Programming with multiple tables</h2>
<p>We will now redo the Twitter spider program using two tables, the primary keys, and the key references as described above. Here is the code for the new version of the program:</p>
<pre class="python"><code>import urllib.request, urllib.parse, urllib.error
import twurl
import json
import sqlite3
import ssl

TWITTER_URL = &#39;https://api.twitter.com/1.1/friends/list.json&#39;

conn = sqlite3.connect(&#39;friends.sqlite&#39;)
cur = conn.cursor()

cur.execute(&#39;&#39;&#39;CREATE TABLE IF NOT EXISTS People
            (id INTEGER PRIMARY KEY, name TEXT UNIQUE, retrieved INTEGER)&#39;&#39;&#39;)
cur.execute(&#39;&#39;&#39;CREATE TABLE IF NOT EXISTS Follows
            (from_id INTEGER, to_id INTEGER, UNIQUE(from_id, to_id))&#39;&#39;&#39;)

# Ignore SSL certificate errors
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

while True:
    acct = input(&#39;Enter a Twitter account, or quit: &#39;)
    if (acct == &#39;quit&#39;): break
    if (len(acct) &lt; 1):
        cur.execute(&#39;SELECT id, name FROM People WHERE retrieved=0 LIMIT 1&#39;)
        try:
            (id, acct) = cur.fetchone()
        except:
            print(&#39;No unretrieved Twitter accounts found&#39;)
            continue
    else:
        cur.execute(&#39;SELECT id FROM People WHERE name = ? LIMIT 1&#39;,
                    (acct, ))
        try:
            id = cur.fetchone()[0]
        except:
            cur.execute(&#39;&#39;&#39;INSERT OR IGNORE INTO People
                        (name, retrieved) VALUES (?, 0)&#39;&#39;&#39;, (acct, ))
            conn.commit()
            if cur.rowcount != 1:
                print(&#39;Error inserting account:&#39;, acct)
                continue
            id = cur.lastrowid

    url = twurl.augment(TWITTER_URL, {&#39;screen_name&#39;: acct, &#39;count&#39;: &#39;100&#39;})
    print(&#39;Retrieving account&#39;, acct)
    try:
        connection = urllib.request.urlopen(url, context=ctx)
    except Exception as err:
        print(&#39;Failed to Retrieve&#39;, err)
        break

    data = connection.read().decode()
    headers = dict(connection.getheaders())

    print(&#39;Remaining&#39;, headers[&#39;x-rate-limit-remaining&#39;])

    try:
        js = json.loads(data)
    except:
        print(&#39;Unable to parse json&#39;)
        print(data)
        break

    # Debugging
    # print(json.dumps(js, indent=4))

    if &#39;users&#39; not in js:
        print(&#39;Incorrect JSON received&#39;)
        print(json.dumps(js, indent=4))
        continue

    cur.execute(&#39;UPDATE People SET retrieved=1 WHERE name = ?&#39;, (acct, ))

    countnew = 0
    countold = 0
    for u in js[&#39;users&#39;]:
        friend = u[&#39;screen_name&#39;]
        print(friend)
        cur.execute(&#39;SELECT id FROM People WHERE name = ? LIMIT 1&#39;,
                    (friend, ))
        try:
            friend_id = cur.fetchone()[0]
            countold = countold + 1
        except:
            cur.execute(&#39;&#39;&#39;INSERT OR IGNORE INTO People (name, retrieved)
                        VALUES (?, 0)&#39;&#39;&#39;, (friend, ))
            conn.commit()
            if cur.rowcount != 1:
                print(&#39;Error inserting account:&#39;, friend)
                continue
            friend_id = cur.lastrowid
            countnew = countnew + 1
        cur.execute(&#39;&#39;&#39;INSERT OR IGNORE INTO Follows (from_id, to_id)
                    VALUES (?, ?)&#39;&#39;&#39;, (id, friend_id))
    print(&#39;New accounts=&#39;, countnew, &#39; revisited=&#39;, countold)
    print(&#39;Remaining&#39;, headers[&#39;x-rate-limit-remaining&#39;])
    conn.commit()
cur.close()

# Code: http://www.py4e.com/code3/twfriends.py</code></pre>
<p>This program is starting to get a bit complicated, but it illustrates the patterns that we need to use when we are using integer keys to link tables. The basic patterns are:</p>
<ol type="1">
<li><p>Create tables with primary keys and constraints.</p></li>
<li><p>When we have a logical key for a person (i.e., account name) and we need the <code>id</code> value for the person, depending on whether or not the person is already in the <code>People</code> table we either need to: (1) look up the person in the <code>People</code> table and retrieve the <code>id</code> value for the person or (2) add the person to the <code>People</code> table and get the <code>id</code> value for the newly added row.</p></li>
<li><p>Insert the row that captures the “follows” relationship.</p></li>
</ol>
<p>We will cover each of these in turn.</p>
<h3 id="constraints-in-database-tables">Constraints in database tables</h3>
<p>As we design our table structures, we can tell the database system that we would like it to enforce a few rules on us. These rules help us from making mistakes and introducing incorrect data into out tables. When we create our tables:</p>
<pre class="python"><code>cur.execute(&#39;&#39;&#39;CREATE TABLE IF NOT EXISTS People
    (id INTEGER PRIMARY KEY, name TEXT UNIQUE, retrieved INTEGER)&#39;&#39;&#39;)
cur.execute(&#39;&#39;&#39;CREATE TABLE IF NOT EXISTS Follows
    (from_id INTEGER, to_id INTEGER, UNIQUE(from_id, to_id))&#39;&#39;&#39;)</code></pre>
<p>We indicate that the <code>name</code> column in the <code>People</code> table must be <code>UNIQUE</code>. We also indicate that the combination of the two numbers in each row of the <code>Follows</code> table must be unique. These constraints keep us from making mistakes such as adding the same relationship more than once.</p>
<p>We can take advantage of these constraints in the following code:</p>
<pre class="python"><code>cur.execute(&#39;&#39;&#39;INSERT OR IGNORE INTO People (name, retrieved)
    VALUES ( ?, 0)&#39;&#39;&#39;, ( friend, ) )</code></pre>
<p>We add the <code>OR IGNORE</code> clause to our <code>INSERT</code> statement to indicate that if this particular <code>INSERT</code> would cause a violation of the “<code>name</code> must be unique” rule, the database system is allowed to ignore the <code>INSERT</code>. We are using the database constraint as a safety net to make sure we don’t inadvertently do something incorrect.</p>
<p>Similarly, the following code ensures that we don’t add the exact same <code>Follows</code> relationship twice.</p>
<pre class="python"><code>cur.execute(&#39;&#39;&#39;INSERT OR IGNORE INTO Follows
    (from_id, to_id) VALUES (?, ?)&#39;&#39;&#39;, (id, friend_id) )</code></pre>
<p>Again, we simply tell the database to ignore our attempted <code>INSERT</code> if it would violate the uniqueness constraint that we specified for the <code>Follows</code> rows.</p>
<h3 id="retrieve-andor-insert-a-record">Retrieve and/or insert a record</h3>
<p>When we prompt the user for a Twitter account, if the account exists, we must look up its <code>id</code> value. If the account does not yet exist in the <code>People</code> table, we must insert the record and get the <code>id</code> value from the inserted row.</p>
<p>This is a very common pattern and is done twice in the program above. This code shows how we look up the <code>id</code> for a friend’s account when we have extracted a <code>screen_name</code> from a <code>user</code> node in the retrieved Twitter JSON.</p>
<p>Since over time it will be increasingly likely that the account will already be in the database, we first check to see if the <code>People</code> record exists using a <code>SELECT</code> statement.</p>
<p>If all goes well<a href="#fn2" class="footnote-ref" id="fnref2" role="doc-noteref"><sup>2</sup></a> inside the <code>try</code> section, we retrieve the record using <code>fetchone()</code> and then retrieve the first (and only) element of the returned tuple and store it in <code>friend_id</code>.</p>
<p>If the <code>SELECT</code> fails, the <code>fetchone()[0]</code> code will fail and control will transfer into the <code>except</code> section.</p>
<pre class="python"><code>    friend = u[&#39;screen_name&#39;]
    cur.execute(&#39;SELECT id FROM People WHERE name = ? LIMIT 1&#39;,
        (friend, ) )
    try:
        friend_id = cur.fetchone()[0]
        countold = countold + 1
    except:
        cur.execute(&#39;&#39;&#39;INSERT OR IGNORE INTO People (name, retrieved)
            VALUES ( ?, 0)&#39;&#39;&#39;, ( friend, ) )
        conn.commit()
        if cur.rowcount != 1 :
            print(&#39;Error inserting account:&#39;,friend)
            continue
        friend_id = cur.lastrowid
        countnew = countnew + 1</code></pre>
<p>If we end up in the <code>except</code> code, it simply means that the row was not found, so we must insert the row. We use <code>INSERT OR IGNORE</code> just to avoid errors and then call <code>commit()</code> to force the database to really be updated. After the write is done, we can check the <code>cur.rowcount</code> to see how many rows were affected. Since we are attempting to insert a single row, if the number of affected rows is something other than 1, it is an error.</p>
<p>If the <code>INSERT</code> is successful, we can look at <code>cur.lastrowid</code> to find out what value the database assigned to the <code>id</code> column in our newly created row.</p>
<h3 id="storing-the-friend-relationship">Storing the friend relationship</h3>
<p>Once we know the key value for both the Twitter user and the friend in the JSON, it is a simple matter to insert the two numbers into the <code>Follows</code> table with the following code:</p>
<pre class="python"><code>cur.execute(&#39;INSERT OR IGNORE INTO Follows (from_id, to_id) VALUES (?, ?)&#39;,
    (id, friend_id) )</code></pre>
<p>Notice that we let the database take care of keeping us from “double-inserting” a relationship by creating the table with a uniqueness constraint and then adding <code>OR IGNORE</code> to our <code>INSERT</code> statement.</p>
<p>Here is a sample execution of this program:</p>
<pre><code>Enter a Twitter account, or quit:
No unretrieved Twitter accounts found
Enter a Twitter account, or quit: drchuck
Retrieving http://api.twitter.com/1.1/friends ...
New accounts= 20  revisited= 0
Enter a Twitter account, or quit:
Retrieving http://api.twitter.com/1.1/friends ...
New accounts= 17  revisited= 3
Enter a Twitter account, or quit:
Retrieving http://api.twitter.com/1.1/friends ...
New accounts= 17  revisited= 3
Enter a Twitter account, or quit: quit</code></pre>
<p>We started with the <code>drchuck</code> account and then let the program automatically pick the next two accounts to retrieve and add to our database.</p>
<p>The following is the first few rows in the <code>People</code> and <code>Follows</code> tables after this run is completed:</p>
<pre><code>People:
(1, &#39;drchuck&#39;, 1)
(2, &#39;opencontent&#39;, 1)
(3, &#39;lhawthorn&#39;, 1)
(4, &#39;steve_coppin&#39;, 0)
(5, &#39;davidkocher&#39;, 0)
55 rows.
Follows:
(1, 2)
(1, 3)
(1, 4)
(1, 5)
(1, 6)
60 rows.</code></pre>
<p>You can see the <code>id</code>, <code>name</code>, and <code>visited</code> fields in the <code>People</code> table and you see the numbers of both ends of the relationship in the <code>Follows</code> table. In the <code>People</code> table, we can see that the first three people have been visited and their data has been retrieved. The data in the <code>Follows</code> table indicates that <code>drchuck</code> (user 1) is a friend to all of the people shown in the first five rows. This makes sense because the first data we retrieved and stored was the Twitter friends of <code>drchuck</code>. If you were to print more rows from the <code>Follows</code> table, you would see the friends of users 2 and 3 as well.</p>
<h2 id="three-kinds-of-keys">Three kinds of keys</h2>
<p>Now that we have started building a data model putting our data into multiple linked tables and linking the rows in those tables using <em>keys</em>, we need to look at some terminology around keys. There are generally three kinds of keys used in a database model.</p>
<ul>
<li><p>A <em>logical key</em> is a key that the “real world” might use to look up a row. In our example data model, the <code>name</code> field is a logical key. It is the screen name for the user and we indeed look up a user’s row several times in the program using the <code>name</code> field. You will often find that it makes sense to add a <code>UNIQUE</code> constraint to a logical key. Since the logical key is how we look up a row from the outside world, it makes little sense to allow multiple rows with the same value in the table.</p></li>
<li><p>A <em>primary key</em> is usually a number that is assigned automatically by the database. It generally has no meaning outside the program and is only used to link rows from different tables together. When we want to look up a row in a table, usually searching for the row using the primary key is the fastest way to find the row. Since primary keys are integer numbers, they take up very little storage and can be compared or sorted very quickly. In our data model, the <code>id</code> field is an example of a primary key.</p></li>
<li><p>A <em>foreign key</em> is usually a number that points to the primary key of an associated row in a different table. An example of a foreign key in our data model is the <code>from_id</code>.</p></li>
</ul>
<p>We are using a naming convention of always calling the primary key field name <code>id</code> and appending the suffix <code>_id</code> to any field name that is a foreign key.</p>
<h2 id="using-join-to-retrieve-data">Using JOIN to retrieve data</h2>
<p>Now that we have followed the rules of database normalization and have data separated into two tables, linked together using primary and foreign keys, we need to be able to build a <code>SELECT</code> that reassembles the data across the tables.</p>
<p>SQL uses the <code>JOIN</code> clause to reconnect these tables. In the <code>JOIN</code> clause you specify the fields that are used to reconnect the rows between the tables.</p>
<p>The following is an example of a <code>SELECT</code> with a <code>JOIN</code> clause:</p>
<pre class="sql"><code>SELECT * FROM Follows JOIN People
    ON Follows.from_id = People.id WHERE People.id = 1</code></pre>
<p>The <code>JOIN</code> clause indicates that the fields we are selecting cross both the <code>Follows</code> and <code>People</code> tables. The <code>ON</code> clause indicates how the two tables are to be joined: Take the rows from <code>Follows</code> and append the row from <code>People</code> where the field <code>from_id</code> in <code>Follows</code> is the same the <code>id</code> value in the <code>People</code> table.</p>
<figure>
<img src="figs2/join.svg" alt="" /><figcaption>Connecting Tables Using JOIN</figcaption>
</figure>
<p>The result of the JOIN is to create extra-long “metarows” which have both the fields from <code>People</code> and the matching fields from <code>Follows</code>. Where there is more than one match between the <code>id</code> field from <code>People</code> and the <code>from_id</code> from <code>People</code>, then JOIN creates a metarow for <em>each</em> of the matching pairs of rows, duplicating data as needed.</p>
<p>The following code demonstrates the data that we will have in the database after the multi-table Twitter spider program (above) has been run several times.</p>
<pre class="python"><code>import sqlite3

conn = sqlite3.connect(&#39;friends.sqlite&#39;)
cur = conn.cursor()

cur.execute(&#39;SELECT * FROM People&#39;)
count = 0
print(&#39;People:&#39;)
for row in cur:
    if count &lt; 5: print(row)
    count = count + 1
print(count, &#39;rows.&#39;)

cur.execute(&#39;SELECT * FROM Follows&#39;)
count = 0
print(&#39;Follows:&#39;)
for row in cur:
    if count &lt; 5: print(row)
    count = count + 1
print(count, &#39;rows.&#39;)

cur.execute(&#39;&#39;&#39;SELECT * FROM Follows JOIN People
            ON Follows.to_id = People.id
            WHERE Follows.from_id = 2&#39;&#39;&#39;)
count = 0
print(&#39;Connections for id=2:&#39;)
for row in cur:
    if count &lt; 5: print(row)
    count = count + 1
print(count, &#39;rows.&#39;)

cur.close()

# Code: http://www.py4e.com/code3/twjoin.py</code></pre>
<p>In this program, we first dump out the <code>People</code> and <code>Follows</code> and then dump out a subset of the data in the tables joined together.</p>
<p>Here is the output of the program:</p>
<pre><code>python twjoin.py
People:
(1, &#39;drchuck&#39;, 1)
(2, &#39;opencontent&#39;, 1)
(3, &#39;lhawthorn&#39;, 1)
(4, &#39;steve_coppin&#39;, 0)
(5, &#39;davidkocher&#39;, 0)
55 rows.
Follows:
(1, 2)
(1, 3)
(1, 4)
(1, 5)
(1, 6)
60 rows.
Connections for id=2:
(2, 1, 1, &#39;drchuck&#39;, 1)
(2, 28, 28, &#39;cnxorg&#39;, 0)
(2, 30, 30, &#39;kthanos&#39;, 0)
(2, 102, 102, &#39;SomethingGirl&#39;, 0)
(2, 103, 103, &#39;ja_Pac&#39;, 0)
20 rows.</code></pre>
<p>You see the columns from the <code>People</code> and <code>Follows</code> tables and the last set of rows is the result of the <code>SELECT</code> with the <code>JOIN</code> clause.</p>
<p>In the last select, we are looking for accounts that are friends of “opencontent” (i.e., <code>People.id=2</code>).</p>
<p>In each of the “metarows” in the last select, the first two columns are from the <code>Follows</code> table followed by columns three through five from the <code>People</code> table. You can also see that the second column (<code>Follows.to_id</code>) matches the third column (<code>People.id</code>) in each of the joined-up “metarows”.</p>
<h2 id="summary">Summary</h2>
<p>This chapter has covered a lot of ground to give you an overview of the basics of using a database in Python. It is more complicated to write the code to use a database to store data than Python dictionaries or flat files so there is little reason to use a database unless your application truly needs the capabilities of a database. The situations where a database can be quite useful are: (1) when your application needs to make small many random updates within a large data set, (2) when your data is so large it cannot fit in a dictionary and you need to look up information repeatedly, or (3) when you have a long-running process that you want to be able to stop and restart and retain the data from one run to the next.</p>
<p>You can build a simple database with a single table to suit many application needs, but most problems will require several tables and links/relationships between rows in different tables. When you start making links between tables, it is important to do some thoughtful design and follow the rules of database normalization to make the best use of the database’s capabilities. Since the primary motivation for using a database is that you have a large amount of data to deal with, it is important to model your data efficiently so your programs run as fast as possible.</p>
<h2 id="debugging">Debugging</h2>
<p>One common pattern when you are developing a Python program to connect to an SQLite database will be to run a Python program and check the results using the Database Browser for SQLite. The browser allows you to quickly check to see if your program is working properly.</p>
<p>You must be careful because SQLite takes care to keep two programs from changing the same data at the same time. For example, if you open a database in the browser and make a change to the database and have not yet pressed the “save” button in the browser, the browser “locks” the database file and keeps any other program from accessing the file. In particular, your Python program will not be able to access the file if it is locked.</p>
<p>So a solution is to make sure to either close the database browser or use the <em>File</em> menu to close the database in the browser before you attempt to access the database from Python to avoid the problem of your Python code failing because the database is locked.</p>
<h2 id="glossary">Glossary</h2>
<dl>
<dt>attribute</dt>
<dd>One of the values within a tuple. More commonly called a “column” or “field”.
</dd>
<dt>constraint</dt>
<dd>When we tell the database to enforce a rule on a field or a row in a table. A common constraint is to insist that there can be no duplicate values in a particular field (i.e., all the values must be unique).
</dd>
<dt>cursor</dt>
<dd>A cursor allows you to execute SQL commands in a database and retrieve data from the database. A cursor is similar to a socket or file handle for network connections and files, respectively.
</dd>
<dt>database browser</dt>
<dd>A piece of software that allows you to directly connect to a database and manipulate the database directly without writing a program.
</dd>
<dt>foreign key</dt>
<dd>A numeric key that points to the primary key of a row in another table. Foreign keys establish relationships between rows stored in different tables.
</dd>
<dt>index</dt>
<dd>Additional data that the database software maintains as rows and inserts into a table to make lookups very fast.
</dd>
<dt>logical key</dt>
<dd>A key that the “outside world” uses to look up a particular row. For example in a table of user accounts, a person’s email address might be a good candidate as the logical key for the user’s data.
</dd>
<dt>normalization</dt>
<dd>Designing a data model so that no data is replicated. We store each item of data at one place in the database and reference it elsewhere using a foreign key.
</dd>
<dt>primary key</dt>
<dd>A numeric key assigned to each row that is used to refer to one row in a table from another table. Often the database is configured to automatically assign primary keys as rows are inserted.
</dd>
<dt>relation</dt>
<dd>An area within a database that contains tuples and attributes. More typically called a “table”.
</dd>
<dt>tuple</dt>
<dd>A single entry in a database table that is a set of attributes. More typically called “row”.
</dd>
</dl>
<p></p>
<section class="footnotes" role="doc-endnotes">
<hr />
<ol>
<li id="fn1" role="doc-endnote"><p>SQLite actually does allow some flexibility in the type of data stored in a column, but we will keep our data types strict in this chapter so the concepts apply equally to other database systems such as MySQL.<a href="#fnref1" class="footnote-back" role="doc-backlink">↩︎</a></p></li>
<li id="fn2" role="doc-endnote"><p>In general, when a sentence starts with “if all goes well” you will find that the code needs to use try/except.<a href="#fnref2" class="footnote-back" role="doc-backlink">↩︎</a></p></li>
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
