# Deployment Security Checklist

When deploying tests to production:

## ✅ Security Measures in Place

1. **`.htaccess` file** - Blocks all web access to `/tests` directory
   - ✅ Committed to repository
   - ✅ Denies all web requests
   - ✅ Prevents `/tests` URLs from being accessed

2. **PHP CLI check** - Tests verify they're running from command line
   - ✅ BaseTestCase checks `php_sapi_name() !== 'cli'`
   - ✅ Returns 403 if accessed via web (unless localhost)

3. **Localhost restriction** - Web access only allowed from localhost
   - ✅ Checks `REMOTE_ADDR` for localhost IPs
   - ✅ Blocks remote access

## 🔒 What's Protected

- ✅ `/tests/*.php` - All test files blocked from web access
- ✅ `/tests/**/*.php` - All subdirectories protected
- ✅ Direct URL access - `https://yoursite.com/tests/SmokeTest.php` → 403 Forbidden
- ✅ Remote execution - Tests can't be triggered from internet

## ✅ Safe to Deploy

**Yes, it's safe to commit and deploy** because:

1. `.htaccess` blocks web access
2. PHP checks prevent web execution
3. Tests only run from command line
4. No sensitive operations exposed

## 🧪 Testing Security

To verify security works:

```bash
# This should work (CLI):
php tests/SmokeTest.php

# This should be blocked (if accessed via web):
# https://yoursite.com/tests/SmokeTest.php → 403 Forbidden
```

## 📝 Production Best Practices

1. **Keep `.htaccess`** - Don't remove it
2. **Don't enable web access** - Keep default security settings
3. **Run tests locally** - Use CLI before deploying
4. **CI/CD** - Run tests in CI/CD, not on production server
5. **Monitor logs** - Watch for 403 errors (indicates blocked access attempts)

## 🚨 If You Need Web Access (Development Only)

**⚠️ Only for local development! Never in production!**

1. Temporarily modify `.htaccess`:
   ```apache
   Require ip 127.0.0.1
   Require ip ::1
   ```

2. Or set environment variable:
   ```bash
   ALLOW_WEB_TESTS=1 php tests/SmokeTest.php
   ```

3. **Remember to revert** before committing!
