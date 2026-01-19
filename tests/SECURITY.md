# Security Considerations for Test Suite

## Web Access Protection

**Tests are blocked from web access by default** to prevent unauthorized execution on production servers.

### Protection Mechanisms

1. **`.htaccess` file** - Blocks all web access to `/tests` directory
2. **PHP CLI check** - Tests verify they're running from command line
3. **Localhost check** - If accessed via web, only localhost is allowed
4. **Environment variable** - Can be enabled with `ALLOW_WEB_TESTS=1` (not recommended for production)

### Running Tests Safely

**✅ Safe ways to run tests:**

1. **Command line (recommended):**
   ```bash
   php tests/SmokeTest.php
   ```

2. **Localhost only:**
   - Tests can run from `127.0.0.1`, `::1`, or local network IPs
   - This is blocked by `.htaccess` by default

**❌ Blocked:**

- Direct web access from internet
- Production servers (unless explicitly configured)
- Remote access

### If You Need Web Access (Development Only)

**⚠️ Only for local development!**

1. **Modify `.htaccess`** to allow localhost:
   ```apache
   Require ip 127.0.0.1
   Require ip ::1
   ```

2. **Or set environment variable** (not recommended):
   ```bash
   ALLOW_WEB_TESTS=1 php tests/SmokeTest.php
   ```

### Production Deployment

When deploying to production:

1. **Keep `.htaccess`** - It blocks web access
2. **Don't enable web access** - Tests should only run via CLI
3. **Remove test files** (optional) - Or keep them but ensure `.htaccess` is in place
4. **CI/CD** - Run tests in CI/CD pipeline, not on production server

### Best Practices

- ✅ Run tests from command line before commits
- ✅ Use CI/CD for automated testing
- ✅ Keep `.htaccess` in place
- ✅ Never enable web access on production
- ✅ Test locally, deploy tested code
