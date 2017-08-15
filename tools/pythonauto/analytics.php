<?php
require_once "../config.php";

use \Tsugi\Core\LTIX;
use \Tsugi\UI\Analytics;

// Sanity checks
$LAUNCH = LTIX::requireData();

if ( ! $USER->instructor ) die('Must be instructor');

// View
$OUTPUT->header();
echo('<link rel=import href="'.$CFG->staticroot.'/webcomponents/tsugi/tsugi-analytics-chart.html">'."\n");
echo('<link rel=import href="'.$CFG->staticroot.'/webcomponents/tsugi/tsugi-analytics-script.html">'."\n");
$OUTPUT->bodyStart();
$OUTPUT->topNav();
?>
<p>
<input type=submit name=doCancel onclick="location='<?php echo(addSession('index.php'));?>'; return false;" value="Back"></p>
<tsugi-analytics-chart chartid="chart_div"></tsugi-analytics-chart>
<?php
$analytics_url = addSession($CFG->wwwroot."/api/analytics");

$OUTPUT->footerStart();
echo('<tsugi-analytics-script chartid="chart_div" chartdata="'.$analytics_url.'"></tsugi-analytics-script>'."\n");
$OUTPUT->footerEnd();
