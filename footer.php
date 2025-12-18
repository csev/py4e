<?php

$foot = '
<p style="font-size: 75%; margin-top: 5em;">
Copyright Creative Commons Attribution 3.0 - Charles R. Severance
</p><script type="module" src="' . htmlspecialchars($CFG->wwwroot.'/lms/announce/tsugi-announce.js') .'"></script>';

$OUTPUT->setAppFooter($foot);
$OUTPUT->footer();

