<?php
require_once "../config.php";

use \Tsugi\Core\LTIX;
use \Tsugi\Util\LTI;
use \Tsugi\Util\Mersenne_Twister;

require_once "sql_util.php";

$LAUNCH = LTIX::requireData();

// Compute the stuff for the output
$code = $USER->id+$LINK->id+$CONTEXT->id;

header('Content-Disposition: attachment; filename="roster_data.json"');
header('Content-Type: application/json; charset=utf-8');
$roster = makeRoster($code);
echo(LTI::jsonIndent(json_encode($roster)));
