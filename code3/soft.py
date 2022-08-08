κείμενο = 'but soft what light in yonder window breaks'
λέξεις = κείμενο.split()
t = list()
for λέξη in λέξεις:
    t.append((len(λέξη), λέξη))

t.sort(reverse=True)

res = list()
for μήκος, λέξη in t:
    res.append(λέξη)

print(res)
