fname = input('Enter the file name: ')
try:
    fhand = open(fname)
except:
    print('File cannot be opened:', fname)
    exit()
count = 0
total = 0
for line in fhand:
    words = line.split()
    if len(words) != 2: continue
    if words[0] != 'X-DSPAM-Confidence:': continue
    try:
        conf = float(words[1])
    except:
        continue
    count = count + 1
    total = total + conf
average = total / count
print('Average spam confidence:', average)
