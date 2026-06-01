<?php

use \Tsugi\UI\Pages;

require_once __DIR__ . '/top.php';
require_once __DIR__ . '/nav.php';

$lessons = $CFG->apphome . '/lessons';
$assignments = $CFG->apphome . '/assignments';
$book = $CFG->apphome . '/book';
$materials = $CFG->apphome . '/materials';
$login = $CFG->apphome . '/login';
$privacy = $CFG->apphome . '/privacy';
$playlist = 'https://www.youtube.com/watch?v=UjeNA_JtXME&list=PLlRFEj9H3Oj7Bp8-DfGpfAfDBiblRfl5p&index=1';

$hero_img = $CFG->apphome . '/site-ai/images/youtube-master-ai-16x9.png';
$hero_alt = 'Becoming a master programmer using AI — course promotional artwork';

echo('<main id="container" class="tsugi-ai-home">'."\n");
echo('<div class="tsugi-ai-hero-float">'."\n");
echo('<img src="'.htmlspecialchars($hero_img).'" width="420" height="236" ');
echo('alt="'.htmlspecialchars($hero_alt, ENT_QUOTES, 'UTF-8').'" loading="lazy">'."\n");
echo('</div>'."\n");
echo('<div class="tsugi-ai-banner">'."\n");
echo('<h1>'.htmlspecialchars($CFG->context_title).'</h1>'."\n");
if ( isset($CFG->servicedesc) && $CFG->servicedesc ) {
    echo('<p>'.htmlspecialchars($CFG->servicedesc).'</p>'."\n");
}
echo('</div>'."\n");

$front_page_text = null;
if ( isset($_SESSION['id']) && isset($_SESSION['context_id']) ) {
    $front_page_text = Pages::getFrontPageText($_SESSION['context_id']);
}
if ( $front_page_text ) {
    echo('<div class="tsugi-ai-page">'.$front_page_text.'</div>'."\n");
} else {

echo('<div class="tsugi-ai-callout">'."\n");
echo('<p><strong>Learning Python with AI</strong> — ');
echo('This site is Python for Everybody. AI assistants can help you read code, debug, and study — but the goal is for <em>you</em> to understand programming. Use AI to explain, not to skip the work of thinking and practicing.');
echo('</p></div>'."\n");

if ( isset($_SESSION['id']) ) {
?>
<p>
Welcome. You are logged in with access to lessons, autograders, assignments, and badges.
</p>
<ul>
<li>Work through the <a href="<?= htmlspecialchars($lessons) ?>">Lessons</a>
 — videos, readings, and LTI autograders in module order.</li>
<li>Track progress on the <a href="<?= htmlspecialchars($assignments) ?>">Assignments</a>
 page and earn <a href="<?= $CFG->apphome ?>/badges">Badges</a>.</li>
<li>Read the free <a href="<?= htmlspecialchars($book) ?>">textbook</a>
 and browse <a href="<?= htmlspecialchars($materials) ?>">OER materials</a>
 for teaching or remixing.</li>
</ul>
<?php
} else {
?>
<p>
Free
<a href="<?= htmlspecialchars($lessons) ?>">lessons</a>,
<a href="<?= htmlspecialchars($playlist) ?>" target="_blank" rel="noopener noreferrer">lecture videos</a>,
<a href="<?= htmlspecialchars($book) ?>">book</a>,
and autograded assignments to learn Python — with guidance on using AI tools responsibly as you study.
</p>
<p>
<a href="<?= htmlspecialchars($login) ?>">Log in</a>
for a grade book, discussions, badges, and full access to autograders. You can also take the course on
<a href="https://www.coursera.org/specializations/python" target="_blank" rel="noopener noreferrer">Coursera</a>,
<a href="https://www.edx.org/bio/charles-severance" target="_blank" rel="noopener noreferrer">edX</a>,
and other platforms listed on the main PY4E site.
</p>
<?php
}

echo('<div class="tsugi-ai-card-grid">'."\n");
echo('<div class="tsugi-ai-card"><h2><a href="'.htmlspecialchars($lessons).'">Lessons</a></h2>');
echo('<p>Lectures, slides, discussions, quizzes, and autograders in module order.</p></div>'."\n");
echo('<div class="tsugi-ai-card"><h2><a href="'.htmlspecialchars($assignments).'">Assignments</a></h2>');
echo('<p>See scores and completion status across graded activities.</p></div>'."\n");
echo('<div class="tsugi-ai-card"><h2><a href="'.htmlspecialchars($book).'">Book</a></h2>');
echo('<p>Python for Everybody textbook (CC BY).</p></div>'."\n");
echo('</div>'."\n");

echo('<p>We take your privacy seriously on this site; see our ');
echo('<a href="'.htmlspecialchars($privacy).'">Privacy Policy</a>.</p>'."\n");

echo('<p>This site runs on <a href="https://www.tsugi.org" target="_blank" rel="noopener noreferrer">Tsugi</a>. ');
echo('Course content and autograders are open source on ');
echo('<a href="https://github.com/csev/py4e" target="_blank" rel="noopener noreferrer">GitHub</a>.</p>'."\n");

} /* end default home content */

echo('</main>'."\n");

require_once __DIR__ . '/footer.php';
