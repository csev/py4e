όνομα = input('Εισάγετε αρχείο:')
handle = open(όνομα, 'r')
counts = dict()

for γραμμή in handle:
    λέξεις = γραμμή.split()
    for λέξη in λέξεις:
        πλήθη[λέξη] = πλήθη.get(λέξη, 0) + 1

maxπλήθος = None
maxλέξη = None
for λέξη, πλήθος in list(πλήθη.items()):
    if maxπλήθος is None or πλήθος > maxπλήθος:
        maxλέξη = λέξη
        maxπλήθος = πλήθος

print(maxλέξη, maxπλήθος)
