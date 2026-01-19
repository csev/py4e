# Test Credentials Security

## ⚠️ No Real Credentials in Tests

**The test files contain NO real credentials, passwords, or sensitive information.**

### Placeholder Credentials Only

The test files use **placeholder values** that are clearly not real:

- `test@example.com` / `testpass` - Placeholder instructor account
- `student@example.com` / `testpass` - Placeholder student account

These are:
- ✅ Clearly placeholder values (`@example.com` domain)
- ✅ Not real credentials
- ✅ Safe to commit to repository
- ✅ Intended to be overridden if needed

### What's Safe

✅ **Safe to commit:**
- Placeholder credentials (`test@example.com`, `testpass`)
- Test URLs (`http://localhost:8888/py4e`)
- Test structure and logic
- `.htaccess` security file

### If You Need Real Test Credentials

**⚠️ Never commit real credentials!**

If you need to use real test accounts:

1. **Create a local config file** (add to `.gitignore`):
   ```php
   // tests/config.local.php (DO NOT COMMIT)
   return [
       'test_instructor_email' => 'real-test-instructor@yoursite.com',
       'test_instructor_password' => 'real-password',
       'test_student_email' => 'real-test-student@yoursite.com',
       'test_student_password' => 'real-password',
   ];
   ```

2. **Load in BaseTestCase**:
   ```php
   protected function getTestCredentials() {
       $configFile = __DIR__ . '/config.local.php';
       if (file_exists($configFile)) {
           return require $configFile;
       }
       // Fall back to placeholders
       return [
           'test_instructor_email' => 'test@example.com',
           'test_instructor_password' => 'testpass',
       ];
   }
   ```

3. **Use environment variables** (alternative):
   ```bash
   TEST_INSTRUCTOR_EMAIL=real@example.com \
   TEST_INSTRUCTOR_PASSWORD=realpass \
   php tests/SmokeTest.php
   ```

### Security Checklist

Before committing:
- ✅ No real passwords
- ✅ No real API keys
- ✅ No database credentials
- ✅ No production URLs
- ✅ Only placeholder/test values
- ✅ Local config files in `.gitignore`

### What Gets Checked

The test suite checks for:
- ✅ Page loads (no 500 errors)
- ✅ Content rendering
- ✅ Navigation functionality
- ✅ Basic functionality

It does NOT:
- ❌ Access real user accounts (unless configured)
- ❌ Connect to production databases
- ❌ Use real API keys
- ❌ Perform destructive operations
