<?php

if ( ! defined('COOKIE_SESSION') ) {
    define('COOKIE_SESSION', true);
}

use Tsugi\Util\Stripe as StripeUtil;

require_once __DIR__ . '/top.php';
require_once __DIR__ . '/nav.php';

global $CFG;

$site_name = StripeUtil::siteName($CFG);
$site_label = StripeUtil::siteLabel($CFG);
$supporter_label = '💚 ' . $site_name . ' Supporter';
$price_phrase = StripeUtil::supporterPricePhrase($CFG);
$stripe_url = rtrim($CFG->apphome, '/') . '/stripe';
$hero_image = rtrim($CFG->apphome, '/') . '/artwork/master-programmer.png';
?>
<style>
.support-hero-link {
    float: right;
    width: min(100%, 18rem);
    max-width: 18rem;
    margin: 0 0 1rem 1.5rem;
}
.support-hero-link img {
    display: block;
    width: 100%;
    border-radius: 50%;
    box-shadow: 0 0.25rem 1rem rgba(0, 0, 0, 0.15);
}
.support-body h1 {
    margin-top: 0;
}
.support-video-placeholder {
    clear: both;
    margin: 1.5rem 0 2rem;
    padding: 3rem 1.5rem;
    text-align: center;
    border: 2px dashed var(--border-color, #ccc);
    border-radius: 0.5rem;
    color: var(--text-muted, #666);
    background: var(--background-color);
}
.support-cta {
    margin: 2rem 0 1rem;
    padding: 1.25rem 1.5rem;
    border-radius: 0.5rem;
    background: var(--background-darker, #f5f5f5);
}
.support-cta .btn {
    margin-top: 0.75rem;
}
</style>
<main id="container">
<div class="support-body">
<a class="support-hero-link" href="https://www.masterprogrammer.com/" target="_blank" rel="noopener noreferrer" title="Master Programmer">
<img class="support-hero" src="<?= htmlspecialchars($hero_image) ?>" alt="Master Programmer — grow, build, solve, lead">
</a>
<h1><?= htmlspecialchars($supporter_label) ?></h1>
<p>
<?= htmlspecialchars($site_label) ?> is free for everyone. We built it to stay that way — open lessons,
autograders, and materials you can use without a paywall.
</p>

<h2>Why we ask for support</h2>
<p>
Running this site takes real work: servers, software, video hosting, security updates, and time to keep
hundreds of lessons and tools working smoothly for learners around the world.
</p>
<p>
A <strong><?= htmlspecialchars($supporter_label) ?></strong> contribution is optional. It helps cover those costs
and keeps <?= htmlspecialchars($site_name) ?> available for the next student who finds their way here.
In return, you receive one year of supporter status on your profile — a small thank-you, not a feature unlock.
</p>
</div>

<div class="support-video-placeholder" id="support-video">
<p><strong>Video coming soon</strong></p>
<p>We will add a short message here about what your support makes possible.</p>
</div>

<h2>Become a supporter</h2>
<p>
Payments are processed securely through our payment provider. The exact amount in your currency is shown
on the next screen<?php if ($price_phrase !== '') { ?>
 (<?= htmlspecialchars($price_phrase) ?>)<?php } ?>.
<em>There are no refunds.</em>
</p>

<div class="support-cta">
<p style="margin: 0;">
Ready to help? Continue to checkout when you are set.
</p>
<p style="margin: 0.5rem 0 0;">
<a href="<?= htmlspecialchars($stripe_url) ?>" class="btn btn-success">Continue to payment</a>
<a href="<?= htmlspecialchars(rtrim($CFG->apphome, '/') . '/profile') ?>" class="btn btn-default">Back to profile</a>
</p>
</div>
</main>
<?php require_once __DIR__ . '/footer.php'; ?>
