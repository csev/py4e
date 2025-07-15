# graphics.py
"""Simple object oriented graphics library

The library is designed to make it very easy for novice programmers to
experiment with computer graphics in an object oriented fashion. It is
written by John Zelle for use with the book "Python Programming: An
Introduction to Computer Science" (Franklin, Beedle & Associates).

LICENSE: This is open-source software released under the terms of the
GPL (http://www.gnu.org/licenses/gpl.html).

PLATFORMS: The package is a wrapper around Tkinter and should run on
any platform where Tkinter is available.

INSTALLATION: Put this file somewhere where Python can see it.

OVERVIEW: There are two kinds of objects in the library. The GraphWin
class implements a window where drawing can be done and various
GraphicsObjects are provided that can be drawn into a GraphWin. As a
simple example, here is a complete program to draw a circle of radius
10 centered in a 100x100 window:

--------------------------------------------------------------------
from graphics import *

def main():
    win = GraphWin("My Circle", 100, 100)
    c = Circle(Point(50,50), 10)
    c.draw(win)
    win.getMouse() // Pause to view result

main()
--------------------------------------------------------------------
GraphWin objects support coordinate transformation through the
setCoords method and pointer-based input through getMouse.

The library provides the following graphical objects:
    Point
    Line
    Circle
    Oval
    Rectangle
    Polygon
    Text
    Entry (for text-based input)
    Image

Various attributes of graphical objects can be set such as
outline-color, fill-color and line-width. Graphical objects also
support moving and hiding for animation effects.

The library also provides a very simple class for pixel-based image
manipulation, Pixmap. A pixmap can be loaded from a file and displayed
using an Image object. Both getPixel and setPixel methods are provided
for manipulating the image.

DOCUMENTATION: For complete documentation, see Chapter 5 of "Python
Programming: An Introduction to Computer Science" by John Zelle,
published by Franklin, Beedle & Associates.  Also see
http://mcsp.wartburg.edu/zelle/python for a quick reference.

This version makes str(obj), where obj is a GraphicsObject, return an
intelligible string, allowing print statements for debugging.

The version also adds the GraphWindow methods
clearLastMouse() which sets the remembered mouse position to None, and
getLastMouse() which returns thbe last Point where the mouse was clicked,
or None if clearLastMouse() was called since the last click.
"""

# Version Submitted by Andrew Harrington 6/23/06
#     Add methods getLastMouse(), clearLastMouse() for asychronous event
#       detection (to terminate animations ....)
# Version by Andrew Harrington 2/11/06
#     Defines __str__ for each subclass of GraphicsObject.
# Version 3.2.2 5/30/05
#     Cleaned up handling of exceptions in Tk thread. The graphics package
#     now raises an exception if attempt is made to communicate with
#     a dead Tk thread.
# Version 3.2.1 5/22/05
#     Added shutdown function for tk thread to eliminate race-condition
#        error "chatter" when main thread terminates
#     Renamed various private globals with _
# Version 3.2 5/4/05
#     Added Pixmap object for simple image manipulation.
# Version 3.1 4/13/05
#     Improved the Tk thread communication so that most Tk calls
#        do not have to wait for synchonization with the Tk thread.
#        (see _tkCall and _tkExec)
# Version 3.0 12/30/04
#     Implemented Tk event loop in separate thread. Should now work
#        interactively with IDLE. Undocumented autoflush feature is
#        no longer necessary. Its default is now False (off). It may
#        be removed in a future version.
#     Better handling of errors regarding operations on windows that
#       have been closed.
#     Addition of an isClosed method to GraphWindow class.

# Version 2.2 8/26/04
#     Fixed cloning bug reported by Joseph Oldham.
#     Now implements deep copy of config info.
# Version 2.1 1/15/04
#     Added autoflush option to GraphWin. When True (default) updates on
#        the window are done after each action. This makes some graphics
#        intensive programs sluggish. Turning off autoflush causes updates
#        to happen during idle periods or when flush is called.
# Version 2.0
#     Updated Documentation
#     Made Polygon accept a list of Points in constructor
#     Made all drawing functions call TK update for easier animations
#          and to make the overall package work better with
#          Python 2.3 and IDLE 1.0 under Windows (still some issues).
#     Removed vestigial turtle graphics.
#     Added ability to configure font for Entry objects (analogous to Text)
#     Added setTextColor for Text as an alias of setFill
#     Changed to class-style exceptions
#     Fixed cloning of Text objects

# Version 1.6
#     Fixed Entry so StringVar uses _root as master, solves weird
#            interaction with shell in Idle
#     Fixed bug in setCoords. X and Y coordinates can increase in
#           "non-intuitive" direction.
#     Tweaked wm_protocol so window is not resizable and kill box closes.

# Version 1.5
#     Fixed bug in Entry. Can now define entry before creating a
#     GraphWin. All GraphWins are now toplevel windows and share
#     a fixed root (called _root).

# Version 1.4
#     Fixed Garbage collection of Tkinter images bug.
#     Added ability to set text atttributes.
#     Added Entry boxes.

import time, os, sys
import Tkinter
tk = Tkinter


##########################################################################
# Module Exceptions

import exceptions

class GraphicsError(exceptions.Exception):
    """Generic error class for graphics module exceptions."""
    def __init__(self, args=None):
        self.args=args

OBJ_ALREADY_DRAWN = "Object currently drawn"
UNSUPPORTED_METHOD = "Object doesn't support operation"
BAD_OPTION = "Illegal option value"
DEAD_THREAD = "Graphics thread quit unexpectedly"

###########################################################################
# Support to run Tk in a separate thread

from copy import copy
from Queue import Queue
import thread
import atexit


_tk_request = Queue(0)
_tk_result = Queue(1)
_POLL_INTERVAL = 10

_root = None
_thread_running = True
_exception_info = None

def _tk_thread():
    global _root
    _root = tk.Tk()
    _root.withdraw()
    _root.after(_POLL_INTERVAL, _tk_pump)
    _root.mainloop()

def _tk_pump():
    global _thread_running
    while not _tk_request.empty():
        command,returns_value = _tk_request.get()
        try:
            result = command()
            if returns_value:
                _tk_result.put(result)
        except:
            _thread_running = False
            if returns_value:
                _tk_result.put(None) # release client
            raise # re-raise the exception -- kills the thread
    if _thread_running:
        _root.after(_POLL_INTERVAL, _tk_pump)

def _tkCall(f, *args, **kw):
    # execute synchronous call to f in the Tk thread
    # this function should be used when a return value from
    #   f is required or when synchronizing the threads.
    # call to _tkCall in Tk thread == DEADLOCK !
    if not _thread_running:
        raise GraphicsError, DEAD_THREAD
    def func():
        return f(*args, **kw)
    _tk_request.put((func,True),True)
    result = _tk_result.get(True)
    return result

def _tkExec(f, *args, **kw):
    # schedule f to execute in the Tk thread. This function does
    #   not wait for f to actually be executed.
    #global _exception_info
    #_exception_info = None
    if not _thread_running:
        raise GraphicsError, DEAD_THREAD
    def func():
        return f(*args, **kw)
    _tk_request.put((func,False),True)
    #if _exception_info is not None:
    #    raise GraphicsError, "Invalid Operation: %s" % str(_exception_info)

def _tkShutdown():
    # shutdown the tk thread
    global _thread_running
    #_tkExec(sys.exit)
    _thread_running = False
    time.sleep(.5) # give tk thread time to quit

# Fire up the separate Tk thread
thread.start_new_thread(_tk_thread,())

# Kill the tk thread at exit
atexit.register(_tkShutdown)

############################################################################
# Graphics classes start here
        
class GraphWin(tk.Canvas):

    """A GraphWin is a toplevel window for displaying graphics."""

    def __init__(self, title="Graphics Window",
                 width=200, height=200, autoflush=False):
        """ init doc """
        _tkCall(self.__init_help, title, width, height, autoflush)
 
    
    def __init_help(self, title, width, height, autoflush):
        master = tk.Toplevel(_root)
        master.protocol("WM_DELETE_WINDOW", self.__close_help)
        tk.Canvas.__init__(self, master, width=width, height=height)
        self.master.title(title)
        self.pack()
        master.resizable(0,0)
        self.foreground = "black"
        self.items = []
        self.mouseX = None
        self.mouseY = None
        self.bind("<Button-1>", self._onClick)
        self.height = height
        self.width = width
        self.autoflush = autoflush
        self._mouseCallback = None
        self.trans = None
        self.closed = False
        if autoflush: _root.update()

    def __checkOpen(self):
        if self.closed:
            raise GraphicsError, "window is closed"

    def setBackground(self, color):
        """Set background color of the window"""
        self.__checkOpen()
        _tkExec(self.config, bg=color)
        #self.config(bg=color)
        
    def setCoords(self, x1, y1, x2, y2):
        """Set coordinates of window to run from (x1,y1) in the
        lower-left corner to (x2,y2) in the upper-right corner."""
        self.trans = Transform(self.width, self.height, x1, y1, x2, y2)

    def close(self):
        if self.closed: return
        _tkCall(self.__close_help)
        
    def __close_help(self):
        """Close the window"""
        self.closed = True
        self.master.destroy()
        _root.update()

    def isClosed(self):
        return self.closed

    def __autoflush(self):
        if self.autoflush:
            _tkCall(_root.update)
    
    def plot(self, x, y, color="black"):
        """Set pixel (x,y) to the given color"""
        self.__checkOpen()
        xs,ys = self.toScreen(x,y)
        #self.create_line(xs,ys,xs+1,ys, fill=color)
        _tkExec(self.create_line,xs,ys,xs+1,ys,fill=color)
        self.__autoflush()
        
    def plotPixel(self, x, y, color="black"):
        """Set pixel raw (independent of window coordinates) pixel
        (x,y) to color"""
        self.__checkOpen()
    	#self.create_line(x,y,x+1,y, fill=color)
        _tkExec(self.create_line, x,y,x+1,y, fill=color)
        self.__autoflush()
    	
    def flush(self):
        """Update drawing to the window"""
        #self.update_idletasks()
        self.__checkOpen()
        _tkCall(self.update_idletasks)
        
    def getMouse(self):
        """Wait for mouse click and return Point object representing
        the click.
        To get the last mouse click without waiting, use self.getLastMouse()."""
        self.mouseX = None
        self.mouseY = None
        while self.mouseX == None or self.mouseY == None:
            _tkCall(self.update)
            if self.isClosed(): raise GraphicsError, "getMouse in closed window"
            time.sleep(.1) # give up thread
        x,y = self.toWorld(self.mouseX, self.mouseY)
        return Point(x,y)
    
    def getLastMouse(self):
        """Return last mouse click Point without waiting for the next click.
        Returns None if no mouse click since the call self.clearLastMouse().
        """
        if self.mouseX == None or self.mouseY == None:
            return None
        x,y = self.toWorld(self.mouseX, self.mouseY)
        return Point(x,y)
    
    def clearLastMouse(self):
        """Makes  self.getLastMouse() return None until the next mouse click.
        """
        self.mouseX = None
        self.mouseY = None
        
    def getHeight(self):
        """Return the height of the window"""
        return self.height
        
    def getWidth(self):
        """Return the width of the window"""
        return self.width
    
    def toScreen(self, x, y):
        trans = self.trans
        if trans:
            return self.trans.screen(x,y)
        else:
            return x,y
                      
    def toWorld(self, x, y):
        trans = self.trans
        if trans:
            return self.trans.world(x,y)
        else:
            return x,y
        
    def setMouseHandler(self, func):
        self._mouseCallback = func
        
    def _onClick(self, e):
        self.mouseX = e.x
        self.mouseY = e.y
        if self._mouseCallback:
            self._mouseCallback(Point(e.x, e.y)) 
                      
class Transform:

    """Internal class for 2-D coordinate transformations"""
    
    def __init__(self, w, h, xlow, ylow, xhigh, yhigh):
        # w, h are width and height of window
        # (xlow,ylow) coordinates of lower-left [raw (0,h-1)]
        # (xhigh,yhigh) coordinates of upper-right [raw (w-1,0)]
        xspan = (xhigh-xlow)
        yspan = (yhigh-ylow)
        self.xbase = xlow
        self.ybase = yhigh
        self.xscale = xspan/float(w-1)
        self.yscale = yspan/float(h-1)
        
    def screen(self,x,y):
        # Returns x,y in screen (actually window) coordinates
        xs = (x-self.xbase) / self.xscale
        ys = (self.ybase-y) / self.yscale
        return int(xs+0.5),int(ys+0.5)
        
    def world(self,xs,ys):
        # Returns xs,ys in world coordinates
        x = xs*self.xscale + self.xbase
        y = self.ybase - ys*self.yscale
        return x,y


# Default values for various item configuration options. Only a subset of
#   keys may be present in the configuration dictionary for a given item
DEFAULT_CONFIG = {"fill":"",
		  "outline":"black",
		  "width":"1",
		  "arrow":"none",
		  "text":"",
		  "justify":"center",
                  "font": ("helvetica", 12, "normal")}

class GraphicsObject:

    """Generic base class for all of the drawable objects"""
    # A subclass of GraphicsObject should override _draw and
    #   and _move methods.
    
    def __init__(self, options):
        # options is a list of strings indicating which options are
        # legal for this object.
        
        # When an object is drawn, canvas is set to the GraphWin(canvas)
        #    object where it is drawn and id is the TK identifier of the
        #    drawn shape.
        self.canvas = None
        self.id = None

        # config is the dictionary of configuration options for the widget.
        config = {}
        for option in options:
            config[option] = DEFAULT_CONFIG[option]
        self.config = config
        
    def setFill(self, color):
        """Set interior color to color"""
        self._reconfig("fill", color)
        
    def setOutline(self, color):
        """Set outline color to color"""
        self._reconfig("outline", color)
        
    def setWidth(self, width):
        """Set line weight to width"""
        self._reconfig("width", width)

    def draw(self, graphwin):

        """Draw the object in graphwin, which should be a GraphWin
        object.  A GraphicsObject may only be drawn into one
        window. Raises an error if attempt made to draw an object that
        is already visible."""

        if self.canvas and not self.canvas.isClosed(): raise GraphicsError, OBJ_ALREADY_DRAWN
        if graphwin.isClosed(): raise GraphicsError, "Can't draw to closed window"
        self.canvas = graphwin
        #self.id = self._draw(graphwin, self.config)
        self.id = _tkCall(self._draw, graphwin, self.config)
        if graphwin.autoflush:
            #_root.update()
            _tkCall(_root.update)

    def undraw(self):

        """Undraw the object (i.e. hide it). Returns silently if the
        object is not currently drawn."""
        
        if not self.canvas: return
        if not self.canvas.isClosed():
            #self.canvas.delete(self.id)
            _tkExec(self.canvas.delete, self.id)
            if self.canvas.autoflush:
                #_root.update()
                _tkCall(_root.update)
        self.canvas = None
        self.id = None

    def move(self, dx, dy):

        """move object dx units in x direction and dy units in y
        direction"""
        
        self._move(dx,dy)
        canvas = self.canvas
        if canvas and not canvas.isClosed():
            trans = canvas.trans
            if trans:
                x = dx/ trans.xscale 
                y = -dy / trans.yscale
            else:
                x = dx
                y = dy
            #self.canvas.move(self.id, x, y)
            _tkExec(self.canvas.move, self.id, x, y)
            if canvas.autoflush:
                #_root.update()
                _tkCall(_root.update)
           
    def _reconfig(self, option, setting):
        # Internal method for changing configuration of the object
        # Raises an error if the option does not exist in the config
        #    dictionary for this object
        if not self.config.has_key(option):
            raise GraphicsError, UNSUPPORTED_METHOD
        options = self.config
        options[option] = setting
        if self.canvas and not self.canvas.isClosed():
            #self.canvas.itemconfig(self.id, options)
            _tkExec(self.canvas.itemconfig, self.id, options)
            if self.canvas.autoflush:
                #_root.update()
                _tkCall(_root.update)

    def _draw(self, canvas, options):
        """draws appropriate figure on canvas with options provided
        Returns Tk id of item drawn"""
        pass # must override in subclass

    def _move(self, dx, dy):
        """updates internal state of object to move it dx,dy units"""
        pass # must override in subclass
         
class Point(GraphicsObject):
    def __init__(self, x, y):
        GraphicsObject.__init__(self, ["outline", "fill"])
        self.setFill = self.setOutline
        self.x = x
        self.y = y
        
    def _draw(self, canvas, options):
        x,y = canvas.toScreen(self.x,self.y)
        return canvas.create_rectangle(x,y,x+1,y+1,options)
        
    def _move(self, dx, dy):
        self.x = self.x + dx
        self.y = self.y + dy
        
    def clone(self):
        other = Point(self.x,self.y)
        other.config = self.config.copy()
        return other

    def coordStr(self):
        return "(%s, %s)" % (approx(self.x), approx(self.y))

    def __str__(self):
        return "Point" + self.coordStr()
                
    def getX(self): return self.x
    def getY(self): return self.y

class _BBox(GraphicsObject):
    # Internal base class for objects represented by bounding box
    # (opposite corners) Line segment is a degenerate case.
    
    def __init__(self, p1, p2, options=["outline","width","fill"]):
        GraphicsObject.__init__(self, options)
        self.p1 = p1.clone()
        self.p2 = p2.clone()

    def _move(self, dx, dy):
        self.p1.x = self.p1.x + dx
        self.p1.y = self.p1.y + dy
        self.p2.x = self.p2.x + dx
        self.p2.y = self.p2.y  + dy
                
    def getP1(self): return self.p1.clone()

    def getP2(self): return self.p2.clone()
    
    def getCenter(self):
        p1 = self.p1
        p2 = self.p2
        return Point((p1.x+p2.x)/2.0, (p1.y+p2.y)/2.0)
    
class Rectangle(_BBox):
    
    def __init__(self, p1, p2):
        _BBox.__init__(self, p1, p2)
    
    def _draw(self, canvas, options):
        p1 = self.p1
        p2 = self.p2
        x1,y1 = canvas.toScreen(p1.x,p1.y)
        x2,y2 = canvas.toScreen(p2.x,p2.y)
        return canvas.create_rectangle(x1,y1,x2,y2,options)

    def __str__(self):
        return "Rect: %s to %s" % (self.p1.coordStr(), self.p2.coordStr()) 
                
        
    def clone(self):
        other = Rectangle(self.p1, self.p2)
        other.config = self.config.copy()
        return other
        
class Oval(_BBox):
    
    def __init__(self, p1, p2):
        _BBox.__init__(self, p1, p2)
        
    def clone(self):
        other = Oval(self.p1, self.p2)
        other.config = self.config.copy()
        return other
   
    def _draw(self, canvas, options):
        p1 = self.p1
        p2 = self.p2
        x1,y1 = canvas.toScreen(p1.x,p1.y)
        x2,y2 = canvas.toScreen(p2.x,p2.y)
        return canvas.create_oval(x1,y1,x2,y2,options)

    def __str__(self):
        return "Oval: %s to %s" % (self.p1.coordStr(), self.p2.coordStr()) 
                
    
class Circle(Oval):
    
    def __init__(self, center, radius):
        p1 = Point(center.x-radius, center.y-radius)
        p2 = Point(center.x+radius, center.y+radius)
        Oval.__init__(self, p1, p2)
        self.radius = radius
        
    def clone(self):
        other = Circle(self.getCenter(), self.radius)
        other.config = self.config.copy()
        return other
        
    def getRadius(self):
        return self.radius

    def __str__(self):
        return "Circle: center %s, r = %s" % \
               (self.getCenter().coordStr(), approx(self.radius)) 
                
              
class Line(_BBox):
    
    def __init__(self, p1, p2):
        _BBox.__init__(self, p1, p2, ["arrow","fill","width"])
        self.setFill(DEFAULT_CONFIG['outline'])
        self.setOutline = self.setFill
   
    def clone(self):
        other = Line(self.p1, self.p2)
        other.config = self.config.copy()
        return other
	
    def _draw(self, canvas, options):
        p1 = self.p1
        p2 = self.p2
        x1,y1 = canvas.toScreen(p1.x,p1.y)
        x2,y2 = canvas.toScreen(p2.x,p2.y)
        return canvas.create_line(x1,y1,x2,y2,options)
        
    def setArrow(self, option):
        if not option in ["first","last","both","none"]:
            raise GraphicsError, BAD_OPTION
        self._reconfig("arrow", option)
        
    def __str__(self):
        return "Line: %s-%s" % (self.p1.coordStr(), self.p2.coordStr()) 

class Polygon(GraphicsObject):
    
    def __init__(self, *points):
        # if points passed as a list, extract it
        if len(points) == 1 and type(points[0]) == type([]):
            points = points[0]
        self.points = map(Point.clone, points)
        GraphicsObject.__init__(self, ["outline", "width", "fill"])
        
    def clone(self):
        other = apply(Polygon, self.points)
        other.config = self.config.copy()
        return other

    def getPoints(self):
        return map(Point.clone, self.points)

    def _move(self, dx, dy):
        for p in self.points:
            p.move(dx,dy)
   
    def _draw(self, canvas, options):
        args = [canvas]
        for p in self.points:
            x,y = canvas.toScreen(p.x,p.y)
            args.append(x)
            args.append(y)
        args.append(options)
        return apply(GraphWin.create_polygon, args) 

    def __str__(self):
        return "Polygon: %s" % \
               "-".join([pt.coordStr() for pt in self.points]) 

class Text(GraphicsObject):
    
    def __init__(self, centerPt, text):
            GraphicsObject.__init__(self, ["justify","fill","text","font"])
            self.setText(text)
            self.anchor = centerPt.clone()
            self.setFill(DEFAULT_CONFIG['outline'])
            self.setOutline = self.setFill
            
    def _draw(self, canvas, options):
            p = self.anchor
            x,y = canvas.toScreen(p.x,p.y)
            return canvas.create_text(x,y,options)
            
    def _move(self, dx, dy):
            self.anchor.move(dx,dy)
            
    def clone(self):
            other = Text(self.anchor, self.config['text'])
            other.config = self.config.copy()
            return other

    def setText(self,text):
            self._reconfig("text", text)
            
    def getText(self):
            return self.config["text"]
            
    def getAnchor(self):
            return self.anchor.clone()

    def setFace(self, face):
        if face in ['helvetica','arial','courier','times roman']:
            f,s,b = self.config['font']
            self._reconfig("font",(face,s,b))
        else:
            raise GraphicsError, BAD_OPTION

    def setSize(self, size):
        if 5 <= size <= 36:
            f,s,b = self.config['font']
            self._reconfig("font", (f,size,b))
        else:
            raise GraphicsError, BAD_OPTION

    def setStyle(self, style):
        if style in ['bold','normal','italic', 'bold italic']:
            f,s,b = self.config['font']
            self._reconfig("font", (f,s,style))
        else:
            raise GraphicsError, BAD_OPTION

    def setTextColor(self, color):
        self.setFill(color)

    def __str__(self):
        return '"%s" at %s' % (self.getText(), self.anchor.coordStr()) 

class Entry(GraphicsObject):

    def __init__(self, centerPt, width):
        GraphicsObject.__init__(self, [])
        self.anchor = centerPt.clone()
        #print self.anchor
        self.width = width
        #self.text = tk.StringVar(_root)
        #self.text.set("")
        self.text = _tkCall(tk.StringVar, _root)
        _tkCall(self.text.set, "")
        self.fill = "gray"
        self.color = "black"
        self.font = DEFAULT_CONFIG['font']
        self.entry = None

    def _draw(self, canvas, options):
        p = self.anchor
        x,y = canvas.toScreen(p.x,p.y)
        frm = tk.Frame(canvas.master)
        self.entry = tk.Entry(frm,
                              width=self.width,
                              textvariable=self.text,
                              bg = self.fill,
                              fg = self.color,
                              font=self.font)
        self.entry.pack()
        #self.setFill(self.fill)
        return canvas.create_window(x,y,window=frm)

    def getText(self):
        return _tkCall(self.text.get)

    def _move(self, dx, dy):
        self.anchor.move(dx,dy)

    def getAnchor(self):
        return self.anchor.clone()

    def clone(self):
        other = Entry(self.anchor, self.width)
        return _tkCall(self.__clone_help, other)

    def __clone_help(self, other):
        other.config = self.config.copy()
        other.text = tk.StringVar()
        other.text.set(self.text.get())
        other.fill = self.fill
        return other

    def setText(self, text):
        #self.text.set(t)
        _tkCall(self.text.set, text)
            
    def setFill(self, color):
        self.fill = color
        if self.entry:
            #self.entry.config(bg=color)
            _tkExec(self.entry.config,bg=color)

    def _setFontComponent(self, which, value):
        font = list(self.font)
        font[which] = value
        self.font = tuple(font)
        if self.entry:
            #self.entry.config(font=self.font)
            _tkExec(self.entry.config, font=self.font)

    def setFace(self, face):
        if face in ['helvetica','arial','courier','times roman']:
            self._setFontComponent(0, face)
        else:
            raise GraphicsError, BAD_OPTION

    def setSize(self, size):
        if 5 <= size <= 36:
            self._setFontComponent(1,size)
        else:
            raise GraphicsError, BAD_OPTION

    def setStyle(self, style):
        if style in ['bold','normal','italic', 'bold italic']:
            self._setFontComponent(2,style)
        else:
            raise GraphicsError, BAD_OPTION

    def setTextColor(self, color):
        self.color=color
        if self.entry:
            #self.entry.config(fg=color)
            _tkExec(self.entry.config,fg=color)

    def __str__(self):
        return 'Entry "%s" at %s' % (self.getText(), self.anchor.coordStr()) 


class Image(GraphicsObject):

    idCount = 0
    imageCache = {} # tk photoimages go here to avoid GC while drawn 
    
    def __init__(self, pt, pixmap):
        GraphicsObject.__init__(self, [])
        self.anchor = pt.clone()
        self.imageId = Image.idCount
        Image.idCount = Image.idCount + 1
        if type(pixmap) == type(""):
            self.img = tk.PhotoImage(file=pixmap, master=_root)
        else:
            self.img = pixmap.image
            		
    def _draw(self, canvas, options):
        p = self.anchor
        x,y = canvas.toScreen(p.x,p.y)
        self.imageCache[self.imageId] = self.img # save a reference  
        return canvas.create_image(x,y,image=self.img)
    
    def _move(self, dx, dy):
        self.anchor.move(dx,dy)
        
    def undraw(self):
        del self.imageCache[self.imageId]  # allow gc of tk photoimage
        GraphicsObject.undraw(self)

    def getAnchor(self):
        return self.anchor.clone()
    		
    def clone(self):
        imgCopy = Pixmap(_tkCall(self.img.copy))
        other = Image(self.anchor, imgCopy)
        other.config = self.config.copy()
        return other

    def __str__(self):
        return 'Image at %s' % self.anchor.coordStr() 

class Pixmap:
    """Pixmap represents an image as a 2D array of color values.
    A Pixmap can be made from a file (gif or ppm):

       pic = Pixmap("myPicture.gif")
       
    or initialized to a given size (initially transparent):

       pic = Pixmap(512, 512)


    """

    def __init__(self, *args):
        if len(args) == 1: # a file name or pixmap
            if type(args[0]) == type(""):
                self.image = _tkCall(tk.PhotoImage, file=args[0], master=_root)
            else:
                self.image = args[0]
        else: # arguments are width and height
            width, height = args
            self.image = _tkCall(tk.PhotoImage, master=_root,
                                width=width, height=height)
    
    def getWidth(self):
        """Returns the width of the image in pixels"""
        return _tkCall(self.image.width)

    def getHeight(self):
        """Returns the height of the image in pixels"""
        return _tkCall(self.image.height)

    def getPixel(self, x, y):
        """Returns a list [r,g,b] with the RGB color values for pixel (x,y)
        r,g,b are in range(256)

        """
        
        value = _tkCall(self.image.get, x,y)
        if type(value) ==  int:
            return [value, value, value]
        else:
            return map(int, value.split()) 

    def setPixel(self, x, y, (r,g,b)):
        """Sets pixel (x,y) to the color given by RGB values r, g, and b.
        r,g,b should be in range(256)

        """
        
        _tkExec(self.image.put, "{%s}"%color_rgb(r,g,b), (x, y))

    def clone(self):
        """Returns a copy of this Pixmap"""
        return Pixmap(self.image.copy())

    def save(self, filename):
        """Saves the pixmap image to filename.
        The format for the save image is determined from the filname extension.

        """
        
        path, name = os.path.split(filename)
        ext = name.split(".")[-1]
        _tkExec(self.image.write, filename, format=ext)

        
def color_rgb(r,g,b):
    """r,g,b are intensities of red, green, and blue in range(256)
    Returns color specifier string for the resulting color"""
    return "#%02x%02x%02x" % (r,g,b)

def approx(x, digitCutoff = 5):
    """ Returns a fixed point string approximating the number x, limiting
    the number of places past the decimal point if there would be more than
    digitCutoff significant digits, and removing unneeded trailing '0's and '.'.  
    Assuming window dimensions under 10**digitCutoff pixels, and at least some
    legal world coordinate having magnitude at least 1, this system should
    provide concise approximations that distinguish all pixel coordinates.
    """
    fracDig = max(0, digitCutoff - len(str(int(abs(x))).lstrip('0')))
    format = "%%.%df" % fracDig
    return (format % x).rstrip('0').rstrip('.')
    
def test():
    win = GraphWin()
    win.setCoords(0,0,10,10)
    t = Text(Point(5,5), "Centered Text")
    t.draw(win)
    p = Polygon(Point(1,1), Point(5,3), Point(2,7))
    p.draw(win)
    e = Entry(Point(5,6), 10)
    e.draw(win)
    win.getMouse()
    p.setFill("red")
    p.setOutline("blue")
    p.setWidth(2)
    s = ""
    for pt in p.getPoints():
        s = s + "(%0.1f,%0.1f) " % (pt.getX(), pt.getY())
    t.setText(e.getText())
    e.setFill("green")
    e.setText("Spam!")
    e.move(2,0)
    win.getMouse()
    p.move(2,3)
    s = ""
    for pt in p.getPoints():
        s = s + "(%0.1f,%0.1f) " % (pt.getX(), pt.getY())
    t.setText(s)
    win.getMouse()
    p.undraw()
    e.undraw()
    t.setStyle("bold")
    win.getMouse()
    t.setStyle("normal")
    win.getMouse()
    t.setStyle("italic")
    win.getMouse()
    t.setStyle("bold italic")
    win.getMouse()
    t.setSize(14)
    win.getMouse()
    t.setFace("arial")
    t.setSize(20)
    win.getMouse()
    win.close()

if __name__ == "__main__":
    test()
