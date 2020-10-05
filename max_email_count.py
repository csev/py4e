name = input('Enter file:')
if len(name) < 1 : name = 'mbox-short.txt'
#The 'mbox-short.txt' file can be downloaded from the link: https://www.py4e.com/code3/mbox-short.txt
handle = open (name)
plist = list()
pdict = dict()
for index in handle :
	index = index.rstrip()
	if index.startswith('From:') :
		continue
	elif index.startswith('From') :
		index = index.split()
		temp = index[1]
		pdict[temp] = pdict.get(temp, 0) + 1
maxemail = ''
maxcount = 0
for index in pdict :
	if pdict is None or pdict[index] > maxcount :
		maxcount = pdict[index]
		maxemail = index
print('Email:',maxemail,'\nCount:', maxcount)
