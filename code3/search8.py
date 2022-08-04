fhand = open('mbox-short.txt')
for line in fhand:
    words = line.split()
    if len(words) > 0:
        if words[0] != 'From':
            continue
        print(words[2])
