# Testing Tools - Complete Guide

## Quick Answer

**You don't need individual test files for every tool.** The test harness at `/tools` tests all tools automatically. However, you **can** create detailed tests for specific tools if needed.

## Two Testing Approaches

### ✅ Approach 1: Test All Tools Through Harness (Default)

**File**: `ToolsTestHarnessTest.php`

**What it does**:
- Tests that `/tools` harness loads
- Verifies tools are discovered and listed
- Tests that iframe launches work
- **Covers ALL tools at once** (including mod tools like aipaper)

**When to use**:
- ✅ Quick smoke testing
- ✅ Verifying tool installation
- ✅ Basic functionality checks
- ✅ Pre-commit testing

**Run it**:
```bash
php tests/ToolsTests/ToolsTestHarnessTest.php
```

### 🔧 Approach 2: Test Individual Tools (For Detailed Testing)

**Files**: `AipaperTest.php`, `PythonAutoTest.php`, etc.

**What it does**:
- Tests specific tool functionality
- Tests complete tool workflows
- Tests tool-specific features
- More detailed than harness tests

**When to use**:
- ✅ Tool has complex workflows (like aipaper)
- ✅ Tool has specific features to test
- ✅ Tool needs regression testing
- ✅ Tool has known issues to monitor

**Run it**:
```bash
php tests/ToolsTests/AipaperTest.php
php tests/ToolsTests/AipaperTest.php --watch  # See browser
```

## Do You Need Individual Tests?

### ❌ You DON'T need individual tests if:
- Tools work through the harness ✅
- Basic smoke testing is enough ✅
- Tools are simple ✅
- Just verifying installation ✅

### ✅ You SHOULD create individual tests if:
- Tool has complex workflows (like aipaper paper creation)
- Tool has specific features to test
- Tool needs regression testing
- Tool has known issues to monitor
- Tool is critical to your application

## Creating Tests for a Tool (e.g., Aipaper)

### Step 1: Copy Template

```bash
cp tests/ToolsTests/ToolTestTemplate.php tests/ToolsTests/AipaperTest.php
```

### Step 2: Customize

```php
class AipaperTest extends BaseTestCase
{
    protected $toolName = 'aipaper';  // Your tool name
    protected $testAccount = 'Jane Instructor';  // Test account to use
    
    // Override testToolFunctionality() with aipaper-specific tests
    public function testToolFunctionality()
    {
        // Your aipaper-specific tests here
    }
}
```

### Step 3: Test Pattern

All tool tests follow this pattern:

```php
public function testToolWorkflow()
{
    $client = $this->getPantherClient();
    
    // 1. Navigate to test harness
    $crawler = $client->request('GET', $this->baseUrl . '/tools');
    
    // 2. Select test account (if needed)
    // ... select Jane Instructor, Sue Student, or Jane Student ...
    
    // 3. Find and launch tool
    // ... find tool link/button and click ...
    
    // 4. Wait for iframe
    $this->waitForIframe($client, 'iframe', 10);
    
    // 5. Switch to iframe
    $this->switchToIframe($client, 0);
    
    // 6. Test tool functionality
    // ... your tool-specific tests ...
    
    // 7. Switch back to main document
    $this->switchToMainDocument($client);
    
    $client->quit();
}
```

## Example: Aipaper Test

See `AipaperTest.php` for a complete example. It includes:

1. **Tool Discovery** - Checks if aipaper appears in harness
2. **Iframe Launch** - Tests that tool launches in iframe
3. **Functionality** - Placeholder for aipaper-specific tests

To add aipaper-specific tests, override `testToolFunctionality()`:

```php
public function testToolFunctionality()
{
    $client = $this->getPantherClient();
    
    // Launch aipaper through harness
    // ... launch code ...
    
    // Switch to iframe
    $this->switchToIframe($client, 0);
    
    // Test aipaper features:
    // - Create new paper
    // - Add content
    // - Use AI features
    // - Save paper
    // - Submit paper
    
    $this->switchToMainDocument($client);
    $client->quit();
}
```

## Finding Tool Elements in Harness

The test harness UI may vary. To find elements:

1. **Use watch mode** to inspect:
   ```bash
   php tests/ToolsTests/AipaperTest.php --watch
   ```

2. **Look for tool by name**:
   ```php
   $bodyText = $crawler->filter('body')->text();
   if (stripos($bodyText, 'aipaper') !== false) {
       // Tool is listed
   }
   ```

3. **Find clickable elements**:
   ```php
   // Look for links
   $links = $crawler->filter('a');
   foreach ($links as $link) {
       if (stripos($link->textContent, 'aipaper') !== false) {
           // Found tool link
       }
   }
   ```

## Helper Methods

From `BaseTestCase`:

- `switchToIframe($client, $index)` - Switch to iframe by index (0 = first)
- `switchToMainDocument($client)` - Switch back to main document
- `waitForIframe($client, $selector, $timeout)` - Wait for iframe
- `isWatchMode()` - Check if in watch mode
- `takeScreenshot($client, $filename)` - Take screenshot for debugging

## Test Accounts Available

The test harness provides three built-in accounts:

1. **Jane Instructor** - Full instructor access
2. **Sue Student** - Student account
3. **Jane Student** - Another student account

Use these in your tests - no setup needed!

## Running Tests

```bash
# Test all tools (harness)
php tests/ToolsTests/ToolsTestHarnessTest.php

# Test specific tool
php tests/ToolsTests/AipaperTest.php

# Watch mode (see browser)
php tests/ToolsTests/AipaperTest.php --watch

# Run all tests
php tests/run-all.php
```

## Summary

- ✅ **Default**: Use `ToolsTestHarnessTest.php` to test all tools
- ✅ **Optional**: Create `AipaperTest.php` for detailed aipaper testing
- ✅ **Pattern**: Launch tool → Switch to iframe → Test → Switch back
- ✅ **Accounts**: Use built-in test accounts (Jane Instructor, Sue Student, Jane Student)
- ✅ **Watch Mode**: Use `--watch` flag to see what's happening

You don't need individual tests for every tool - only create them for tools that need detailed testing!
