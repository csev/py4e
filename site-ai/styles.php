<?php
/**
 * AI vhost theme — purple palette from site-ai/images/youtube-master-ai-16x9.png.
 * Accent neon is decorative only; text and links use darker violet for WCAG AA.
 */
function ai_print_styles() {
    echo('<style>
:root {
    --ai-neon: #c026d3;
    --ai-bright: #a855f7;
    --ai-accent: #7c3aed;
    --ai-accent-dark: #5b21b6;
    --ai-accent-darker: #4c1d95;
    --ai-surface: #faf5ff;
    --ai-surface-border: #d8b4fe;
    --ai-text: #1e1b4b;
    --ai-text-muted: #4338ca;
    --ai-banner-bg-start: #2e1065;
    --ai-banner-bg-end: #7c3aed;
    --ai-link: #5b21b6;
    --ai-link-hover: #4c1d95;
}
#container.tsugi-ai-home,
#container.tsugi-ai-page {
    max-width: 960px;
    color: var(--ai-text);
}
.tsugi-ai-home a,
.tsugi-ai-page a {
    color: var(--ai-link);
    text-decoration-thickness: 1px;
    text-underline-offset: 0.15em;
}
.tsugi-ai-home a:hover,
.tsugi-ai-home a:focus,
.tsugi-ai-page a:hover,
.tsugi-ai-page a:focus {
    color: var(--ai-link-hover);
}
.tsugi-ai-home a:focus-visible,
.tsugi-ai-page a:focus-visible {
    outline: 2px solid var(--ai-accent);
    outline-offset: 2px;
}
.tsugi-ai-hero-float {
    float: right;
    margin: 0 0 1rem 1.25rem;
    max-width: min(100%, 420px);
}
.tsugi-ai-hero-float img {
    display: block;
    width: 100%;
    height: auto;
    border-radius: 0.5rem;
    border: 2px solid var(--ai-accent);
    box-shadow: 0 4px 24px rgba(76, 29, 149, 0.35);
}
.tsugi-ai-banner {
    background: linear-gradient(135deg, var(--ai-banner-bg-start) 0%, var(--ai-banner-bg-end) 70%, var(--ai-bright) 100%);
    color: #fff;
    padding: 1.25rem 1.5rem;
    border-radius: 0.5rem;
    margin-bottom: 1.25rem;
    border: 1px solid var(--ai-accent-dark);
    box-shadow: 0 0 20px rgba(192, 38, 211, 0.25);
}
.tsugi-ai-banner h1 {
    margin: 0 0 0.35rem 0;
    color: #fff;
    font-size: 1.75rem;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.4);
}
.tsugi-ai-banner p {
    margin: 0;
    color: #f5f3ff;
}
.tsugi-ai-callout {
    background: var(--ai-surface);
    border-left: 4px solid var(--ai-accent);
    padding: 0.75rem 1rem;
    margin: 1rem 0;
    border-radius: 0 0.25rem 0.25rem 0;
    color: var(--ai-text);
}
.tsugi-ai-callout strong {
    color: var(--ai-accent-darker);
}
.tsugi-ai-card-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1rem;
    margin-top: 1rem;
    clear: both;
}
.tsugi-ai-card {
    border: 1px solid var(--ai-surface-border);
    border-radius: 0.5rem;
    padding: 1rem 1.25rem;
    background: var(--ai-surface);
}
.tsugi-ai-card h2 {
    margin-top: 0;
    font-size: 1.1rem;
}
.tsugi-ai-card h2 a {
    color: var(--ai-accent-darker);
}
.tsugi-ai-home::after {
    content: "";
    display: table;
    clear: both;
}
.navbar-default {
    border-color: var(--ai-surface-border);
    background-color: #fff;
}
.navbar-default .navbar-brand,
.navbar-default .navbar-nav > li > a {
    color: var(--ai-accent-darker);
}
.navbar-default .navbar-nav > li > a:hover,
.navbar-default .navbar-nav > li > a:focus,
.navbar-default .navbar-brand:hover,
.navbar-default .navbar-brand:focus {
    color: var(--ai-link-hover);
}
@media (max-width: 640px) {
    .tsugi-ai-hero-float {
        float: none;
        margin: 0 auto 1rem auto;
        max-width: 100%;
    }
}
</style>'."\n");
}
