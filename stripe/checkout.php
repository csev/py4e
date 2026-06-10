<?php
/**
 * Supporter checkout: confirm locally, then start Stripe Checkout on POST.
 */

define('COOKIE_SESSION', true);
require_once __DIR__ . '/../tsugi/config.php';

use Tsugi\Core\LTIX;
use Tsugi\Util\Stripe;
use Tsugi\Util\U;

LTIX::session_start();

global $CFG;

$user_id = U::loggedInUserId();
if ($user_id <= 0) {
    $_SESSION['login_return'] = rtrim($CFG->apphome, '/') . '/stripe/checkout.php';
    header('Location: ' . rtrim($CFG->apphome, '/') . '/login');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $site_name = Stripe::siteName($CFG);
    $site_label = Stripe::siteLabel($CFG);
    $supporter_label = '💚 ' . $site_name . ' Supporter';
    $price_phrase = Stripe::supporterPricePhrase($CFG);
    $profile_url = rtrim($CFG->apphome, '/') . '/profile';
    $home_url = rtrim($CFG->apphome, '/') . '/';

    require_once __DIR__ . '/../top.php';
    require_once __DIR__ . '/../nav.php';
    ?>
<main id="container">
<h1><?= htmlspecialchars($supporter_label) ?></h1>
<p>
Support <?= htmlspecialchars($site_label) ?> with a one-time payment<?php if ($price_phrase !== '') { ?>
 of <?= htmlspecialchars($price_phrase) ?><?php } ?>.
You will receive one year of <?= htmlspecialchars($supporter_label) ?> status.
</p>
<p>The exact amount in your currency is shown on the next screen.</p>
<p>You will be redirected to our payment provider to complete checkout securely.</p>
<form method="post" action="">
<p>
<button type="submit" class="btn btn-success">Continue to payment</button>
<a href="<?= htmlspecialchars($profile_url) ?>" class="btn btn-default">Cancel</a>
</p>
</form>
<p style="margin-top: 1.5em;">
<a href="<?= htmlspecialchars($profile_url) ?>">Back to profile</a>
|
<a href="<?= htmlspecialchars($home_url) ?>">Back home</a>
</p>
</main>
    <?php
    require_once __DIR__ . '/../footer.php';
    exit;
}

$cfg = Stripe::config();
$stripe = Stripe::client($cfg['secret_key']);

$base = rtrim($CFG->apphome, '/');
$success_url = $base . '/stripe/success.php?session_id={CHECKOUT_SESSION_ID}';
$cancel_url = $base . '/stripe/cancel.php';

$session_params = array(
    'mode' => 'payment',
    'adaptive_pricing' => array(
        'enabled' => true,
    ),
    'line_items' => array(
        array(
            'price' => $cfg['supporter_price'],
            'quantity' => 1,
        ),
    ),
    'success_url' => $success_url,
    'cancel_url' => $cancel_url,
    'client_reference_id' => (string) $user_id,
    'metadata' => array(
        'user_id' => (string) $user_id,
        'site' => 'py4e',
        'premium_months' => '12',
    ),
);

$email = isset($_SESSION['email']) ? trim((string) $_SESSION['email']) : '';
if ($email !== '') {
    $session_params['customer_email'] = $email;
}

try {
    $session = $stripe->checkout->sessions->create($session_params);
} catch (\Stripe\Exception\ApiErrorException $e) {
    error_log('Stripe checkout API error: ' . $e->getMessage());
    Stripe::fail('Stripe API error: ' . $e->getMessage());
} catch (\Exception $e) {
    error_log('Stripe checkout error: ' . $e->getMessage());
    Stripe::fail('Unexpected error creating checkout session: ' . $e->getMessage());
}

if (empty($session->url)) {
    Stripe::fail('Stripe Checkout Session created but no redirect URL was returned.');
}

header('Location: ' . $session->url, true, 303);
exit;
