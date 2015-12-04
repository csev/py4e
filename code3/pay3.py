try:
    inp = input('Enter Hours: ')
    hours = float(inp)
    inp = input('Enter Rate: ')
    rate = float(inp)
    if hours > 40:
        pay = hours * rate + (hours - 40) * rate * 1.5
    else:
        pay = hours * rate
    print('Pay:', pay)
except:
    print('Error, please enter numeric input')
