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
<h2 id="συντελεστές">Συντελεστές</h2>
<pre><code> Συντακτική υποστήριξη: Elliott Hauser, Sue Blumenberg
 Σχεδίαση εξωφύλλου: Aimee Andrion</code></pre>
<h2 id="ιστορικό-εκτύπωσης">Ιστορικό Εκτύπωσης</h2>
<ul>
<li>2016-Ιουλ-05 Πρώτη ολοκληρωμένη έκδοση σε Python 3.0</li>
<li>2015-Δεκ-20 Αρχική, κατά προσέγγιση μετατροπή, σε Python 3.0</li>
</ul>
<h2 id="λεπτομέρειες-πνευματικών-δικαιωμάτων">Λεπτομέρειες πνευματικών δικαιωμάτων</h2>
<p>Πνευματικά δικαιώματα 2009- Dr. Charles R. Severance.</p>
<p>Αυτό το έργο χορηγείται με άδεια Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License. Αυτή η άδεια είναι διαθέσιμη στη διεύθυνση</p>
<p>http://creativecommons.org/licenses/by-nc-sa/3.0/</p>
<p>Μπορείτε να δείτε τι θεωρεί ο συγγραφέας εμπορικές και μη εμπορικές χρήσεις αυτού του υλικού καθώς και εξαιρέσεις αδειών στο Παράρτημα με τίτλο «Στοιχεία πνευματικών δικαιωμάτων».</p>
<h1 id="πρόλογος">Πρόλογος</h1>
<h2 id="ανασκευή-ενός-ανοιχτού-βιβλίου">Ανασκευή ενός “ανοιχτού” βιβλίου</h2>
<p>Είναι πολύ φυσικό για τους ακαδημαϊκούς, στους οποίους λένε συνεχώς «δημοσιεύστε ή χάνετε» να θέλουν να δημιουργούν πάντα κάτι από την αρχή, που να είναι το δικό τους, φρέσκο ​​δημιούργημα. Αυτό το βιβλίο είναι ένα πείραμα στο να μην ξεκινήσω από το μηδέν, αλλά αντίθετα να “αναμείξω” το βιβλίο με τίτλο <em>Think Python: How to Think Like a Computer Scientist</em>, που γράφτηκε από τους Allen B. Downey, Jeff Elkner και άλλους.</p>
<p>Τον Δεκέμβριο του 2009, ετοιμαζόμουν να διδάξω <em>SI502 - Networked Programming</em> στο Πανεπιστήμιο του Michigan, για πέμπτο συνεχόμενο εξάμηνο και αποφάσισα ότι ήρθε η ώρα να γράψω ένα εγχειρίδιο Python, που να επικεντρωνόταν στην διαχείριση δεδομένων αντί στην κατανόηση αλγορίθμων και στις αφαιρέσεις. Ο στόχος μου, στο SI502, είναι να διδάξω δεξιότητες δια βίου χειρισμού δεδομένων, χρησιμοποιώντας Python. Λίγοι από τους φοιτητές μου σχεδίαζαν να γίνουν επαγγελματίες προγραμματιστές υπολογιστών. Αντίθετα, σχεδίαζαν να γίνουν βιβλιοθηκονόμοι, διευθυντές, δικηγόροι, βιολόγοι, οικονομολόγοι κ.λπ., που έτυχε να θέλουν να χρησιμοποιήσουν επιδέξια την τεχνολογία, στον τομέα που επέλεξαν.</p>
<p>Δεν κατάφερα να βρω το τέλειο βιβλίο Python, με γνώμονα τα δεδομένα του μαθήματός μου, γι’ αυτό ξεκίνησα να γράψω ένα τέτοιο βιβλίο. Ευτυχώς σε μια συνεδρίαση της σχολής, τρεις εβδομάδες πριν ξεκινήσω το νέο μου βιβλίο από την αρχή κατά τη διάρκεια των διακοπών, ο Δρ. Atul Prakash μου έδειξε το βιβλίο <em>Think Python</em> που είχε χρησιμοποιήσει για να διδάξει το μάθημά του για την Python εκείνο το εξάμηνο. Είναι ένα καλογραμμένο κείμενο Επιστήμης Υπολογιστών με έμφαση σε σύντομες, άμεσες επεξηγήσεις και στη διευκόληνση της εκμάθησης.</p>
<p>Η συνολική δομή του βιβλίου έχει αλλάξει για να μπορεί κανείς να αντιμετωπίσει προβλήματα ανάλυσης δεδομένων, όσο το δυνατόν γρηγορότερα, και να έχει μια σειρά από παραδείγματα και ασκήσεις σχετικά με την ανάλυση δεδομένων από την αρχή.</p>
<p>Τα κεφάλαια 2–10 είναι παρόμοια με το βιβλίο <em>Think Python</em>, αλλά υπήρξαν σημαντικές αλλαγές. Παραδείγματα και ασκήσεις που προσανατολίζονται σε αριθμούς έχουν αντικατασταθεί με ασκήσεις προσανατολισμένες σε δεδομένα. Τα θέματα παρουσιάζονται με τη σειρά που απαιτείται για τη δημιουργία ολοένα και πιο εξελιγμένων λύσεων ανάλυσης δεδομένων. Ορισμένα θέματα όπως το <code>try</code> και <code>except</code> μεταφέρθηκαν και παρουσιάζονται ως μέρος του κεφαλαίου της δομής επιλογής. Οι συναρτήσεις αντιμετωπίζονται πολύ επιφανειακά, μέχρι να χρειαστούν για την αντιμετώπιση της πολυπλοκότητας του προγράμματος, αντί να εισαχθούν ως πρώιμο μάθημα αφαίρεσης. Σχεδόν όλες οι συναρτήσεις που καθορίζονται από τον χρήστη έχουν αφαιρεθεί από τον κώδικα των παραδειγμάτων και τις ασκήσεις, εκτός του Κεφαλαίου 4. Η λέξη “recursion (αναδρομή)”<a href="#fn1" class="footnote-ref" id="fnref1" role="doc-noteref"><sup>1</sup></a> δεν εμφανίζεται καθόλου στο βιβλίο.</p>
<p>Στα κεφάλαια 1 και 11–16, όλο το υλικό είναι ολοκαίνουργιο, εστιάζοντας σε πραγματικές χρήσεις και απλά παραδείγματα Python για ανάλυση δεδομένων, συμπεριλαμβανομένων των κανονικών εκφράσεων για αναζήτηση και ανάλυση, αυτοματοποίηση εργασιών στον υπολογιστή σας, ανάκτηση δεδομένων από όλο το δίκτυο. ιστοσυγκομιδή δεδομένων, αντικειμενοστραφή προγραμματισμό, χρήση διαδικτυακών υπηρεσιών, ανάλυση δεδομένων XML και JSON, δημιουργία και χρήση βάσεων δεδομένων με χρήση δομημένης γλώσσας ερωτημάτων και οπτικοποίηση δεδομένων.</p>
<p>Ο απώτερος στόχος όλων αυτών των αλλαγών είναι η στροφή από την Επιστήμη των Υπολογιστών στην Πληροφορική και η συμπερίληψη μόνο θεμάτων μιας πρώτης τάξεως τεχνολογίας, που μπορεί να είναι χρήσιμα ακόμα κι αν κάποιος επιλέξει να μην γίνει επαγγελματίας προγραμματιστής.</p>
<p>Οι μαθητές που βρίσκουν αυτό το βιβλίο ενδιαφέρον και θέλουν να το εξερευνήσουν περαιτέρω θα πρέπει να κοιτάξουν το βιβλίο <em>Think Python</em> του Allen B. Downey. Επειδή υπάρχει μεγάλη αλληλοεπικάλυψη μεταξύ των δύο βιβλίων, οι μαθητές θα αποκτήσουν γρήγορα δεξιότητες στους πρόσθετους τομείς του τεχνικού προγραμματισμού και της αλγοριθμικής σκέψης που καλύπτονται στο <em>Think Python</em>. Και δεδομένου ότι τα βιβλία έχουν παρόμοιο στυλ γραφής, θα πρέπει να μπορούν να μεταβούν γρήγορα στο <em>Think Python</em>, με ελάχιστη προσπάθεια.</p>
<p>  </p>
<p>Ως κάτοχος πνευματικών δικαιωμάτων του <em>Think Python</em>, ο Allen μου έδωσε την άδεια να αλλάξω την άδεια χρήσης του βιβλίου, για το υλικό από το βιβλίο του που παραμένει σε αυτό το βιβλίο, από την άδεια GNU Free Documentation στην πιο πρόσφατη άδεια Creative Commons Attribution — Share Alike. Αυτό ακολουθεί μια γενική αλλαγή στις άδειες ανοιχτής τεκμηρίωσης που μετακινούνται από το GFDL στο CC-BY-SA (π.χ. Wikipedia). Η χρήση της άδειας CC-BY-SA διατηρεί την ισχυρή παράδοση copyleft του βιβλίου, ενώ καθιστά ακόμη πιο απλό για τους νέους συγγραφείς να επαναχρησιμοποιήσουν αυτό το υλικό, όπως τους βολεύει.</p>
<p>Πιστεύω ότι αυτό το βιβλίο χρησιμεύει ως παράδειγμα του γιατί το ανοιχτό υλικό είναι τόσο σημαντικό για το μέλλον της εκπαίδευσης και θέλω να ευχαριστήσω τους Allen B. Downey και Cambridge University Press για τη καινοτόμα απόφασή τους, να διαθέσουν το βιβλίο με ανοιχτά πνευματικά δικαιώματα . Ελπίζω να είναι ευχαριστημένοι με τα αποτελέσματα των προσπαθειών μου και ελπίζω ότι εσείς, οι αναγνώστες, να είστε ευχαριστημένοι με τις συλλογικές <em>μας</em> προσπάθειες.</p>
<p>Θα ήθελα να ευχαριστήσω τους Allen B. Downey και Lauren Cowles για τη βοήθειά τους, την υπομονή και την καθοδήγησή τους στην αντιμετώπιση και επίλυση των ζητημάτων πνευματικών δικαιωμάτων γύρω από αυτό το βιβλίο.</p>
<p>Charles Severance<br />
www.dr-chuck.com<br />
Ann Arbor, MI, USA<br />
9 Σεπτεμβρίου 2013</p>
<p>Ο Charles Severance είναι Αναπληρωτής Κλινικός Καθηγητής στο University of Michigan School of Information.</p>
<section class="footnotes" role="doc-endnotes">
<hr />
<ol>
<li id="fn1" role="doc-endnote"><p>Εκτός, φυσικά, από αυτήν τη γραμμή.<a href="#fnref1" class="footnote-back" role="doc-backlink">↩︎</a></p></li>
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
