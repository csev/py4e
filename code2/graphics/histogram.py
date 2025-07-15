import string 
from graphics import *

fname = raw_input("Enter file name:")
if len(fname) == 0 :
  print "Assuming mbox-short.txt"
  fname = "mbox-short.txt"
infile = open(fname, "r")

# Set up a 24 element list of zeros
totals = [0] * 24;
print totals;

# Accumulate the times
for line in infile:
    if line[0:5] == "From " :
	words = line.split()
        time = words[5]
	print "Time", time

	# Split time
	tsplit = time.split(':')
	try : 
            hour = int(tsplit[0])
	    print "Hour", hour
	except:
            print "Hour not found"
            continue

	totals[hour] = totals[hour] + 1
	print totals

bmax = max(totals)
print "Maximum value", bmax

ymax = ( int(bmax / 10) + 1 ) * 10

print "Y-Axis Maximum", ymax

win = GraphWin("Distribution of Commits "+fname, 600,400)
win.setCoords(0,0,1,1)

# Draw the X-Axis
xaxis = Line(Point(0.1,0.1),Point(0.9,0.1))
xaxis.draw(win)

# Label the X-Axis - we have 24 hours (0-23)
# so we need to know each slot's width
width = 0.8 * (1.0 / 24.0)
for i in range(24):
    center = (i * width) + (width / 2.0) + 0.1;
    txt = Text(Point(center, 0.066), str(i))
    txt.draw(win)

txt = Text(Point(0.5,0.033),"Hour of the Day");
txt.draw(win)

# Draw the Y-Axis
yaxis = Line(Point(0.1,0.1),Point(0.1,0.9))
yaxis.draw(win)

# Label the Y-Axis
# we will have 10 labels up to ymax
unit = ymax / 10.0;
for i in range(10) :
    center = 0.1 + (i + 1) * 0.08;
    value = int( (i + 1) * unit ) ;
    txt = Text(Point(0.066,center), str(value))
    txt.draw(win)


# Draw the bars
for i in range(24):
    if totals[i] == 0:
        continue
    left = i * width + 0.1;
    right = i * width + width + 0.1;
    height = (float(totals[i]) / ymax) * 0.8;
    rec = Rectangle(Point(left,0.1), Point(right,0.1+height))
    rec.setFill('blue')
    rec.draw(win)

win.getMouse()
