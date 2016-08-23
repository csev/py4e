<?php
require_once "../config.php";

use \Tsugi\Grades\GradeUtil;
use \Tsugi\Core\LTIX;

// Sanity checks
$LAUNCH = LTIX::requireData();
$user_id = $USER->id;

if ( ! isset($_POST['code']) ) {
    echo(json_encode(array("error" => "Missing code")));
    return;
}

// Check to see if the code actually changed
$code = $_POST['code'];
GradeUtil::gradeUpdateJson(array("code" => $code));
$_SESSION['pythonauto_lastcode'] = $code;

$retval = Array("status" => "success");
echo json_encode($retval);
