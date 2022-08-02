fhand = open('mbox-short.txt')
for line in fhand:
    if line.startswith('From:'):
        print(line)
