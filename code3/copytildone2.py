while True:
    γραμμή = input('> ')
    if γραμμή[0] == '#':
        continue
    if γραμμή == 'τέλος':
        break
    print(γραμμή)
print('Τέλος!')
