<?php
/**
 * PY4E labs vhost ($CFG overrides). Loaded via applyVhostVariantConfig() on labs.* hosts.
 * Named vhost.php (not config.php) so it is tracked in git — root .gitignore ignores config.php.
 */

function labs_apply_vhost_config($CFG) {
    if ( $CFG->getVhostId() !== 'labs' ) {
        return;
    }

    $CFG->servicename = 'PY4E Labs';
    $CFG->servicedesc = 'Hands-on autograded labs for Python for Everybody';
    $CFG->context_title = 'Python for Everybody Labs';
    $dir = $CFG->getVhostVariantDir('labs');
    $CFG->lessons = $CFG->getVhostSiteRoot() . '/' . $dir . '/lessons.json';
}
