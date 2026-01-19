# Py4E Panther QA Test Suite

This directory contains browser automation tests using Symfony Panther for testing the py4e application.

## ⚠️ Security

**Tests are protected from web access** to prevent unauthorized execution:
- `.htaccess` blocks all web access to `/tests` directory
- Tests can only run from command line (CLI) or localhost
- **Safe to deploy** - tests won't run via web URLs on production servers

See `SECURITY.md` for details.

## Setup

1. Install dependencies (if not already installed):
```bash
cd /Users/csev/htdocs/py4e/tsugi
composer install
```

2. Make sure Chrome/Chromium is installed on your Mac:
```bash
# Check if Chrome is installed
which google-chrome-stable || which chromium || which chromium-browser || which google-chrome
```

3. Ensure your local server is running at `http://localhost:8888/py4e/`

## Running Tests

### Run a single test:
```bash
cd /Users/csev/htdocs/py4e
php tests/SmokeTest.php
```

### Watch tests run (see browser window):
```bash
cd /Users/csev/htdocs/py4e
php tests/SmokeTest.php --watch
# or use the convenience script:
./tests/run-watch.sh
```

### Run all tests:
```bash
cd /Users/csev/htdocs/py4e
php tests/run-all.php
```

### Run specific test suite:
```bash
php tests/Py4ETests/LessonsTest.php
php tests/ToolsTests/PythonAutoTest.php
php tests/ToolsTests/ToolsTestHarnessTest.php
php tests/ToolsTests/AipaperTest.php  # Example: test specific tool
```

**Note**: Mod tools are NOT tested directly. They are tested through the tools test harness at `/tools` which goes to `/tsugi/store/test`. This harness provides built-in test accounts (Jane Instructor, Sue Student, Jane Student) and launches tools via iframes.

### Testing Individual Tools

You can create detailed tests for specific tools (like aipaper). See:
- `tests/ToolsTests/ToolTestTemplate.php` - Template for creating tool tests
- `tests/ToolsTests/AipaperTest.php` - Example test for aipaper tool
- `tests/ToolsTests/HOW_TO_TEST_TOOLS.md` - Guide for testing individual tools

## Watch Mode

Watch mode shows the browser window as tests run, so you can see what's happening in real-time. This is useful for:
- Debugging test failures
- Understanding what the tests are doing
- Verifying visual elements

**Enable watch mode:**
- Add `--watch` flag: `php tests/SmokeTest.php --watch`
- Or use: `./tests/run-watch.sh`
- Or set environment variable: `PANTHER_WATCH=1 php tests/SmokeTest.php`

## Test Structure

```
tests/
├── README.md                    # This file
├── SmokeTest.php               # Quick smoke test - run before commits
├── run-all.php                 # Run all test suites
├── BaseTestCase.php            # Base test class with common utilities
├── Py4ETests/                  # Tests for main py4e functionality
│   ├── LessonsTest.php         # Test lessons rendering and navigation
│   ├── HomePageTest.php        # Test homepage functionality
│   └── MaterialsTest.php       # Test materials page
├── ToolsTests/                  # Tests for tools in /tools folder
│   ├── PythonAutoTest.php      # Test pythonauto tool
│   ├── PythonDataTest.php      # Test python-data tool
│   ├── SqlIntroTest.php        # Test sql-intro tool
│   └── ToolsTestHarnessTest.php # Test the tools test harness (/tools -> /tsugi/store/test)
│                                 # This harness tests ALL tools including mod tools
│                                 # Uses built-in accounts: Jane Instructor, Sue Student, Jane Student
```

## Test Organization

### Smoke Tests
Quick tests that verify basic functionality is working. Run these before every commit.

### Py4E Tests
Tests for the main py4e application:
- Lessons rendering (with and without items array)
- Navigation between modules
- Progress badges
- LTI launches
- Discussions

### Tools Tests
Tests for individual tools in `/tools`:
- Tool launches
- Exercise submission
- Grade recording
- Settings pages

### Mod Tests
Tests for tools in `/mod`:
- Peer grading workflows
- Other mod tool functionality

## Writing New Tests

1. Extend `BaseTestCase`:
```php
<?php
require_once __DIR__ . '/BaseTestCase.php';

class MyTest extends BaseTestCase {
    public function testSomething() {
        $client = $this->getPantherClient();
        $crawler = $client->request('GET', $this->baseUrl . '/my-page');
        // Your assertions here
    }
}
```

2. Use helper methods from `BaseTestCase`:
- `getPantherClient()` - Get configured Panther client
- `loginAsInstructor()` - Login as instructor
- `loginAsStudent()` - Login as student
- `waitForElement()` - Wait for element to appear

## CI Integration

These tests can be integrated into CI/CD pipelines. Make sure:
- Chrome/Chromium is available in CI environment
- Xvfb or similar is set up for headless browser testing
- Base URL is configurable via environment variable
