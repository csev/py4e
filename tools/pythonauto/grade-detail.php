<?php
require_once "../config.php";
\Tsugi\Core\LTIX::getConnection();

use \Tsugi\Grades\GradeUtil;

session_start();

// Get the user's grade data also checks session
$row = GradeUtil::gradeLoad($_REQUEST['user_id']);

$menu = new \Tsugi\UI\MenuSet();
$menu->addLeft(__('Back to all grades'), 'index.php');

// View
$OUTPUT->header();
$OUTPUT->bodyStart();
$OUTPUT->topNav($menu);
$OUTPUT->flashMessages();

// Show the basic info for this user
GradeUtil::gradeShowInfo($row, false);

// Unique detail
echo("<p>Submission:</p>\n");
$json = json_decode($row['json']);
if ( is_object($json) && isset($json->code)) {
    echo("<pre>\n");
    echo(htmlent_utf8($json->code));
    echo("\n");
    echo("</pre>\n");
}

$OUTPUT->footer();
