<?php
use \Tsugi\Core\LTIX;
use \Tsugi\UI\Output;

require_once "top.php";
require_once "nav.php";
?>
<div id="container">
<div style="margin-left: 10px; float:right">
<iframe width="400" height="225" src="https://www.youtube.com/embed/UjeNA_JtXME?rel=0" frameborder="0" allowfullscreen></iframe>
</div>
<h1>Python για Όλους</h1>
<?php if ( isset($_SESSION['id']) ) { ?>
<p>
Καλώς ορίσατε στον δωρεάν ιστότοπό μου για την Python για όλους.
Τώρα που έχετε συνδεθεί, έχετε πρόσβαση σε λειτουργίες τύπου-μαθήματος του συγκεκριμένου ιστότοπου.
<ul>
<li>
Καθώς προχωράτε στα <a href="lessons">Μαθήματα</a> της σειράς μαθημάτων θα βλέπετε επιπλέον
συνδέσμους για τους αυτόματους βαθμολογητές (autograders) της τάξης. Μπορείτε να δοκιμάσετε τους autograders και να λάβετε βαθμολογία.</li>
<li>
Μπορείτε να παρακολουθήσετε την πρόοδό σας μέσω του μαθήματος χρησιμοποιώντας την επιλογή <a href="assignments">Εργασίες</a>
και όταν ολοκληρώσετε μια ομάδα εργασιών, μπορείτε να κερδίσετε ένα <a href="badges">Badge - Σήμα</a>.
Μπορείτε να κατεβάσετε αυτά τα badges και να τα φιλοξενήσετε στον ιστότοπό σας ή να παραπέμψετε τις διευθύνσεις URL του σήματος σε αυτόν τον ιστότοπο.</li>
<li>
Εάν θέλετε να χρησιμοποιήσετε αυτά τα υλικά με άδεια Creative Commons στις δικές σας τάξεις, μπορείτε να κάνετε
<a href="materials.php">λήψη ή σύνδεση</a> στα περιεχόμενα αυτού του ιστότοπου, να
<a href="tsugi/cc/">εξάγετε το υλικό του μαθήματος</a> ως ένα
IMS Common Cartridge®, ή να κάνετε αίτηση για
ένα <a href="tsugi/admin/key/index.php">key και secret</a> IMS Learning Tools Interoperability® (LTI®)
για να ξεκινήσετε τους αυτόματους βαθμολογητές από το LMS σας.
</li>
</ul>
<?php } else { ?>
<p>
Αυτός ο ιστότοπος δημιουργεί ένα σύνολο από δωρεάν 
<a href="lessons">υλικό</a>, 
<a href="https://www.youtube.com/watch?v=UjeNA_JtXME&list=PLlRFEj9H3Oj7Bp8-DfGpfAfDBiblRfl5p&index=1" target="_blank">διαλέξεις</a>, 
<a href="book.php">βιβλίο</a>
και εργασίες για να βοηθήσει τους μαθητές να
μάθουν πως να προγραμματίζουν σε Python.
Μπορείτε να παρακολουθήσετε αυτό το μάθημα και να λάβετε ένα πιστοποιητικό από:
<ul>
<li><a href="https://www.coursera.org/specializations/python" target="_blank">Coursera: Python for Everybody Specialization</a> </li>
<li><a href="https://www.edx.org/bio/charles-severance" target="_blank">edX: Python for Everybody</a></li>
<li><a href="https://www.futurelearn.com/courses/programming-for-everybody-python" target="_blank">FutureLearn: Programming for Everybody (Getting Started with Python)</a></li>
</ul>
<p>
Εάν <a href="tsugi/login.php">συνδεθείτε</a> σε αυτόν τον ιστότοπο
θα έχετε συμμετάσχει σε ένα δωρεάν, παγκόσμιο
και ανοιχτό διαδικτυακό μάθημα. Θα έχετε ένα βιβλίο βαθμολογίας, εργασίες αυτόματης βαθμολόγησης, φόρουμ συζήτησης και μπορείτε να κερδίσετε
διακριτικά για τις προσπάθειές σας.</p>
<p>
Σε αυτόν τον ιστότοπο λαμβάνουμε σοβαρά υπόψη το απόρρητό σας, μπορείτε να ελέγξετε την
<a href="privacy">Πολιτική Απορρήτου</a> για περισσότερες λεπτομέρειες.
</p>
<p>
Εάν θέλετε να χρησιμοποιήσετε αυτό το υλικό
στα δικά σας μαθήματα μπορείτε να κατεβάσετε ή να συνδέσετε τα περιεχόμενα αυτού του ιστότοπου κάνοντας
<a href="tsugi/cc/">εξαγωγή του υλικού του μαθήματος</a> σαν ένα
IMS Common Cartridge®, ή κάνοντας αίτηση για 
ένα <a href="tsugi/admin/key/index.php">key και secret</a> IMS Learning Tools Interoperability® (LTI®)
για να ξεκινήσετε τους αυτόματους βαθμολογητές από το LMS σας.
</p>
<p>
Ο κωδικός για αυτόν τον ιστότοπο, συμπεριλαμβανομένων των αυτόματων βαθμολογητών, των διαφανειών και του περιεχομένου των μαθημάτων, είναι διαθέσιμος στο
<a href="https://github.com/csev/py4e" target="_blank">GitHub</a>.  Αυτό σημαίνει ότι μπορείτε να φτιάξετε το δικό σας
αντίγραφο του ιστότοπου του μαθήματος, να το δημοσιεύστε και να το αλλάξετε με όποιον τρόπο θέλετε.  Ακόμα πιο συναρπαστικό, θα μπορούσατε να μεταφράσετε
ολόκληρο τον ιστότοπο (μάθημα) στη γλώσσα σας και να τον δημοσιεύστε.  Έχω δώσει 
κάποιες <a href="https://github.com/csev/py4e/blob/master/TRANSLATION.md" target="_new">
οδηγίες για τον τρόπο μετάφρασης αυτού του μαθήματος</a> στο αποθετήριο (repository) μου στο GitHub.
</p>
<?php } ?>
Αυτός ο ιστότοπος χρησιμοποιεί το framework <a href="http://www.tsugi.org" target="_blank">Tsugi</a>
να ενσωματώσει ένα σύστημα διαχείρισης μάθησης και να
παράσχει τους αυτόματους βαθμολογητές.
Εάν ενδιαφέρεστε να συνεργαστείτε
για να δημιουργήσετε τέτοιου είδους ιστότοπους για τον εαυτό σας, δείτε την
ιστοσελίδα <a href="http://www.tsugi.org" target="_blank">tsugi.org</a> και/ή
επικοινωνήστε μαζί μου.
</p>
<p>
Και ναι, ο Dr Chuck έχει πραγματικά ένα αγωνιστικό αυτοκίνητο - ονομάζεται
<a href="https://www.sakaiger.com/sakaicar/" target=_blank">SakaiCar</a>.
Αγωνίζεται στο
<a href="https://www.24hoursoflemons.com" target="_blank">24 Hours of Lemons</a>.
</p>
<!--
<?php
echo(Output::safe_var_dump($_SESSION));
var_dump($USER);
?>
-->
</div>
<?php $OUTPUT->footer();
