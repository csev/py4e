<?php
/**
 * Labs vhost home layout — www-style hero video float with light polish.
 */
function labs_print_styles() {
    echo('<style>
#container.tsugi-labs-home {
    max-width: 960px;
}
.tsugi-site-under-construction {
    background: #fef3c7;
    border: 1px solid #d97706;
    color: #78350f;
    padding: 0.65rem 1rem;
    margin: 0 0 1.25rem 0;
    border-radius: 0.25rem;
}
.tsugi-labs-hero-float {
    float: right;
    margin: 0 0 1rem 1.25rem;
    max-width: min(100%, 420px);
}
.tsugi-labs-hero-float iframe {
    display: block;
    width: 100%;
    max-width: 400px;
    height: auto;
    aspect-ratio: 16 / 9;
    border: 0;
}
.tsugi-labs-home::after {
    content: "";
    display: table;
    clear: both;
}
@media (max-width: 640px) {
    .tsugi-labs-hero-float {
        float: none;
        margin: 0 auto 1.25rem;
        max-width: 100%;
    }
}
</style>');
}
