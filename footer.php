<?php

$foot = '
<p style="font-size: 0.875rem; color: #333; margin-top: 5em;">
Copyright Creative Commons Attribution 4.0 - Charles R. Severance
</p><script type="module" src="' . htmlspecialchars($CFG->wwwroot.'/lms/announce/tsugi-announce.js') .'"></script>';

$OUTPUT->setAppFooter($foot);
$OUTPUT->footer();

