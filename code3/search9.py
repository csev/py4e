fhand = open('mbox-short.txt')
for γραμμή in fhand:
    λέξεις = γραμμή.split()
    print('Εντοπισμός σφαλμάτων:', λέξεις)
    if len(λέξεις) > 0:
        if λέξεις[0] != 'From':
            continue
        print(λέξεις[2])
