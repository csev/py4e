fhand = open('mbox-short.txt')
for γραμμή in fhand:
    γραμμή = γραμμή.rstrip()
    if γραμμή.find('@uct.ac.za') == -1: continue
    print(γραμμή)
