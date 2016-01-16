
# Post process the LaTeX Output

while True:
    try:
        line = raw_input()
    except:
        break

    # \includegraphics{width=0.25cm,height=0.25cm@../images/pda.eps}
    # \includegraphics[width=0.25cm,height=0.25cm]{../images/pda.eps}
    if line.find('\\includegraphics') == 0 :
        curly = line.find('{')
        exclam = line.find('@')
        if curly < 1 or exclam < 1 :
            print line
            continue
        newline = line.replace('{','[').replace('@',']{')
        print newline
        continue

    if line == '\\begin{verbatim}' : 
        # print '\\vspace{0.0\\parskip\\fontsize{9}{11}}'
        print '{\\small'
        print line
    elif line == '\\end{verbatim}' : 
        print line
        print '}'
        # print '\\vspace{0.0\\parskip\\normalsize}'
    else:
        print line
