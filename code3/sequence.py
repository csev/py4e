inp = input('Enter a Number:')
n = int(inp)
while n != 1:
    print(n, end=' ')  # Set newline to empty space (no linefeed)
    if n % 2 == 0:     # n is even
        n = n / 2
    else:              # n is odd
        n = n * 3 + 1
