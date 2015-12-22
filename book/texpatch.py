
while True:
    try:
        line = raw_input()
    except:
        break
    if line == '\\begin{verbatim}' : 
        # print '\\vspace{0.0\\parskip\\fontsize{9}{11}}'
        print ('{\\small')
        print (line)
    elif line == '\\end{verbatim}' : 
        print (line)
        print ('}')
        # print '\\vspace{0.0\\parskip\\normalsize}'
    else:
        print (line)
