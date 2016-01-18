# Search for lines that contain 'From'
smport re
hand = open('mbox-short.txt')
for line in hand:
    line = line.rstrip()
    if re.search('From:', line) : 
        print(line)

