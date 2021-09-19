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
<h1 id="μεταβλητές-εκφράσεις-και-εντολές">Μεταβλητές, εκφράσεις και εντολές</h1>
<h2 id="τιμές-και-τύποι">Τιμές και τύποι</h2>
<p>   </p>
<p>Μια <em>τιμή</em>, όπως ένα γράμμα ή ένας αριθμός, είναι ένα από τα βασικά στοιχεία με τα οποία λειτουργεί ένα πρόγραμμα. Οι τιμές που έχουμε δει μέχρι τώρα είναι 1, 2 και “Γειά σου κόσμε!”</p>
<p>Αυτές οι τιμές ανήκουν σε διαφορετικούς <em>τύπους</em>: το 2 είναι ένας ακέραιος αριθμός και το “Γειά σου κόσμε!” είναι μια <em>συμβολοσειρά</em>, που ονομάζεται επειδή περιέχει μια “σειρά” συμβόλων και γραμμάτων. Μπορείτε (εσείς αλλά και ο διερμηνέας) να εντοπίσετε συμβολοσειρές επειδή περικλείονται σε εισαγωγικά.</p>
<p></p>
<p>Η εντολή <code>print</code> λειτουργεί και για ακέραιους αριθμούς. Χρησιμοποιούμε την εντολή <code>python</code> για να ξεκινήσουμε τον διερμηνέα.</p>
<pre class="python"><code>python
&gt;&gt;&gt; print(4)
4</code></pre>
<p>Εάν δεν είστε σίγουροι τι τύπου είναι μια τιμή, ο διερμηνέας μπορεί να σας πει.</p>
<pre class="python trinket" height="160"><code>&gt;&gt;&gt; type(&#39;Hello, World!&#39;)
&lt;class &#39;str&#39;&gt;
&gt;&gt;&gt; type(17)
&lt;class &#39;int&#39;&gt;</code></pre>
<p>Δεν αποτελεί έκπληξη το γεγονός ότι οι συμβολοσειρές ανήκουν στον τύπο <code>str</code> και οι ακέραιοι στον τύπο<code>int</code>. Λιγότερο προφανώς, οι αριθμοί με υποδιαστολή ανήκουν σε έναν τύπο που ονομάζεται <code>float</code>, επειδή αυτοί οι αριθμοί αντιπροσωπεύονται από μια μορφή που ονομάζεται <em>floating point</em>.</p>
<p>      </p>
<pre class="python trinket" height="120"><code>&gt;&gt;&gt; type(3.2)
&lt;class &#39;float&#39;&gt;</code></pre>
<p>Τι γίνεται με τις τιμές όπως το “17” και το “3.2”; Μοιάζουν με αριθμούς, αλλά περικλείονται με εισαγωγικά σαν συμβολοσειρές.</p>
<p></p>
<pre class="python trinket" height="160"><code>&gt;&gt;&gt; type(&#39;17&#39;)
&lt;class &#39;str&#39;&gt;
&gt;&gt;&gt; type(&#39;3.2&#39;)
&lt;class &#39;str&#39;&gt;</code></pre>
<p>Είναι συμβολοσειρές.</p>
<p>Όταν πληκτρολογείτε έναν μεγάλο ακέραιο, μπορεί να μπείτε στον πειρασμό να χρησιμοποιήσετε διαχωριστικά χιλιάδων, όπως στο 1.000.000. Αυτός δεν είναι ένας έγκυρος ακέραιος αριθμός στην Python, αποδεκτό είναι το:</p>
<pre class="python trinket" height="120"><code>&gt;&gt;&gt; print(1,000,000)
1 0 0</code></pre>
<p>Ε, αυτό δεν το περιμέναμε καθόλου! Η Python ερμηνεύει το 1,000,000 ως μια ακολουθία ακέραιων διαχωρισμένων με κόμμα, την οποία εκτυπώνει με κενά μεταξύ τους.</p>
<p>  </p>
<p>Αυτό είναι το πρώτο παράδειγμα που έχουμε δει για ένα σημασιολογικό σφάλμα: ο κώδικας τρέχει χωρίς να παράγει μήνυμα σφάλματος, αλλά δεν κάνει το “σωστό”.</p>
<h2 id="μεταβλητές">Μεταβλητές</h2>
<p>  </p>
<p>Ένα από τα πιο ισχυρά χαρακτηριστικά μιας γλώσσας προγραμματισμού είναι η δυνατότητα χειρισμού <em>μεταβλητών</em>. Μια μεταβλητή είναι ένα όνομα που αναφέρεται σε μια τιμή.</p>
<p>Μια <em>εντολή εκχώρησης</em> δημιουργεί νέες μεταβλητές και τους δίνει τιμές:</p>
<pre class="python"><code>&gt;&gt;&gt; message = &#39;Και τώρα κάτι εντελώς διαφορετικό&#39;
&gt;&gt;&gt; n = 17
&gt;&gt;&gt; pi = 3.1415926535897931</code></pre>
<p>Αυτό το παράδειγμα υλοποιεί τρεις αναθέσεις. Η πρώτη αναθέτει μια συμβολοσειρά σε μια νέα μεταβλητή με το όνομα <code>message</code>, η δεύτερη αναθέτει τον ακέραιο 17 στο <code>n</code> και η τρίτη αναθέτει την τιμή (κατά προσέγγιση) του <em>π</em> στο <code>pi</code>.</p>
<p>Για να εμφανίσετε την τιμή μιας μεταβλητής, μπορείτε να χρησιμοποιήσετε μια εντολή print:</p>
<pre class="python"><code>&gt;&gt;&gt; print(n)
17
&gt;&gt;&gt; print(pi)
3.141592653589793</code></pre>
<p>Ο τύπος μιας μεταβλητής είναι ο τύπος της τιμής στην οποία αναφέρεται.</p>
<pre class="python"><code>&gt;&gt;&gt; type(message)
&lt;class &#39;str&#39;&gt;
&gt;&gt;&gt; type(n)
&lt;class &#39;int&#39;&gt;
&gt;&gt;&gt; type(pi)
&lt;class &#39;float&#39;&gt;</code></pre>
<h2 id="ονόματα-μεταβλητών-και-δεσμευμένες-λέξεις">Ονόματα μεταβλητών και δεσμευμένες λέξεις</h2>
<p></p>
<p>Οι προγραμματιστές επιλέγουν, γενικά, ονόματα για τις μεταβλητές τους που έχουν νόημα και δηλώνουν τον λόγο για τον οποίο χρησιμοποιείται η μεταβλητή.</p>
<p>Τα ονόματα των μεταβλητών μπορεί να είναι αυθαίρετα μεγάλα. Μπορούν να περιέχουν γράμματα και αριθμούς, αλλά δεν μπορούν να ξεκινήσουν με αριθμό. Είναι αποδεκτό να χρησιμοποιείτε κεφαλαία γράμματα, αλλά είναι καλή ιδέα να αρχίζετε τα ονόματα μεταβλητών με πεζό γράμμα (θα δείτε το γιατί αργότερα).</p>
<p>Σε ένα όνομα μπορεί να χρησιμοποιηθεί και ο χαρακτήρας υπογράμμισης (_) ή κάτω παύλα. Συχνά χρησιμοποιείται σε ονόματα με πολλές λέξεις, όπως <code>my_name</code> ή <code>airspeed_of_unladen_swallow</code>. Τα ονόματα μεταβλητών μπορούν να ξεκινούν με χαρακτήρα υπογράμμισης, αλλά γενικά αποφεύγουμε να το κάνουμε αυτό, εκτός εάν γράφουμε κώδικα βιβλιοθήκης για χρήση από άλλους.</p>
<p> </p>
<p>Εάν δώσετε σε μια μεταβλητή ένα μη αποδεκτό όνομα, προκύπτει σφάλμα σύνταξης:</p>
<pre class="python trinket" height="450"><code>&gt;&gt;&gt; 76trombones = &#39;big parade&#39;
SyntaxError: invalid syntax
&gt;&gt;&gt; more@ = 1000000
SyntaxError: invalid syntax
&gt;&gt;&gt; class = &#39;Advanced Theoretical Zymurgy&#39;
SyntaxError: invalid syntax</code></pre>
<p>Το <code>76trombones</code> είναι μη αποδεκτό επειδή αρχίζει με αριθμό. Το <code>more@</code> είναι μη αποδεκτό επειδή περιέχει έναν μη αποδεκτό χαρακτήρα, @. Αλλά ποιο το πρόβλημα με το <code>class</code>;</p>
<p>Αποδεικνύεται ότι το <code>class</code> είναι μία από τις <em>δεσμευμένες λέξεις</em> της Python. Ο διερμηνέας χρησιμοποιεί δεσμευμένες λέξεις για να αναγνωρίσει τη δομή του προγράμματος και δεν μπορούν να χρησιμοποιηθούν ως ονόματα μεταβλητών.</p>
<p></p>
<p>Η Python διαθέτει 35 δεσμευμένες λέξεις:</p>
<pre><code>and       del       from      None      True
as        elif      global    nonlocal  try
assert    else      if        not       while
break     except    import    or        with
class     False     in        pass      yield
continue  finally   is        raise     async
def       for       lambda    return    await</code></pre>
<p>Ίσως θα ήταν χρήσιμο να κρατήσετε αυτήν τη λίστα εύκαιρη. Εάν ο διερμηνέας παραπονιέται για ένα από τα ονόματα μεταβλητών σας και δεν ξέρετε γιατί, ελέγξτε αν βρίσκεται σε αυτήν τη λίστα.</p>
<h2 id="εντολές">Εντολές</h2>
<p>Μια <em>εντολή</em> είναι μια μονάδα κώδικα που μπορεί να εκτελέσει ο διερμηνέας της Python. Έχουμε συναντήσει δύο είδη εντωλών: την εντολή print και την ανάθεση τιμής.</p>
<p>  </p>
<p>Όταν πληκτρολογείτε μια δήλωση σε διαδραστική λειτουργία, ο διερμηνέας την εκτελεί και εμφανίζει το αποτέλεσμα, εάν προκύπτει κάποιο.</p>
<p>Ένα σενάριο/script περιέχει συνήθως μια ακολουθία εντολών. Εάν υπάρχουν περισσότερες από μία εντολές, τα αποτελέσματα εμφανίζονται ένα κάθε φορά, καθώς εκτελούνται οι εντολές.</p>
<p>Για παράδειγμα, το script</p>
<pre class="python"><code>print(1)
x = 2
print(x)</code></pre>
<p>παράγει την έξοδο</p>
<pre><code>1
2</code></pre>
<p>Η εντολή εκχώρησης δεν παράγει έξοδο.</p>
<h2 id="τελεστές-και-τελεστέοι">Τελεστές και τελεστέοι</h2>
<p>   </p>
<p>Οι <em>τελεστές</em> είναι ειδικά σύμβολα που αναπαριστούν υπολογισμούς, όπως της πρόσθεσης και του πολλαπλασιασμού. Οι τιμές στις οποίες εφαρμόζεται ο τελεστής καλούνται <em>τελεστέοι</em>.</p>
<p>Οι τελεστές <code>+</code>, <code>-</code>, <code>*</code>, <code>/</code> και <code>**</code> εκτελούν πρόσθεση, αφαίρεση, πολλαπλασιασμό, διαίρεση και ύψωση σε δύναμη, όπως στα παρακάτω παραδείγματα:</p>
<pre class="python"><code>20+32
hour-1
hour*60+minute
minute/60
5**2
(5+9)*(15-7)</code></pre>
<p>Υπήρξε μια αλλαγή στον τελεστή της διαίρεσης, μεταξύ Python 2.x και Python 3.x. Στην Python 3.x, το αποτέλεσμα αυτής της διαίρεσης είναι float:</p>
<pre class="python trinket" height="160"><code>&gt;&gt;&gt; minute = 59
&gt;&gt;&gt; minute/60
0.9833333333333333</code></pre>
<p>Ο τελεστής διαίρεσης στην Python 2.0, όταν διαιρεί δύο ακέραιους αριθμούς περικόπτει το αποτέλεσμα σε ακέραιο:</p>
<pre class="python"><code>&gt;&gt;&gt; minute = 59
&gt;&gt;&gt; minute/60
0</code></pre>
<p>Για να λάβετε την ίδια απάντηση στην Python 3.0, χρησιμοποιήστε τη ευκλείδεια διαίρεση (<code>//</code> integer).</p>
<pre class="python trinket" height="160"><code>&gt;&gt;&gt; minute = 59
&gt;&gt;&gt; minute//60
0</code></pre>
<p>Στην Python 3.0, η ακέραιη διαίρεση λειτουργεί πολύ καλύτερα από ό,τι θα περιμένατε εάν εισαγάγατε την έκφραση σε μια αριθμομηχανή.</p>
<p>     </p>
<h2 id="εκφράσεις">Εκφράσεις</h2>
<p>Μια <em>έκφραση</em> είναι ένας συνδυασμός τιμών, μεταβλητών και τελεστών. Μια τιμή, από μόνη της, θεωρείται ως μία έκφραση και το ίδιο και μια μεταβλητή. Έτσι, τα παρακάτω είναι αποδεκτές μορφές εκφράσεων (υποθέτοντας ότι στη μεταβλητή <code>x</code> έχει εκχωρηθεί μία τιμή):</p>
<p> </p>
<pre class="python"><code>17
x
x + 17</code></pre>
<p>Εάν πληκτρολογήσετε μια έκφραση σε διαδραστική λειτουργία, ο διερμηνέας την <em>υπολογίζει</em> και εμφανίζει το αποτέλεσμα:</p>
<pre class="python"><code>&gt;&gt;&gt; 1 + 1
2</code></pre>
<p>But in a script, an expression all by itself doesn’t do anything! This is a common source of confusion for beginners.</p>
<p><strong>Exercise 1: Type the following statements in the Python interpreter to see what they do:</strong></p>
<pre class="python"><code>5
x = 5
x + 1</code></pre>
<h2 id="order-of-operations">Order of operations</h2>
<p>  </p>
<p>When more than one operator appears in an expression, the order of evaluation depends on the <em>rules of precedence</em>. For mathematical operators, Python follows mathematical convention. The acronym <em>PEMDAS</em> is a useful way to remember the rules:</p>
<p></p>
<ul>
<li><p><em>P</em>arentheses have the highest precedence and can be used to force an expression to evaluate in the order you want. Since expressions in parentheses are evaluated first, <code>2 *     (3-1)</code> is 4, and <code>(1+1)**(5-2)</code> is 8. You can also use parentheses to make an expression easier to read, as in <code>(minute * 100) / 60</code>, even if it doesn’t change the result.</p></li>
<li><p><em>E</em>xponentiation has the next highest precedence, so <code>2**1+1</code> is 3, not 4, and <code>3*1**3</code> is 3, not 27.</p></li>
<li><p><em>M</em>ultiplication and <em>D</em>ivision have the same precedence, which is higher than <em>A</em>ddition and <em>S</em>ubtraction, which also have the same precedence. So <code>2*3-1</code> is 5, not 4, and <code>6+4/2</code> is 8, not 5.</p></li>
<li><p>Operators with the same precedence are evaluated from left to right. So the expression <code>5-3-1</code> is 1, not 3, because the <code>5-3</code> happens first and then <code>1</code> is subtracted from 2.</p></li>
</ul>
<p>When in doubt, always put parentheses in your expressions to make sure the computations are performed in the order you intend.</p>
<h2 id="modulus-operator">Modulus operator</h2>
<p> </p>
<p>The <em>modulus operator</em> works on integers and yields the remainder when the first operand is divided by the second. In Python, the modulus operator is a percent sign (<code>%</code>). The syntax is the same as for other operators:</p>
<pre class="python trinket" height="240"><code>&gt;&gt;&gt; quotient = 7 // 3
&gt;&gt;&gt; print(quotient)
2
&gt;&gt;&gt; remainder = 7 % 3
&gt;&gt;&gt; print(remainder)
1</code></pre>
<p>So 7 divided by 3 is 2 with 1 left over.</p>
<p>The modulus operator turns out to be surprisingly useful. For example, you can check whether one number is divisible by another: if <code>x % y</code> is zero, then <code>x</code> is divisible by <code>y</code>.</p>
<p></p>
<p>You can also extract the right-most digit or digits from a number. For example, <code>x % 10</code> yields the right-most digit of <code>x</code> (in base 10). Similarly, <code>x % 100</code> yields the last two digits.</p>
<h2 id="string-operations">String operations</h2>
<p> </p>
<p>The <code>+</code> operator works with strings, but it is not addition in the mathematical sense. Instead it performs <em>concatenation</em>, which means joining the strings by linking them end to end. For example:</p>
<p></p>
<pre class="python"><code>&gt;&gt;&gt; first = 10
&gt;&gt;&gt; second = 15
&gt;&gt;&gt; print(first+second)
25
&gt;&gt;&gt; first = &#39;100&#39;
&gt;&gt;&gt; second = &#39;150&#39;
&gt;&gt;&gt; print(first + second)
100150</code></pre>
<p>The <code>*</code> operator also works with strings by multiplying the content of a string by an integer. For example:</p>
<pre class="python"><code>&gt;&gt;&gt; first = &#39;Test &#39;
&gt;&gt;&gt; second = 3
&gt;&gt;&gt; print(first * second)
Test Test Test</code></pre>
<h2 id="asking-the-user-for-input">Asking the user for input</h2>
<p></p>
<p>Sometimes we would like to take the value for a variable from the user via their keyboard. Python provides a built-in function called <code>input</code> that gets input from the keyboard<a href="#fn1" class="footnote-ref" id="fnref1" role="doc-noteref"><sup>1</sup></a>. When this function is called, the program stops and waits for the user to type something. When the user presses <code>Return</code> or <code>Enter</code>, the program resumes and <code>input</code> returns what the user typed as a string.</p>
<p></p>
<pre class="python"><code>&gt;&gt;&gt; inp = input()
Some silly stuff
&gt;&gt;&gt; print(inp)
Some silly stuff</code></pre>
<p>Before getting input from the user, it is a good idea to print a prompt telling the user what to input. You can pass a string to <code>input</code> to be displayed to the user before pausing for input:</p>
<p></p>
<pre class="python"><code>&gt;&gt;&gt; name = input(&#39;What is your name?\n&#39;)
What is your name?
Chuck
&gt;&gt;&gt; print(name)
Chuck</code></pre>
<p>The sequence <code>\n</code> at the end of the prompt represents a <em>newline</em>, which is a special character that causes a line break. That’s why the user’s input appears below the prompt.</p>
<p></p>
<p>If you expect the user to type an integer, you can try to convert the return value to <code>int</code> using the <code>int()</code> function:</p>
<pre class="python"><code>&gt;&gt;&gt; prompt = &#39;What...is the airspeed velocity of an unladen swallow?\n&#39;
&gt;&gt;&gt; speed = input(prompt)
What...is the airspeed velocity of an unladen swallow?
17
&gt;&gt;&gt; int(speed)
17
&gt;&gt;&gt; int(speed) + 5
22</code></pre>
<p>But if the user types something other than a string of digits, you get an error:</p>
<pre class="python"><code>&gt;&gt;&gt; speed = input(prompt)
What...is the airspeed velocity of an unladen swallow?
What do you mean, an African or a European swallow?
&gt;&gt;&gt; int(speed)
ValueError: invalid literal for int() with base 10:</code></pre>
<p>We will see how to handle this kind of error later.</p>
<p> </p>
<h2 id="comments">Comments</h2>
<p></p>
<p>As programs get bigger and more complicated, they get more difficult to read. Formal languages are dense, and it is often difficult to look at a piece of code and figure out what it is doing, or why.</p>
<p>For this reason, it is a good idea to add notes to your programs to explain in natural language what the program is doing. These notes are called <em>comments</em>, and in Python they start with the <code>#</code> symbol:</p>
<pre class="python"><code># compute the percentage of the hour that has elapsed
percentage = (minute * 100) / 60</code></pre>
<p>In this case, the comment appears on a line by itself. You can also put comments at the end of a line:</p>
<pre class="python"><code>percentage = (minute * 100) / 60     # percentage of an hour</code></pre>
<p>Everything from the <code>#</code> to the end of the line is ignored; it has no effect on the program.</p>
<p>Comments are most useful when they document non-obvious features of the code. It is reasonable to assume that the reader can figure out <em>what</em> the code does; it is much more useful to explain <em>why</em>.</p>
<p>This comment is redundant with the code and useless:</p>
<pre class="python"><code>v = 5     # assign 5 to v</code></pre>
<p>This comment contains useful information that is not in the code:</p>
<pre class="python"><code>v = 5     # velocity in meters/second.</code></pre>
<p>Good variable names can reduce the need for comments, but long names can make complex expressions hard to read, so there is a trade-off.</p>
<h2 id="choosing-mnemonic-variable-names">Choosing mnemonic variable names</h2>
<p></p>
<p>As long as you follow the simple rules of variable naming, and avoid reserved words, you have a lot of choice when you name your variables. In the beginning, this choice can be confusing both when you read a program and when you write your own programs. For example, the following three programs are identical in terms of what they accomplish, but very different when you read them and try to understand them.</p>
<pre class="python"><code>a = 35.0
b = 12.50
c = a * b
print(c)</code></pre>
<pre class="python"><code>hours = 35.0
rate = 12.50
pay = hours * rate
print(pay)</code></pre>
<pre class="python"><code>x1q3z9ahd = 35.0
x1q3z9afd = 12.50
x1q3p9afd = x1q3z9ahd * x1q3z9afd
print(x1q3p9afd)</code></pre>
<p>The Python interpreter sees all three of these programs as <em>exactly the same</em> but humans see and understand these programs quite differently. Humans will most quickly understand the <em>intent</em> of the second program because the programmer has chosen variable names that reflect their intent regarding what data will be stored in each variable.</p>
<p>We call these wisely chosen variable names “mnemonic variable names”. The word <em>mnemonic</em><a href="#fn2" class="footnote-ref" id="fnref2" role="doc-noteref"><sup>2</sup></a> means “memory aid”. We choose mnemonic variable names to help us remember why we created the variable in the first place.</p>
<p>While this all sounds great, and it is a very good idea to use mnemonic variable names, mnemonic variable names can get in the way of a beginning programmer’s ability to parse and understand code. This is because beginning programmers have not yet memorized the reserved words (there are only 33 of them) and sometimes variables with names that are too descriptive start to look like part of the language and not just well-chosen variable names.</p>
<p>Take a quick look at the following Python sample code which loops through some data. We will cover loops soon, but for now try to just puzzle through what this means:</p>
<pre class="python"><code>for word in words:
    print(word)</code></pre>
<p>What is happening here? Which of the tokens (for, word, in, etc.) are reserved words and which are just variable names? Does Python understand at a fundamental level the notion of words? Beginning programmers have trouble separating what parts of the code <em>must</em> be the same as this example and what parts of the code are simply choices made by the programmer.</p>
<p>The following code is equivalent to the above code:</p>
<pre class="python"><code>for slice in pizza:
    print(slice)</code></pre>
<p>It is easier for the beginning programmer to look at this code and know which parts are reserved words defined by Python and which parts are simply variable names chosen by the programmer. It is pretty clear that Python has no fundamental understanding of pizza and slices and the fact that a pizza consists of a set of one or more slices.</p>
<p>But if our program is truly about reading data and looking for words in the data, <code>pizza</code> and <code>slice</code> are very un-mnemonic variable names. Choosing them as variable names distracts from the meaning of the program.</p>
<p>After a pretty short period of time, you will know the most common reserved words and you will start to see the reserved words jumping out at you:</p>
<pre>
<b>for</b> word <b>in</b> words<b>:</b>
    <b>print</b>(word)
</pre>
<p>The parts of the code that are defined by Python (<code>for</code>, <code>in</code>, <code>print</code>, and <code>:</code>) are in bold and the programmer-chosen variables (<code>word</code> and <code>words</code>) are not in bold. Many text editors are aware of Python syntax and will color reserved words differently to give you clues to keep your variables and reserved words separate. After a while you will begin to read Python and quickly determine what is a variable and what is a reserved word.</p>
<h2 id="debugging">Debugging</h2>
<p></p>
<p>At this point, the syntax error you are most likely to make is an illegal variable name, like <code>class</code> and <code>yield</code>, which are keywords, or <code>odd~job</code> and <code>US$</code>, which contain illegal characters.</p>
<p> </p>
<p>If you put a space in a variable name, Python thinks it is two operands without an operator:</p>
<pre class="python"><code>&gt;&gt;&gt; bad name = 5
SyntaxError: invalid syntax</code></pre>
<pre class="python"><code>&gt;&gt;&gt; month = 09
  File &quot;&lt;stdin&gt;&quot;, line 1
    month = 09
             ^
SyntaxError: invalid token</code></pre>
<p>For syntax errors, the error messages don’t help much. The most common messages are <code>SyntaxError: invalid syntax</code> and <code>SyntaxError: invalid token</code>, neither of which is very informative.</p>
<p>    </p>
<p>The runtime error you are most likely to make is a “use before def;” that is, trying to use a variable before you have assigned a value. This can happen if you spell a variable name wrong:</p>
<pre class="python"><code>&gt;&gt;&gt; principal = 327.68
&gt;&gt;&gt; interest = principle * rate
NameError: name &#39;principle&#39; is not defined</code></pre>
<p>Variables names are case sensitive, so <code>LaTeX</code> is not the same as <code>latex</code>.</p>
<p>  </p>
<p>At this point, the most likely cause of a semantic error is the order of operations. For example, to evaluate <span class="math inline">1/2<em>π</em></span>, you might be tempted to write</p>
<pre class="python"><code>&gt;&gt;&gt; 1.0 / 2.0 * pi</code></pre>
<p>But the division happens first, so you would get <span class="math inline"><em>π</em>/2</span>, which is not the same thing! There is no way for Python to know what you meant to write, so in this case you don’t get an error message; you just get the wrong answer.</p>
<p></p>
<h2 id="glossary">Glossary</h2>
<dl>
<dt>assignment</dt>
<dd>A statement that assigns a value to a variable.
</dd>
<dt>concatenate</dt>
<dd>To join two operands end to end.
</dd>
<dt>comment</dt>
<dd>Information in a program that is meant for other programmers (or anyone reading the source code) and has no effect on the execution of the program.
</dd>
<dt>evaluate</dt>
<dd>To simplify an expression by performing the operations in order to yield a single value.
</dd>
<dt>expression</dt>
<dd>A combination of variables, operators, and values that represents a single result value.
</dd>
<dt>floating point</dt>
<dd>A type that represents numbers with fractional parts.
</dd>
<dt>integer</dt>
<dd>A type that represents whole numbers.
</dd>
<dt>keyword</dt>
<dd>A reserved word that is used by the compiler to parse a program; you cannot use keywords like <code>if</code>, <code>def</code>, and <code>while</code> as variable names.
</dd>
<dt>mnemonic</dt>
<dd>A memory aid. We often give variables mnemonic names to help us remember what is stored in the variable.
</dd>
<dt>modulus operator</dt>
<dd>An operator, denoted with a percent sign (<code>%</code>), that works on integers and yields the remainder when one number is divided by another.
</dd>
<dt>operand</dt>
<dd>One of the values on which an operator operates.
</dd>
<dt>operator</dt>
<dd>A special symbol that represents a simple computation like addition, multiplication, or string concatenation.
</dd>
<dt>rules of precedence</dt>
<dd>The set of rules governing the order in which expressions involving multiple operators and operands are evaluated.
</dd>
<dt>statement</dt>
<dd>A section of code that represents a command or action. So far, the statements we have seen are assignments and print expression statement.
</dd>
<dt>string</dt>
<dd>A type that represents sequences of characters.
</dd>
<dt>type</dt>
<dd>A category of values. The types we have seen so far are integers (type <code>int</code>), floating-point numbers (type <code>float</code>), and strings (type <code>str</code>).
</dd>
<dt>value</dt>
<dd>One of the basic units of data, like a number or string, that a program manipulates.
</dd>
<dt>variable</dt>
<dd>A name that refers to a value.
</dd>
</dl>
<h2 id="exercises">Exercises</h2>
<p><strong>Exercise 2: Write a program that uses <code>input</code> to prompt a user for their name and then welcomes them.</strong></p>
<pre><code>Enter your name: Chuck
Hello Chuck</code></pre>
<p><strong>Exercise 3: Write a program to prompt the user for hours and rate per hour to compute gross pay.</strong></p>
<pre><code>Enter Hours: 35
Enter Rate: 2.75
Pay: 96.25</code></pre>
<p>We won’t worry about making sure our pay has exactly two digits after the decimal place for now. If you want, you can play with the built-in Python <code>round</code> function to properly round the resulting pay to two decimal places.</p>
<p><strong>Exercise 4: Assume that we execute the following assignment statements:</strong></p>
<pre><code>width = 17
height = 12.0</code></pre>
<p>For each of the following expressions, write the value of the expression and the type (of the value of the expression).</p>
<ol type="1">
<li><p><code>width//2</code></p></li>
<li><p><code>width/2.0</code></p></li>
<li><p><code>height/3</code></p></li>
<li><p><code>1 + 2 * 5</code></p></li>
</ol>
<p>Use the Python interpreter to check your answers.</p>
<p><strong>Exercise 5: Write a program which prompts the user for a Celsius temperature, convert the temperature to Fahrenheit, and print out the converted temperature.</strong></p>
<section class="footnotes" role="doc-endnotes">
<hr />
<ol>
<li id="fn1" role="doc-endnote"><p>In Python 2.0, this function was named <code>raw_input</code>.<a href="#fnref1" class="footnote-back" role="doc-backlink">↩︎</a></p></li>
<li id="fn2" role="doc-endnote"><p>See <a href="https://en.wikipedia.org/wiki/Mnemonic" class="uri">https://en.wikipedia.org/wiki/Mnemonic</a> for an extended description of the word “mnemonic”.<a href="#fnref2" class="footnote-back" role="doc-backlink">↩︎</a></p></li>
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
