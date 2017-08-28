import re
s = 'This message from csev@umich.edu to cwen@iupui.edu is about a meeting @2PM'
lst = re.findall('\S+@\S+', s)
print lst

