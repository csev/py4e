# Running PY4E with Docker

PY4E is a PHP app built on the [Tsugi](https://www.tsugi.org/) framework. Tsugi
is **not** committed to this repo — the Docker image clones and builds it for
you, generates `tsugi/config.php` from environment variables, and creates the
MySQL tables on first boot. No manual MAMP/Composer steps required.

## Files

| File | Purpose |
|------|---------|
| `Dockerfile` | PHP 8.4 + Apache image; clones & `composer install`s Tsugi |
| `docker-entrypoint.sh` | Generates `config.php`, waits for DB, runs Tsugi DB upgrade |
| `docker-compose.yml` | `web` + `db` (MySQL 8) services — used for both localhost and Dokploy |
| `.env.example` | Copy to `.env` and fill in |

---

## 1. Localhost

```bash
cp .env.example .env        # then edit passwords in .env
docker compose up --build
```

Open:

- Site: <http://localhost:8080>
- Tsugi admin console: <http://localhost:8080/tsugi/admin> (use `PY4E_ADMIN_PW`)

The first boot runs the database upgrade automatically. If the site still shows
a "database" warning, open the admin console and run **Upgrade Database** once,
then refresh.

Change the published port with `PY4E_HTTP_PORT` in `.env`.

Stop / reset:

```bash
docker compose down          # stop
docker compose down -v       # stop AND wipe the database volume
```

---

## 2. VPS with Dokploy

Dokploy runs a **Traefik** reverse proxy that terminates TLS and routes your
domain to the container, so you deploy the same `docker-compose.yml`.

1. Push this repo to GitHub/GitLab (or use Dokploy's raw compose paste).
2. In Dokploy: **Create → Compose**, connect the repo, set the compose path to
   `docker-compose.yml`.
3. Set **Environment Variables** (Dokploy's env editor = your `.env`):

   ```env
   PY4E_APPHOME=https://py4e.example.com     # your real domain, https
   PY4E_ADMIN_PW=<strong-password>
   MYSQL_DATABASE=tsugi
   MYSQL_USER=ltiuser
   MYSQL_PASSWORD=<strong-password>
   MYSQL_ROOT_PASSWORD=<strong-password>
   ```

4. In the service's **Domains** tab, add `py4e.example.com` pointing to the
   `web` service, container port **80**, and enable HTTPS (Let's Encrypt).
5. Deploy.

### Notes for Dokploy

- **Ports:** Traefik reaches the container over the internal Docker network, so
  you don't need the published `ports:` mapping. It's harmless to leave, but you
  can delete the `ports:` block from the `web` service if you prefer Traefik‑only
  exposure.
- **`PY4E_APPHOME` must match your public HTTPS domain** — Tsugi builds absolute
  URLs (logins, LTI launches, assets) from it. Getting this wrong causes broken
  redirects.
- **Persistence:** the `db_data` named volume keeps your database across
  redeploys. Dokploy preserves named volumes by default — don't prune them.
- **Google login / Maps** are optional; set `PY4E_GOOGLE_*` vars to enable, and
  add `https://py4e.example.com/login` as an authorized redirect URI in Google
  Cloud Console.

---

## How configuration works

`docker-entrypoint.sh` copies Tsugi's shipped `config-dist.php` to `config.php`
on first boot, then appends overrides that read these environment variables:

| Env var | Meaning | Default |
|---------|---------|---------|
| `PY4E_APPHOME` | Public site root URL | `http://localhost:8080` |
| `PY4E_WWWROOT` | Public Tsugi mount URL | `${PY4E_APPHOME}/tsugi` |
| `PY4E_STATICROOT` | Where Tsugi static assets (CSS/JS) load from | `https://static.tsugi.org` (CDN) |
| `PY4E_ADMIN_PW` | Tsugi admin console password | `admin` |
| `PY4E_DB_HOST` / `PY4E_DB_PORT` / `PY4E_DB_NAME` | DB connection | `db` / `3306` / `tsugi` |
| `PY4E_DB_USER` / `PY4E_DB_PASS` | DB credentials | `ltiuser` / `ltipassword` |
| `PY4E_GOOGLE_CLIENT_ID` / `_SECRET` / `PY4E_GOOGLE_MAP_API_KEY` | Optional Google integration | (unset) |
| `TSUGI_REF` | Tsugi git branch/tag to build | `master` |

To regenerate `config.php` (e.g. after changing vars), the file lives inside the
container; the simplest reset is `docker compose up --build --force-recreate`.
