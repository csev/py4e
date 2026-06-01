<?php

use \Tsugi\UI\Pages;

require_once __DIR__ . '/top.php';
require_once __DIR__ . '/nav.php';

$labs_catalog = $CFG->apphome . '/labs';
$assignments = $CFG->apphome . '/assignments';
$grades = $CFG->apphome . '/grades';
$login = $CFG->apphome . '/login';
$privacy = $CFG->apphome . '/privacy';
$www = 'https://www.py4e.com/';
$playlist = 'https://www.youtube.com/watch?v=UjeNA_JtXME&list=PLlRFEj9H3Oj7Bp8-DfGpfAfDBiblRfl5p&index=1';
$embed = 'https://www.youtube.com/embed/UjeNA_JtXME?list=PLlRFEj9H3Oj7Bp8-DfGpfAfDBiblRfl5p&rel=0';

echo('<main id="container" class="tsugi-labs-home">'."\n");
echo('<div class="tsugi-labs-hero-float">'."\n");
echo('<iframe width="400" height="225" src="'.htmlspecialchars($embed).'" ');
echo('title="Python for Everybody course introduction video" ');
echo('allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" ');
echo('referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe>'."\n");
echo('</div>'."\n");

echo('<h1>'.htmlspecialchars($CFG->context_title).'</h1>'."\n");
if ( isset($CFG->servicedesc) && $CFG->servicedesc ) {
    echo('<p>'.htmlspecialchars($CFG->servicedesc).'</p>'."\n");
}

$front_page_text = null;
if ( isset($_SESSION['id']) && isset($_SESSION['context_id']) ) {
    $front_page_text = Pages::getFrontPageText($_SESSION['context_id']);
}
if ( $front_page_text ) {
    echo($front_page_text."\n");
} else {

if ( isset($_SESSION['id']) ) {
?>
<p>
Welcome to PY4E Labs. You are logged in with access to the interactive lab catalog, autograders,
and a grade book for progress tracking.
</p>
<ul>
<li>
<a href="<?= htmlspecialchars($labs_catalog) ?>">Interactive Labs</a>
 — browse and launch hands-on autograded activities.
</li>
<li>
<a href="<?= htmlspecialchars($assignments) ?>">Assignments</a>
 — track completion and scores.
</li>
<li>
<a href="<?= htmlspecialchars($grades) ?>">Grades</a>
 — view your grade book for this site.
</li>
</ul>
<?php
} else {
?>
<p>
This site is a hands-on companion to
<a href="<?= htmlspecialchars($www) ?>">Python for Everybody</a>.
Explore free
<a href="<?= htmlspecialchars($labs_catalog) ?>">interactive labs</a>,
<a href="<?= htmlspecialchars($playlist) ?>" target="_blank" rel="noopener noreferrer">lecture videos</a>,
and autograded Python exercises focused on practice.
</p>
<p>
<a href="<?= htmlspecialchars($login) ?>">Log in</a>
for a grade book, assignment tracking, and full access to launch autograders from the lab catalog.
You can also take the full course on
<a href="https://www.coursera.org/specializations/python" target="_blank" rel="noopener noreferrer">Coursera</a>
or
<a href="https://www.edx.org/bio/charles-severance" target="_blank" rel="noopener noreferrer">edX</a>.
</p>
<?php
}
?>
<p>
We take your privacy seriously on this site; see our <a href="<?= htmlspecialchars($privacy) ?>">Privacy Policy</a>.
</p>
<p>
This site uses <a href="https://www.tsugi.org" target="_blank" rel="noopener noreferrer">Tsugi</a>
for autograders and course tools. Course materials are open source on <a href="https://github.com/csev/py4e" target="_blank" rel="noopener noreferrer">GitHub</a>.
</p>
<?php
} /* end default home content */

echo('</main>'."\n");

require_once __DIR__ . '/footer.php';
