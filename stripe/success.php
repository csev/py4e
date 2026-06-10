<?php
/**
 * Return page after Stripe Checkout succeeds.
 *
 * Premium is granted by stripe/webhook.php — this page only confirms payment status.
 */

define('COOKIE_SESSION', true);
require_once __DIR__ . '/../tsugi/config.php';

use Tsugi\Core\LTIX;
use Tsugi\Util\Stripe;
use Tsugi\Util\U;

$launch = LTIX::session_start();

global $CFG;

$session_id = isset($_GET['session_id']) ? trim((string) $_GET['session_id']) : '';
$paid = false;
$status_message = '';
$fulfillment_note = 'Your 💚 PY4E Supporter status is activated by our payment webhook and may take a few seconds to appear.';

if ($session_id === '' || !preg_match('/^cs_/', $session_id)) {
    $status_message = 'Missing or invalid checkout session id.';
} else {
    try {
        $cfg = Stripe::config();
        $stripe = Stripe::client($cfg['secret_key']);
        $session = Stripe::retrieveCheckoutSession($stripe, $session_id);
        $payment_status = (string) Stripe::val($session, 'payment_status', '');
        $paid = ($payment_status === 'paid');

        if ($paid) {
            $status_message = 'Payment received. Thank you for supporting Python for Everybody!';
        } else {
            $status_message = 'Checkout status: ' . htmlspecialchars($payment_status);
        }

        $session_user_id = (int) Stripe::val($session, 'client_reference_id', 0);
        $logged_in_user_id = U::loggedInUserId();
        if ($logged_in_user_id > 0 && $session_user_id > 0 && $logged_in_user_id !== $session_user_id) {
            $status_message .= ' (This payment belongs to a different account.)';
        }
    } catch (\Exception $e) {
        error_log('Stripe success page error: ' . $e->getMessage());
        $status_message = 'Could not verify payment status right now. If you were charged, your supporter status will still be applied shortly.';
    }
}

require_once __DIR__ . '/../top.php';
require_once __DIR__ . '/../nav.php';
?>
<main id="container">
<h1>Thank you!</h1>
<?php if ($status_message !== '') { ?>
<p><?= htmlspecialchars($status_message) ?></p>
<?php } ?>
<?php if ($paid) { ?>
<p><?= htmlspecialchars($fulfillment_note) ?></p>
<?php } ?>
<p>
<a href="<?= htmlspecialchars(rtrim($CFG->apphome, '/') . '/lessons') ?>">Back to Lessons</a>
|
<a href="<?= htmlspecialchars(rtrim($CFG->apphome, '/') . '/profile') ?>">View your profile</a>
</p>
</main>
<?php require_once __DIR__ . '/../footer.php'; ?>
