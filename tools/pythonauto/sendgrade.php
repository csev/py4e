<?php
require_once "../config.php";

use \Tsugi\Grades\GradeUtil;
use \Tsugi\Core\LTIX;

// Sanity checks
$LAUNCH = LTIX::requireData();
$user_id = $USER->id;

$grade = 1.0;

$code = $_POST['code'];
GradeUtil::gradeUpdateJson(array("code" => $code));
$_SESSION['pythonauto_lastcode'] = $code;

$debug_log = array();
$retval = LTIX::gradeSend($grade, false, $debug_log);
if ( is_string($retval) ) {
    echo json_encode(Array("status" => "failure", "detail" => $retval, "debug_log" => $debug_log));
    return;
}

$retval = Array("status" => "success", "debug_log" => $debug_log);
echo json_encode($retval);
