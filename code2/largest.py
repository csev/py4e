largest = None
print 'Before:', largest
for iterval in [3, 41, 12, 9, 74, 15]:
    if largest == None or largest < iterval:
        largest = iterval
    print 'Loop:', iterval, largest
print 'Largest:', largest

