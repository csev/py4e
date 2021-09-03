import sqlite3

conn = sqlite3.connect('spider.sqlite')
cur = conn.cursor()

# Βρείτε τα αναγνωριστικά που στέλνουν την κατάταξη σελίδων - μας ενδιαφέρουν 
# μόνο οι σελίδες στο SCC που έχουν συνδέσμους εισόδου και εξόδου
cur.execute('''SELECT DISTINCT from_id FROM Links''')
from_ids = list()
for row in cur: 
    from_ids.append(row[0])

# Βρείτε τα αναγνωριστικά που λαμβάνουν κατάταξη σελίδας 
to_ids = list()
links = list()
cur.execute('''SELECT DISTINCT from_id, to_id FROM Links''')
for row in cur:
    from_id = row[0]
    to_id = row[1]
    if from_id == to_id : continue
    if from_id not in from_ids : continue
    if to_id not in from_ids : continue
    links.append(row)
    if to_id not in to_ids : to_ids.append(to_id)

# Λάβετε τις πιο πρόσφατες βαθμολογίες σελίδων για μέρη που είναι 
# πολύ συνδεδεμένα
prev_ranks = dict()
for node in from_ids:
    cur.execute('''SELECT new_rank FROM Pages WHERE id = ?''', (node, ))
    row = cur.fetchone()
    prev_ranks[node] = row[0]

sval = input('Πόσες επαναλήψεις:')
many = 1
if ( len(sval) > 0 ) : many = int(sval)

# Έλεγχος λογικής
if len(prev_ranks) < 1 : 
    print("Τίποτα στη σελίδα κατάταξης. Ελέγξτε τα δεδομένα.")
    quit()

# Ας κάνουμε το Page Rank στη μνήμη, ώστε να είναι πραγματικά γρήγορο
for i in range(many):
    # print prev_ranks.items()[:5]
    next_ranks = dict();
    total = 0.0
    for (node, old_rank) in list(prev_ranks.items()):
        total = total + old_rank
        next_ranks[node] = 0.0
    # print total

    # Εύρεση του αριθμού των εξερχόμενων συνδέσμων και αποστολή της κατάταξης
    # της σελίδας
    for (node, old_rank) in list(prev_ranks.items()):
        # print node, old_rank
        give_ids = list()
        for (from_id, to_id) in links:
            if from_id != node : continue
           #  print '   ',from_id,to_id

            if to_id not in to_ids: continue
            give_ids.append(to_id)
        if ( len(give_ids) < 1 ) : continue
        amount = old_rank / len(give_ids)
        # print node, old_rank,amount, give_ids
    
        for id in give_ids:
            next_ranks[id] = next_ranks[id] + amount
    
    newtot = 0
    for (node, next_rank) in list(next_ranks.items()):
        newtot = newtot + next_rank
    evap = (total - newtot) / len(next_ranks)

    # print newtot, evap
    for node in next_ranks:
        next_ranks[node] = next_ranks[node] + evap

    newtot = 0
    for (node, next_rank) in list(next_ranks.items()):
        newtot = newtot + next_rank

    # Υπολογισμος της μέσης αλλαγής ανά σελίδα από παλιά σε νέα κατάταξη 
    # Ως ένδειξη σύγκλισης του αλγορίθμου
    totdiff = 0
    for (node, old_rank) in list(prev_ranks.items()):
        new_rank = next_ranks[node]
        diff = abs(old_rank-new_rank)
        totdiff = totdiff + diff

    avediff = totdiff / len(prev_ranks)
    print(i+1, avediff)

    # rotate
    prev_ranks = next_ranks

# Τοποθέτηση ξανά των τελικών βαθμολογιών στη βάση δεδομένων
print(list(next_ranks.items())[:5])
cur.execute('''UPDATE Pages SET old_rank=new_rank''')
for (id, new_rank) in list(next_ranks.items()) :
    cur.execute('''UPDATE Pages SET new_rank=? WHERE id=?''', (new_rank, id))
conn.commit()
cur.close()

