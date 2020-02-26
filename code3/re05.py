import re
s = 'Un mensaje de csev@umich.edu para cwen@iupui.edu acerca de una junta @2PM'
lst = re.findall(r'\S+@\S+', s)
print(lst)
