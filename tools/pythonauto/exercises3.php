<?php

$EXERCISES =
Array(
"hello" => Array (
"qtext" => "Γράψτε ένα πρόγραμμα που χρησιμοποιεί μια εντολή <b>print</b> για να πει 'hello world' όπως φαίνεται στην 'Επιθυμητή έξοδο'.",
"desired" => "hello world",
"code" => '# ο παρακάτω κώδικας σχεδόν λειτουργεί
prinq("hello world")',
"checks" => Array(
"print" => "Πρέπει να χρησιμοποιήσετε μια εντολή print στον κώδικά σας."
)),

"loop" => Array (
"qtext" => "Γράψτε ένα πρόγραμμα, που χρησιμοποιεί έναν βρόχο <b>for</b> και την ενσωματωμένη συνάρτηση
<b>range</b> για να γράψει τρεις αριθμούς όπως φαίνεται στην 'Επιθυμητή έξοδο'.",
"desired" => "0
1
2",
"code" => 'print(range(3))',
"checks" => Array(
"for" => "Πρέπει να παράγετε τους αριθμούς χρησιμοποιώντας έναν βρόχο for.",
"print" => "Πρέπει να χρησιμοποιήσετε μια δήλωση print εντός του βρόχου.",
"range" => "Θα πρέπει να χρησιμοποιήσετε τη συνάρτηση range για να 
δημιουργήσετε τη λίστα αριθμών στη δήλωση for.",
":" => "Η δήλωση for πρέπει να τελειώνει με άνω κάτω τελεία (:) και η 
επόμενη γραμμή πρέπει να έχει εσοχή"
)),

"2.2" => Array (
"qtext" => "<b>2.2</b> Γράψτε ένα πρόγραμμα που χρησιμοποιεί την <b>input</b>
για να ζητά από το χρήστη το όνομά του και στη συνέχεια τον καλωσορίζει.
Λάβετε υπόψη ότι η <b>input</b> θα εμφανίσει ένα παράθυρο διαλόγου.
Εισαγάγετε το <b> Sarah </b> στο αναδυόμενο πλαίσιο όταν σας ζητηθεί,
ώστε η έξοδός σας να ταιριάζει με την επιθυμητή έξοδο. ",
"desired" => "Hello Sarah",
"code" => '# Ο παρακάτω κώδικας σχεδόν λειτουργεί

name = input("Enter your name: ")
print("Howdy ")',
"checks" => Array(
"input" => "Πρέπει να ζητήσετε το όνομα του χρήστη χρησιμοποιώντας τη συνάρτηση input().",
"!Sarah" => "Πρέπει πραγματικά να ζητήσετε το όνομα του χρήστη",
"print" => "Πρέπει να χρησιμοποιήσετε την εντολή print για να εκτυπώσετε τη σωστή έξοδο."
)),

"2.3" => Array(
"qtext" => "<b>2.3</b> Γράψτε ένα πρόγραμμα που προτρέπει τον χρήστη
να εισάγει ώρες και ωρομίσθιο και να υπολογίζει και να εκτυπώνει τον
ακαθάριστο μισθό του. Εισάγετε 35 ώρες και ωρομίσθιο 2.75 για να ελέγξετε το
πρόγραμμα (ο μισθός θα πρέπει να είναι 96.25). Θα πρέπει να χρησιμοποιήσετε το 
<b>input</b> για να διαβάσετε τη συμβολοσειρά και το <b>float()</b> για να
μετατρέψετε τη συμβολοσειρά σε αριθμό. Μην ασχοληθείτε με τον έλεγχο σφαλμάτων
- υποθέστε ότι ο χρήστης πληκτρολογεί τους αριθμούς σωστά.",
"desired" => "Pay: 96.25",
"code" => '# Η πρώτη γραμμή του προγράμματος σας δίνεται έτοιμη

hrs = input("Enter Hours:")',
"checks" => Array(
"input" => "Πρέπει να ζητήσετε την εισαγωγή των ωρών και του ωρομισθίου χρησιμοποιώντας την συνάρτηση input().",
"print" => "Πρέπει να χρησιμοποιήσετε την εντολή print για να εκτυπώσετε τη σωστή έξοδο.",
"float" => "Πρέπει να χρησιμοποιήσετε την ενσωματωμένη συνάρτηση float() για να μετατρέψετε τη συμβολοσειρά σε αριθμό.",
"*" => "Για να πολλαπλασιάσετε τις ώρες με το ωρομίσθιο, μετά την ανάγνωσή τους, χρησιμοποιήστε τον τελεστή '*'.",
"!35" => "Δεν πρέπει να συμπεριλάβετε τα δεδομένα εισόδου στον κώδικά σας. Πρέπει να διαβάσετε τις τιμές για τις ώρες και το ωρομίσθιο χρησιμοποιώντας το input().",
"!2.75" => "Δεν πρέπει να συμπεριλάβετε τα δεδομένα εισόδου στον κώδικά σας. Πρέπει να διαβάσετε τις τιμές για τις ώρες και το ωρομίσθιο χρησιμοποιώντας το input().",
"!96.25" => "Πρέπει πραγματικά να υπολογίσετε τον μισθό.")),


"3.1" => Array(
"qtext" => "<b>3.1</b> Γράψτε ένα πρόγραμμα που προτρέπει τον χρήστη 
να εισάγει ώρες και ωρομίσθιο και να υπολογίζει τον μεικτό μισθό του.
Ο μισθός υπολογίζεται με το ωρομίσθιο για τις πρώτες 40 ώρες και 
1.5 φορά το ωρομίσθιο για όλες τις υπόλοιπες ώρες, μετά τις πρώτες 40 ώρες. 
Για να ελέγξετε το πρόγραμμά σας χρησιμοποιήστε το 45 για τις ώρες και για το ωρομίσθιο 10.50
(ο μισθός που θα προκύψει θα πρέπει να είναι 498.75). 
Πρέπει να χρησιμοποιήσετε το <b>input</b>
για να διαβάσετε τη συμβολοσειρά και <b>float()</b> για να μετατρέψετε τη
συμβολοσειρά σε αριθμό. Μην ασχοληθείτε με τον έλεγχο σφαλμάτων - υποθέστε ότι
ο χρήστης πληκτρολογεί τους αριθμούς σωστά.",
"desired" => "498.75",
"desired2" => "Pay: 498.75",
"code" => 'hrs = input("Enter Hours:")
h = float(hrs)',
"checks" => Array(
"input" => "Πρέπει να ζητήσετε την εισαγωγή των ωρών και του ωρομισθίου χρησιμοποιώντας την συνάρτηση input().",
"print" => "Πρέπει να χρησιμοποιήσετε την εντολή print για να εκτυπώσετε τη σωστή έξοδο στο output.",
"if" => "Πρέπει να χρησιμοποιείσετε την εντολή if για να αποφασίσετε αν θα υπολογιστούν υπερωρίες ή όχι.",
"float" => "Πρέπει να χρησιμοποιήσετε την ενσωματωμένη συνάρτηση float() για να μετατρέψετε τη συμβολοσειρά σε έναν αριθμό.",
"!45" => "Πρέπει να διαβάσετε από το πληκτρολόγιο τα δεδομένα χρησιμοποιώντας την input() και στη συνέχεια να τα μετατρέψετε στον κατάλληλο τύπο. Το νούμερο '45' δεν πρέπει να περιέχεται στο πρόγραμμά σας.",
"!10.5" => "Πρέπει να διαβάσετε από το πληκτρολόγιο τα δεδομένα χρησιμοποιώντας την input() και στη συνέχεια να τα μετατρέψετε στον κατάλληλο τύπο.",
"!498" => "Πρέπει πραγματικά να υπολογίσετε τον μισθό.")),

"3.3" => Array(
"qtext" => "<b>3.3</b> Γράψτε ένα πρόγραμμα που ζητά έναν βαθμό μεταξύ 0.0 και
1.0. Αν ο βαθμός είναι εκτός ορίων, εμφανίζει ένα μήνυμα λάθους. Αν ο βαθμός
είναι μεταξύ 0.0 και 1.0, εκτυπώνει την αντίστοιχη αξιολόγηση με βάση τον ακόλουθο πίνακα:<br/>
Βαθμός  Αξιολόγηση<br/>
>= 0.9     A<br/>
>= 0.8     B<br/>
>= 0.7     C<br/>
>= 0.6     D<br/>
< 0.6      F<br/>
Εάν ο χρήστης εισάγει μια τιμή εκτός ορίων, εκτυπώστε ένα κατάλληλο μήνυμα σφάλματος
και βγείτε. Για να ελέγξετε το πρόγραμμά σας, εισαγάγετε ως βαθμολογία το 0.85.
",
"desired" => "Β",
"code" => 'score = input("Enter Score: ")',
"checks" => Array(
"input" => "Πρέπει να ζητήσετε το βαθμό χρησιμοποιώντας την συνάρτηση input().",
"float" => "Πρέπει να χρησιμοποιήσετε την ενσωματωμένη συνάρτηση float() για να μετατρέψετε τη συμβολοσειρά σε αριθμό.",
"print" => "Πρέπει να χρησιμοποιήσετε την εντολή print για να εμφανίσετε το αποτέλεσμα.",
"if" => "Πρέπει να χρησιμοποιείσετε μια εντολή if για να ελέγξετε την τιμή του βαθμού.",
"elif" => "Ένας από τους μαθησιακούς στόχους αυτής της εργασίας είναι η χρήση μιας εντολής elif, κατά τον έλεγχο της βαθμολογίας.")
),

"4.6" => Array(
"qtext" => "<b>4.6</b> Γράψτε ένα πρόγραμμα που προτρέπει τον χρήστη 
να εισάγει ώρες και ωρομίσθιο και υπολογίζει τον μεικτό μισθό του.
Ο μισθός υπολογίζεται με το ωρομίσθιο για τις πρώτες 40 ώρες και 
1.5 φορά το ωρομίσθιο για όλες τις υπόλοιπες ώρες, μετά τις πρώτες 40 ώρες. 
Τοποθετήστε τη λογική του υπολογισμού σε μια συνάρτηση με όνομα <b>computepay()</b>
και καλέστε τη συνάρτηση για να εκτελέσει τον υπολογισμό. Η συνάρτηση πρέπει να
επιστρέφει μια τιμή. Χρησιμοποιήστε 45 ώρες και ωρομίσθιο 10.50 την ώρα για να
ελέγξετε το πρόγραμμα (ο μεικτός μισθός πρέπει να είναι 498.75).
Πρέπει να χρησιμοποιήσετε την <b>input</b> για να διαβάσετε τη συμβολοσειρά και
το <b>float()</b> για να μετατρέψετε τη συμβολοσειρά σε αριθμό.
Μην ασχοληθείτε με τον έλεγχο σφαλμάτων - υποθέστε ότι ο χρήστης πληκτρολογεί
τους αριθμούς σωστά.  Μην ονομάσετε την μεταβλητή σας sum και μη
χρησιμοποιήσετε τη συνάρτηση sum().
",
"desired" => "Pay 498.75",
"code" => 'def computepay(h, r):
    return 42.37

hrs = input("Enter Hours:")
p = computepay(10, 20)
print("Pay", p)',
"checks" => Array(
"input" => "Πρέπει να ζητήσετε τις ώρες και το ωρομίσθιο χρησιμοποιώντας τη συνάρτηση input().",
"print" => "Πρέπει να χρησιμοποιήσετε τη συνάρτηση print για να εκτυπώσετε το αποτέλεσμα.",
"!45" => "Πρέπει να ζητήσετε την πληκτρολόγηση των δεδομένων.",
"!10.5" => "Πρέπει να ζητήσετε την πληκτρολόγηση των δεδομένων.",
"if" => "Πρέπει να χρησιμοποιήσετε μια εντολή if για να αποφασίσετε αν θα υπολογίσετε υπερωρίες ή όχι.",
"float" => "Πρέπει να χρησιμοποιήσετε την ενσωματωμένη συνάρτηση float() για να μετατρέψετε ένα string σε float.",
"def" => "Πρέπει να χρησιμοποιήσετε μια συνάρτηση με όνομα computepay που θα κάνει τον υπολογισμό.",
"!sum(" => "Μην χρησιμοποιείτε μεταβλητή με το όνομα sum ή συνάρτηση sum()",
"return" => "Πρέπει να χρησιμοποιήσετε μια δήλωση return για να επιστρέψετε τον υπολογισμένο μισθό πίσω στο κυρίως πρόγραμμα.",
"computepay" => "Πρέπει να χρησιμοποιήσετε μια συνάρτηση με το όνομα computepay για να κάνετε τον υπολογισμό.",
"!475" => "Πρέπει πραγματικά να υπολογίσετε την αμοιβή.")
),

"5.2" => Array(
"qtext" => "<b>5.2</b> Γράψτε ένα πρόγραμμα που προτρέπει για την εισαγωγή ακεραίων αριθμων
μέχρι ο χρήστης να εισάγει 'done'.  Όταν εισαχθεί 'done', να εκτυπώνει τον μεγαλύτερο και τον μικρότερο
από τους αριθμούς που δόθηκαν.  Αν ο χρήστης εισάγει οτιδήποτε άλλο εκτός από έγκυρο αριθμό, εντοπίστε το
με ένα try/except, εμφανίστε το μήνυμα 'Invalid input' και αγνοήστε την είσοδο.
Εισάγετε 7, 2, bob, 10,  και 4 και παράξτε την παρακάτω έξοδο.
",
"desired" => "Invalid input
Maximum is 10
Minimum is 2",
"code" => 'largest = None
smallest = None
while True:
    num = input("Enter a number: ")
    if num == "done":
        break
    print(num)

print("Maximum", largest)',
"checks" => Array(
"input" => "Πρέπει να ζητήσετε τους αριθμούς χρησιμοποιώντας τη συνάρτηση input().",
"print" => "Πρέπει να χρησιμοποιήσετε τη συνάρτηση print για να εκτυπώσετε το αποτέλεσμα.",
"while" => "Πρέπει να χρησιμοποιήσετε μια εντολή while για να διαβάσετε τους αριθμούς.",
"int" => "Πρέπει να χρησιμοποιήσετε τη συνάρτηση int() για την μετατροπή από string σε integer.",
"! 2" => "Πρέπει πραγματικά να υπολογίσετε το μέγιστο και το ελάχιστο.",
"!=2" => "Πρέπει πραγματικά να υπολογίσετε το μέγιστο και το ελάχιστο.",
"! 10" => "Πρέπει πραγματικά να υπολογίσετε το μέγιστο και το ελάχιστο.",
"!=10" => "Πρέπει πραγματικά να υπολογίσετε το μέγιστο και το ελάχιστο.",
"try" => "Πρέπει να διαχειριστείτε τους μη ακεραίους χρησιμοποιώντας μια δομή try/except.",
"except" => "Πρέπει να διαχειριστείτε τους μη ακεραίους χρησιμοποιώντας μια δομή try/except.")
),

"6.5" => Array(
"qtext" => "<b>6.5</b> Γράψτε ένα πρόγραμμα χρησιμοποιώντας την find() και τον τελεστή διαμέρισης (βλέπε ενότητα 6.10)
για να εξάγετε τον αριθμό από το τέλος της παρακάτω γραμμής. Μετατρέψτε την εξαχθήσα τιμή σε αριθμό κινητής υποδιαστολής
(float) και εκτυπώστε την.",
"desired" => "0.8475",
"code" => 'text = "X-DSPAM-Confidence:    0.8475"',
"checks" => Array(
"find" => "Πρέπει να χρησιμοποιήσετε τη συνάρτηση find για να πάρετε τη θέση της υποδιαστολής μέσα στη συμβολοσειρά (string).",
":" => "Πρέπει να χρησιμοποιήσετε διαμέριση συμβολοσειρών [n:m] για να εξάγετε τα δεδομένα από τη συμβολοσειρά.",
"float" => "Πρέπει να χρησιμοποιήσετε τη συνάρτηση float() για να μετατρέψετε την string σε float.",
'!"0.8475"' =>  "Πρέπει πραγματικά να εξάγετε τα δεδομένα από τη συμβολοσειρά.")
),

"fopen" => Array(
"qtext" => 'This Python program opens the file
"mbox-short.txt" and counts the number of lines in the file.',
"desired" => "1910 Lines",
"code" => 'fh = open("mbox-short.txt", "r")

count = 0
for line in fh:
   count = count + 1

print(count,"Lines")
'
),

"7.1" => Array(
"qtext" => "<b>7.1</b> Γράψτε ένα πρόγραμμα που ζητά ένα όνομα αρχείου, έπειτα ανοίγει το αρχείο αυτό,
διαβάζει το σύνολο του αρχείου και εκτυπώνει το περιεχόμενό του σε κεφαλαία. Χρησιμοποιήστε
το αρχείο <b>words.txt</b> για να παράξετε την παρακάτω έξοδο.".
'<p>
Μπορείτε να κατεβάσετε το δείγμα δεδομένων στο
<a href="http://www.gr.py4e.com/code3/words.txt" target="_blank">
http://www.gr.py4e.com/code3/words.txt</a>',
"desired" => "WRITING PROGRAMS OR PROGRAMMING IS A VERY CREATIVE
AND REWARDING ACTIVITY  YOU CAN WRITE PROGRAMS FOR
MANY REASONS RANGING FROM MAKING YOUR LIVING TO SOLVING
A DIFFICULT DATA ANALYSIS PROBLEM TO HAVING FUN TO HELPING
SOMEONE ELSE SOLVE A PROBLEM  THIS BOOK ASSUMES THAT
{\EM EVERYONE} NEEDS TO KNOW HOW TO PROGRAM AND THAT ONCE
YOU KNOW HOW TO PROGRAM, YOU WILL FIGURE OUT WHAT YOU WANT
TO DO WITH YOUR NEWFOUND SKILLS

WE ARE SURROUNDED IN OUR DAILY LIVES WITH COMPUTERS RANGING
FROM LAPTOPS TO CELL PHONES  WE CAN THINK OF THESE COMPUTERS
AS OUR PERSONAL ASSISTANTS WHO CAN TAKE CARE OF MANY THINGS
ON OUR BEHALF  THE HARDWARE IN OUR CURRENT-DAY COMPUTERS
IS ESSENTIALLY BUILT TO CONTINUOUSLY AS US THE QUESTION
WHAT WOULD YOU LIKE ME TO DO NEXT

OUR COMPUTERS ARE FAST AND HAVE VASTS AMOUNTS OF MEMORY AND
COULD BE VERY HELPFUL TO US IF WE ONLY KNEW THE LANGUAGE TO
SPEAK TO EXPLAIN TO THE COMPUTER WHAT WE WOULD LIKE IT TO
DO NEXT IF WE KNEW THIS LANGUAGE WE COULD TELL THE
COMPUTER TO DO TASKS ON OUR BEHALF THAT WERE REPTITIVE
INTERESTINGLY, THE KINDS OF THINGS COMPUTERS CAN DO BEST
ARE OFTEN THE KINDS OF THINGS THAT WE HUMANS FIND BORING
AND MIND-NUMBING",
"code" => '# Use words.txt as the file name
fname = input("Enter file name: ")
fh = open(fname)
',
"xcode" => '# Use words.txt as the file name
fname = input("Enter file name: ")
fh = open(fname)
text = fh.read().strip()
print(text.upper())
',
"checks" => Array(
"input" => "You must prompt for the file name using the input() function.",
"open" => "You need to use open() to open the file.",
"print" => "You must use the print statement to print the lines.",
"strip" => "You should use strip() or rstrip() to avoid double newlines.  You may need to scroll down to see a mis-match of the output.",
"upper" => "You should use the upper() function to convert the lines to upper case.")
),

"7.2" => Array(
"qtext" => '<b>7.2</b> Γράψτε ένα πρόγραμμα που ζητά ένα όνομα αρχείου, έπειτα ανοίγει το αρχείο αυτό,
διαβάζει το σύνολο του αρχείου αναζητώντας τις γραμμές της μορφής:
<pre>
X-DSPAM-Confidence:    0.8475
</pre>
Μετρήστε αυτές τις γραμμές, εξάγετε τις τιμές κινητής υποδιαστολής από καθεμία
από τις γραμμές, υπολογίστε τον μέσο όρο αυτών των τιμών και δημιουργήστε μια έξοδο
όπως φαίνεται παρακάτω. Μην χρησιμοποιήσετε τη συνάρτηση sum() ή μια μεταβλητή με
όνομα sum στη λύση σας.
<p>
Μπορείτε να κατεβάσετε το δείγμα δεδομένων στο
<a href="http://www.gr.py4e.com/code3/mbox-short.txt" target="_blank">
http://www.gr.py4e.com/code3/mbox-short.txt</a> όταν εκτελέσετε τον κώδικα, εισάγετε
 <b>mbox-short.txt</b> ως όνομα του αρχείου.',
"desired" => "Average spam confidence: 0.7507185185185187",
"code" => '# Use the file name mbox-short.txt as the file name
fname = input("Enter file name: ")
fh = open(fname)
for line in fh:
    if not line.startswith("X-DSPAM-Confidence:"):
        continue
    print(line)
print("Done")
',
"xcode" => '# Use the file name mbox-short.txt as the file name
fname = input("Enter file name: ")
fh = open(fname)
tot = 0.0
count = 0
for line in fh:
    if not line.startswith("X-DSPAM-Confidence:") : continue
    words = line.split()
    tot = tot + float(words[1])
    count = count + 1
print("Average spam confidence:", tot/count)
',
"checks" => Array(
"input" => "Πρέπει να ζητήσετε το όνομα αρχείου χρησιμοποιώντας τη συνάρτηση input().",
"open" => "Πρέπει να χρησιμοποιήσετε την open() για να ανοίξετε το αρχείο.",
"!sum" => "Δεν πρέπει να χρησιμοποιήσετε τη συνάρτηση sum() και αποφύγετε τη χρήση μεταβλητής με το όνομα sum.",
"float" => "Πρέπει να χρησιμοποιήσετε τη συνάρτηση float() για να μετατρέψετε μια string σε float.",
'!18518' =>  "Πρέπει πραγματικά να εξάγετε τα δεδομένα από τη συμβολοσειρά και να τα μετατρέψετε.",
"/" => "Ο μέσος όρος ουσιαστικά είναι το σύνολο / πλήθος.")
),

"8.4" => Array(
"qtext" => '<b>8.4</b> Ανοίξτε το αρχείο <b>romeo.txt</b> και διαβάστε το γραμμή - γραμμή.
Για κάθε γραμμή, χωρίστε την σε μια λίστα λέξεων χρησιμοποιώντας τη συνάρτηση <b>split</b>.
Για κάθε λέξη, κάθε γραμμής, ελέγξτε αν η λέξη περιέχεται ήδη στη λίστα και αν όχι προσθέστε
την στη λίστα. Όταν ολοκληρωθεί το πρόγραμμα, ταξινομήστε, τις λέξεις με τη sort(), και εκτυπώστε
τις όπως εμφανίζονται στην επιθυμητή έξοσο.
<p>Μπορείτε να κατεβάσετε το δείγμα δεδομένων στο
<a href="http://www.gr.py4e.com/code3/romeo.txt" target="_blank">
http://www.gr.py4e.com/code3/romeo.txt</a>',
"desired" => "['Arise', 'But', 'It', 'Juliet', 'Who', 'already', 'and', 'breaks', 'east', 'envious', 'fair', 'grief', 'is', 'kill', 'light', 'moon', 'pale', 'sick', 'soft', 'sun', 'the', 'through', 'what', 'window', 'with', 'yonder']",
"code" => 'fname = input("Enter file name: ")
fh = open(fname)
lst = list()
for line in fh:
print(line.rstrip())
',
"xcode" => 'fname = input("Enter file name: ")
fh = open(fname)
lst = list()
for line in fh:
    words = line.split()
    for word in words:
        if word in lst: continue
        lst.append(word)
lst.sort()
print(lst)
',
"checks" => Array(
"split" => "Πρέπει να χρησιμοποιήσετε την split() για να διασπάσετε τη γραμμή σε λέξεις.",
"append" => "Πρέπει να χρησιμοποιήσετε την append() για να προσθέσετε τη λέξη στη λίστα, αν δεν περιέχεται ήδη.",
"!extend" => "Δεν πρέπει να χρησιμοποιήσετε την extend() σε αυτή την εργασία.",
"open" => "Πρέπει να χρησιμοποιήσετε την open() για να ανοίξετε το αρχείο.",
"sort" => "Πρέπει να χρησιμοποιήσετε την sort() για να ταξινομήσετε τη λίστα, πριν την εμφανίσετε.",
"!'yonder'" => "Δεν πρέπει να προσθέσετε εσείς τα δεδομένα εξόδου στη συμβολοσειρά.",
"!.remove(" => "Δεν πρέπει να χρησιμοποιήσετε τη μέθοδο remove().",
"!.set(" => "Δεν πρέπει να χρησιμοποιήσετε τη μέθοδο set().",
"for" => "Χρειάζονται δύο βρόχοι for. Ένα για τις γραμμές και ένα γα τις λέξεις κάθε γραμμής.")
),

"8.5" => Array(
"qtext" => "<b>8.5</b> Ανοίξτε το αρχεί <b>mbox-short.txt</b> και διαβάστε το γραμμή - γραμμή.
Όταν βρείτε μία γραμμή που αρχίζει με 'From ' όπως η ακόλουθη γραμμή:
<pre>
From stephen.marquard@uct.ac.za Sat Jan  5 09:14:16 2008
</pre>
αναλύστε τη γραμμή του From χρησιμοποιώντας τη split() και εκτυπώστε τη δεύτερη λέξη της γραμμής
(δηλ. ολόκληρη τη διεύθυνση του ατόμου που έστειλε το μήνυμα). Τέλος εκτυπώστε το πλήθος τους.
<p>
<b>Βοήθεια:</b> φροντίστε να μην συμπεριλάβετε τις γραμμές που ξεκινούν με 'From:'. Δείτε επίσης την
τελευταία γραμμή τhw ενδεικτικής εξόδου για να δείτε πώς να εκτυπώσετε το πλήθος.".
'<p>
Μπορείτε να κατεβάσετε το δείγμα δεδομένων στο
<a href="http://www.gr.py4e.com/code3/mbox-short.txt" target="_blank">
http://www.gr.py4e.com/code3/mbox-short.txt</a>',
"desired" => "stephen.marquard@uct.ac.za
louis@media.berkeley.edu
zqian@umich.edu
rjlowe@iupui.edu
zqian@umich.edu
rjlowe@iupui.edu
cwen@iupui.edu
cwen@iupui.edu
gsilver@umich.edu
gsilver@umich.edu
zqian@umich.edu
gsilver@umich.edu
wagnermr@iupui.edu
zqian@umich.edu
antranig@caret.cam.ac.uk
gopal.ramasammycook@gmail.com
david.horwitz@uct.ac.za
david.horwitz@uct.ac.za
david.horwitz@uct.ac.za
david.horwitz@uct.ac.za
stephen.marquard@uct.ac.za
louis@media.berkeley.edu
louis@media.berkeley.edu
ray@media.berkeley.edu
cwen@iupui.edu
cwen@iupui.edu
cwen@iupui.edu
There were 27 lines in the file with From as the first word",
"code" => 'fname = input("Enter file name: ")
if len(fname) < 1:
    fname = "mbox-short.txt"

fh = open(fname)
count = 0

print("There were", count, "lines in the file with From as the first word")
',
"xcode" => 'fname = input("Enter file name: ")
if len(fname) < 1 : fname = "mbox-short.txt"

fh = open(fname)
count = 0
for line in fh:
    wds = line.split()
    if len(wds) < 2 : continue
    if wds[0] != "From" : continue
    print(wds[1])
    count = count + 1
print("There were", count, "lines in the file with From as the first word")
',
"checks" => Array(
"for" => "Χρειάζεστε έναν βρόχο for για να διαβάσετε τις γραμμές του αρχείου.",
"split" => "Θα πρέπει να χρησιμοποιήσετε τη split() για να σπάσετε κάθε γραμμή σε λέξεις.",
"if" => "Πρέπει να χρησιμοποιήσετε μία ή περισσότερες προτάσεις if για να παραλείψετε τις γραμμές που δεν ξεκινούν με 'From '.",
"open" => "Πρέπει να χρησιμοποιήσετε την open() για να ανοίξετε το αρχείο.")
),

"9.4" => Array(
"qtext" => "<b>9.4</b> Γράψτε ένα πρόγραμμα για να διαβάσετε το <b>mbox-short.txt</b> και
εντοπίστε ποιος έχει στείλει τον μεγαλύτερο αριθμό μηνυμάτων αλληλογραφίας. Το πρόγραμμα
πρέπει να αναζητά τις γραμμές 'From ' και παίρνει τη δεύτερη λέξη αυτών των γραμμών ως το
άτομο που έστειλε το μήνυμα. Το πρόγραμμα δημιουργεί ένα λεξικό Python, που αντιστοιχίζει
τη διεύθυνση αλληλογραφίας του αποστολέα με τη συχνότητα εμφάνισής του στο αρχείο.
Μετά την παραγωγή του λεξικού, το πρόγραμμα διαβάζει το λεξικό αυτό, χρησιμοποιώντας έναν
βρόχο μεγίστου, για να βρει τον πιο συχνά εμφανιζόμενο αποστολέα.",
"desired" => "cwen@iupui.edu 5",
"code" => 'name = input("Enter file:")
if len(name) < 1:
    name = "mbox-short.txt"
handle = open(name)
',
"xcode" => 'name = input("Enter file:")
if len(name) < 1 : name = "mbox-short.txt"
handle = open(name)
counts = dict()
for line in handle:
    wds = line.split()
    if len(wds) < 2 : continue
    if wds[0] != "From" : continue
    email = wds[1]
    counts[email] = counts.get(email,0) + 1

bigcount = None
bigname = None
for name,count in counts.items():
    if bigname is None or count > bigcount:
        bigname = name
        bigcount = count

print(bigname, bigcount)
',
"checks" => Array(
"for" => "Χρειάζεστε έναν βρόχο for για να διαβάσετε τις γραμμές του αρχείου.",
"split" => "Θα πρέπει να χρησιμοποιήσετε τη split() για να διασπάσετε κάθε γραμμή σε λέξεις.",
"!cwen@iupui.edu" => "Χρειάζεστε έναν βρόχο for για να διαβάσετε τα δεδομένα του αρχείου.",
"if" => "Πρέπει να χρησιμοποιήσετε μία ή περισσότερες προτάσεις if για να παραλείψετε τις γραμμές που δεν ξεκινούν με 'From '.",
"open" => "Πρέπει να χρησιμοποιήσετε την open() για να ανοίξετε το αρχείο.")
),

"10.2" => Array(
"qtext" => "<b>10.2</b> Γράψτε ένα πρόγραμμα για να διαβάσετε το <b>mbox-short.txt</b> και υπολογίστε
την κατανομή ανά ώρα της ημέρας, για κάθε ένα από τα μηνύματα. Μπορείτε να εξάγετε την ώρα από τη γραμμή
'From ', βρίσκοντας την ώρα και μετά χωρίζοντας τη συμβολοσειρά για δεύτερη φορά χρησιμοποιώντας την
άνω και κάτω τελεία.
<pre>
From stephen.marquard@uct.ac.za Sat Jan  5 <b>09</b>:14:16 2008
</pre>
Αφού συγκεντρώσετε τις μετρήσεις για κάθε ώρα, εκτυπώστε τις μετρήσεις, ταξινομημένες ανά ώρα,
όπως φαίνεται παρακάτω.",
"desired" => "04 3
06 1
07 1
09 2
10 3
11 6
14 1
15 2
16 4
17 2
18 1
19 1",
"code" => 'name = input("Enter file:")
if len(name) < 1:
    name = "mbox-short.txt"
handle = open(name)
',
"xcode" => 'name = input("Enter file:")
if len(name) < 1 : name = "mbox-short.txt"
handle = open(name)
counts = dict()
for line in handle:
    wds = line.split()
    if len(wds) < 5 : continue
    if wds[0] != "From" : continue
    when = wds[5]
    tics = when.split(":")
    if len(tics) != 3 : continue
    hour = tics[0]
    counts[hour] = counts.get(hour,0) + 1

lst = counts.items()
lst.sort()

for key, val in lst :
    print(key, val)
',
"checks" => Array(
"for" => "Χρειάζεστε έναν βρόχο for για να διαβάσετε τις γραμμές του αρχείου.",
"sort" => "Πρέπει να χρησιμοποιήσετε τη μέθοδο sort() για να ταξινομήσετε τη λίστα των χρόνων.")
),

"11.1" => Array (
"qtext" => '<b>11.1</b> Sadly, the autograder does not support the regular expression library.
So please write a program that computes the
<b>Answer to the Ultimate Question of Life, the Universe, and Everything</b>
[<a href="http://www.youtube.com/watch?v=aboZctrHfK8" target="_blank">more detail</a>].
Sample output is below.',
"desired" => "42",
"code" => '',
"checks" => Array(
"print" => "By now you should know that a print statement would be helpful here.",
"*" => "I think that multiplication is involved..."
)),

"11.9" => Array(
"qtext" => "<b>11.9</b> Write a program to prompt the user for a regular expression
and read through the <b>mbox-short.txt</b> and count the number of lines that match
the regular expression using re.search().",
"desired" => "04 3
19 1",
"code" => 'import re

string = input("Enter a regular expression:")
if len(name) < 1 : name = "mbox-short.txt"
handle = open("mbox-short.txt")
count = 0
for line in handle:
    if re.search(string) : count = count + 1
print("mbox-short.txt had ", count, "lines that matched", string)

',
"xcode" => 'name = input("Enter file:")
if len(name) < 1 : name = "mbox-short.txt"
handle = open(name)
counts = dict()
for line in handle:
    wds = line.split()
    if len(wds) < 5 : continue
    if wds[0] != "From" : continue
    when = wds[5]
    tics = when.split(":")
    if len(tics) != 3 : continue
    hour = tics[0]
    counts[hour] = counts.get(hour,0) + 1

lst = counts.items()
lst.sort()

for key, val in lst :
    print(key, val)
',
"checks" => Array(
"for" => "You need a for loop to read the lines in the file.",
"sort" => "You need to use list sort() method to sort the list of times.")
)


);
