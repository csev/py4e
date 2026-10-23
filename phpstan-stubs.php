<?php

/**
 * Globals that Tsugi defines while booting a request.
 * Declared here so static analysis does not need a running site.
 */

namespace {
    /** @var \Tsugi\Config\ConfigInfo|null $CFG */
    $CFG;

    /** @var \Tsugi\UI\Output|null $OUTPUT */
    $OUTPUT;

    /** @var \Tsugi\Util\PDOX|null $PDOX */
    $PDOX;

    /** @var \Tsugi\Core\Launch|null $LAUNCH */
    $LAUNCH;

    /** @var \Tsugi\Core\Result|null $RESULT */
    $RESULT;

    /** @var \Tsugi\Core\User|null $USER */
    $USER;

    /** @var \Tsugi\Core\Link|null $LINK */
    $LINK;

    /** @var \Tsugi\Core\Context|null $CONTEXT */
    $CONTEXT;

    /** @var object|null $dueDate */
    $dueDate;

    /**
     * Set by the untracked tools/python-data/data/opengeo_api.php key file.
     *
     * @var string
     */
    $OPENGEO_KEY;
}
