<?php include("top.php");?>
<?php include("nav.php");?>
<div id="iframe-dialog" title="Read Only Dialog" style="display: none;">
   <iframe name="iframe-frame" style="height:600px" id="iframe-frame"
    src="<?= $OUTPUT->getSpinnerUrl() ?>"></iframe>
</div>
<div style="float: right; margin: 5px;"/><iframe style="width:120px;height:240px;" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" src="//ws-na.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&OneJS=1&Operation=GetAdHtml&MarketPlace=US&source=ss&ref=as_ss_li_til&ad_type=product_link&tracking_id=drchu02-20&marketplace=amazon&region=US&placement=1530051126&asins=1530051126&linkId=2ea6c883c6cf11f29568856139bad34b&show_border=true&link_opens_in_new_window=true"></iframe></div>
<h1>Χρήση αυτού του μαθήματος στο τοπικό σας LMS</h1>
<p>
   Μπορείτε να χρησιμοποιήσετε/επαναχρησιμοποιήσετε/αναμίξετε/διατηρήσετε το υλικό αυτού του ιστότοπου στα δικά σας μαθήματα.
   Σχεδόν όλο το υλικό σε αυτήν την ιστοσελίδα είναι Copyright Creative Commons Attribution. Αυτοί είναι σύνδεσμοι προς
   περιεχόμενο με δυνατότητα λήψης, καθώς και σύνδεσμοι προς άλλες πηγές αυτού του υλικού μαθημάτων.
</p>
<ul>
   <li>
      <p>
         Εάν το LMS σας υποστηρίζςι
         <a href="https://www.imsglobal.org/activity/learning-tools-interoperability" target="_blank">Διαλειτουργικότητα Εργαλείων Εκμάθησης IMS®</a> 
         έκδοση 1.x, μπορείτε να συνδεθείτε και να ζητήσετε πρόσβαση στα εργαλεία αυτού του ιστότοπου. Βεβαιωθείτε ότι έχετε σημειώσει εάν χρειάζεστε 
         ένα κλειδί LTI 1.x. Θα σας δοθούν οδηγίες για το πώς να χρησιμοποιήσετε τα διαπιστευτήριά σας μόλις λάβετε το κλειδί σας.
      </p>
   </li>
   <li>
      <p>
         <a href="#" title="Download course material"
         onclick="showModalIframeUrl(this.title, 'iframe-dialog', 'iframe-frame', 'tsugi/cc/select', _TSUGI.spinnerUrl, true); return false;" >
         Κατεβάστε το υλικό του μαθήματος </a> σαν <a href="https://www.imsglobal.org/cc/index.html" target="_blank">IMS Common Cartridge®</a>, 
         για εισαγωγή σε LMS όπως τα Sakai, Moodle, Canvas, Desire2Learn, Blackboard ή παρόμοια. Μετά τη φόρτωση του Cartridge, θα χρειαστείτε 
         ένα κλειδί LTI και ένα μυστικό για την παροχή των εργαλείων που βασίζονται σε LTI που παρέχονται σε αυτό το Cartridge.
      </p>
   </li>
   <li>
      <p>
         Εάν το LMS σας υποστηρίζει <a href="https://www.imsglobal.org/specs/lticiv1p0" target="_blank">
         Διαλειτουργικότητα Εργαλείων Εκμάθησης® Content-Item Message</a> μπορείτε να συνδεθείτε και να υποβάλετε αίτηση για κλειδί LTI 1.x και 
         μυστικό και να εγκαταστήσετε αυτόν τον ιστότοπο στο LMS σας ως App Store / Αποθήκη Αντικειμένων Μάθησης, που θα σας επιτρέψει να συντάξετε
         την τάξη σας στο LMS σας. Ενώ επιλέγετε εργαλεία και περιεχόμενο από αυτόν τον ιστότοπο, ένα στοιχείο κάθε φορά, Θα σας δοθούν οδηγίες για 
         το πώς να ρυθμίσετε το "κατάστημα εφαρμογών" στο LMS σας όταν λάβετε το κλειδί και το μυστικό σας.
      </p>
   </li>
   <li>
      <p>
         Εάν χρησιμοποιείτε <a href="https://classroom.google.com" target="_blank">Google Classroom</a>,
         μπορείτε να συνδέσετε αυτόματα τους πόρους σε αυτόν τον ιστότοπο στο Classroom σας με μια
         <a href="<?= $CFG->apphome ?>/lessons/intro?nostyle=yes">χαμηλής μορφοποίησης έκδοση των μαθημάτων</a>. (πρέπει να συνδεθείτε)
      </p>
   </li>
   <li>
      <p>
         Εάν το LMS σας δεν υποστηρίζει ούτε Content Item, ούτε Common Cartridge, αλλά υποστηρίζει LTI, μπορείτε να αντιγράψετε χειροκίνητα 
         τους συνδέσμους από αυτό το υλικό μαθημάτων στο LMS σας έναν προς έναν. Έχουμε μια <a href="<?= $CFG-> apphome?>/Derss/intro? Nostyle = yes "> 
         ειδική προβολή των μαθημάτων σε χαμηλό στυλ </a> για να κάνουμε αυτήν την αντιγραφή με το χέρι τόσο εύκολη όσο μπορεί να είναι.
      </p>
   </li>
</ul>
<p>
   <b><a href="courses">Μαθήματα/ιστοσελίδες που μπορούν να χρησιμοποιήσουν αυτό το υλικό</a></b>
</p>
<p>
   Αυτός ο ιστότοπος χρησιμοποιεί το λογισμικό <a href="http://www.tsugi.org/" target="_blank"> Tsugi </a> για να φιλοξενήσει τους αυτόματους βαθμολογητές 
   και για να παρέχει αυτό το υλικό, ώστε να μπορεί εύκολα ενσωματωμένο σε ένα Σύστημα Διαχείρισης Εκμάθησης όπως <a href="http://www.sakaiproject.org/" target="_blank">
   Sakai </a>, Moodle, Canvas, Desire2Learn, Blackboard ή παρόμοια.
</p>
<h1>Σύνδεσμοι για το υλικό των μαθημάτων</h1>
<ul>
    <li>Βίντεο-Διαλέξεις
       <ul>
          <li><a href="https://www.youtube.com/playlist?list=PLlRFEj9H3Oj7Bp8-DfGpfAfDBiblRfl5p" target="_blank">YouTube Playlist</a></li>
          <li><a href="https://itunes.apple.com/us/podcast/python-for-everybody-video/id1214664324" target="_blank">iTunes Video</a></li>
          <li><a href="http://amzn.to/2mFrCuh" target="_blank">Amazon Prime Video</a></li>
       </ul>
    </li>
    <li>Ηχητικές Διαλέξεις
       <ul>
         <li><a href="https://itunes.apple.com/us/podcast/python-for-everybody-audio-py4e/id1214665693" target="_blank">iTunes Audio</a></li>
         <li><a href="https://play.google.com/music/listen?u=0#/ps/Ijgj3aofh6m73rps4wtdk6djhv4" target="_blank">Google Play Audio</a></li>
      </ul>
    </li>
    <li>
        <a href="lectures3/gr/" target="_blank">Διαφάνειες Διαλέξεων και Φυλλάδια</a>
    </li>
    <li>
        <a href="code3.zip" target="_blank">Δείγμα Κώδικα ZIP</a>
        (<a href="code3/" target="_blank">Μεμονωμένα Αρχεία</a>)
    </li>
    <li>
        <a href="book.php">Δωρεάν Εγχειρίδιο</a>
    </li>
    <li>
        Όλο το περιεχόμενο του μαθήματος και το λογισμικό αυτόματης βαθμολόγησης είναι διαθέσιμα στο <a href="https://github.com/csev/py4e" target="_blank">
        Github</a> υπό άδεια Creative Commons ή Apache 2.0.
    </li>
</ul>
<p>
   Εάν ενδιαφέρεστε για τη μετάφραση του βιβλίου ή άλλων διαδικτυακών υλικών σε άλλη γλώσσα, σας έχω δώσει 
   <a href = "https://github.com/csev/py4e/blob/master/TRANSLATION.md" target = "_ new" > οδηγίες σχετικά με τον τρόπο μετάφρασης αυτού του μαθήματος </a> 
   στο αποθετήριο μου στο GitHub .
   Εάν ξεκινάτε μια μετάφραση, επικοινωνήστε μαζί μου για να συντονίσουμε τις δραστηριότητές μας.
</p>
<h1>Αρχείο Ήχου</h1>
<p>
   Εδώ είναι βρίσκονται, αρχειοθετημένες, οι <a href="https://archive.org/details/201509UMSI502Podcasts_201601" target="_blank"> ζωντανές ηχογραφήσεις διαλέξεων </a>
   από το SI502 όπως διδάχθηκε στην πανεπιστημιούπολη του UM School of Information το Φθινόπωρο του 2015.
</p>


<?php include("footer.php"); ?>

