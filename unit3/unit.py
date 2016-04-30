
import os
import sys
import re
import subprocess

# Note - someone familiar with Windows might be able to make
# this work on Windows

if sys.platform.startswith('win') :
    print('These unit tests likely fail on Windows', os.platform)

os.system("rm testtmp/*")
os.system("mkdir -p testtmp")

# Known Failures
failures = [
    # 'urllink2.py',  -- Fixed
    # 'urllinks.py',  -- Fixed
]

toskip = [
    'unit.py',  # avoid infinite loops
    'wikigrade.py',  # talks to ctools - too complex
    'argfile.py',  # argument passing - no need to test
    'argtest.py',  # argument passing - no need to test
    'urllink3.py', # might run forever
    'db2.py',  # requires that db1.py be excuted first to create database
]

success = 0
fail = 0
codefolder = '../code3'

for i in os.listdir(codefolder):
    if not i.endswith(".py"): 
        continue
    if i in toskip : continue
    if i in failures : continue
    if i.startswith('tw') : continue
    if i.startswith('txt') : continue
    base = i.replace(".py","")
    data = open(codefolder+'/'+i).read()
    lines = data.split('\n')
    inputs = re.findall('input.*\([^\n]*\)',data.lower())
    finputs = re.findall('input.*\([^\n]*enter[^\n]*file[^\n].*\)',data.lower())
    if len(inputs) == 1 and len(finputs) == 1 : 
        cmd = "python3 "+codefolder+'/'+i+" < testinp/mbox-short.inp > testtmp/"+base+".txt"
        code = os.system(cmd)
    elif len(inputs) > 0 :
        inputname = 'testinp/'+base+'.inp'
        try:
            fh = open(inputname)
            fh.close()
            code = 0
        except:
            cmd = "Not Handled: "+i;
            code = 1

        if code == 0 :
            cmd = "python3 "+codefolder+'/'+i+" < testinp/"+base+".inp > testtmp/"+base+".txt"
            code = os.system(cmd)

    else :
        cmd = "python3 "+codefolder+'/'+i+" > testtmp/"+base+".txt"
        code = os.system(cmd)

    if code == 0 :
        success = success + 1
        continue

    fail = fail + 1
    print (cmd)

print('Tests passed:',success)
print('Tests failed:',fail)
if ( len(failures) > 0 ) : print('Unit Test TODO:',failures)
os.system("rm *.sqlite")
os.system("rm cover.jpg")
os.system("rm stuff.jpg")

print("Comparing outputs...")

# code = os.system("diff -r testout testtmp | grep -v '^Only in testtmp: '")
p = os.popen("diff -r testout testtmp")
data = p.read()
lines = data.rstrip().split('\n')
diff = False
for line in lines:
    if line.startswith('Only in testtmp: ') :
        continue
    print (line)
    diff = True
if diff or fail >= 1 :
    sys.exit(1)
