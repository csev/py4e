# BaseToolTest - Complete Tool Testing Framework

## Overview

`BaseToolTest` provides a complete test flow for testing any tool through the `/tools` test harness. It handles:

1. ✅ Finding tool in store listing (`/tools` → `/tsugi/store/`)
2. ✅ Navigating to tool details page (clicking "Details" button)
3. ✅ Clicking "Try It" button to launch test harness
4. ✅ Testing tool launch in iframe
5. ✅ Testing all four identities (Jane Instructor, Sue Student, Ed Student, Anonymous)

## Quick Start

Create a test for any tool by extending `BaseToolTest`:

```php
<?php
require_once __DIR__ . '/BaseToolTest.php';

class YourToolTest extends BaseToolTest
{
    protected $toolKey = 'your-tool-key';  // REQUIRED: folder name
    protected $toolName = 'Your Tool Name';  // Optional: display name
}

// Run tests
if (php_sapi_name() === 'cli' && basename(__FILE__) === basename($_SERVER['SCRIPT_NAME'])) {
    $test = new YourToolTest();
    exit($test->runAll());
}
```

## Example: AipaperTest

See `AipaperTest.php` for a complete example:

```php
class AipaperTest extends BaseToolTest
{
    protected $toolKey = 'aipaper';
    protected $toolName = 'AI Paper';
    
    // Optional: Add tool-specific tests
    public function testAipaperFunctionality()
    {
        // Your custom tests here
    }
}
```

## Test Flow

The base test follows this exact flow:

1. **Store Listing** (`testToolAppearsInStore`)
   - Navigate to `/tools` (redirects to `/tsugi/store/`)
   - Find tool card (`div.app`) containing tool name/key
   - Verify tool is listed

2. **Tool Launch** (`testToolLaunchesViaTryIt`)
   - Navigate to tool details page (click "Details" button)
   - Click "Try It" button
   - Wait for iframe to appear
   - Switch to iframe and verify content loaded

3. **All Identities** (`testAllIdentities`)
   - Launch tool as default identity (Jane Instructor) - **tested once**
   - Switch to Identity tab
   - Test remaining identities:
     - Sue Student (switched via identity tab)
     - Ed Student (switched via identity tab)
     - Anonymous (switched via identity tab)
   - For each identity:
     - Tool launches in iframe
     - Calls `testToolFunctionalityForIdentity()` hook (override in derived class)

## Available Methods

### Public Test Methods (automatically run)

- `testToolAppearsInStore()` - Verify tool appears in store listing
- `testToolLaunchesViaTryIt()` - Test tool launch via "Try It" button
- `testAllIdentities()` - Test all four identities

### Protected Helper Methods (for custom tests)

- `navigateToToolDetails($client)` - Navigate to tool details page
- `clickTryItButton($client, $crawler)` - Click "Try It" button
- `waitForIframeElement($client, $timeout)` - Wait for iframe to appear
- `switchIdentity($client, $crawler, $identityKey)` - Switch to different identity

## Customizing Tests

### Add Tool-Specific Tests Per Identity

Override `testToolFunctionalityForIdentity()` to add tests that run for each identity:

```php
class AipaperTest extends BaseToolTest
{
    protected $toolKey = 'aipaper';
    
    /**
     * Test aipaper functionality for a specific identity
     * This is called automatically for each identity (Jane Instructor, Sue Student, Ed Student, Anonymous)
     */
    protected function testToolFunctionalityForIdentity($client, $identityKey, $identityName, $iframeCrawler)
    {
        // Call parent for basic content check
        parent::testToolFunctionalityForIdentity($client, $identityKey, $identityName, $iframeCrawler);
        
        // Add tool-specific tests here
        // $identityKey will be: 'instructor', 'learner1', 'learner2', or 'learner3'
        
        // Example: Test instructor-specific features
        if ($identityKey === 'instructor') {
            $createButton = $iframeCrawler->filter('button.create-paper');
            if ($createButton->count() > 0) {
                echo "     ✓ Instructor has create button\n";
            }
        }
        
        // Example: Test student-specific features
        if (in_array($identityKey, ['learner1', 'learner2'])) {
            // Test student features
        }
        
        // Example: Test paper creation workflow
        // $createButton = $iframeCrawler->filter('button.create-paper');
        // if ($createButton->count() > 0) {
        //     $client->click($createButton->link());
        //     // ... test creation flow ...
        // }
    }
}
```

**Important**: The base test automatically:
1. Launches tool for Jane Instructor (initial launch) - **tested once**
2. Tests Jane Instructor functionality via `testToolFunctionalityForIdentity()`
3. Switches to Sue Student and tests
4. Switches to Ed Student and tests  
5. Switches to Anonymous and tests

You only need to override `testToolFunctionalityForIdentity()` - the base class handles all the navigation and identity switching!

## Running Tests

```bash
# Run all tests for a tool
php tests/ToolsTests/AipaperTest.php

# Watch mode (see browser)
php tests/ToolsTests/AipaperTest.php --watch

# Run specific test method (if you add custom methods)
# (Modify runAll() to call your method)
```

## Test Output

```
=== Running Base Tool Tests for 'aipaper' ===

✓ Tool 'aipaper' found in store listing
   Navigating to tool details...
   Clicking 'Try It' button...
   Waiting for tool to launch in iframe...
✓ Tool launched successfully via 'Try It'
   Content length: 1234 chars
   Testing all identities...
   Testing identity: Jane Instructor...
     ✓ Jane Instructor: Tool launched successfully (1234 chars)
   Testing identity: Sue Student...
     ✓ Sue Student: Tool launched successfully (1234 chars)
   Testing identity: Ed Student...
     ✓ Ed Student: Tool launched successfully (1234 chars)
   Testing identity: Anonymous...
     ✓ Anonymous: Tool launched successfully (1234 chars)
✓ All identities tested

✓ All base tool tests completed!
```

## Troubleshooting

### "Tool card not found"
- Check that `$toolKey` matches the tool's folder name
- Check that `$toolName` matches the tool's display name (if set)
- Verify tool is registered (has `register.php` in its folder)

### "Details button not found"
- Tool card structure may differ
- Check HTML structure of tool cards in `/tools`

### "Try It button not found"
- Details page structure may differ
- Check if button is in a form or is a direct link

### "Iframe not found"
- Tool may not be launching automatically
- Tool may require manual interaction
- Tool registration may be incomplete
- Try running with `--watch` to see what's happening

### "Identity tab not found"
- Tab structure may differ
- Check HTML structure of test harness page

## Creating Tests for Other Tools

### Example: Agreement Tool

```php
class AgreementTest extends BaseToolTest
{
    protected $toolKey = 'agreement';
    protected $toolName = 'Agreement Tool';
}
```

### Example: Breakout Tool

```php
class BreakoutTest extends BaseToolTest
{
    protected $toolKey = 'breakout';
    protected $toolName = 'Breakout Tool';
}
```

That's it! The base class handles all the navigation and testing.

## Next Steps

1. Create test file extending `BaseToolTest`
2. Set `$toolKey` and optionally `$toolName`
3. Run the test
4. Add tool-specific tests if needed

The base test provides comprehensive coverage of the test harness flow!
