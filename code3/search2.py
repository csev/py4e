fhand = open('mbox-short.txt')
for γραμμή in fhand:
    γραμμή = γραμμή.rstrip()
    if γραμμή.startswith('From:'):
        print(γραμμή)
