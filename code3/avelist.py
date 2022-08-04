numlist = list()
while (True):
    είσοδος = input('Εισαγάγετε έναν αριθμό: ')
    if είσοδος == 'τέλος': break
    τιμή = float(είσοδος)
    numlist.append(τιμή)

μέσοςΌρος = sum(numlist) / len(numlist)
print('Μέσος Όρος:', μέσοςΌρος)
