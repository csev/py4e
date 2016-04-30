inp = input('Enter a Number:')
n = int(inp)
while n != 1:
    print(n, end=' ')     # Use comma to suppress newline
    if n % 2 == 0:        # n is even
        n = n / 2
    else:                 # n is odd
        n = n * 3 + 1
