<?php
require_once "../config.php";
\Tsugi\Core\LTIX::getConnection();

use \Tsugi\Grades\GradeUtil;
use \Tsugi\Grades\UI;

$GRADE_DETAIL_CLASS = new \Tsugi\Grades\SimpleGradeDetail();

UI::GradeTable($GRADE_DETAIL_CLASS);
