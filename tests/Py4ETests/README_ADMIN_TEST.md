# Admin Smoke Test

## Overview

Tests the Tsugi admin interface at `/tsugi/admin`:
1. Navigates to admin page
2. Logs in with admin password (`$CFG->adminpw`)
3. Tests admin UI navigation (hrefs and modal popups)

## Prerequisites

**Note**: If Google OAuth is enabled in `config.php`, the admin gate will redirect to `/tsugi/login.php` for Google authentication. You may need to log in via Google first, or disable Google OAuth for testing.

## Running the Test

```bash
# Normal mode
php tests/Py4ETests/AdminSmokeTest.php

# Watch mode (visible browser)
php tests/Py4ETests/AdminSmokeTest.php --watch
```

## What Gets Tested

1. **Admin Login Page** - Verifies page loads
2. **Admin Login** - Tests password authentication
3. **Admin UI Navigation** - Tests admin links and modal popups:
   - Manage Access Keys
   - Manage Data Expiry
   - View Contexts
   - View Activity
   - View Users
   - Recent Logins (modal)
   - Upgrade Database (modal)
   - And more...

## Troubleshooting

### "Redirected to login page"

**Cause**: Google OAuth is enabled in `config.php` and user is not authenticated

**Solution**: 
- Log in via Google OAuth first, then run the test
- Or temporarily disable Google OAuth in `config.php` for testing

### "Password field not found"

**Cause**: Page structure differs or login form not loading

**Solution**: 
- Check that admin password is set in `tsugi/config.php`
- Run with `--watch` to see what's happening
- Verify admin page is accessible: `http://localhost:8888/py4e/tsugi/admin`

## Admin Password

The test automatically reads the admin password from `tsugi/config.php`:
```php
$CFG->adminpw = 'short';  // Default
```

The test extracts this value, so no hardcoded passwords needed in test code.
