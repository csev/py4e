<?php

$parsedown_emoji = array(
    ':bulb:' => '<g-emoji class="g-emoji" alias="bulb" fallback-src="https://github.githubassets.com/images/icons/emoji/unicode/1f4a1.png">💡</g-emoji>',
    ':exclamation:' => '<g-emoji class="g-emoji" alias="exclamation" fallback-src="https://github.githubassets.com/images/icons/emoji/unicode/2757.png">❗️</g-emoji>',
    ':warning:' => '<g-emoji class="g-emoji" alias="warning" fallback-src="https://github.githubassets.com/images/icons/emoji/unicode/26a0.png">⚠️</g-emoji>',
);

$parsedown_emoji_search = array();
$parsedown_emoji_replace = array();
foreach($parsedown_emoji as $k => $v ) {
    $parsedown_emoji_search[] = $k;
    $parsedown_emoji_replace[] = $v;
}
