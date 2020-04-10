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
echo("<p>Submitted URL:</p>\n");
$json = json_decode($row['json']);
if ( is_object($json) && isset($json->url)) {
    echo("<p><a href=\"".safe_href($json->url)."\" target=\"_new\">");;
    echo(htmlent_utf8($json->url));
    echo("</a></p>\n");
}

$OUTPUT->footer();
