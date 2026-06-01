# PY4E Labs (application)

The **labs** hostname (`labs.py4e.com`, `labs.local.py4e.com`) loads everything from **`site-labs/`**: lessons JSON, config, and slim labs UI. Site mode is decided in **`site/vhost.php`** (generic) and **`site-labs/config.php`** (labs-only `$CFG` overrides) — not in Tsugi.

| Path | Purpose |
|------|---------|
| `site-labs/config.php` | `$CFG` overrides when host is `labs.*` (servicename, lessons file) |
| `site-labs/lessons.json` | Lessons JSON used on labs vhosts (`"labs": true` on LTI items) |
| `site-labs/home.php`, `buildmenu.php`, `top.php`, `nav.php`, `footer.php`, `styles.php` | Labs shell (home matches www-style YouTube hero) |
| `/labs` (URL) | Tsugi route — catalog of lab activities (see root `.htaccess`) |

`vhost_id()` is still `labs` from the hostname; `site/site.php` maps that id to the `site-labs` folder via `vhost_variant_directories()`.

Production: `https://labs.py4e.com`  
Local: `https://labs.local.py4e.com`

---

## Local Apache, `/etc/hosts`, and certificates

**Not stored in this repo.** Use the shared machine config under:

**`/Users/csev/htdocs/apache/`**

That folder has:

- `README.md` — MAMP `Include` lines, full `/etc/hosts` list, mkcert steps
- `labs-local-vhosts.conf` — `labs.local.*.com` → each course docroot
- `local-www-vhosts.conf` — `local.*.com` (main site) → each course docroot
- `mkcert-labs-local.sh` / `mkcert-local-www.sh` — certs in `htdocs/certs/`

Restore in MAMP `httpd-vhosts.conf`:

```apache
Include "/Users/csev/htdocs/apache/local-www-vhosts.conf"
Include "/Users/csev/htdocs/apache/labs-local-vhosts.conf"
```

---

## Quick test without custom hostnames

`site/vhost.php` treats **`labs.localhost`** (and any `{id}.localhost`) as subdomain vhost `{id}` if your server maps that host to this docroot.

---

## URLs to verify (py4e)

| URL | Expected |
|-----|----------|
| `https://local.py4e.com/` | Main PY4E home |
| `https://labs.local.py4e.com/` | Labs home |
| `https://labs.local.py4e.com/labs` | Interactive Labs catalog |
| `https://labs.local.py4e.com/lessons` | Lessons UI (`site-labs/lessons.json`) |

Log in on the labs host to launch LTI tools from the catalog.

---

## Other course sites

Copy `site-labs/` and map the vhost id in `vhost_variant_directories()`. Vhosts for all sites are in `htdocs/apache/*.conf`.
