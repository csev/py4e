fhand = open('mbox-short.txt')
for γραμμή in fhand:
    if γραμμή.startswith('From:'):
        print(γραμμή)
