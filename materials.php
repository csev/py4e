<?php include("top.php");?>
<?php include("nav.php");?>
<div id="iframe-dialog" title="Read Only Dialog" style="display: none;">
   <iframe name="iframe-frame" style="height:600px" id="iframe-frame"
    src="<?= $OUTPUT->getSpinnerUrl() ?>"></iframe>
</div>
<div style="float: right; margin: 5px;"/><iframe style="width:120px;height:240px;" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" src="//ws-na.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&OneJS=1&Operation=GetAdHtml&MarketPlace=US&source=ss&ref=as_ss_li_til&ad_type=product_link&tracking_id=drchu02-20&marketplace=amazon&region=US&placement=1530051126&asins=1530051126&linkId=2ea6c883c6cf11f29568856139bad34b&show_border=true&link_opens_in_new_window=true"></iframe></div>
<h2>Open Educational Resources (OER)</h2>
<p>
You are welcome to use/reuse/remix/retain the materials from this site in your own courses.
Nearly all the material in this web site is Copyright Creative Commons Attribution.  These are
links to downloadable content as well as links to other sources of this course material.
</p>
<p><b><a href="courses">Other courses/web sites using this book</a></b>
</p>
<ul>
    <li>Video Lectures
    <ul>
    <li><a href="https://www.youtube.com/playlist?list=PLlRFEj9H3Oj7Bp8-DfGpfAfDBiblRfl5p" target="_blank">YouTube Playlist</a></li>
    <li><a href="https://itunes.apple.com/us/podcast/python-for-everybody-video/id1214664324" target="_blank">iTunes Video</a></li>
    <li><a href="http://amzn.to/2mFrCuh" target="_blank">Amazon Prime Video</a></li>
    </ul>
    </li>
    <li>Audio Lectures
    <ul>
    <li><a href="https://itunes.apple.com/us/podcast/python-for-everybody-audio-py4e/id1214665693" target="_blank">iTunes Audio</a></li>
    <li><a href="https://play.google.com/music/listen?u=0#/ps/Ijgj3aofh6m73rps4wtdk6djhv4" target="_blank">Google Play Audio</a></li>
    </ul>
    </li>
    <li>
        <a href="lectures3/" target="_blank">Lecture Slides and Handouts</a>
    </li>
    <li>
        <a href="code3.zip" target="_blank">Sample Code ZIP</a>
        (<a href="code3/" target="_blank">Individual Files</a>)
    </li>
    <li>
        <a href="book.php">Free Textbook</a>
    </li>
    <li>
        All the course content and autograder software is available on
        <a href="https://github.com/csev/py4e" target="_blank">
        Github</a> under a Creative Commons or Apache 2.0 license.
    </li>
</ul>
<p>
If you are interested in translating the book or other online materials into another
language, I have provided
some <a href="https://github.com/csev/py4e/blob/master/TRANSLATION.md" target="_new">
instructions on how to translate this course</a> in my GitHub repository.
If you are starting a translation, please contact me so we can coordinate our activities.
</p>
<h2>Using this Course in Your Local LMS</h2>
<p>This web site uses the <a href="http://www.tsugi.org/" target="_blank">Tsugi</a> software
to both host the software-based autograders and provide this material so it can easily be
integrated into a Learning Management System like
<a href="http://www.sakaiproject.org/" target=_blank">Sakai</a>, Moodle, Canvas, Desire2Learn, Blackboard
or similar.
</p>
<ul>
<li>
<p>
If your LMS supports
<a href="https://www.imsglobal.org/activity/learning-tools-interoperability" target="_blank">
IMS Learning Tools Interoperabilty®</a> version 1.x, you can login, and request access
to the tools on this site.  Make sure you indicate whether you need an LTI 1.x
key.   You will be given instructions on how to use
your credentials once you get your key.
</p>
</li>
<li>
<p>
<a href="#" title="Download course material"
  onclick="showModalIframeUrl(this.title, 'iframe-dialog', 'iframe-frame', 'tsugi/cc/select', _TSUGI.spinnerUrl, true); return false;" >
  Download course material
  </a> as an
<a href="https://www.imsglobal.org/cc/index.html" target="_blank">
IMS Common Cartridge®</a>, to import into an LMS like Sakai, Moodle, Canvas,
Desire2Learn, Blackboard, or similar.
After loading the Cartridge, you will need an LTI key and secret to provision the
LTI-based tools provided in that cartridge.
</p>
</li>
<li>
<p>
If your LMS supports
<a href="https://www.imsglobal.org/specs/lticiv1p0" target="_blank">
Learning Tools Interoperability® Content-Item Message</a> you can
login and apply for an LTI 1.x key and secret and install this web site
into your LMS as an App Store / Learning Object Repository that allows
you to author you class in your LMS while selecting tools and content
from this site one item at a time.  You will be given instructions
on how to set up the "app store" in your LMS when you receive
your key and secret.
</p>
</li>
<li><p>
If you are using
<a href="https://classroom.google.com" target="_blank">Google Classroom</a>,
you can automatically link the resources in this site
into your classroom in the
<a href="<?= $CFG->apphome ?>/lessons/intro?nostyle=yes">low-style view of the lessons</a>. (must be logged in)
</p></li>
<li>
<p>
If your LMS supports neither Content Item, nor Common Cartridge, but does support LTI,
you can hand-copy the links from this course material into your LMS one-by-one.  We have
a <a href="<?= $CFG->apphome ?>/lessons/intro?nostyle=yes">special low-style view of the lessons</a>
to make this hand-copying as easy as it can be.
</p>
</li>
</ul>
<h2>Audio Archive</h2>
<p>
Here is an archive of the
<a href="https://archive.org/details/201509UMSI502Podcasts_201601" target="_blank">live lecture recordings</a>
from SI502 as taught on campus at the UM School of Information Fall 2015.
</p>


<?php include("footer.php"); ?>

