<?php
/**
 * PY4E AI vhost ($CFG overrides). Loaded via applyVhostVariantConfig() on ai.* hosts.
 * Named vhost.php (not config.php) so it is tracked in git — root .gitignore ignores config.php.
 */

function ai_apply_vhost_config($CFG) {
    if ( $CFG->getVhostId() !== 'ai' ) {
        return;
    }

    $CFG->servicename = 'PY4E with AI';
    $CFG->servicedesc = 'Python for Everybody with guidance on learning alongside AI tools';
    $CFG->context_title = 'Python for Everybody (AI)';
    $dir = $CFG->getVhostVariantDir('ai');
    $CFG->lessons = $CFG->getVhostSiteRoot() . '/' . $dir . '/lessons.json';
    $CFG->theme_base = '#7c3aed';
}
