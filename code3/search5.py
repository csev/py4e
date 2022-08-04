fhand = open('mbox-short.txt')
for γραμμή in fhand:
    γραμμή = γραμμή.rstrip()
    if not γραμμή.startswith('From '): continue
    λέξεις = γραμμή.split()
    print(λέξεις[2])
