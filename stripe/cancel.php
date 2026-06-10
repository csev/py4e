<?php
/**
 * Return page when the user cancels Stripe Checkout.
 */

define('COOKIE_SESSION', true);
require_once __DIR__ . '/../tsugi/config.php';

use Tsugi\Core\LTIX;

$launch = LTIX::session_start();

global $CFG;

require_once __DIR__ . '/../top.php';
require_once __DIR__ . '/../nav.php';
?>
<main id="container">
<h1>Checkout cancelled</h1>
<p>No charge was made. You can try again whenever you like.</p>
<p>
<a href="<?= htmlspecialchars(rtrim($CFG->apphome, '/') . '/stripe/checkout.php') ?>">Try checkout again</a>
|
<a href="<?= htmlspecialchars(rtrim($CFG->apphome, '/') . '/') ?>">Back home</a>
</p>
</main>
<?php require_once __DIR__ . '/../footer.php'; ?>
