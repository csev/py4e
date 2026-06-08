# PY4E with AI (application)

The **ai** hostname (`ai.py4e.com`, `ai.local.py4e.com`) loads everything from **`site-ai/`**: lessons JSON, config, home page, and themed shell (www-style nav).

| Path | Purpose |
|------|---------|
| `site-ai/vhost.php` | `$CFG` overrides on `ai.*` hosts (servicename, lessons path, theme) |
| `site-ai/lessons.json` | Lessons and badges for the AI track |
| `site-ai/home.php` | AI-themed home page |
| `site-ai/buildmenu.php`, `top.php`, `nav.php`, `footer.php` | Shell |
| `site-ai/styles.php` | Banner and accent CSS |

`vhost_id()` is still `ai` from the hostname; `site/site.php` maps that id to the `site-ai` folder via `vhost_variant_directories()`.

Production (when configured): `https://ai.py4e.com`  
Local: `https://ai.local.py4e.com` or `https://ai.localhost` (same docroot as PY4E)

Add vhosts in **`/Users/csev/htdocs/apache/`** (see that folder’s README):

```apache
Include "/Users/csev/htdocs/apache/ai-local-vhosts.conf"
```

`/etc/hosts`:

```
127.0.0.1 ai.local.py4e.com
```

TLS:

```bash
chmod +x /Users/csev/htdocs/apache/mkcert-ai-local.sh
/Users/csev/htdocs/apache/mkcert-ai-local.sh
```

## URLs to verify

| URL | Expected |
|-----|----------|
| `https://ai.local.py4e.com/` | AI home (banner, lessons-focused copy) |
| `https://ai.local.py4e.com/lessons` | Lessons UI (`site-ai/lessons.json`) |
| `https://ai.local.py4e.com/assignments` | Assignments list |

## Other *4e sites

Copy `site-ai/` (or `site-labs/`) and map the vhost id in `vhost_variant_directories()`; adjust `*_apply_vhost_config()` in the variant `config.php`. Keep `site/vhost.php` generic.
