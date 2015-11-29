fn = raw_input("Enter name: ");
fh = open(fn);

count = 0;
lastword = None
for line in fh:
	count = count + 1
	words = line.split()
	for word in words:
		if len(word) > 3 :
			ch1 = word[0:1]
			ch2 = word[1:2]
			ch3 = word[2:3]
			if ch1 >= 'A' and ch1 <= 'Z' and ch2 >= 'A' and ch2 <= 'Z' and ch3 >= 'a' and ch3 <= 'z' :
				print count, word

		if len(word) < 2 : 
			lastword = word
			continue
		word = word.lower()
		ch = word[0:1]
		if ch < 'a' or ch > 'z' : 
			lastword = word
			continue
		if lastword == word:
			print count, word, lastword
		lastword = word

