<?php
require_once "../config.php";

use \Tsugi\Core\LTIX;
use \Tsugi\Core\Settings;
use \Tsugi\UI\SettingsForm;
use \Tsugi\Grades\GradeUtil;
use \Tsugi\UI\Lessons;

// Sanity checks
$LAUNCH = LTIX::requireData();
$p = $CFG->dbprefix;

if ( SettingsForm::handleSettingsPost() ) {
    header( 'Location: '.addSession('index.php?howdysuppress=1') ) ;
    return;
}

$oldsettings = Settings::linkGetAll();

// Get the current user's grade data
$row = GradeUtil::gradeLoad();
$OLDCODE = false;
$json = array();
$editor = 1;
if ( $row !== false && isset($row['json'])) {
    $json = json_decode($row['json'], true);
    if ( isset($json["code"]) ) $OLDCODE = $json["code"];
    if ( isset($json["editor"]) ) $editor = $json["editor"];
}

if ( isset($_GET['editor']) && ( $_GET['editor'] == '1' || $_GET['editor'] == '0' ) ) {
    $neweditor = $_GET['editor']+0;
    if ( $editor != $neweditor ) {
        GradeUtil::gradeUpdateJson(array("editor" => $neweditor));
        $json['editor'] = $neweditor;
        $editor = $neweditor;
    }
}
$ace_editor = $editor == 1;

require_once "exercises3.php";

// Get any due date information
$dueDate = SettingsForm::getDueDate();

$menu = false;
if ( $LAUNCH->link && $LAUNCH->user && $LAUNCH->user->instructor ) {
    $menu = new \Tsugi\UI\MenuSet();
    $menu->addLeft('Student Data', 'grades.php');
    if ( $CFG->launchactivity ) {
        $menu->addRight(__('Launches'), 'analytics');
    }
    $menu->addRight(__('Settings'), '#', /* push */ false, SettingsForm::attr());
}

$OUTPUT->header();

// Defaults
$QTEXT = 'You can write any code you like in the window below.  There are three files
loaded and ready for you to open if you want to do file processing:
"mbox-short.txt", "romeo.txt", and "words.txt".';
$DESIRED = false;
$CODE = 'fh = open("romeo.txt", "r")

count = 0
for line in fh:
    print(line.strip())
    count = count + 1

print(count,"Lines")';

$CHECKS = false;
$EX = false;
$XCODE = false;
$EXERCISE_KEY = false;
$PARSONS_SEED = false;

// Check which exercise we are supposed to do - settings, then custom, then 
// inherit, then GET
if ( isset($oldsettings['exercise']) && $oldsettings['exercise'] != '0' ) {
    $ex = $oldsettings['exercise'];
} else {
    $ex = LTIX::ltiCustomGet('exercise');
}
if ( $ex === false && isset($_GET["inherit"]) && isset($CFG->lessons) ) {
    $l = new Lessons($CFG->lessons);
    if ( $l ) {
        $lti = $l->getLtiByRlid($_GET['inherit']);
        if ( isset($lti->custom) ) foreach($lti->custom as $custom ) {
            if (isset($custom->key) && isset($custom->value) && $custom->key == 'exercise' ) {
                $ex = $custom->value;
                Settings::linkSet('exercise', $ex);
            }
        }
    }
}
if ( $ex === false && isset($_REQUEST["exercise"]) ) {
    $ex = $_REQUEST["exercise"];
    Settings::linkSet('exercise', $ex);
}

if ( $ex !== false && $ex != "code" ) {
    if ( isset($EXERCISES[$ex]) ) $EX = $EXERCISES[$ex];
    if ( $EX !== false ) {
        $CODE = '';
        $QTEXT = $EX["qtext"];
        $DESIRED = $EX["desired"];
        $DESIRED2 = isset($EX["desired2"]) ? $EX["desired2"] : '';
        $DESIRED = rtrim($DESIRED);
        $DESIRED2 = rtrim($DESIRED2);
        if ( isset($EX["code"]) ) $CODE = $EX["code"];
        if ( isset($EX["checks"]) ) $CHECKS = json_encode($EX["checks"]);
        if ( isset($EX["xcode"]) ) $XCODE = $EX["xcode"];
        $EXERCISE_KEY = $ex;
        $uid = (isset($USER->id) && $USER->id) ? $USER->id : session_id();
        $PARSONS_SEED = crc32($ex.':'.$uid);
    }
    if ( $EX === false ) {
        echo("</head><body><h1>Error, exercise ".htmlentities($ex).
            " is not available.  Please see your instructor.</h1></body>");
        return;
    }
}

// If we are not using settings, update the default settings.
if ( (! isset($oldsettings['exercise'])) || $oldsettings['exercise'] != $ex ) {
    $oldsettings['exercise'] = $ex;
}

?>
<style>
body { font-family: sans-serif; }
.inputarea { width: 100%; height: 250px; }
#parsons-blocks {
    list-style: none;
    margin: 0;
    padding: 0;
}
.parsons-block {
    display: flex;
    align-items: flex-start;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    background: #f8f8f8;
    user-select: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    cursor: move;
}
.parsons-block.ui-sortable-helper {
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.18);
    background: #fff;
}
.parsons-block-placeholder {
    visibility: visible !important;
    border: 2px dashed #9b8ec4;
    background: #f3f0fa;
    min-height: 40px;
}
.parsons-block-num {
    flex: 0 0 28px;
    text-align: center;
    font-weight: bold;
    padding: 8px 4px;
    background: #e8e8e8;
    border-right: 1px solid #ccc;
    color: #666;
}
.parsons-drag-grip {
    flex: 0 0 22px;
    text-align: center;
    padding: 8px 2px;
    color: #999;
    border-right: 1px solid #ddd;
    font-size: 14px;
    line-height: 1;
}
.parsons-block-code {
    flex: 1;
    font-family: Courier, monospace;
    font-size: 14px;
    padding: 8px 10px;
    color: #333;
    white-space: pre-wrap;
    word-wrap: break-word;
    pointer-events: none;
}
#parsons-hint .modal-body {
    user-select: none;
    -webkit-user-select: none;
    -moz-user-select: none;
}
#parsons-hint .modal-body * {
    user-select: none;
    -webkit-user-select: none;
    -moz-user-select: none;
}
#parsons-hint .modal-header {
    cursor: move;
}
#parsons-hint .modal-header .close {
    cursor: pointer;
}
/* Square icon button — ~1 step above Bootstrap .btn height (info button) */
#forminput .btn.btn-sparkle {
    box-sizing: border-box;
    width: 38px;
    height: 38px;
    min-width: 38px;
    min-height: 38px;
    padding: 0;
    line-height: 1;
    vertical-align: middle;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #2e1065;
    border: 1px solid #4c1d95;
}
#forminput .btn.btn-sparkle:hover,
#forminput .btn.btn-sparkle:focus {
    background: #4c1d95;
    border-color: #5b21b6;
    outline: none;
}
#forminput .btn.btn-sparkle img {
    width: 30px;
    height: 30px;
    object-fit: contain;
    display: block;
    margin: 0;
}
#forminput .btn.btn-sparkle:hover img {
    filter: brightness(1.08);
}
/* Fallback if Bootstrap .sr-only is unavailable */
.sr-only {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    border: 0;
}
#textarea {
    position: relative;
}
#ace-host {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
/* Hide the sync textarea from visual/contrast checks while Ace is active.
   display:none keeps .value readable for Check Code / grading. */
textarea.ace-backed {
    display: none !important;
}
#code {
    color: #000;
    background-color: #fff;
}
.ace_editor {
    font-size: 16px;
}
</style>
<link href="static/splitter/jquery.splitter.css" rel="stylesheet"/>
<?php if ( $ace_editor ) { ?>
<script type="text/javascript" src="static/ace/ace.js"></script>
<script type="text/javascript" src="static/ace/mode-python.js"></script>
<script type="text/javascript" src="static/ace/theme-chrome.js"></script>
<?php } ?>
<!--
<script src="static/skulpt-004/skulpt.min.js?v=1" type="text/javascript"></script>
<script src="static/skulpt-004/skulpt-stdlib.js?v=1" type="text/javascript"></script>
-->
<script src="static/skulpt-2020-09-15/skulpt.min.js?v=1" type="text/javascript"></script>
<script src="static/skulpt-2020-09-15/skulpt-stdlib.js?v=1" type="text/javascript"></script>
<script type="text/javascript">

function builtinRead(x)
{
    if (Sk.builtinFiles === undefined || Sk.builtinFiles["files"][x] === undefined)
        throw "File not found: '" + x + "'";
    return Sk.builtinFiles["files"][x];
}

function makefilediv(name,text) {
    text.replace("&","&amp;");
    text.replace("<","&lt;");
/*
    var msgContainer = document.createElement('div');

    var msg2 = document.createTextNode(text);
    msgContainer.appendChild(msg2);
    msgContainer.setAttribute('id', name);  //set id
    msgContainer.setAttribute('style', 'display:none');  //set CSS
    document.body.appendChild(msgContainer);
*/
    $('body').append('<div id="'+name+'" style="display: none">'+text+'</div>');
}

// May want this under the control of the exercises.
// Instead of always retrieving them

function load_files() {
    $.get('static/files/romeo.txt', function(data) {
        makefilediv('romeo.txt', data);
    });
    $.get('static/files/words.txt', function(data) {
        makefilediv('words.txt', data);
    });
    $.get('static/files/mbox-short.txt', function(data) {
        makefilediv('mbox-short.txt', data);
    });
}

<?php
    if ( $CHECKS === false ) {
        echo("   window.CHECKS = false;\n");
    } else {
        echo("   window.CHECKS = $CHECKS;\n");
    }
    if ( $XCODE === false ) {
        echo("   window.PARSONS_XCODE = false;\n");
        echo("   window.PARSONS_EXERCISE = false;\n");
        echo("   window.PARSONS_SEED = false;\n");
    } else {
        echo("   window.PARSONS_XCODE = ".json_encode($XCODE).";\n");
        echo("   window.PARSONS_EXERCISE = ".json_encode($EXERCISE_KEY).";\n");
        echo("   window.PARSONS_SEED = ".$PARSONS_SEED.";\n");
    }
?>
</script>
<script type="text/javascript" src="static/parsons-blocks.js"></script>
<script type="text/javascript" src="static/parsons-hint.js"></script>
<script type="text/javascript">

    window.GLOBAL_ERROR = true;
    window.GLOBAL_TIMER = false;
    window.ACE_EDITOR = false;
    window.SPLIT_1 = false;
    window.SPLIT_2 = false;
    window.MOBILE = false;
    window.INFO_FOCUS_RETURN = null;

    if (typeof console == "undefined") {
        console = {log: function() {}};
    }

    // Screen-reader announcements: display:none toggles are not reliably spoken,
    // so we mirror status into a dedicated aria-live region.
    function announceStatus(msg) {
        var el = document.getElementById("a11y-status");
        if ( !el ) return;
        el.textContent = "";
        // Clear-then-set so repeated identical messages are still announced.
        setTimeout(function() {
            el.textContent = msg || "";
        }, 50);
    }

    function getOutputPlainText() {
        var output = document.getElementById("output");
        if ( !output ) return "";
        var text = output.innerText || output.textContent || "";
        return text.replace(/\s+/g, " ").trim();
    }

    function getOutputSummary(maxLen) {
        var text = getOutputPlainText();
        if ( !text ) return "Your output is empty.";
        maxLen = maxLen || 280;
        if ( text.length > maxLen ) {
            text = text.substring(0, maxLen) + "…";
        }
        return "Your output updated. " + text;
    }

    function announceOutputUpdated() {
        announceStatus(getOutputSummary());
    }

    function setOutputBusy(busy) {
        var output = document.getElementById("output");
        if ( !output ) return;
        if ( busy ) {
            output.setAttribute("aria-busy", "true");
        } else {
            output.removeAttribute("aria-busy");
        }
    }

    function hideall() {
        $("#check").hide();
        $("#grade").hide();
        $("#redo").hide();
        $("#complete").hide();
        $("#gradegood").hide();
        $("#gradelow").hide();
        $("#gradebad").hide();
    }

    // http://stackoverflow.com/questions/1418050/string-strip-for-javascript
    if(typeof(String.prototype.trim) === "undefined")
    {
        String.prototype.trim = function()
        {
            return String(this).replace(/^\s+|\s+$/g, '');
        };
    }

    function finalcheck() {
        if ( window.GLOBAL_TIMER != false ) window.clearInterval(window.GLOBAL_TIMER);
        window.GLOBAL_TIMER = false;
        hideall();
        setOutputBusy(false);
        var output = document.getElementById("output");
        oldtext = output.innerHTML;
        if ( oldtext.trim().length < 1 ) {
            alert('Your program does not have any output');
            window.GLOBAL_ERROR = true;
        }
        window.console && console.log('finalcheck oldtext='+oldtext);
        if ( oldtext.indexOf('42<span') === 0 ) {
            alert('Although 42 is the answer to the ultimate question of life, the universe, and everything, it appears not to be the correct answer for this assignment.');
        }
        $("#spinner").hide();
        var prog = document.getElementById("code").value;
        var lines = prog.split("\n");
        prog = '';
        for ( var i = 0; i < lines.length; i++ ) {
            line = lines[i];
            if ( line.substring(0,1) == '#' ) continue;
            var pos = line.indexOf('#');
            if ( pos > 0 ) {
                line = line.substring(0,pos);
            }
            prog = prog + line + "\n";
        }
        for ( var key in window.CHECKS ) {
            // The key can be inverted if the first character is !
            if ( key.length > 1 && key.substring(0,1) == '!' ) {
                xkey = key.substring(1);
                if ( prog.indexOf(xkey) < 0 ) continue;
            } else {
                if ( prog.indexOf(key) >= 0 ) continue;
            }
            alert(window.CHECKS[key]);
            window.GLOBAL_ERROR = true;
            break;
        }

        if ( window.GLOBAL_ERROR ) {
<?php if ( $EX !== false ) { ?>
            $("#redo").show();
            announceStatus("Please correct your code and re-run. " + getOutputSummary());
<?php } else { ?>
            $("#complete").show();
            announceStatus("Execution complete. " + getOutputSummary());
<?php } ?>
        } else {
            $("#check").show();
            // $("#grade").show();
            gradeit();
        }
    }

/*
// Brad Miller Python3 hack - breaks printing of tuples
function outf(text) {
    var mypre = document.getElementById(Sk.pre);
    // bnm python 3
    x = text;
    if (x.charAt(0) == '(') {
        x = x.slice(1, -1);
        x = '[' + x + ']';
        try {
            var xl = eval(x);
            xl = xl.map(pyStr);
            x = xl.join(' ');
        } catch (err) {
        }
    }
    text = x;
    text = text.replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/\n/g, "<br/>");
    mypre.innerHTML = mypre.innerHTML + text;
}
*/
    function outf(text)
    {
        // window.console && console.log('Text='+text+':');
        var output = document.getElementById("output");
        oldtext = output.innerHTML;
        // window.console && console.log(oldtext);
        oldtext = oldtext.replace(/<span.*span>/g,"")
        text = text.replace(/</g, '&lt;');
        newtext = oldtext + text;
        output.innerHTML = newtext;

        if ( window.GLOBAL_TIMER != false ) window.clearInterval(window.GLOBAL_TIMER);
        window.GLOBAL_TIMER = setTimeout("finalcheck();",1500);

        var desired = document.getElementById("desired");

        if ( desired == null ) return;

        var desired = desired.innerHTML;
        var desired2 = document.getElementById("desired2").innerHTML;

        deslines = desired.split('\n');
        deslines2 = desired2.split('\n');
        newlines = newtext.split('\n');
        newoutput = '';
        err = false;
        for ( i=0, newlength = newlines.length; i < newlength; i++ ) {
            if ( i > 0 ) newoutput += '\n';
            nl = newlines[i];
            newoutput += nl;
            // Extra blank lines are no problem.
            if ( i >= deslines.length && $.trim(nl) == '' ) {
                continue;
            }
            if ( i >= deslines.length ) {
                if ( !err ) newoutput += '<span style="color:red"> &larr; Extra output</span>';
                err = true;
                continue;
            }
            dl = deslines[i];
            dl2 = dl;
            if ( i < deslines2.length ) {
                dl2 = deslines2[i];
            }
            if ( dl != nl && dl2 != nl) {
                if ( !err ) newoutput += '<span style="color:red"> &larr; Mismatch</span>';
                err = true;
                continue;
            }
        }
        if ( !err && deslines.length > newlines.length ) {
            newoutput += '<span style="color:red"> &larr; Missing output</span>';
            err = true;
        }
        window.GLOBAL_ERROR = err;
        console.log(err);
        output.innerHTML = newoutput;
    }

    var sendCodeFail = false;
    function runit()
    {
        hideall();
        if ( window.ACE_EDITOR !== false ) ace_save();
        var prog = document.getElementById("code").value;
        window.console && console.log('code');
        window.console && console.log(prog);
        if ( prog.length < 1 ) {
            alert("You do not have any Python code");
            announceStatus("You do not have any Python code.");
            return false;
        }
        $("#spinner").show();
        setOutputBusy(true);
        announceStatus("Checking code.");

<?php if ( $RESULT->id ) { ?>
        if ( ! sendCodeFail ) {
            var toSend = { code : prog };
            $.ajax({
                type: "POST",
                url: "<?php echo addSession('sendcode.php'); ?>",
                dataType: "json",
                beforeSend: function (request)
                {
                    request.setRequestHeader("X-CSRF-Token", CSRF_TOKEN);
                },
                data: toSend
            }).done( function (data) {
                console.log("Code updated on server.");
            }).error( function() {
                console.log("Sendcode disabled due to error");
                sendCodeFail = true;
            });
        }
    <?php } ?>

        var output = document.getElementById("output");
        output.innerHTML = '';
        if ( window.GLOBAL_TIMER != false ) window.clearInterval(window.GLOBAL_TIMER);
        window.GLOBAL_TIMER = setTimeout("finalcheck();",2500);
        /* skulpt-004
        Sk.python3 = true;
        Sk.configure({output:outf, read: builtinRead, python3: false});
         */
        // Skulpt-2009-09-15
        // https://github.com/skulpt/skulpt/issues/639
        Sk.configure({output:outf, read: builtinRead, __future__: Sk.python3,
            inputfunTakesPrompt: true,
            inputfun: function (prompt) {
                console.log('inputfun', prompt);
                return window.prompt(prompt);
            }
        });
        // Sk.execLimit = 10000; // Ten Seconds

        try {
            var module = Sk.importMainWithBody("<stdin>", false, prog);
        } catch (e) {
            $("#spinner").hide();
            setOutputBusy(false);
            var f = e + ''; // Convert to a string.
            if ( f.startsWith('SystemExit') ) return true;
            if ( window.GLOBAL_TIMER != false ) window.clearInterval(window.GLOBAL_TIMER);
            window.GLOBAL_TIMER = false;
            window.GLOBAL_ERROR = true;
            hideall();
            $("#redo").show();
            announceStatus("Error running code. " + f);
            alert(e);
        }
        return false;
    }

    function resetcode() {
        if ( ! confirm("Are you sure you want to reset the code area to the original sample code?") ) return;
        if ( window.ACE_EDITOR !== false ) ace_destroy();
        document.getElementById("code").value = document.getElementById("resetcode").value;
        if ( window.MOBILE === false ) load_ace();
    }

    function gradeit() {
        $("#check").hide();
        $("#spinner").show();

        var oldgrade = <?php echo($row && isset($row['grade']) ? $row['grade'] : '0.0'); ?>;
        var grade = 1.0 - <?php echo( $dueDate->penalty); ?>;
        if ( oldgrade > grade ) grade = oldgrade;  // Never go down
        window.console && console.log("Sending grade="+grade);

        if ( window.ACE_EDITOR !== false ) ace_save();
        var code = document.getElementById("code").value;
        var toSend = { grade : grade, code : code };

        $.ajax({
            type: "POST",
            url: "<?php echo addSession('sendgrade.php'); ?>",
            dataType: "json",
            beforeSend: function (request)
            {
                request.setRequestHeader("X-CSRF-Token", CSRF_TOKEN);
            },
            data: toSend
        }).done( function (data) {
            window.console && console.log("Grade response received...");
            window.console && console.log(data);
            $("#spinner").hide();
            if ( data.status == "success") {
                $("#gradegood").show();
                $('#curgrade').text('1');
                announceStatus("Grade updated on server. " + getOutputSummary());
            } else {
                $("#gradebad").show();
                announceStatus("Error storing grade on server.");
            }
        }).error( function(data) {;
            window.console && console.log("Grade response received...");
            window.console && console.log(data);
            $("#spinner").hide();
            $("#gradebad").show();
            announceStatus("Error storing grade on server.");
        });
        return false;
    }

// Deal with missing IE String functions
// http://stackoverflow.com/questions/2308134/trim-in-javascript-not-working-in-ie
// https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/TrimLeft

if(typeof String.prototype.trimLeft !== 'function') {
    String.prototype.trimLeft = function() {
        return this.replace(/^\s+/,"");
    }
}

if(typeof String.prototype.trimRight !== 'function') {
    String.prototype.trimRight = function() {
        return this.replace(/\s+$/,"");
    }
}

<?php if ( $USER->instructor && $XCODE !== false ) { ?>
    window.INSTRUCTOR_XCODE = <?php echo json_encode($XCODE); ?>;

    function copyInstructorSolution() {
        var text = window.INSTRUCTOR_XCODE;
        if (!text) {
            return false;
        }
        function copied() {
            alert('Solution copied to clipboard.');
        }
        function fallbackCopy() {
            var ta = document.createElement('textarea');
            ta.value = text;
            ta.setAttribute('readonly', '');
            ta.style.position = 'fixed';
            ta.style.left = '-9999px';
            document.body.appendChild(ta);
            ta.select();
            try {
                if ( document.execCommand('copy') ) {
                    copied();
                } else {
                    alert('Could not copy automatically.');
                }
            } catch (e) {
                alert('Could not copy automatically.');
            }
            document.body.removeChild(ta);
        }
        if ( navigator.clipboard && navigator.clipboard.writeText ) {
            navigator.clipboard.writeText(text).then(copied).catch(fallbackCopy);
        } else {
            fallbackCopy();
        }
        return false;
    }
<?php } ?>

    function getFocusableIn(container) {
        if ( !container ) return [];
        var nodes = container.querySelectorAll(
            'a[href], button:not([disabled]), textarea:not([disabled]), input:not([disabled]), select:not([disabled]), [tabindex]:not([tabindex="-1"])'
        );
        var list = [];
        for ( var i = 0; i < nodes.length; i++ ) {
            if ( nodes[i].getClientRects().length > 0 ) {
                list.push(nodes[i]);
            }
        }
        return list;
    }

    function trapModalFocus(e, modal) {
        if ( e.keyCode !== 9 ) return; // Tab
        var focusable = getFocusableIn(modal);
        if ( !focusable.length ) {
            e.preventDefault();
            return;
        }
        var first = focusable[0];
        var last = focusable[focusable.length - 1];
        if ( e.shiftKey ) {
            if ( document.activeElement === first || !modal.contains(document.activeElement) ) {
                e.preventDefault();
                last.focus();
            }
        } else if ( document.activeElement === last ) {
            e.preventDefault();
            first.focus();
        }
    }

    function openInfoDialog() {
        window.INFO_FOCUS_RETURN = document.getElementById('info-button') || document.activeElement;
        $('#info').modal('show');
        return false;
    }

    function initAccessibleModals() {
        var $info = $('#info');
        if ( $info.length ) {
            $info.on('shown.bs.modal', function () {
                var closeBtn = this.querySelector('.close');
                if ( closeBtn ) closeBtn.focus();
            });
            $info.on('hidden.bs.modal', function () {
                var ret = window.INFO_FOCUS_RETURN || document.getElementById('info-button');
                if ( ret && typeof ret.focus === 'function' ) ret.focus();
                window.INFO_FOCUS_RETURN = null;
            });
            $info.on('keydown', function (e) {
                trapModalFocus(e, this);
            });
        }

        var $parsons = $('#parsons-hint');
        if ( $parsons.length ) {
            $parsons.on('shown.bs.modal', function () {
                var closeBtn = this.querySelector('.close');
                if ( closeBtn ) closeBtn.focus();
            });
            $parsons.on('hidden.bs.modal', function () {
                var ret = document.getElementById('parsons-hint-button');
                if ( ret && typeof ret.focus === 'function' ) ret.focus();
            });
            $parsons.on('keydown', function (e) {
                trapModalFocus(e, this);
            });
        }
    }

</script>
<style>
pre {
white-space: -moz-pre-wrap; /* Mozilla, supported since 1999 */
white-space: -pre-wrap; /* Opera 4 - 6 */
white-space: -o-pre-wrap; /* Opera 7 */
white-space: pre-wrap; /* CSS3 */
word-wrap: break-word; /* IE 5.5+ */
font-size: 14px;
}
</style>
<?php
$OUTPUT->bodyStart();
$OUTPUT->topNav($menu);
$OUTPUT->flashMessages();

if ( $USER->instructor ) {
    SettingsForm::start();
    SettingsForm::select('exercise', __('No Exercise - Python Playground'), array_keys($EXERCISES));
    SettingsForm::dueDate();
    SettingsForm::done();
    SettingsForm::end();

} // end isInstructor() 

$page_heading = 'Python Autograder';
if ( isset($LINK->title) && strlen($LINK->title) > 0 ) {
    $page_heading = $LINK->title;
} else if ( $EX === false ) {
    $page_heading = 'Python Playground';
}
?>
<h1 class="sr-only"><?php echo(htmlentities($page_heading)); ?></h1>

<div class="modal fade" id="info" tabindex="-1" role="dialog" aria-modal="true" aria-labelledby="info-title">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title" id="info-title">
<?php
if ( isset($LINK->title) ) {
    echo(htmlentities($LINK->title));
} else {
    $OUTPUT->welcomeUserCourse();
}
?></h4>
      </div>
      <div class="modal-body" id="info-body">
<?php if ( $EX === false ) { ?>
        <p>This is an open-ended space for you to write and execute Python programs.
        This page does not check our output and it does not send a grade back.  It is
        here as a place for you to develop small programs and test things out.
        </p>
<?php if ( $RESULT->id !== false ) { ?>
        <p>
        Whatever code you type will be saved and restored when you come back to this
        page.</p>
<?php } ?>
        <p>
        Remember that this is an in-browser Python emulator and as your programs get
        more sophisticated, you may encounter situations where this Python emulator
        gives <i>different</i> results than the real Python 
        running on your laptop, desktop, or server.  It is intended to be used
        for simple programs being developed by beginning programmers while they
        are learning to program.
        </p> <p>
        There are three files loaded into this environment from the
        <a href="http://www.py4e.com/" target="_blank">Python for Everybody</a>
        web site and ready for you to open if you want to
        do file processing: "mbox-short.txt", "romeo.txt", and "words.txt".
        </p>
<?php } else { ?>
<?php if ( isset($LTI['grade']) ) { ?>
        <p style="border: blue 1px solid">Your current grade in this
        exercise is <span id="curgrade"><?php echo($LTI['grade']); ?></span>.</p>
<?php } ?>
        <p>Your goal in this auto grader is to write or paste in a program that implements the specifications
        of the assignment.  You run the program by pressing "Check Code".
        The output of your program is displayed in the "Your Output" section of the screen.
        If your output does not match the "Desired Output", you will not get a score.
        </p><p>
        Even if "Your Output" matches "Desired Output" exactly,
        the autograder still does a few checks of your source code to make sure that you
        implemented the assignment using the expected techniques from the chapter. These messages
        can also help struggling students with clues as to what might be missing.
        </p>
        <p>
        This autograder keeps your highest score, not your last score.  You either get full credit (1.0) or
        no credit (0.0) when you run your code - but if you have a 1.0 score and you do a failed run,
        your score will not be changed.
        </p>
<?php } ?>
<?php
    $identity = __("Logged in as: ").$USER->key;
    if ( strlen($USER->email) > 0 ) {
        $identity .= ' ' . htmlentities($USER->email);
    }
    if ( strlen($USER->displayname) > 0 ) {
        $identity .= ' ' . htmlentities($USER->displayname);
    }
    echo("<p>".$identity."</p>")
?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php if ( $XCODE !== false ) { ?>
<div class="modal fade" id="parsons-hint" tabindex="-1" role="dialog" aria-modal="true" aria-labelledby="parsons-hint-title">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title" id="parsons-hint-title">Code Fragments</h2>
      </div>
      <div class="modal-body">
        <p>These code fragments are <b>out of order</b>.
        <b>Drag and drop</b> them into the correct sequence, then write your own solution in the editor.</p>
        <div id="parsons-blocks"></div>
        <p class="text-muted" style="margin-top: 12px; font-size: 12px;">
        Drag to rearrange. Copying from this window is disabled.</p>
      </div>
<?php if ( $USER->instructor ) { ?>
      <div class="modal-footer">
        <button onclick="return copyInstructorSolution();" class="btn btn-default" type="button">Copy Solution</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
<?php } ?>
    </div>
  </div>
</div>
<?php } ?>

<div id="overall" style="border: 3px solid black;">
<div id="inputs">
<div class="well" style="background-color: #EEE8AA">
<?php
if ( $dueDate->message ) {
    echo('<p style="color:red;">'.$dueDate->message.'</p>'."\n");
}
?>
<?php echo($QTEXT); ?>
</div>
<form id="forminput">
<?php
    if ( $EX !== false ) {
         echo('<button onclick="runit()" class="btn btn-primary" type="button">Check Code</button>'."\n");
    } else {
        echo('<button onclick="runit()" class="btn btn-warning" type="button">Run Python</button>'."\n");
    }
    if ( strlen($CODE) > 0 ) {
        echo('<button onclick="resetcode()" class="btn btn-default" type="button">Reset Code</button> ');
    }
    echo('<button id="info-button" onclick="return openInfoDialog();" class="btn btn-default" type="button" aria-label="About this autograder" title="About this autograder"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></button> '."\n");
    if ( $XCODE !== false ) {
        echo('<button id="parsons-hint-button" onclick="return showParsonsHint();" class="btn btn-sparkle" type="button" title="Study code fragments" aria-label="Study code fragments">'."\n");
        echo('<img src="static/sparkle.png" alt="" aria-hidden="true">'."\n");
        echo('</button> '."\n");
    }
?>
<img id="spinner" src="static/spinner.gif" alt="" aria-hidden="true" style="vertical-align: middle;display: none">
<div id="a11y-status" class="sr-only" role="status" aria-live="polite" aria-atomic="true"></div>
<span id="redo" style="color:red;display:none" aria-hidden="true"> Please correct your code and re-run. </span>
<span id="complete" style="color:green;display:none" aria-hidden="true"> Execution complete. </span>
<span id="gradegood" style="color:green;display:none" aria-hidden="true"> Grade updated on server. </span>
<span id="gradelow" style="color:green;display:none" aria-hidden="true"> Grade updated on server. </span>
<span id="gradebad" style="color:red;display:none" aria-hidden="true"> Error storing grade on server. </span>
<br/>
&nbsp;<br/>
<div id="textarea" class="inputarea">
<textarea id="code" aria-label="Python code editor" style="width:100%; height: 100%; font-family:Courier,fixed;font-size:16px;">
<?php
if ( $OLDCODE !== false ) {
    echo(htmlentities($OLDCODE));
} else {
    echo(htmlentities($CODE));
}
?>
</textarea>
</div>
</div>
<div id="outputs">
<div id="left">
<b id="your-output-label">Your Output</b>
<pre id="output" class="inputarea" role="region" aria-labelledby="your-output-label" tabindex="0"></pre>
</div>
<?php if ( $EX !== false ) { ?>
<div id="right">
<b id="desired-output-label">Desired Output</b>
<pre id="desired" class="inputarea" role="region" aria-labelledby="desired-output-label" tabindex="0"><?php echo($DESIRED); echo("\n"); ?></pre>
<span id="desired2" style="display:none"><?php echo($DESIRED2); echo("\n"); ?></span>
</div>
<?php } ?>
</div>
</div>
</form>
</div>
<div id="footer" style="text-align: center">
Setting:
<?php
    if ( $ace_editor ) {
        $editurl = reconstruct_query('index.php',array("editor" => 0));
        $textval = "Hide editor";
    } else {
        $editurl = reconstruct_query('index.php',array("editor" => 1));
        $textval = "Show editor";
    }
    echo('<a href="'.$editurl.'">'.$textval.'</a>');
?>
This software is based on <a href="http://skulpt.org/" target="_blank">Skulpt</a>
and <a href="https://ace.c9.io/" target="_blank">Ace</a>.
The source code for this auto-grader is available on
<a href="https://github.com/csev/tsugi" target="_blank">on GitHub</a>.
<textarea id="resetcode" cols="80" style="display:none" aria-hidden="true" tabindex="-1" readonly aria-label="Original sample code used by Reset Code">
<?php   echo(htmlentities($CODE)); ?>
</textarea>
<?php
$OUTPUT->footerStart();
?>
<script type="text/javascript" src="static/splitter/jquery.splitter-0.14.0.js"></script>
<script type="text/javascript">
// $(document).ready(function() { doc_ready(); } );
function compute_divs() {
    $doc = $(window).height();
    $ot = $('#overall').offset().top;
    $ft = $('#forminput').offset().top;
    window.console && console.log('doc='+$doc+' ft='+$ft+' overall='+$ot);
    $avail = $doc - ($ot - 30);
    if ( $avail < 400 ) $avail = 400;
    if ( $avail > 700 ) $avail = 700;
    $favail = $avail - $ft + $ot;

    $('#overall').width('95%').height($avail);
    $('#inputs').width('45%').height($avail);
    $('#forminput').width('95%').height($favail);
    $('#outputs').width('45%').height($avail);
    $('#textarea').height('100%');
    $('#output').height('100%');
<?php if ( $EX !== false ) { ?>
    $('#desired').height('100%');
<?php } ?>

    if ( window.SPLIT_1 == false ) {
        window.SPLIT_1 = $('#overall').split({
            orientation:'vertical',
            limit:100,
            onDrag: function () {
                if ( window.ACE_EDITOR !== false ) window.ACE_EDITOR.resize();
            }
        });
        window.console && console.log(window.SPLIT_1);
<?php if ( $EX !== false ) { ?>
        window.SPLIT_2 = $('#outputs').split({
            orientation:'horizontal',
            limit:100,
            onDrag: function () {
                if ( window.ACE_EDITOR !== false ) window.ACE_EDITOR.resize();
            }
        });
<?php } ?>
    } else {
        window.SPLIT_1.position('50%');
<?php if ( $EX !== false ) { ?>
        window.SPLIT_2.position('50%');
<?php } ?>
    }
    window.console && console.log('avail='+$avail+' favail='+$favail);
    if ( window.ACE_EDITOR !== false ) {
        window.ACE_EDITOR.resize();
    }
}

<?php if ( $ace_editor ) { ?>
function ace_save() {
    if ( window.ACE_EDITOR === false ) return;
    document.getElementById("code").value = window.ACE_EDITOR.getValue();
}

function ace_destroy() {
    if ( window.ACE_EDITOR === false ) return;
    ace_save();
    window.ACE_EDITOR.destroy();
    var host = document.getElementById("ace-host");
    if ( host && host.parentNode ) {
        host.parentNode.removeChild(host);
    }
    window.ACE_EDITOR = false;
    var ta = document.getElementById("code");
    if ( ta ) {
        ta.classList.remove("ace-backed");
        ta.removeAttribute("aria-hidden");
        ta.removeAttribute("tabindex");
    }
}

function load_ace() {
    if ( typeof ace === "undefined" ) return;
    if ( window.ACE_EDITOR !== false ) return;
    var ta = document.getElementById("code");
    if ( !ta ) return;
    var parent = document.getElementById("textarea");
    if ( !parent ) return;

    var host = document.getElementById("ace-host");
    if ( !host ) {
        host = document.createElement("div");
        host.id = "ace-host";
        host.setAttribute("role", "presentation");
        parent.insertBefore(host, ta);
    }

    ta.classList.add("ace-backed");
    ta.setAttribute("aria-hidden", "true");
    ta.setAttribute("tabindex", "-1");

    ace.config.set("basePath", "static/ace");
    var editor = ace.edit(host);
    editor.setTheme("ace/theme/chrome");
    editor.session.setMode("ace/mode/python");
    editor.setShowPrintMargin(false);
    editor.session.setTabSize(4);
    editor.session.setUseSoftTabs(true);
    editor.session.setUseWorker(false);
    editor.setOptions({
        fontSize: "16px",
        fontFamily: "Courier,monospace",
        showLineNumbers: true,
        highlightActiveLine: true,
        behavioursEnabled: true,
        wrap: false
    });
    editor.setValue(ta.value || "", -1);
    editor.clearSelection();
    editor.gotoLine(1, 0, false);

    // Ace's input textarea — better SR target than the backed-off source textarea
    try {
        var aceInput = editor.textInput && editor.textInput.getElement
            ? editor.textInput.getElement()
            : null;
        if ( aceInput ) {
            aceInput.setAttribute("aria-label", "Python code editor");
        }
    } catch (e) {}

    window.ACE_EDITOR = editor;
    editor.resize();
}
<?php } else { ?>
function ace_save() {}
function ace_destroy() {}
function load_ace() {}
<?php } ?>

 $().ready(function(){
    if ( typeof initParsonsHintGuards === 'function' ) {
        initParsonsHintGuards();
    }
    initAccessibleModals();
    // I cannot make this reliable :(
    $(window).resize(function () { compute_divs(); });
    window.MOBILE = $(window).width() <= 480;
    // window.MOBILE = TRUE;
<?php if ( $EX === false && ! isset($_REQUEST['howdysuppress']) ) { ?>
    // You know it is a hack when you are doing setTimeOut() :)
    $('#info').on('hidden.bs.modal', function (e) {
        if ( MOBILE === false ) {
            compute_divs();
            setTimeout('compute_divs();', 1200);
        }
    })
    window.INFO_FOCUS_RETURN = document.getElementById('info-button');
    $('#info').modal();
<?php } ?>
    load_files();
    if ( MOBILE === false ) {
<?php if ( $ace_editor ) { ?>
        load_ace();
<?php } ?>
        compute_divs();
        setTimeout('compute_divs();', 1200);
    }
 });
</script>
<?php
if ( $USER->instructor ) {
    echo("<!--\n");
    echo(">Global Tsugi Objects:\n\n");
    var_dump($USER);
    var_dump($CONTEXT);
    var_dump($LINK);
    echo("\n<hr/>\n");
    echo("Session data (low level):\n");
    echo($OUTPUT->safe_var_dump($_SESSION));
    echo("\n-->\n");
}
?>
<?php
$OUTPUT->footerEnd();
