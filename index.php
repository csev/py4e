<?php
if ( isset($_POST['secret']) && ($_POST['secret'] == 'gr' || $_POST['secret'] == 'py4e') ) {
    setCookie('secret', '42', time() + 15 * 3600 * 24);
    header("Location: index.php");
    return;
} else if ( !isset($_COOKIE['secret']) || $_COOKIE['secret'] != '42' ) {
?>
<body style="font-family: sans-serif,Courier,monospace; width: 80%; max-width:650px;margin-left: auto; margin-right: auto;">
<center>
<h1 style="color:#0D47A1;">py4e - GR<br/>Python για Όλους</h1>
<form method="post">
    <input type="text" name="secret">
    <input type="submit" value="Unlock">
</form>
<div style="padding: bottom 10px; line-height: 1.6; letter-spacing: 0.1em;">
    <p>
        Η παρούσα σελίδα αποτελεί μετάφραση του επιτυχημένου μαθήματος <a href="https://www.py4e.com" target=target="_blank">Python for Everybody</a>
        του Charles R. Severance, γνωστού και ως <br><a href="http://www.dr-chuck.com/" target="_blank">Dr-Chuck</a>.
    </p>
    <p style="font-size: 18; color: red;">
        <img src="undercon.jpg" alt="developer typing by a \'under constraction\' sign" width="300" height="150"><br>
        <b>Προς το παρόν τελεί υπό κατασκευή</b>
    </p>
    <p>
        Αν θέλετε να περιηγηθείτε στην υπό κατασκευή σελίδα θα πρέπει να πληκτρολογήσετε έναν <b>κωδικό</b>!
        (βλέπε <a href="https://www.cc4e.com" target="_blank">CC4e</a>).<br>
        Ο κωδικός είναι σχετικός με τη σελίδα (δυο γράμματα, όλα κι όλα ή εναλλακτικά τέσσερα).
    </p>
    <p>
        <strong>Προσέξτε λίγο τον τίτλο!!</strong>
    </p>
        Αν πάλι βαριέστε τις δοκιμές μπορείτε να απολαύσετε μαθήματα του Dr. Chuck (στα αγγλικά)
        στους παρακάτω συνδέσμου: <br>
        <a href="https://www.py4e.com" target="_blank">Python</a>,
        <a href="https://www.dj4e.com" target="_blank">Django</a>,
        <a href="https://www.wa4e.com" target="_blank">PHP</a>, and
        <a href="https://www.pg4e.com" target="_blank">PostgreSQL</a>).<br>
        ή να ρίξετε μια ματιά στο <b>νέο μάθημά</b> του (επίσης υπό κατασκευή) το
        <a href="https://www.cc4e.com" target="_blank">CC4e</a>
    </p>
    <p style="font-size:70%;padding-top: 20px;letter-spacing: normal">
        Οποιαδήποτε πρόταση-διόρθωση είναι καλοδεχούμενη και μπορείτε να επικοινωνήσετε μαζί μου στο <a href="mailto:dinakiourtidou1@gmail.com? subject=py4e%20Feedback">Κωνσταντία Δ. Κιουρτίδου</a>.
    </p>
</div>
<script language="javascript">
    console.log('Ο κωδικός είναι σχετικός με τη γλώσσα της παρούσας σελίδας');
    console.log('αλλά και με το περιεχόμενο του μαθήματος');
</script>
</center>
<?php
    return;
}
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
