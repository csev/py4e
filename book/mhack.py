
# Remove blank lines before and after a glossary definition

lines = list()
while True:
    try:
        line = raw_input()
    except:
        break
    lines.append(line)

blank = True
colon = False
newlines = list()
for pos in range(len(lines)):

    if pos < 5  or pos > len(lines)-5 :
        newlines.append(lines[pos])
        continue

    line = lines[pos]
    if line == '' : 
        blank = True
        continue

    prev = lines[pos-1]
    nxt = lines[pos+1]

    if line.startswith(':') :
        # ignore any outstanding blank lines
        blank = False
        colon = True
        newlines.append(line)
        continue

    # Ignore any outstanding blank lines
    if colon and line.startswith('\\') : 
        colon = False
        blank = False
        newlines.append(line)
        continue

    if blank:
        newlines.append('')
        blank = False

    newlines.append(line)

for line in newlines:
    print line
