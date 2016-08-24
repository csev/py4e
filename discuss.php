<?php
use \Tsugi\Util\LTI;
use \Tsugi\Core\LTIX;

require_once "top.php";
require_once "nav.php";

$OUTPUT->flashMessages();

    if ( !isset($CFG->disqushost) ) {
        echo("<p>Disqus not enabled</p>\n");
    } else if ( isset($_SESSION['id']) ) {
?>
<hr/>
<div id="disqus_thread" style="margin-top: 30px;"></div>
<script>

/**
 *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
 *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables */
var disqus_config = function () {
    this.page.url = '<?= $CFG->apphome ?>';  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = 'discuss.php'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
(function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = '//<?= $CFG->disqusshortname ?>.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                                    
<?php
    } else {
        echo("<p>You must be logged in to participate in the discussion.</p>\n");
    }
?>
</div> <!-- container -->
<?php
$OUTPUT->footer();

