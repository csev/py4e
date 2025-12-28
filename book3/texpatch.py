
# Post process the LaTeX Output

while True:
    try:
        line = input()
    except:
        break

    # \includegraphics{width=0.25cm,height=0.25cm@../images/pda.eps}
    # \includegraphics[width=0.25cm,height=0.25cm]{../images/pda.eps}
    # Also handle \pandocbounded{\includegraphics{...@...}}
    # And handle cases like \includegraphics[keepaspectratio,alt={...}]{height=1.0in@../images/pda2.eps}
    if '\\includegraphics' in line and '@' in line:
        # Handle pandocbounded wrapper case
        if '\\pandocbounded' in line:
            # Find the includegraphics part inside pandocbounded
            # Pattern: \pandocbounded{\includegraphics[...]{...@...}} or \pandocbounded{\includegraphics{...@...}}
            start = line.find('\\includegraphics')
            if start >= 0:
                # Check if there are already square brackets
                bracket_start = line.find('[', start)
                brace_start = line.find('{', start)
                
                if bracket_start >= 0 and bracket_start < brace_start:
                    # Case: \includegraphics[existing options]{height=1.0in@path}
                    bracket_end = line.find(']', bracket_start)
                    if bracket_end > bracket_start:
                        existing_options = line[bracket_start+1:bracket_end]
                        brace_start = bracket_end + 1
                        # Now find the @ symbol and closing brace
                        at_pos = line.find('@', brace_start)
                        brace_end = line.find('}', at_pos)
                        if at_pos > brace_start and brace_end > at_pos:
                            height_options = line[brace_start+1:at_pos]
                            path = line[at_pos+1:brace_end]
                            after_ig = line[brace_end+1:]
                            # Merge options: existing_options,height_options
                            if height_options.strip():
                                merged_options = existing_options + ',' + height_options
                            else:
                                merged_options = existing_options
                            before_ig = line[:start]
                            newline = before_ig + '\\includegraphics[' + merged_options + ']{' + path + '}' + after_ig
                            print(newline)
                            continue
                else:
                    # Case: \includegraphics{height=1.0in@path} (no existing brackets)
                    brace_start = start + len('\\includegraphics{')
                    at_pos = line.find('@', brace_start)
                    brace_end = line.find('}', at_pos)
                    if at_pos > brace_start and brace_end > at_pos:
                        options = line[brace_start:at_pos]
                        path = line[at_pos+1:brace_end]
                        after_ig = line[brace_end+1:]
                        before_ig = line[:start]
                        newline = before_ig + '\\includegraphics[' + options + ']{' + path + '}' + after_ig
                        print(newline)
                        continue
        else:
            # Regular includegraphics without pandocbounded
            start = line.find('\\includegraphics')
            if start >= 0:
                # Check if there are already square brackets
                bracket_start = line.find('[', start)
                brace_start = line.find('{', start)
                
                if bracket_start >= 0 and bracket_start < brace_start:
                    # Case: \includegraphics[existing options]{height=1.0in@path}
                    bracket_end = line.find(']', bracket_start)
                    if bracket_end > bracket_start:
                        existing_options = line[bracket_start+1:bracket_end]
                        brace_start = bracket_end + 1
                        at_pos = line.find('@', brace_start)
                        brace_end = line.find('}', at_pos)
                        if at_pos > brace_start and brace_end > at_pos:
                            height_options = line[brace_start+1:at_pos]
                            path = line[at_pos+1:brace_end]
                            after_ig = line[brace_end+1:]
                            if height_options.strip():
                                merged_options = existing_options + ',' + height_options
                            else:
                                merged_options = existing_options
                            before_ig = line[:start]
                            newline = before_ig + '\\includegraphics[' + merged_options + ']{' + path + '}' + after_ig
                            print(newline)
                            continue
                else:
                    # Case: \includegraphics{height=1.0in@path} (no existing brackets)
                    brace_start = start + len('\\includegraphics{')
                    at_pos = line.find('@', brace_start)
                    brace_end = line.find('}', at_pos)
                    if at_pos > brace_start and brace_end > at_pos:
                        before_ig = line[:start]
                        options = line[brace_start:at_pos]
                        path = line[at_pos+1:brace_end]
                        after_ig = line[brace_end+1:]
                        newline = before_ig + '\\includegraphics[' + options + ']{' + path + '}' + after_ig
                        print(newline)
                        continue

    if line == '\\begin{verbatim}' : 
        # print '\\vspace{0.0\\parskip\\fontsize{9}{11}}'
        print('{\\small')
        print(line)
    elif line == '\\end{verbatim}' : 
        print(line)
        print('}')
        # print '\\vspace{0.0\\parskip\\normalsize}'
    else:
        print(line)
