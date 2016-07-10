from __future__ import print_function
import sys
from pyquery import PyQuery
import re

filename = sys.argv[1]

print("Processing TOC for " + filename + "...")

with open(filename, 'r+') as f:
    text = f.read()

with open(filename, 'w') as f:   
    f.write('{% extends "books/pfe/base.html" %}\n\n')
    pattern = re.compile(r"{% block toc %}(.*){% endblock %}", re.DOTALL)
    matches = re.findall(pattern, text)
    d = PyQuery(matches[0])
    # first ul gets 'right'
    d('ul').eq(0).addClass('right')
    # first li gets dropdown
    d('li').eq(0).addClass('has-dropdown')
    # second ul is dropdown
    d('ul').eq(1).addClass('dropdown')

    toc = "{% block toc %}\n" + str(d) + "\n{% endblock %}"
    newtext = re.sub(pattern, toc, text)
    f.write(newtext)