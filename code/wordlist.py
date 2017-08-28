name = raw_input('Enter file: ')
handle = open(name, 'r')
wordlist = list()
for line in handle:
    words = line.split()
    for word in words:
        if word in wordlist: continue
        wordlist.append(word)

wordlist.sort()
print wordlist
