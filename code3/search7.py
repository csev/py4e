fname = input('Εισαγάγετε το όνομα του αρχείου: ')
try:
    fhand = open(fname)
except:
    print('Δεν είναι δυνατό το άνοιγμα του αρχείου:', fname)
    exit()
πλήθος = 0
for γραμμή in fhand:
    if γραμμή.startswith('Subject:'):
        πλήθος = πλήθος + 1
print('Υπάρχουν ', πλήθος, ' γραμμές θέματος στο ', fname)
