import re

while True:
    try:
        line = input()
    except:
        break

    # Use . instead of backslash to avoid regex weirdness across python versions
    x = re.findall(r'^.VerbatimInput{(.*)}', line)
    if not x:
        print(line)
        continue
    fn = x[0]

    with open(fn) as fh:

        print('~~~~ {.python}')
        blank = True

        for ln in fh:
            print(ln.rstrip())
            blank = len(ln.strip()) > 0

        # Canonical URL
        if fn.startswith('../'):
            # Add a blank unless there is one at end of file
            if blank:
                print()
            fu = fn.replace('../', 'https://www.py4e.com/')
            print('# Code:', fu)

        print('~~~~')
