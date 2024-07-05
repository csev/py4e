<?php

use \Tsugi\Core\LTIX;
use \Tsugi\Util\LTI;
use \Tsugi\Util\Net;

$oldgrade = $RESULT->grade;
if ( isset($_POST['grade']) ) {

    $grade = $_POST['grade'] ?? null;

    if (!is_numeric($grade) ) {
        $_SESSION['error'] = "A QA Engineer walks into restaraunt ...";
        header('Location: '.addSession('index.php'));
        return;
    }

    $grade = $grade * 1.0;

    if ( $grade < 0.0 ) {
        $_SESSION['error'] = "No need to be so negative about yourself ...";
        header('Location: '.addSession('index.php'));
        return;
    }

    if ( $grade < 1.0 ) {
        $_SESSION['error'] = "The range is 0-100 ...";
        header('Location: '.addSession('index.php'));
        return;
    }

    if ( $grade == 42.0 ) {
        $_SESSION['error'] = "Achievement unlocked ...";
        $grade = 100.0;
        LTIX::gradeSendDueDate($grade/100.0, $oldgrade, $dueDate);
        header('Location: '.addSession('index.php'));
        return;
    }

    if ( $grade < 51.0 ) {
        $_SESSION['error'] = "You should have more confidence ...";
        header('Location: '.addSession('index.php'));
        return;
    }

    if ( $grade > 100.0 ) {
        $_SESSION['error'] = "I like your confidence but the protocol does not support numbers > 100 ...";
        header('Location: '.addSession('index.php'));
        return;
    }

    LTIX::gradeSendDueDate($grade/100.0, $oldgrade, $dueDate);
    header('Location: '.addSession('index.php'));
    return;
}

?>
<p>
<b>Choose your own grade!</b>
</p>
<p>
Congratulations - this assignment gives you a grade with no work.  Frankly, you have been working very hard
to get to this point and you deserve to relax and let this tool give you the grade you deserve!
You can choose any grade you want (we recommend 100).
</p>
<form method="post">
Grade you want (0-100): <input type="text" size="10" name="grade">
<input type="submit" value="Submit Grade"><br/>
</form>
<p>
Actually we use this placeholder assignment when we are going to delete an assignment from a
future verison of the course but need a place holder for that assignment until the course is revised :). 
And we also give you a free look at one of Dr. Chuck's race cars - the "Forarri".
</p>
<center>
<img src="Forarri_2MB.png" style="width: 50%;">
</center>
