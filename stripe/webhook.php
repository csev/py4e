<?php
/**
 * Stripe webhook endpoint for PY4E supporter checkout fulfillment.
 *
 * Local dev: stripe listen --forward-to https://local.py4e.com/stripe/webhook.php
 * Put the signing secret from that command in webhook_secret config.
 */

require_once __DIR__ . '/../tsugi/config.php';

use Tsugi\Util\Stripe;

header('Content-Type: text/plain; charset=utf-8');

$cfg = Stripe::config(true);
Stripe::requireSdk();

$payload = @file_get_contents('php://input');
if ($payload === false || $payload === '') {
    Stripe::fail('Empty webhook payload', 400);
}

$sig_header = Stripe::webhookSignatureHeader();
if ($sig_header === '') {
    Stripe::fail('Missing Stripe-Signature header', 400);
}

try {
    $event = Stripe::constructEvent($payload, $sig_header, $cfg['webhook_secrets']);
} catch (\UnexpectedValueException $e) {
    error_log('Stripe webhook invalid payload: ' . $e->getMessage());
    Stripe::fail('Invalid payload', 400);
}

$type = (string) Stripe::val($event, 'type', '');
if ($type !== 'checkout.session.completed') {
    http_response_code(200);
    echo "Ignored event type: {$type}\n";
    exit;
}

$session = Stripe::val($event, 'data', null);
$session = is_object($session) ? Stripe::val($session, 'object', null) : null;
if (!is_object($session)) {
    Stripe::fail('Missing checkout session object in event', 400);
}

$session_id = (string) Stripe::val($session, 'id', '');
if ($session_id === '') {
    Stripe::fail('Missing checkout session id in event', 400);
}

try {
    $stripe = Stripe::client($cfg['secret_key']);
    $session = Stripe::retrieveCheckoutSession($stripe, $session_id);
} catch (\Stripe\Exception\ApiErrorException $e) {
    error_log('Stripe webhook retrieve session failed: ' . $e->getMessage());
    Stripe::fail('Could not retrieve checkout session', 500);
}

$result = Stripe::fulfillCheckoutSession($session, $cfg['supporter_price']);

if (!$result['ok']) {
    error_log('Stripe webhook fulfillment failed session=' . $session_id . ' error=' . $result['error']);
    // Return 200 so Stripe does not retry forever on bad user/profile data.
    http_response_code(200);
    echo 'Fulfillment failed: ' . $result['error'] . "\n";
    exit;
}

http_response_code(200);
if (!empty($result['skipped'])) {
    echo "Already fulfilled for session {$session_id}\n";
} else {
    echo "Supporter granted until {$result['premium_until']} (profile_id={$result['profile_id']})\n";
}
exit;
