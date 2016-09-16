<?php

$foot = '';
if ( ! $CFG->OFFLINE ) $foot .= '
<div id="google_translate_element" style="position: fixed; right: 1em; bottom: 0.25em;"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: "en", layout: google.translate.TranslateElement.InlineLayout.SIMPLE, gaTrack: true, gaId: "UA-423997-22"}, "google_translate_element");
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
';

$foot .= '
<p style="font-size: 75%; margin-top: 5em;">
Copyright Creative Commons Attribution 3.0 - Charles R. Severance
</p>
';

$OUTPUT->setAppFooter($foot);
$OUTPUT->footer();
