# Watch Mode - Visual Test Execution

Watch mode allows you to see the browser window as tests run, making it easy to understand what's happening and debug issues.

## Quick Start

**Run tests with visible browser:**
```bash
cd /Users/csev/htdocs/py4e
php tests/SmokeTest.php --watch
```

Or use the convenience script:
```bash
./tests/run-watch.sh
```

## What You'll See

When watch mode is enabled:
- ✅ Browser window opens and stays visible
- ✅ You can watch pages load and navigate
- ✅ Tests pause briefly on each page (2 seconds) so you can see what's happening
- ✅ Browser window closes automatically when tests complete

## Use Cases

**Watch mode is great for:**
- 🐛 **Debugging failures** - See exactly what the browser sees when a test fails
- 📚 **Learning** - Understand what each test is checking
- ✅ **Verification** - Visually confirm that pages render correctly
- 🎨 **UI Testing** - Check visual elements, layouts, and styling

**Headless mode (default) is better for:**
- ⚡ **Speed** - Faster execution (no browser rendering)
- 🤖 **CI/CD** - Automated testing in headless environments
- 📊 **Bulk testing** - Running many tests quickly

## Options

### Command Line Flag
```bash
php tests/SmokeTest.php --watch
```

### Environment Variable
```bash
PANTHER_WATCH=1 php tests/SmokeTest.php
```

### Shell Script
```bash
./tests/run-watch.sh
./tests/run-smoke.sh --watch
```

## Tips

1. **Window Size**: In watch mode, the browser opens at 1400x1000 pixels for better visibility
2. **Pause Duration**: Tests pause for 2 seconds on each page in watch mode
3. **Interrupt**: Press Ctrl+C to stop tests early
4. **Screenshots**: Screenshots are still saved in `tests/screenshots/` if tests fail

## Example Output

```
👀 Watch mode enabled - browser window will be visible
   Press Ctrl+C to stop

=== Running Py4E Smoke Tests ===

✓ Homepage loads successfully
✓ Lessons page loads successfully
✓ Lesson module loads successfully
✓ Tools directory is accessible
✓ Mod directory is accessible

✓ All smoke tests passed!
```

The browser window will open and you'll see each page load as the tests progress!
