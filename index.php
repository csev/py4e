<?php include("header.php");?>
<div class="hide-for-large" id="mobile-support"></div>
<div id="first-row" class="row">
  <div class="small-12 medium-12 large-6 columns">
    <p>The goal of this site is to provide a set of materials in support of my <a href="book.php">Python for Informatics: Exploring Information</a> book to allow you to learn Python on your own. This page serves as an outline of the materials to support the textbook.
    </p>
    <p><b>New:</b> The book is being converted into Python 3 and here is how you could <a href="book/index.htm">help us with the conversion</a>.
    </p>
    <p>You can download the exercises, audio, and video lectures to your local computer so you can play them locally. This can be done with either a Right-Click or a Control-Click in most browsers.
    </p>
  </div>
  <div class="small-12 medium-12 large-6 columns">
     <div class="flex-video">
       <iframe width="100%" height="auto" src="//www.youtube.com/embed/UQVK-dsU7-Y" frameborder="0" allowfullscreen></iframe>
    </div>
  </div>
</div>
<?php
function media($name) {
    echo('<span>Watch the video on <a href="youtube/'.$name.'.php" target="_blank">YouTube</a>, </span><br class="hide-for-large">');
    echo('<span>Listen or download the <a href="podcasts/'.$name.'.mp3" target="_blank">Audio</a>, </span><br class="hide-for-large">');
    echo('<span>Watch or download the <a href="videos/'.$name.'.mp4" target="_blank">Video</a></span>');
}
$afs = "http://www-personal.umich.edu/~csev";
?>

<!-- accordion for mobile -->

<div class="row hide-for-large">
    <div class="small-12 columns">
        <ul class="accordion" data-accordion role="tablist">
            <li class="accordion-item is-active">
                <a href="#panel1d" role="tab" class="accordion-title" id="panel1d-heading" aria-controls="panel1d"><h2>Welcome Lecture</h2></a>
                <div id="panel1d" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="panel1d-heading">
                    <p>(<a href="https://www.youtube.com/watch?v=UQVK-dsU7-Y&index=2&list=PLlRFEj9H3Oj4JXIwMwN1_ss1Tk8wZShEJ" target="_blank">YouTube</a>, <a href="https://itunes.apple.com/us/podcast/python-for-informaticss-official/id711095516?mt=2" target="_blank">Audio podcast for all lectures</a>)
                    </p>
                </div>
            </li>
            <li class="accordion-item">
               <a href="#panel2d" role="tab" class="accordion-title" id="panel1d-heading" aria-controls="panel2d"><h2>Get The Book</h2></a>
               <div id="panel2d" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="panel2d-heading">
                   <p>Get your copy of the <a href="book.php">Python for Informatics: Exploring Information</a>.</p>
               </div>
            </li>

  <li class="accordion-item">
    <a href="#panel3d" role="tab" class="accordion-title" id="panel1d-heading" aria-controls="panel3d">
      <h2>Install Python</h2></a>
    <div id="panel3d" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="panel3d-heading">
      <p>Install the appropriate version of Python and a text editor for your system following <a href=install.php>these instructions</a>.</p>
    </div>
  </li>
  <li class="accordion-item">
    <a href="#panel4d" role="tab" class="accordion-title" id="panel1d-heading" aria-controls="panel4d">
      <h2>Get The Sample Code</h2></a>
    <div id="panel4d" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="panel4d-heading">
      <p>Download <a href="code.zip" target="_blank">Sample code from the book</a>.</p>
    </div>
  </li>
  <li class="accordion-item">
    <a href="#panel5d" role="tab" class="accordion-title" id="panel1d-heading" aria-controls="panel5d">
      <h2>Auto-grader</h2></a>
    <div id="panel5d" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="panel5d-heading">
      <p>Play with the <a href="pythonauto/index.php">Auto-grader</a> and write a "hello world" program.</p>
    </div>
  </li>
  <li class="accordion-item">
    <a href="#panel6d" role="tab" class="accordion-title" id="panel1d-heading" aria-controls="panel6d">
      <h2>Course Slides</h2></a>
    <div id="panel6d" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="panel6d-heading">
      <p>The <a href="https://drive.google.com/folderview?id=0B7X1ycQalUnyWXg2MVhTbEZFT28&usp=sharing" target="_blank">course slides</a> have been converted to Google drive and are being translated into 30 languages.
        </p>
    </div>
  </li>
  <li class="accordion-item">
    <a href="#panel7d" role="tab" class="accordion-title" id="panel1d-heading" aria-controls="panel7d">
      <h2>Chapter 1: Why program?</h2></a>
    <div id="panel7d" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="panel7d-heading">
      (<?php media('Py4Inf-01-Intro'); ?>)
    </div>
  </li>
  <li class="accordion-item">
    <a href="#panel8d" role="tab" class="accordion-title" id="panel1d-heading" aria-controls="panel8d">
      <h2>Chapter 2: Variables, Expressions, and Statements</h2></a>
    <div id="panel8d" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="panel8d-heading">
      (<?php media('Py4Inf-02-Expressions'); ?>)
        <p>
        Worked Exercise Screencasts:
        <a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-02-02.mp4" target="_blank">2.2</a>,
        <a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-02-03.mp4" target="_blank">2.3</a> (suggest download)
        </p>
    </div>
  </li>
  <li class="accordion-item">
    <a href="#panel9d" role="tab" class="accordion-title" id="panel1d-heading" aria-controls="panel9d">
      <h2>Chapter 3: Conditional Execution</h2></a>
    <div id="panel9d" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="panel9d-heading">
      (<?php media('Py4Inf-03-Conditional'); ?>)
         <p>
           Worked Exercise Screencasts:
           <a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-03-01.mp4" target="_blank">3.1</a>,
           <a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-03-02.mp4" target="_blank">3.2</a> (suggest download)
         </p>
    </div>
  </li>
  <li class="accordion-item">
    <a href="#panel10d" role="tab" class="accordion-title" id="panel1d-heading" aria-controls="panel10d">
      <h2>Chapter 4: Functions</h2></a>
    <div id="panel10d" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="panel10d-heading">
      (<?php media('Py4Inf-04-Functions'); ?>)

        <p>Worked Exercise Screencasts:
        <a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-04-06.mp4" target="_blank">4.6</a> (suggest download)
        </p>
    </div>
  </li>
  <li class="accordion-item">
    <a href="#panel11d" role="tab" class="accordion-title" id="panel1d-heading" aria-controls="panel11d">
      <h2>Chapter 5: Loops & Iterations</h2></a>
    <div id="panel11d" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="panel11d-heading">
      (<?php media('Py4Inf-05-Iterations'); ?>)
         <p>Worked Exercise Screencasts:
         <a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-05-01.mp4" target="_blank">5.1</a> (suggest download)
         </p>
    </div>
  </li>
  <li class="accordion-item">
    <a href="#panel12d" role="tab" class="accordion-title" id="panel1d-heading" aria-controls="panel12d">
      <h2>Chapter 6: Strings</h2></a>
    <div id="panel12d" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="panel12d-heading">
      (<?php media('Py4Inf-06-Strings'); ?>)
        <p>
        Worked Exercise Screencasts:
        <a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-06-07.mp4" target="_blank">6.7</a> (suggest download)
        </p>
    </div>
  </li>
  <li class="accordion-item">
    <a href="#panel13d" role="tab" class="accordion-title" id="panel1d-heading" aria-controls="panel13d">
      <h2>Chapter 7: Files</h2></a>
    <div id="panel13d" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="panel13d-heading">
      <p>(<?php media('Py4Inf-07-Files'); ?>)
        </p>
        <p>Worked Exercise Screencasts: <a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-07-01.mp4" target="_blank">7.1</a> (suggest download)
        </p>
    </div>
  </li>
  <li class="accordion-item">
    <a href="#panel14d" role="tab" class="accordion-title" id="panel1d-heading" aria-controls="panel14d">
      <h2>Chapter 8: Lists</h2></a>
    <div id="panel14d" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="panel14d-heading">
      <p>(<?php media('Py4Inf-08-Lists'); ?>)
        </p>
        <p>Worked Exercise Screencasts: <a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-08.mp4" target="_blank">Finding and Fixing Errors - Lists of Words</a> (suggest download)
        </p>
    </div>
  </li>
  <li class="accordion-item">
    <a href="#panel15d" role="tab" class="accordion-title" id="panel1d-heading" aria-controls="panel15d">
      <h2>Chapter 9: Dictionaries</h2></a>
    <div id="panel15d" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="panel15d-heading">
      <p>(<?php media('Py4Inf-09-Dictionaries'); ?>)
        </p>
        <p>Worked Exercise Screencasts: <a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-09.mp4" target="_blank">Most Common Word</a> (suggest download)
         </p>
    </div>
  </li>
  <li class="accordion-item">
    <a href="#panel16d" role="tab" class="accordion-title" id="panel1d-heading" aria-controls="panel16d">
      <h2>Chapter 10: Tuples</h2></a>
    <div id="panel16d" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="panel16d-heading">
      <p>(<?php media('Py4Inf-10-Tuples'); ?>)
        </p>
       <p>Worked Exercise Screencasts: <a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-10.mp4" target="_blank">Top-5 Words</a> (suggest download)
       </p>
    </div>
  </li>
  <li class="accordion-item">
    <a href="#panel17d" role="tab" class="accordion-title" id="panel1d-heading" aria-controls="panel17d">
      <h2>Chapter 11: Regular Expressions</h2></a>
    <div id="panel17d" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="panel17d-heading">
      <p>(<?php media('Py4Inf-11-Regex'); ?>, <a href="lectures/Py4Inf-11-Regex-Guide.pdf" target="_new">Regex-Guide</a>)
        </p>
    </div>
  </li>
  <li class="accordion-item">
    <a href="#panel18d" role="tab" class="accordion-title" id="panel1d-heading" aria-controls="panel18d">
      <h2>Internet History, Technology, and Security</h2></a>
    <div id="panel18d" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="panel18d-heading">
      <p>When I teach from this book I spend two weeks on <a href="https://www.coursera.org/course/insidetheinternet" target="_blank">Internet History, Technology, and Security</a> between Chapters 11 and 12. Talking about history and technology allows the students to take a mental break from programming and lays the ground work for the second half of the book.
        </p>
    </div>
  </li>
  <li class="accordion-item">
    <a href="#panel19d" role="tab" class="accordion-title" id="panel1d-heading" aria-controls="panel19d">
      <h2>Chapter 12: Network Programming (HTTP)</h2></a>
    <div id="panel19d" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="panel19d-heading">
      <p>(Get the <a href="<?php $afs ?>/books/py4inf/media/Py4Inf-12-HTTP.ppt" target="_blank">Slides</a>,<br>Watch on <a href="https://www.youtube.com/watch?v=Zr8BQiPNaFI&index=30&list=PLlRFEj9H3Oj4JXIwMwN1_ss1Tk8wZShEJ" target="_blank">YouTube</a>,<br>Watch or Download the <a href="<?php $afs ?>/books/py4inf/media/Py4Inf-12-HTTP.mov" target="_blank">Video</a>,
      </p>
      <p>
        Listen or download the Lecture Audio
        <a href="<?= $afs ?>/books/py4inf/media/Py4Inf-12-Net-Prog-A.mp3" target="_blank">Part 1</a> and <a href="<?= $afs ?>/books/py4inf/media/Py4Inf-12-Net-Prog-B.mp3" target="_blank">Part 2</a>)
      </p>
      <p>Worked Exercise Screencasts:
        <a href="<?= $afs ?>/books/py4inf/media/Py4Inf-ex-12-04.mp4" target="_blank">12.4 HTML Scraping with BeautifulSoup </a> (suggest download)
      </p>
    </div>
  </li>
  <li class="accordion-item">
    <a href="#panel20d" role="tab" class="accordion-title" id="panel1d-heading" aria-controls="panel20d">
      <h2>Chapter 13: Using Web Services</h2></a>
    <div id="panel20d" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="panel20d-heading">
      <p>(<a href="<?= $afs ?>/books/py4inf/media/Py4Inf-13-WebServices.ppt" target="_blank">Slides</a>, <a href="https://www.youtube.com/watch?v=6cwi1NcL0Zc&index=31&list=PLlRFEj9H3Oj4JXIwMwN1_ss1Tk8wZShEJ" target="_blank">YouTube</a>, Download Video <a href="<?= $afs ?>/books/py4inf/media/Py4Inf-13-Webservices-01.mp4" target="_blank">Part 1</a>, <a href="<?= $afs ?>/books/py4inf/media/Py4Inf-13-Webservices-02.mp4" target="_blank">Part 2</a>, and <a href="<?= $afs ?>/books/py4inf/media/Py4Inf-13-Webservices-03.mp4" target="_blank">Part 3</a>)
        </p>
    </div>
  </li>
  <li class="accordion-item">
    <a href="#panel21d" role="tab" class="accordion-title" id="panel1d-heading" aria-controls="panel21d">
      <h2>Chapter 14: Databases</h2></a>
    <div id="panel21d" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="panel21d-heading">
       <p>
          (<a href="<?= $afs ?>/books/py4inf/media/Py4Inf-14-Database.ppt" target="_blank">Slides</a>, Lecture Audio <a href="<?= $afs ?>/books/py4inf/media/Py4Inf-14-Database-A.mp3" target="_blank">Part 1</a> and <a href="<?= $afs ?>/books/py4inf/media/Py4Inf-14-Database-B.mp3" target="_blank">Part 2</a>)
         SQLite3 Browser: <a href="http://sqlitebrowser.org/" target="_blank">http://sqlitebrowser.org/</a>
      </p>
    </div>
  </li>
  <li class="accordion-item">
    <a href="#panel22d" role="tab" class="accordion-title" id="panel1d-heading" aria-controls="panel22d">
      <h2>Archive</h2></a>
    <div id="panel22d" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="panel22d-heading">
      <p>
          Here is an archive of the <a href="https://archive.org/details/201509UMSI502Podcasts_201601" target="_blank">live lecture recordings</a> from SI502 at the UM School of Information Fall 2015.
        </p>
        <p>
         Here are <a href="videos/" target="_blank">archive copies</a> of the various audio, video, PowerPoints, PDFs and closed caption files if you want to reuse these materials in your own courses. All this material (including audio and video) is Copyright Creative Commons Attribution 3.0 unless otherwise indicated.
        </p>
    </div>
  </li>
  <li class="accordion-item">
    <a href="#panel23d" role="tab" class="accordion-title" id="panel1d-heading" aria-controls="panel23d">
      <h2>Big Data Workshop</h2></a>
    <div id="panel23d" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="panel23d-heading">
       <p>
         Here are the materials for the <a href="workshop/materials.zip">Big Data Workshop</a>.
       </p>
    </div>
  </li>
        </ul>
    </div>
</div>

<!-- tabs for desktop -->

<div class="row collapse show-for-large">
  <div class="large-4 columns">
    <ul class="tabs vertical" id="vert-tabs" data-tabs>
      <li class="tabs-title is-active"><a href="#panel1v" aria-selected="true">Welcome Lecture</a></li>
      <li class="tabs-title"><a href="#panel2v">Get The Book</a></li>
      <li class="tabs-title"><a href="#panel3v">Install Python</a></li>
      <li class="tabs-title"><a href="#panel4v">Get The Sample Code</a></li>
      <li class="tabs-title"><a href="#panel5v">Auto-grader</a></li>
      <li class="tabs-title"><a href="#panel6v">Course Slides</a></li>
      <li class="tabs-title"><a href="#panel7v">Chapter 1: Why Program?</a></li>
      <li class="tabs-title"><a href="#panel8v">Chapter 2: Variables, Expressions, & Statements</a></li>
      <li class="tabs-title"><a href="#panel9v">Chapter 3: Conditional Execution</a></li>
      <li class="tabs-title"><a href="#panel10v">Chapter 4: Functions</a></li>
      <li class="tabs-title"><a href="#panel11v">Chapter 5: Loops & Iterations</a></li>
      <li class="tabs-title"><a href="#panel12v">Chapter 6: Strings</a></li>
      <li class="tabs-title"><a href="#panel13v">Chapter 7: Files</a></li>
      <li class="tabs-title"><a href="#panel14v">Chapter 8: Lists</a></li>
      <li class="tabs-title"><a href="#panel15v">Chapter 9: Dictionaries</a></li>
      <li class="tabs-title"><a href="#panel16v">Chapter 10: Tuples</a></li>
      <li class="tabs-title"><a href="#panel17v">Chapter 11: Regular Expressions</a></li>
      <li class="tabs-title"><a href="#panel18v">Internet History, Technology, and Security</a></li>
      <li class="tabs-title"><a href="#panel19v">Chapter 12: Network Programming (HTTP)</a></li>
      <li class="tabs-title"><a href="#panel20v">Chapter 13: Using Web Services</a></li>
      <li class="tabs-title"><a href="#panel21v">Chapter 14: Databases</a></li>
      <li class="tabs-title"><a href="#panel22v">Archive</a></li>
     <li class="tabs-title"><a href="#panel23v">Big Data Workshop</a></li>
    </ul>
    </div>

    <div class="large-8 columns">
    <div class="tabs-content vertical" data-tabs-content="example-vert-tabs">
      <div class="tabs-panel is-active" id="panel1v">
        <h3>Welcome Lecture</h3>
        <p>(<a href="https://www.youtube.com/watch?v=UQVK-dsU7-Y&index=2&list=PLlRFEj9H3Oj4JXIwMwN1_ss1Tk8wZShEJ" target="_blank">YouTube</a>, <a href="https://itunes.apple.com/us/podcast/python-for-informaticss-official/id711095516?mt=2" target="_blank">Audio podcast for all lectures</a>)
        </p>
      </div>
	  <div class="tabs-panel" id="panel2v">
	    <p>Get your copy of the <a href="book.php">Python for Informatics: Exploring Information</a>.</p>
	  </div>
	  <div class="tabs-panel" id="panel3v">
	    <p>Install the appropriate version of Python and a text editor for your system following <a href=install.php>these instructions</a>.</p>
	  </div>
      <div class="tabs-panel" id="panel4v">
        <p>Download <a href="code.zip" target="_blank">Sample code from the book</a>.</p>
      </div>
      <div class="tabs-panel" id="panel5v">
        <p>Play with the <a href="pythonauto/index.php">Auto-grader</a> and write a "hello world" program.</p>
      </div>
      <div class="tabs-panel" id="panel6v">
        <p>The <a href="https://drive.google.com/folderview?id=0B7X1ycQalUnyWXg2MVhTbEZFT28&usp=sharing" target="_blank">course slides</a> have been converted to Google drive and are being translated into 30 languages.
        </p>
      </div>
      <div class="tabs-panel" id="panel7v">
        <p>Why program?</p>
        (<?php media('Py4Inf-01-Intro'); ?>)
      </div>
      <div class="tabs-panel" id="panel8v">
        <p>Variables, expressions, and statements</p>
        (<?php media('Py4Inf-02-Expressions'); ?>)
        <p>
        Worked Exercise Screencasts:
        <a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-02-02.mp4" target="_blank">2.2</a>,
        <a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-02-03.mp4" target="_blank">2.3</a> (suggest download)
        </p>
      </div>
      <div class="tabs-panel" id="panel9v">
        <p>Conditional Execution</p>
        (<?php media('Py4Inf-03-Conditional'); ?>)
         <p>
           Worked Exercise Screencasts:
           <a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-03-01.mp4" target="_blank">3.1</a>,
           <a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-03-02.mp4" target="_blank">3.2</a> (suggest download)
         </p>
      </div>
      <div class="tabs-panel" id="panel10v">
        <p>Functions</p>
        (<?php media('Py4Inf-04-Functions'); ?>)

        <p>Worked Exercise Screencasts:
        <a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-04-06.mp4" target="_blank">4.6</a> (suggest download)
        </p>
      </div>
      <div class="tabs-panel" id="panel11v">
        <p>Loops and iterations</p>
        (<?php media('Py4Inf-05-Iterations'); ?>)
         <p>Worked Exercise Screencasts:
         <a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-05-01.mp4" target="_blank">5.1</a> (suggest download)
         </p>
      </div>
      <div class="tabs-panel" id="panel12v">
        <p>Strings</p>
        (<?php media('Py4Inf-06-Strings'); ?>)
        <p>
        Worked Exercise Screencasts:
        <a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-06-07.mp4" target="_blank">6.7</a> (suggest download)
        </p>
      </div>

      <div class="tabs-panel" id="panel13v">
        <p>(<?php media('Py4Inf-07-Files'); ?>)
        </p>
        <p>Worked Exercise Screencasts: <a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-07-01.mp4" target="_blank">7.1</a> (suggest download)
        </p>
      </div>
      <div class="tabs-panel" id="panel14v">
        <p>(<?php media('Py4Inf-08-Lists'); ?>)
        </p>
        <p>Worked Exercise Screencasts: <a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-08.mp4" target="_blank">Finding and Fixing Errors - Lists of Words</a> (suggest download)
        </p>
      </div>
      <div class="tabs-panel" id="panel15v">
        <p>(<?php media('Py4Inf-09-Dictionaries'); ?>)
        </p>
        <p>Worked Exercise Screencasts: <a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-09.mp4" target="_blank">Most Common Word</a> (suggest download)
         </p>
      </div>
      <div class="tabs-panel" id="panel16v">
        <p>(<?php media('Py4Inf-10-Tuples'); ?>)
        </p>
       <p>Worked Exercise Screencasts: <a href="<?= $afs ?>/books/py4inf/exercises/Py4Inf-ex-10.mp4" target="_blank">Top-5 Words</a> (suggest download)
       </p>
      </div>
      <div class="tabs-panel" id="panel17v">
        <p>(<?php media('Py4Inf-11-Regex'); ?>, <a href="lectures/Py4Inf-11-Regex-Guide.pdf" target="_new">Regex-Guide</a>)
        </p>
      </div>
      <div class="tabs-panel" id="panel18v">
        <p>When I teach from this book I spend two weeks on <a href="https://www.coursera.org/course/insidetheinternet" target="_blank">Internet History, Technology, and Security</a> between Chapters 11 and 12. Talking about history and technology allows the students to take a mental break from programming and lays the ground work for the second half of the book.
        </p>
      </div>
      <div class="tabs-panel" id="panel19v">
        <p>(<a href="<?= $afs ?>/books/py4inf/media/Py4Inf-12-HTTP.ppt" target="_blank">Slides</a>, <a href="https://www.youtube.com/watch?v=Zr8BQiPNaFI&index=30&list=PLlRFEj9H3Oj4JXIwMwN1_ss1Tk8wZShEJ" target="_blank">YouTube</a>, <a href="<?= $afs ?>/books/py4inf/media/Py4Inf-12-HTTP.mov" target="_blank">Download Video</a>,
      </p>
      <p>
        Lecture Audio
        <a href="<?= $afs ?>/books/py4inf/media/Py4Inf-12-Net-Prog-A.mp3" target="_blank">Part 1</a> and <a href="<?= $afs ?>/books/py4inf/media/Py4Inf-12-Net-Prog-B.mp3" target="_blank">Part 2</a>)
      </p>
      <p>Worked Exercise Screencasts:
        <a href="<?= $afs ?>/books/py4inf/media/Py4Inf-ex-12-04.mp4" target="_blank">12.4 HTML Scraping with BeautifulSoup </a> (suggest download)
      </p>
      </div>
      <div class="tabs-panel" id="panel20v">
        <p>(<a href="<?= $afs ?>/books/py4inf/media/Py4Inf-13-WebServices.ppt" target="_blank">Slides</a>, <a href="https://www.youtube.com/watch?v=6cwi1NcL0Zc&index=31&list=PLlRFEj9H3Oj4JXIwMwN1_ss1Tk8wZShEJ" target="_blank">YouTube</a>, Download Video <a href="<?= $afs ?>/books/py4inf/media/Py4Inf-13-Webservices-01.mp4" target="_blank">Part 1</a>, <a href="<?= $afs ?>/books/py4inf/media/Py4Inf-13-Webservices-02.mp4" target="_blank">Part 2</a>, and <a href="<?= $afs ?>/books/py4inf/media/Py4Inf-13-Webservices-03.mp4" target="_blank">Part 3</a>)
        </p>
      </div>
      <div class="tabs-panel" id="panel21v">
        <p>
          (<a href="<?= $afs ?>/books/py4inf/media/Py4Inf-14-Database.ppt" target="_blank">Slides</a>, Lecture Audio <a href="<?= $afs ?>/books/py4inf/media/Py4Inf-14-Database-A.mp3" target="_blank">Part 1</a> and <a href="<?= $afs ?>/books/py4inf/media/Py4Inf-14-Database-B.mp3" target="_blank">Part 2</a>)
         SQLite3 Browser: <a href="http://sqlitebrowser.org/" target="_blank">http://sqlitebrowser.org/</a>
      </p>
      </div>
      <div class="tabs-panel" id="panel22v">
        <p>
          Here is an archive of the <a href="https://archive.org/details/201509UMSI502Podcasts_201601" target="_blank">live lecture recordings</a> from SI502 at the UM School of Information Fall 2015.
        </p>
        <p>
         Here are <a href="videos/" target="_blank">archive copies</a> of the various audio, video, PowerPoints, PDFs and closed caption files if you want to reuse these materials in your own courses. All this material (including audio and video) is Copyright Creative Commons Attribution 3.0 unless otherwise indicated.
        </p>
      </div>
      <div class="tabs-panel" id="panel23v">
       <p>
         Here are the materials for the <a href="workshop/materials.zip">Big Data Workshop</a>.
       </p>
      </div>

    </div>
  </div>
</div>
<script>
$(".tabs-title").click(function(event){
var num = $(this).position().top
$(".tabs-content").css({top: num, position: 'absolute'})
});
</script>

<div class="row show-for-large">
    <div class="small-12 columns" id="disqus_thread"></div>
</div>
<script>
/**
* RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
* LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
*/

var disqus_config = function () {
this.page.url = PAGE_URL; // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};

(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');

s.src = '//pythonlearn.disqus.com/embed.js';

s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();

</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
<?php include("footer.php"); ?>

