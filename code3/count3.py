import string
fhand = open('romeo-full.txt')
πλήθη = dict()
for γραμμή in fhand:
    γραμμή = γραμμή.translate(str.maketrans('', '', string.punctuation))
    γραμμή = γραμμή.lower()
    λέξεις = γραμμή.split()
    for λέξη in λέξεις:
        if λέξη not in πλήθη:
            πλήθη[λέξη] = 1
        else:
            πλήθη[λέξη] += 1

# Sort the dictionary by value
λίστα = list()
for κλειδί, τιμή in list(πλήθη.items()):
    λίστα.append((τιμή, κλειδί))

λίστα.sort(reverse=True)

for κλειδί, τιμή in λίστα[:10]:
    print(κλειδί, τιμή)
