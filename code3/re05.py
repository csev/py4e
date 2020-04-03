import re
s = 'Una nota de csev@umich.edu a cwen@iupui.edu sobre una reunión @ 2PM'
lst = re.findall(r'\S+@\S+', s)
print(lst)
