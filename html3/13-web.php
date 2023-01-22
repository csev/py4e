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
  <title>Untitled</title>
  <style type="text/css">
      code{white-space: pre-wrap;}
      span.smallcaps{font-variant: small-caps;}
      span.underline{text-decoration: underline;}
      div.column{display: inline-block; vertical-align: top; width: 50%;}
  </style>
</head>
<body>
<h1 id="χρήση-υπηρεσιών-ιστού">Χρήση Υπηρεσιών Ιστού</h1>
<p>Από τη στιγμή που έγινε εύκολη η ανάκτηση και η ανάλυση εγγράφων μέσω HTTP, χρησιμοποιώντας προγράμματα, δεν χρειάστηκε πολύς χρόνος για να αναπτύξουμε μια προσέγγιση παραγωγής εγγράφων σχεδιασένων ειδικά για κατανάλωση από άλλα προγράμματα (δηλαδή, όχι HTML για εμφάνιση σε πρόγραμμα περιήγησης ).</p>
<p>Υπάρχουν δύο κοινές μορφές που χρησιμοποιούμε κατά την ανταλλαγή δεδομένων στον ιστό. Η eXtensible Markup Language (XML) ή Επεκτάσιμη Γλώσσα Σήμανσης χρησιμοποιείται εδώ και πολύ καιρό και είναι η καταλληλότερη για έγγραφα τυποποιημένα για ανταλλαγή δεδομένων. Όταν τα προγράμματα θέλουν απλώς να ανταλλάξουν λεξικά, λίστες ή άλλες εσωτερικές πληροφορίες μεταξύ τους, χρησιμοποιούν JavaScript Object Notation (JSON) ή Σημειογραφία Αντικειμένου JavaScript (δείτε <a href="http://www.json.org">www.json.org</a>). Θα εξετάσουμε και τις δύο μορφές.</p>
<h2 id="extensible-markup-language---xml">eXtensible Markup Language - XML</h2>
<p>Η XML μοιάζει πολύ με την HTML, αλλά η XML είναι πιο δομημένη. Ακολουθεί ένα δείγμα εγγράφου XML:</p>
<pre class="xml"><code>&lt;άτομο&gt;
  &lt;όνομα&gt;Chuck&lt;/όνομα&gt;
  &lt;τηλέφωνο τύπος=&quot;εσωτερικό&quot;&gt;
    +1 734 303 4456
  &lt;/τηλέφωνο&gt;
  &lt;email κρυφό=&quot;ναι&quot; /&gt;
&lt;/άτομο&gt;</code></pre>
<p>Κάθε ζεύγος ετικετών ανοίγματος (π.χ. <code>&lt;άτομο&gt;</code>) και κλεισίματος (π.χ. <code>&lt;/άτομο&gt;</code>) αντιπροσωπεύει ένα <em>στοιχείο</em> ή <em>κόμβο</em> με το ίδιο όνομα με αυτό της ετικέτας (π.χ. <code>άτομο</code>). Κάθε στοιχείο μπορεί να έχει κάποιο κείμενο, ορισμένα χαρακτηριστικά (π.χ. <code>κρυφό</code>) και άλλα εμφωλευμένα στοιχεία. Εάν ένα στοιχείο XML είναι κενό (δηλαδή, δεν έχει περιεχόμενο), μπορεί να απεικονίζεται από μια ετικέτα που κλείνει αυτόματα (π.χ. <code>&lt;email /&gt;</code>).</p>
<p>Συχνά είναι χρήσιμο να σκεφτόμαστε ένα έγγραφο XML ως μια δομή δέντρου, όπου υπάρχει ένα κορυφαίο στοιχείο (εδώ το: <code>άτομο</code>) και οι άλλες ετικέτες (π.χ. <code>τηλέφωνο</code>) σχεδιάζονται ως <em>παιδιά</em> των στοιχείων <em>γονέα</em> τους.</p>
<figure>
<img src="../images/xml-tree.svg" alt="Μια αναπαράσταση δέντρου της XML" style="height: 2.0in;"/>
<figcaption>
Μια αναπαράσταση δέντρου της XML
</figcaption>
</figure>
<h2 id="ανάλυση-xml">Ανάλυση XML</h2>
<p>  </p>
<p>Εδώ είναι μια απλή εφαρμογή, που αναλύει ορισμένα δεδομένα XML και εξάγει κάποια στοιχεία δεδομένων από το XML:</p>
<pre class="python"><code>import xml.etree.ElementTree as ET

data = &#39;&#39;&#39;
&lt;άτομο&gt;
  &lt;όνομα&gt;Chuck&lt;/όνομα&gt;
  &lt;τηλέφωνο τύπος=&quot;εσωτερικό&quot;&gt;
    +1 734 303 4456
  &lt;/τηλέφωνο&gt;
  &lt;email κρυφό=&quot;ναι&quot; /&gt;
&lt;/άτομο&gt;&#39;&#39;&#39;

tree = ET.fromstring(data)
print(&#39;Όνομα:&#39;, tree.find(&#39;όνομα&#39;).text)
print(&#39;Χαρακτηριστικό:&#39;, tree.find(&#39;email&#39;).get(&#39;κρυφό&#39;))

# Code: http://www.py4e.com/code3/xml1.py</code></pre>
<p>Το τριπλό μονό εισαγωγικό (<code>'''</code>), καθώς και το τριπλό διπλό εισαγωγικό (<code>"""</code>), επιτρέπουν τη δημιουργία συμβολοσειρών που εκτείνονται σε πολλές γραμμές.</p>
<p>Η κλήση <code>fromstring</code> μετατρέπει την αναπαράσταση συμβολοσειράς του XML σε ένα “δέντρο” στοιχείων XML. Όταν το XML αναπαρασταθεί με δέντρο, έχουμε μια σειρά από μεθόδους που μπορούμε να καλέσουμε για να εξαγάγουμε τμήματα δεδομένων από τη συμβολοσειρά XML. Η συνάρτηση <code>find</code> πραγματοποιεί αναζήτηση στο δέντρο XML και ανακτά το στοιχείο που ταιριάζει με την καθορισμένη ετικέτα.</p>
<pre class="{text}"><code>Όνομα: Chuck
Χαρακτηριστικό:: yes</code></pre>
<p>Το XML σε αυτό το παράδειγμα είναι αρκετά απλό, αποδεικνύεται όμως ότι υπάρχουν πολλοί κανόνες σχετικά με έγκυρη XML. Η χρήση ενός αναλυτή XML, όπως το <code>ElementTree</code>, μας επιτρέπει να εξαγάγουμε δεδομένα από το XML χωρίς να ανησυχούμε για τους περίπλοκους, σε κάποιες περιπτώσεις, κανόνες σύνταξης XML.</p>
<h2 id="προσπέλαση-των-κόμβων-με-επανάληψη">Προσπέλαση των κόμβων με επανάληψη</h2>
<p> </p>
<p>Often the XML has multiple nodes and we need to write a loop to process all of the nodes. In the following program, we loop through all of the <code>user</code> nodes:</p>
<pre class="python"><code>import xml.etree.ElementTree as ET

input = &#39;&#39;&#39;
&lt;stuff&gt;
  &lt;χρήστες&gt;
    &lt;χρήστης x=&quot;2&quot;&gt;
      &lt;id&gt;001&lt;/id&gt;
      &lt;όνομα&gt;Chuck&lt;/όνομα&gt;
    &lt;/χρήστης&gt;
    &lt;χρήστης x=&quot;7&quot;&gt;
      &lt;id&gt;009&lt;/id&gt;
      &lt;όνομα&gt;Brent&lt;/όνομα&gt;
    &lt;/χρήστης&gt;
  &lt;/χρήστες&gt;
&lt;/stuff&gt;&#39;&#39;&#39;

stuff = ET.fromstring(input)
lst = stuff.findall(&#39;χρήστες/χρήστης&#39;)
print(&#39;Πλήθος χρηστών:&#39;, len(lst))

for item in lst:
    print(&#39;Όνομα&#39;, item.find(&#39;όνομα&#39;).text)
    print(&#39;Id&#39;, item.find(&#39;id&#39;).text)
    print(&#39;Χαρακτηριστικό&#39;, item.get(&#39;x&#39;))

# Code: http://www.py4e.com/code3/xml2.py</code></pre>
<p>Η μέθοδος <code>findall</code> ανακτά μια λίστα Python με υποδέντρα που αντιπροσωπεύουν τις δομές <code>χρήστης</code> στο δέντρο XML. Στη συνέχεια, μπορούμε να γράψουμε ένα βρόχο <code>for</code>, που εξετάζει κάθε κόμβο χρήστη και εκτυπώνει τα στοιχεία κειμένου <code>όνομα</code> και <code>id</code> καθώς και το χαρακτηριστικό <code>x</code> του κόμβου (<code>χρήστης</code>).</p>
<pre class="{text}"><code>Πλήθος χρηστών: 2
Όνομα Chuck
Id 001
Χαρακτηριστικό 2
Όνομα Brent
Id 009
Χαρακτηριστικό 7</code></pre>
<p>Είναι σημαντικό να συμπεριληφθούν όλα τα στοιχεία γονικού επιπέδου στη δήλωση <code>findall</code>, εκτός από το στοιχείο ανώτατου επιπέδου (π.χ. <code>χρήστες/χρήστης</code>). Διαφορετικά, η Python δεν θα βρει κανέναν, επιθυμητό, κόμβο.</p>
<pre class="python"><code>import xml.etree.ElementTree as ET

input = &#39;&#39;&#39;
&lt;stuff&gt;
  &lt;χρήστες&gt;
    &lt;χρήστης x=&quot;2&quot;&gt;
      &lt;id&gt;001&lt;/id&gt;
      &lt;όνομα&gt;Chuck&lt;/όνομα&gt;
    &lt;/χρήστης&gt;
    &lt;χρήστης x=&quot;7&quot;&gt;
      &lt;id&gt;009&lt;/id&gt;
      &lt;όνομα&gt;Brent&lt;/όνομα&gt;
    &lt;/χρήστης&gt;
  &lt;/χρήστες&gt;
&lt;/stuff&gt;&#39;&#39;&#39;

stuff = ET.fromstring(input)

lst = stuff.findall(&#39;χρήστες/χρήστης&#39;)
print(&#39;Πλήθος χρηστών:&#39;, len(lst))

lst2 = stuff.findall(&#39;χρήστης&#39;)
print(&#39;Πλήθος χρηστών:&#39;, len(lst2))</code></pre>
<p><code>lst</code> αποθηκεύει όλα τα στοιχεία <code>user</code> τα οποία είναι εμφωλευμένα στον γονέα <code>users</code>. <code>lst2</code> αναζητά τα στοιχεία <code>user</code> τα οποία δεν είναι εμφωλευμένα, μέσα στο στοιχείο ανώτατου επιπέδου <code>stuff</code>, τα οποία δεν υπάρχουν.</p>
<pre class="{text}"><code>User count: 2
User count: 0</code></pre>
<h2 id="javascript-object-notation---json">JavaScript Object Notation - JSON</h2>
<p> </p>
<p>Η μορφή JSON εμπνεύστηκε από τη μορφή αντικειμένου και πίνακα, που χρησιμοποιείται στη γλώσσα JavaScript. Αλλά δεδομένου ότι η Python επινοήθηκε πριν από την JavaScript, η σύνταξη της Python για λεξικά και λίστες επηρέασε τη σύνταξη του JSON. Έτσι, η μορφή του JSON είναι σχεδόν πανομοιότυπη με έναν συνδυασμό λιστών και λεξικών Python.</p>
<p>Εδώ παραθέτω μια κωδικοποίηση JSON, που είναι περίπου ισοδύναμη με την απλή XML παραπάνω:</p>
<pre class="json"><code>{
  &quot;όνομα&quot; : &quot;Chuck&quot;,
  &quot;τηλέφωνο&quot; : {
    &quot;τύπος&quot; : &quot;εσωτερικό&quot;,
    &quot;αριθμός&quot; : &quot;+1 734 303 4456&quot;
   },
   &quot;email&quot; : {
     &quot;κρυφό&quot; : &quot;ναι&quot;
   }
}</code></pre>
<p>Θα παρατηρήσετε κάποιες διαφορές. Αρχικά, στην XML, μπορούμε να προσθέσουμε χαρακτηριστικά, όπως το “εσωτερικό” στην ετικέτα “τηλέφωνο”. Στο JSON, έχουμε απλώς ζεύγη κλειδιού-τιμής. Επίσης, η ετικέτα “άτομο” της XML έχει ακυρωθεί και αντικαθίσταται από ένα ζεύγος εξωτερικών αγκίστρων.</p>
<p>Γενικά, οι δομές JSON είναι απλούστερες από την XML επειδή το JSON έχει λιγότερες δυνατότητες από το XML. Αλλά το JSON έχει το πλεονέκτημα ότι αντιστοιχίζεται <em>απευθείας</em> σε κάποιο συνδυασμό λεξικών και λιστών. Και, δεδομένου ότι σχεδόν όλες οι γλώσσες προγραμματισμού έχουν κάτι αντίστοιχο με τα λεξικά και τις λίστες της Python, το JSON είναι μια πολύ φυσική μορφή για να ανταλλάσσουν δεδομένα δύο συνεργαζόμενα προγράμματα.</p>
<p>Το JSON γίνεται ταχύτατα η μορφή που επιλέγεται, για σχεδόν το σύνολο των δεδομένων που ανταλλάσσονται μεταξύ εφαρμογών, λόγω της σχετικής απλότητάς του σε σύγκριση με την XML.</p>
<h2 id="ανάλυση-json">Ανάλυση JSON</h2>
<p>Κατασκευάζουμε το JSON μας με εμφωλευμένα λεξικά και λίστες όπως απαιτείται. Σε αυτό το παράδειγμα, αναπαριστούμε μια λίστα χρηστών, όπου κάθε χρήστης είναι ένα σύνολο ζευγών κλειδιών-τιμών (δηλαδή, ένα λεξικό). Έχουμε λοιπόν μια λίστα με λεξικά.</p>
<p>Στο παρακάτω πρόγραμμα, χρησιμοποιούμε την ενσωματωμένη βιβλιοθήκη <code>json</code> για να αναλύσουμε το JSON και να διαβάσουμε τα δεδομένα. Συγκρίνετε προσεκτικά αυτό το πρόγραμμα και τα δεδομένα εισόδου του με τα ισοδύναμα δεδομένα και τον κώδικα XML παραπάνω. Το JSON έχει λιγότερες λεπτομέρειες, επομένως πρέπει να γνωρίζουμε εκ των προτέρων ότι λαμβάνουμε μια λίστα και ότι η λίστα είναι χρηστών και κάθε χρήστης είναι ένα σύνολο ζευγών κλειδιών-τιμών. Το JSON είναι πιο συνοπτικό (πλεονέκτημα) αλλά είναι επίσης λιγότερο αυτο-περιγραφικό (ένα μειονέκτημα).</p>
<pre class="python"><code>import json

data = &#39;&#39;&#39;
[
  { &quot;id&quot; : &quot;001&quot;,
    &quot;x&quot; : &quot;2&quot;,
    &quot;όνομα&quot; : &quot;Chuck&quot;
  } ,
  { &quot;id&quot; : &quot;009&quot;,
    &quot;x&quot; : &quot;7&quot;,
    &quot;όνομα&quot; : &quot;Brent&quot;
  }
]&#39;&#39;&#39;

info = json.loads(data)
print(&#39;Πλήθος χρηστών:&#39;, len(info))

for item in info:
    print(&#39;Όνομα&#39;, item[&#39;όνομα&#39;])
    print(&#39;Id&#39;, item[&#39;id&#39;])
    print(&#39;Χαρακτηριστικό&#39;, item[&#39;x&#39;])

# Code: http://www.py4e.com/code3/json2.py</code></pre>
<p>Εάν συγκρίνετε τον κώδικα για την εξαγωγή δεδομένων από το αναλυμένο JSON και το XML, θα δείτε ότι αυτό που λαμβάνουμε από το <code>json.loads()</code> είναι μια λίστα Python, την οποία διασχίζουμε με έναν βρόχο <code>for</code> και κάθε στοιχείο σε αυτήν τη λίστα είναι ένα λεξικό Python. Αφού αναλυθεί το JSON, μπορούμε να χρησιμοποιήσουμε τον τελεστή ευρετηρίου Python για να εξαγάγουμε τα διάφορα bit δεδομένων για κάθε χρήστη. Δεν χρειάζεται να χρησιμοποιήσουμε τη βιβλιοθήκη JSON για να διερευνήσουμε το αναλυμένο JSON, καθώς τα δεδομένα που επιστρέφονται είναι απλώς εγγενείς δομές Python.</p>
<p>Η έξοδος αυτού του προγράμματος είναι ακριβώς η ίδια με την παραπάνω έκδοση XML.</p>
<pre class="{text}"><code>Πλήθος χρηστών: 2
Όνομα Chuck
Id 001
Χαρακτηριστικό 2
Όνομα Brent
Id 009
Χαρακτηριστικό 7</code></pre>
<p>Σε γενικές γραμμές, υπάρχει μια τάση του κλάδου να απομακρύνεται από την XML και να υιοθετεί το JSON για τις υπηρεσίες Ιστού. Επειδή το JSON είναι απλούστερο και αντιστοιχίζεται πιο άμεσα σε εγγενείς δομές δεδομένων που έχουμε ήδη στις γλώσσες προγραμματισμού, ο κώδικας ανάλυσης και εξαγωγής δεδομένων είναι συνήθως απλούστερος και πιο άμεσος όταν χρησιμοποιείται JSON. Αλλά η XML είναι πιο αυτοπεριγραφική από την JSON και έτσι υπάρχουν ορισμένες εφαρμογές όπου η XML διατηρεί ένα πλεονέκτημα. Για παράδειγμα, οι περισσότεροι επεξεργαστές κειμένου αποθηκεύουν έγγραφα εσωτερικά χρησιμοποιώντας XML αντί JSON.</p>
<h2 id="διεπαφές-προγραμματισμού-εφαρμογών">Διεπαφές προγραμματισμού εφαρμογών</h2>
<p>Τώρα έχουμε τη δυνατότητα να ανταλλάσσουμε δεδομένα μεταξύ εφαρμογών, χρησιμοποιώντας το Πρωτόκολλο Μεταφοράς HyperText (HTTP) και έναν τρόπο να αναπαραστήσουμε σύνθετα δεδομένα, που ανταλλάσουμε μεταξύ αυτών των εφαρμογών χρησιμοποιώντας τη Γλώσσα Επεκτάσιμης Σήμανσης (XML) ή τη Σημειογραφία Αντικειμένων JavaScript (JSON).</p>
<p>Το επόμενο βήμα είναι να αρχίσουμε να ορίζουμε και να τεκμηριώνουμε “συμβάσεις” μεταξύ εφαρμογών χρησιμοποιώντας αυτές τις τεχνικές. Η γενική ονομασία για αυτές τις από εφαρμογής σε εφαρμογή συμβάσεις είναι <em>Διεπαφές Προγράμματος Εφαρμογής ή Application Program Interfaces</em> (APIs). Όταν χρησιμοποιούμε ένα API, γενικά ένα πρόγραμμα καθιστά διαθέσιμο ένα σύνολο <em>υπηρεσιών</em>, για χρήση από άλλες εφαρμογές και δημοσιεύει τα API (δηλαδή τους “κανόνες”) που πρέπει να ακολουθούνται για την πρόσβαση στις υπηρεσίες που παρέχονται από αυτό.</p>
<p>Όταν αρχίζουμε να χτίζουμε τα προγράμματά μας, όπου η λειτουργικότητα του προγράμματός μας περιλαμβάνει πρόσβαση σε υπηρεσίες που παρέχονται από άλλα προγράμματα, ονομάζουμε την προσέγγιση <em>Αρχιτεκτονική προσανατολισμένη στις υπηρεσίες ή Service-oriented architecture</em> (SOA). Μια προσέγγιση SOA είναι μια προσέγγιση όπου η συνολική μας εφαρμογή κάνει χρήση των υπηρεσιών άλλων εφαρμογών. Μια προσέγγιση που δεν είναι SOA είναι αυτή όπου η εφαρμογή είναι μια ενιαία, αυτόνομη εφαρμογή, που περιέχει όλο τον απαραίτητο κώδικα για την υλοποίηση της εφαρμογής.</p>
<p>Βλέπουμε πολλά παραδείγματα SOA όταν χρησιμοποιούμε τον ιστό. Μπορούμε να μεταβούμε σε έναν ιστότοπο και να κάνουμε κράτηση για αεροπορικά εισιτήρια, ξενοδοχεία και αυτοκίνητα, όλα από έναν μόνο ιστότοπο. Τα δεδομένα για τα ξενοδοχεία δεν αποθηκεύονται στους υπολογιστές της αεροπορικής εταιρείας. Αντίθετα, οι υπολογιστές της αεροπορικής εταιρείας επικοινωνούν με τις υπηρεσίες στους υπολογιστές του ξενοδοχείου, ανακτούν τα δεδομένα του ξενοδοχείου και τα παρουσιάζουν στον χρήστη. Όταν ο χρήστης συμφωνεί να κάνει μια κράτηση ξενοδοχείου, χρησιμοποιώντας τον ιστότοπο της αεροπορικής εταιρείας, ο ιστότοπος της αεροπορικής εταιρείας χρησιμοποιεί μια άλλη υπηρεσία web, στα συστήματα του ξενοδοχείου, για να υλοποιήσει πραγματικά την κράτηση. Και όταν έρθει η ώρα να χρεώσετε την πιστωτική σας κάρτα για ολόκληρη τη συναλλαγή, και πάλι άλλοι υπολογιστές εμπλέκονται στη διαδικασία.</p>
<figure>
<img src="height=3.0in@../images/soa.svg" alt="Αρχιτεκτονική Προσανατολισμένη στις Υπηρεσίες (Service-oriented architecture)" /><figcaption>Αρχιτεκτονική Προσανατολισμένη στις Υπηρεσίες (Service-oriented architecture)</figcaption>
</figure>
<p>Μια αρχιτεκτονική προσανατολισμένη στις υπηρεσίες έχει πολλά πλεονεκτήματα, όπως: (1) διατηρούμε πάντα μόνο ένα αντίγραφο δεδομένων (αυτό είναι ιδιαίτερα σημαντικό για πράγματα όπως κρατήσεις ξενοδοχείων, όπου δεν θέλουμε να κάνουμε υπερβολική δέσμευση) και (2) οι κάτοχοι των δεδομένα μπορούν να ορίσουν τους κανόνες σχετικά με τη χρήση των δεδομένων τους. Με αυτά τα πλεονεκτήματα, ένα σύστημα SOA πρέπει να είναι προσεκτικά σχεδιασμένο ώστε να έχει καλή απόδοση και να καλύπτει τις ανάγκες του χρήστη.</p>
<p>Όταν μια εφαρμογή διαθέτει ένα σύνολο υπηρεσιών στο API της μέσω του ιστού, την ονομάζουμε <em>υπηρεσίες Ιστού (web services)</em>.</p>
<h2 id="ασφάλεια-και-χρήση-api">Ασφάλεια και χρήση API</h2>
<p> </p>
<p>Είναι αρκετά συνηθισμένο να χρειάζεστε ένα κλειδί API για να χρησιμοποιήσετε το API ενός προμηθευτή. Η γενική ιδέα είναι ότι θέλουν να γνωρίζουν ποιος χρησιμοποιεί τις υπηρεσίες τους και πόσο τις χρησιμοποιεί ο κάθε χρήστης. Ίσως έχουν δωρεάν και επί πληρωμή επίπεδα των υπηρεσιών τους ή έχουν μια πολιτική που περιορίζει τον αριθμό των αιτημάτων που μπορεί να υποβάλει ένα άτομο κατά τη διάρκεια μιας συγκεκριμένης χρονικής περιόδου.</p>
<p>Μερικές φορές, μόλις λάβετε το κλειδί API σας, απλώς συμπεριλάβετε το κλειδί ως μέρος των δεδομένων POST ή ίσως ως παράμετρο στη διεύθυνση URL κατά την κλήση του API.</p>
<p>Άλλες φορές, ο πωλητής θέλει αυξημένη διασφάλιση της προέλευσης των αιτημάτων και έτσι περιμένει από εσάς να στείλετε κρυπτογραφικά υπογεγραμμένα μηνύματα χρησιμοποιώντας κοινόχρηστα κλειδιά και μυστικά. Μια πολύ κοινή τεχνολογία που χρησιμοποιείται για την υπογραφή αιτημάτων μέσω Διαδικτύου ονομάζεται <em>OAuth</em>. Μπορείτε να διαβάσετε περισσότερα για το πρωτόκολλο OAuth στο <a href="http://www.oauth.net">www.oauth.net</a>.</p>
<p>Ευτυχώς, υπάρχουν πολλές βολικές και δωρεάν βιβλιοθήκες OAuth, ώστε να μπορείτε να αποφύγετε να γράψετε μια υλοποίηση OAuth, από την αρχή διαβάζοντας τις προδιαγραφές. Αυτές οι βιβλιοθήκες είναι ποικίλης πολυπλοκότητας και έχουν διαφορετικούς βαθμούς πλούτου. Ο ιστότοπος του OAuth έχει πληροφορίες σχετικά με διάφορες βιβλιοθήκες OAuth.</p>
<h2 id="γλωσσάριο">Γλωσσάριο</h2>
<dl>
<dt>API</dt>
<dd>Application Program Interface (Διεπαφές Προγράμματος Εφαρμογή) - Ένα συμβόλαιο μεταξύ εφαρμογών που ορίζει τα πρότυπα αλληλεπίδρασης μεταξύ δύο στοιχείων εφαρμογής.
</dd>
<dt>ElementTree</dt>
<dd>Μια ενσωματωμένη βιβλιοθήκη Python που χρησιμοποιείται για την ανάλυση δεδομένων XML.
</dd>
<dt>JSON</dt>
<dd>JavaScript Object Notation (Σημειογραφία Αντικειμένου JavaScript) - Μια μορφή που επιτρέπει τη σήμανση δομημένων δεδομένων με βάση τη σύνταξη των αντικειμένων JavaScript.
</dd>
<dt>SOA</dt>
<dd>Service-Oriented Architecture (Αρχιτεκτονική προσανατολισμένη στις υπηρεσίες) - Όταν μια εφαρμογή αποτελείται από στοιχεία συνδεδεμένα σε ένα δίκτυο.
</dd>
<dt>XML</dt>
<dd>eXtensible Markup Language (Επεκτάσιμη Γλώσσα Σήμανσης) - Μια μορφή που επιτρέπει τη σήμανση δομημένων δεδομένων.
</dd>
</dl>
<h2 id="εφαρμογή-1-υπηρεσία-ιστού-γεωκωδικοποίησης-google">Εφαρμογή 1: Υπηρεσία ιστού γεωκωδικοποίησης Google</h2>
<p>    </p>
<p>Η Google διαθέτει μια εξαιρετική υπηρεσία ιστού που μας επιτρέπει να χρησιμοποιούμε τη μεγάλη βάση δεδομένων γεωγραφικών πληροφοριών της. Μπορούμε να υποβάλουμε μια συμβολοσειρά γεωγραφικής αναζήτησης όπως “Ann Arbor, MI” στο API γεωκωδικοποίησης της και να ζητήσουμε από την Google να επιστρέψει την καλύτερη εικασία για το πού θα βρούμε τη συμβολοσειρά αναζήτησής μας σε έναν χάρτη και να μας ενημερώσει για τα γειτονικά ορόσημα.</p>
<p>Η υπηρεσία γεωκωδικοποίησης είναι δωρεάν αλλά περιορισμένης χρήση, επομένως δεν μπορείτε να κάνετε απεριόριστη χρήση του API σε μια εμπορική εφαρμογή. Ωστόσο, εάν έχετε κάποια δεδομένα έρευνας, όπου ένας τελικός χρήστης έχει εισαγάγει μια τοποθεσία σε ένα πλαίσιο εισαγωγής ελεύθερης μορφής, μπορείτε να χρησιμοποιήσετε αυτό το API για να καθαρίσετε τα δεδομένα σας αρκετά καλά.</p>
<p><em>Όταν χρησιμοποιείτε ένα δωρεάν API, όπως το API γεωκωδικοποίησης της Google, θα πρέπει να δείχνετε σεβασμό στη χρήση αυτών των πόρων. Εάν πάρα πολλοί άνθρωποι κάνουν κατάχρηση της υπηρεσίας, η Google ενδέχεται να απορρίψει ή να περιορίσει σημαντικά τη δωρεάν υπηρεσία της.</em></p>
<p> </p>
<p>Μπορείτε να διαβάσετε την ηλεκτρονική τεκμηρίωση για αυτήν την υπηρεσία, αλλά είναι αρκετά απλή και μπορείτε ακόμη και να τη δοκιμάσετε χρησιμοποιώντας ένα πρόγραμμα περιήγησης πληκτρολογώντας την ακόλουθη διεύθυνση URL στο πρόγραμμα περιήγησής σας:</p>
<p><a href="http://maps.googleapis.com/maps/api/geocode/json?address=Ann+Arbor%2C+MI">http://maps.googleapis.com/maps/api/geocode/json?address=Ann+Arbor%2C+MI</a></p>
<p>Φροντίστε να αφαιρέσετε τυχόν κενά από τη διεύθυνση URL προτού την επικολλήσετε στο πρόγραμμα περιήγησής σας.</p>
<p>Η παρακάτω είναι μια απλή εφαρμογή, για να ζητήσει από τον χρήστη μια συμβολοσειρά αναζήτησης, να καλέσει το API γεωκωδικοποίησης της Google και να εξαγάγει πληροφορίες από το JSON που επιστράφηκε.</p>
<pre class="python"><code>import urllib.request, urllib.parse, urllib.error
import json
import ssl

api_key = False
# Εάν διαθέτετε κλειδί API Google Places, πληκτρολογήστε το εδώ
# api_key = &#39;AIzaSy___IDByT70&#39;
# https://developers.google.com/maps/documentation/geocoding/intro

if api_key is False:
    api_key = 42
    serviceurl = &#39;http://py4e-data.dr-chuck.net/json?&#39;
else :
    serviceurl = &#39;https://maps.googleapis.com/maps/api/geocode/json?&#39;

# Αγνόησε τα σφάλματα πιστοποιητικού SSL
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

while True:
    address = input(&#39;Εισαγάγετε τοποθεσία: &#39;)
    if len(address) &lt; 1: break

    parms = dict()
    parms[&#39;address&#39;] = address
    if api_key is not False: parms[&#39;key&#39;] = api_key
    url = serviceurl + urllib.parse.urlencode(parms)

    print(&#39;Ανάκτηση&#39;, url)
    uh = urllib.request.urlopen(url, context=ctx)
    data = uh.read().decode()
    print(&#39;Ανακτήθηκαν&#39;, len(data), &#39;χαρακτήρες&#39;)

    try:
        js = json.loads(data)
    except:
        js = None

    if not js or &#39;status&#39; not in js or js[&#39;status&#39;] != &#39;OK&#39;:
        print(&#39;==== Αποτυχία ανάκτησης ====&#39;)
        print(data)
        continue

    print(json.dumps(js, indent=4))

    lat = js[&#39;results&#39;][0][&#39;geometry&#39;][&#39;location&#39;][&#39;lat&#39;]
    lng = js[&#39;results&#39;][0][&#39;geometry&#39;][&#39;location&#39;][&#39;lng&#39;]
    print(&#39;πλάτος&#39;, lat, &#39;μήκος&#39;, lng)
    location = js[&#39;results&#39;][0][&#39;formatted_address&#39;]
    print(location)

# Code: http://www.py4e.com/code3/geojson.py</code></pre>
<p>Το πρόγραμμα παίρνει τη συμβολοσειρά αναζήτησης και κατασκευάζει μια διεύθυνση URL με τη συμβολοσειρά αναζήτησης, ως σωστά κωδικοποιημένη παράμετρο, και στη συνέχεια χρησιμοποιεί το <code>urllib</code> για να ανακτήσει το κείμενο από το API γεωκωδικοποίησης της Google. Σε αντίθεση με μια σταθερή ιστοσελίδα, τα δεδομένα που λαμβάνουμε εξαρτώνται από τις παραμέτρους που στέλνουμε και τα γεωγραφικά δεδομένα που είναι αποθηκευμένα στους διακομιστές της Google.</p>
<p>Μόλις ανακτήσουμε τα δεδομένα JSON, τα αναλύουμε με τη βιβλιοθήκη <code>json</code> και κάνουμε μερικούς ελέγχους για να βεβαιωθούμε ότι λάβαμε καλά δεδομένα και, στη συνέχεια, εξάγουμε τις πληροφορίες που αναζητούμε.</p>
<p>Η έξοδος του προγράμματος είναι η εξής (μερικά από τα JSON που επιστράφηκαν έχουν αφαιρεθεί):</p>
<pre class="{text}"><code>$ python3 geojson.py
Εισαγάγετε τοποθεσία: Ann Arbor, MI
Ανάκτηση http://py4e-data.dr-chuck.net/json?address=Ann+Arbor%2C+MI&amp;key=42
Ανακτήθηκαν 1736 χαρακτήρες</code></pre>
<pre class="json"><code>{
    &quot;results&quot;: [
        {
            &quot;address_components&quot;: [
                {
                    &quot;long_name&quot;: &quot;Ann Arbor&quot;,
                    &quot;short_name&quot;: &quot;Ann Arbor&quot;,
                    &quot;types&quot;: [
                        &quot;locality&quot;,
                        &quot;political&quot;
                    ]
                },
                {
                    &quot;long_name&quot;: &quot;Washtenaw County&quot;,
                    &quot;short_name&quot;: &quot;Washtenaw County&quot;,
                    &quot;types&quot;: [
                        &quot;administrative_area_level_2&quot;,
                        &quot;political&quot;
                    ]
                },
                {
                    &quot;long_name&quot;: &quot;Michigan&quot;,
                    &quot;short_name&quot;: &quot;MI&quot;,
                    &quot;types&quot;: [
                        &quot;administrative_area_level_1&quot;,
                        &quot;political&quot;
                    ]
                },
                {
                    &quot;long_name&quot;: &quot;United States&quot;,
                    &quot;short_name&quot;: &quot;US&quot;,
                    &quot;types&quot;: [
                        &quot;country&quot;,
                        &quot;political&quot;
                    ]
                }
            ],
            &quot;formatted_address&quot;: &quot;Ann Arbor, MI, USA&quot;,
            &quot;geometry&quot;: {
                &quot;bounds&quot;: {
                    &quot;northeast&quot;: {
                        &quot;lat&quot;: 42.3239728,
                        &quot;lng&quot;: -83.6758069
                    },
                    &quot;southwest&quot;: {
                        &quot;lat&quot;: 42.222668,
                        &quot;lng&quot;: -83.799572
                    }
                },
                &quot;location&quot;: {
                    &quot;lat&quot;: 42.2808256,
                    &quot;lng&quot;: -83.7430378
                },
                &quot;location_type&quot;: &quot;APPROXIMATE&quot;,
                &quot;viewport&quot;: {
                    &quot;northeast&quot;: {
                        &quot;lat&quot;: 42.3239728,
                        &quot;lng&quot;: -83.6758069
                    },
                    &quot;southwest&quot;: {
                        &quot;lat&quot;: 42.222668,
                        &quot;lng&quot;: -83.799572
                    }
                }
            },
            &quot;place_id&quot;: &quot;ChIJMx9D1A2wPIgR4rXIhkb5Cds&quot;,
            &quot;types&quot;: [
                &quot;locality&quot;,
                &quot;political&quot;
            ]
        }
    ],
    &quot;status&quot;: &quot;OK&quot;
}
πλάτος 42.2808256 μήκος -83.7430378
Ann Arbor, MI, USA</code></pre>
<pre class="{text}"><code>Εισαγάγετε τοποθεσία:</code></pre>
<p>Μπορείτε να κάνετε λήψη του <a href="http://www.gr.py4e.com/code3/geoxml.py">www.gr.py4e.com/code3/geoxml.py</a> για να εξερευνήσετε την παραλλαγή XML του API γεωκωδικοποίησης Google.</p>
<p><strong>Άσκηση 1: Αλλάξτε είτε το</strong> <a href="http://www.py4e.com/code3/geojson.py"><strong>geojson.py</strong></a> <strong>είτε το</strong> <a href="http://www.py4e.com/code3/geoxml.py"><strong>geoxml.py</strong></a> <strong>για να εκτυπώσετε τον κωδικό χώρας δύο χαρακτήρων από τα δεδομένα που ανακτήθηκαν. Προσθέστε έλεγχο σφαλμάτων, ώστε το πρόγραμμά σας να μην ανιχνεύει εάν ο κωδικός χώρας δεν υπάρχει. Μόλις το θέσετε σε λειτουργία, αναζητήστε “Atlantic Ocean” και βεβαιωθείτε ότι μπορεί να χειριστεί τοποθεσίες που δεν βρίσκονται σε καμία χώρα.</strong></p>
<h2 id="εφαρμογή-2-twitter">Εφαρμογή 2: Twitter</h2>
<p>Καθώς το Twitter API γινόταν όλο και πιο πολύτιμο, το Twitter μετατράπηκε από ένα ανοιχτό και δημόσιο API σε ένα API που απαιτούσε τη χρήση υπογραφών OAuth σε κάθε αίτημα API.</p>
<p>Για αυτό το επόμενο δείγμα προγράμματος, πραγματοποιήστε λήψη των αρχείων <em>twurl.py</em>, <em>hidden.py</em>, <em>oauth.py</em> και <em>twitter1.py</em> από <a href="http://www.gr.py4e.com/code3">www.gr.py4e.com/code</a> και αποθηκεύστε τα όλα σε ένα φάκελο στον υπολογιστή σας.</p>
<p>Για να χρησιμοποιήσετε αυτά τα προγράμματα θα χρειαστεί να έχετε λογαριασμό Twitter και να εξουσιοδοτήσετε τον κώδικα Python ως εφαρμογή, να ένα κλειδί (key), ένα μυστικό (secret), ένα διακριτικό (token) και ένα μυστικό διακριτικού (token secret). Θα επεξεργαστείτε το αρχείο <em>hidden.py</em> και θα προσθέσετε αυτές τις τέσσερις συμβολοσειρές στις κατάλληλες μεταβλητές του αρχείου:</p>
<pre class="python"><code># Κρατήστε αυτό το αρχείο ξεχωριστά

# https://apps.twitter.com/
# Δημιουργήστε νέο App και πάρτε τις τέσσερις συμβολοσειρές

def oauth():
    return {&quot;consumer_key&quot;: &quot;h7Lu...Ng&quot;,
            &quot;consumer_secret&quot;: &quot;dNKenAC3New...mmn7Q&quot;,
            &quot;token_key&quot;: &quot;10185562-eibxCp9n2...P4GEQQOSGI&quot;,
            &quot;token_secret&quot;: &quot;H0ycCFemmC4wyf1...qoIpBo&quot;}

# Code: http://www.py4e.com/code3/hidden.py</code></pre>
<p>Η πρόσβαση στην υπηρεσία ιστού Twitter γίνεται χρησιμοποιώντας μια διεύθυνση URL όπως αυτή:</p>
<p><a href="https://api.twitter.com/1.1/statuses/user_timeline.json" class="uri">https://api.twitter.com/1.1/statuses/user_timeline.json</a></p>
<p>Αλλά μόλις προστεθούν όλες οι πληροφορίες ασφαλείας, η διεύθυνση URL θα μοιάζει περισσότερο με:</p>
<pre class="{text}"><code>https://api.twitter.com/1.1/statuses/user_timeline.json?count=2
&amp;oauth_version=1.0&amp;oauth_token=101...SGI&amp;screen_name=drchuck
&amp;oauth_nonce=09239679&amp;oauth_timestamp=1380395644
&amp;oauth_signature=rLK...BoD&amp;oauth_consumer_key=h7Lu...GNg
&amp;oauth_signature_method=HMAC-SHA1</code></pre>
<p>Μπορείτε να διαβάσετε την προδιαγραφή OAuth, εάν θέλετε να μάθετε περισσότερα σχετικά με τη σημασία των διαφόρων παραμέτρων που προστίθενται για την κάλυψη των απαιτήσεων ασφαλείας του OAuth.</p>
<p>Για τα προγράμματα που εκτελούμε με το Twitter, αποκρύπτουμε όλη την πολυπλοκότητα στα αρχεία <em>oauth.py</em> και <em>twurl.py</em>. Απλώς ορίζουμε τα μυστικά στο <em>hidden.py</em> και μετά στέλνουμε το επιθυμητό URL στη συνάρτηση <em>twurl.augment()</em> και ο κώδικας της βιβλιοθήκης προσθέτει όλες τις απαραίτητες παραμέτρους στη διεύθυνση URL για εμάς.</p>
<p>Αυτό το πρόγραμμα ανακτά το χρονοδιάγραμμα (timeline) για έναν συγκεκριμένο χρήστη του Twitter και μας το επιστρέφει σε μορφή JSON σε μια συμβολοσειρά. Εκτυπώνουμε απλώς τους πρώτους 250 χαρακτήρες της συμβολοσειράς:</p>
<pre class="python"><code>import urllib.request, urllib.parse, urllib.error
import twurl
import ssl

# https://apps.twitter.com/
# Create App and get the four strings, put them in hidden.py

TWITTER_URL = &#39;https://api.twitter.com/1.1/statuses/user_timeline.json&#39;

# Ignore SSL certificate errors
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

while True:
    print(&#39;&#39;)
    acct = input(&#39;Enter Twitter Account:&#39;)
    if (len(acct) &lt; 1): break
    url = twurl.augment(TWITTER_URL,
                        {&#39;screen_name&#39;: acct, &#39;count&#39;: &#39;2&#39;})
    print(&#39;Retrieving&#39;, url)
    connection = urllib.request.urlopen(url, context=ctx)
    data = connection.read().decode()
    print(data[:250])
    headers = dict(connection.getheaders())
    # print headers
    print(&#39;Remaining&#39;, headers[&#39;x-rate-limit-remaining&#39;])

# Code: http://www.py4e.com/code3/twitter1.py</code></pre>

<p>Όταν το πρόγραμμα εκτελείται, παράγει την ακόλουθη έξοδο:</p>
<pre class="{text}"><code>Enter Twitter Account:drchuck
Retrieving https://api.twitter.com/1.1/ ...
[{&quot;created_at&quot;:&quot;Sat Sep 28 17:30:25 +0000 2013&quot;,&quot;
id&quot;:384007200990982144,&quot;id_str&quot;:&quot;384007200990982144&quot;,
&quot;text&quot;:&quot;RT @fixpert: See how the Dutch handle traffic
intersections: http:\/\/t.co\/tIiVWtEhj4\n#brilliant&quot;,
&quot;source&quot;:&quot;web&quot;,&quot;truncated&quot;:false,&quot;in_rep
Remaining 178

Enter Twitter Account:fixpert
Retrieving https://api.twitter.com/1.1/ ...
[{&quot;created_at&quot;:&quot;Sat Sep 28 18:03:56 +0000 2013&quot;,
&quot;id&quot;:384015634108919808,&quot;id_str&quot;:&quot;384015634108919808&quot;,
&quot;text&quot;:&quot;3 months after my freak bocce ball accident,
my wedding ring fits again! :)\n\nhttps:\/\/t.co\/2XmHPx7kgX&quot;,
&quot;source&quot;:&quot;web&quot;,&quot;truncated&quot;:false,
Remaining 177

Enter Twitter Account:</code></pre>
<p>Μαζί με τα επιστρεφόμενα δεδομένα χρονοδιαγράμματος, το Twitter επιστρέφει επίσης μεταδεδομένα σχετικά με το αίτημα στις κεφαλίδες απόκρισης HTTP. Ειδικότερα, μια κεφαλίδα, <code>x-rate-limit-remaining</code>, μας ενημερώνει πόσα ακόμη αιτήματα μπορούμε να υποβάλουμε προτού απόκλειστουμε για ένα σύντομο χρονικό διάστημα. Μπορείτε να δείτε ότι οι ανακτήσεις που απομένουν μειώνονται κατά μία κάθε φορά που υποβάλλουμε ένα αίτημα στο API.</p>
<p>Στο παρακάτω παράδειγμα, ανακτούμε τους φίλους Twitter ενός χρήστη, αναλύουμε το JSON που επιστράφηκε και εξάγουμε ορισμένες από τις πληροφορίες σχετικά με τους φίλους. Επίσης, απορρίπτουμε το JSON μετά την ανάλυση και το “εκτυπώνουμε όμορφα” με μια εσοχή τεσσάρων χαρακτήρων για να μας επιτρέψει να διαπεράσουμε τα δεδομένα όταν θέλουμε να εξαγάγουμε περισσότερα πεδία.</p>
<pre class="python"><code>import urllib.request, urllib.parse, urllib.error
import twurl
import json
import ssl

# https://apps.twitter.com/
# Create App and get the four strings, put them in hidden.py

TWITTER_URL = &#39;https://api.twitter.com/1.1/friends/list.json&#39;

# Ignore SSL certificate errors
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

while True:
    print(&#39;&#39;)
    acct = input(&#39;Enter Twitter Account:&#39;)
    if (len(acct) &lt; 1): break
    url = twurl.augment(TWITTER_URL,
                        {&#39;screen_name&#39;: acct, &#39;count&#39;: &#39;5&#39;})
    print(&#39;Retrieving&#39;, url)
    connection = urllib.request.urlopen(url, context=ctx)
    data = connection.read().decode()

    js = json.loads(data)
    print(json.dumps(js, indent=2))

    headers = dict(connection.getheaders())
    print(&#39;Remaining&#39;, headers[&#39;x-rate-limit-remaining&#39;])

    for u in js[&#39;users&#39;]:
        print(u[&#39;screen_name&#39;])
        if &#39;status&#39; not in u:
            print(&#39;   * No status found&#39;)
            continue
        s = u[&#39;status&#39;][&#39;text&#39;]
        print(&#39;  &#39;, s[:50])

# Code: http://www.py4e.com/code3/twitter2.py</code></pre>

<p>Εφόσον το JSON γίνεται ένα σύνολο από ένθετες λίστες και λεξικά Python, μπορούμε να χρησιμοποιήσουμε έναν συνδυασμό της λειτουργίας ευρετηρίου και των βρόχων <code>for</code> για να διατρέξουμε στις επιστρεφόμενες δομές δεδομένων με πολύ λίγο κώδικα Python.</p>
<p>Η έξοδος του προγράμματος έχει ως εξής (ορισμένα από τα στοιχεία δεδομένων συντομεύονται για να χωρούν στη σελίδα):</p>
<pre class="{text}"><code>Enter Twitter Account:drchuck
Retrieving https://api.twitter.com/1.1/friends ...
Remaining 14</code></pre>
<pre class="json"><code>{
  &quot;next_cursor&quot;: 1444171224491980205,
  &quot;users&quot;: [
    {
      &quot;id&quot;: 662433,
      &quot;followers_count&quot;: 28725,
      &quot;status&quot;: {
        &quot;text&quot;: &quot;@jazzychad I just bought one .__.&quot;,
        &quot;created_at&quot;: &quot;Fri Sep 20 08:36:34 +0000 2013&quot;,
        &quot;retweeted&quot;: false,
      },
      &quot;location&quot;: &quot;San Francisco, California&quot;,
      &quot;screen_name&quot;: &quot;leahculver&quot;,
      &quot;name&quot;: &quot;Leah Culver&quot;,
    },
    {
      &quot;id&quot;: 40426722,
      &quot;followers_count&quot;: 2635,
      &quot;status&quot;: {
        &quot;text&quot;: &quot;RT @WSJ: Big employers like Google ...&quot;,
        &quot;created_at&quot;: &quot;Sat Sep 28 19:36:37 +0000 2013&quot;,
      },
      &quot;location&quot;: &quot;Victoria Canada&quot;,
      &quot;screen_name&quot;: &quot;_valeriei&quot;,
      &quot;name&quot;: &quot;Valerie Irvine&quot;,
    }
  ],
 &quot;next_cursor_str&quot;: &quot;1444171224491980205&quot;
}</code></pre>
<pre class="{text}"><code>leahculver
   @jazzychad I just bought one .__.
_valeriei
   RT @WSJ: Big employers like Google, AT&amp;amp;T are h
ericbollens
   RT @lukew: sneak peek: my LONG take on the good &amp;a
halherzog
   Learning Objects is 10. We had a cake with the LO,
scweeker
   @DeviceLabDC love it! Now where so I get that &quot;etc

Enter Twitter Account:</code></pre>
<p>Το τελευταίο κομμάτι της εξόδου είναι αυτό όπου βλέπουμε τον βρόχο for να διαβάζει τους πέντε πιο πρόσφατους “φίλους” του λογαριασμού Twitter <em><span class="citation" data-cites="drchuck">@drchuck</span></em> και να εκτυπώνει το πιο πρόσφατο status του κάθε φίλου. Υπάρχουν πολλά περισσότερα διαθέσιμα δεδομένα στο JSON που επιστράφηκε. Αν κοιτάξετε στην έξοδο του προγράμματος, μπορείτε επίσης να δείτε ότι το “βρείτε τους φίλους (find the friends)” ενός συγκεκριμένου λογαριασμού έχει διαφορετικό όριο χρέωσης από τον αριθμό των ερωτημάτων χρονοδιαγράμματος, που επιτρέπεται να εκτελούμε ανά χρονική περίοδο.</p>
<p>Αυτά τα ασφαλή κλειδιά API επιτρέπουν στο Twitter να είναι σίγουρο ότι γνωρίζει ποιος χρησιμοποιεί το API και τα δεδομένα του και σε ποιο επίπεδο. Η προσέγγιση περιορισμού πρόσβασης μάς επιτρέπει να κάνουμε απλές, ανακτήσεις προσωπικών δεδομένων, αλλά δεν μας επιτρέπει να δημιουργήσουμε ένα προϊόν που αντλεί δεδομένα από το API τους, εκατομμύρια φορές την ημέρα.</p>
</body>
</html>
<?php if ( file_exists("../bookfoot.php") ) {
  $HTML_FILE = basename(__FILE__);
  $HTML = ob_get_contents();
  ob_end_clean();
  require_once "../bookfoot.php";
}?>
