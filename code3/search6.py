fname = input('Εισαγάγετε το όνομα του αρχείου: ')
fhand = open(fname)
πλήθος = 0
for γραμμή in fhand:
    if γραμμή.startswith('Subject:'):
        πλήθος = πλήθος + 1
print('Υπάρχουν ', πλήθος, ' γραμμές θέματος στο ', fname)
