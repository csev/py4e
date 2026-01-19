# How to Test Individual Tools

## Overview

You **don't need separate test files for each tool**. Instead, test tools through the **test harness at `/tools`** which:
- Lists ALL tools (including mod tools like aipaper)
- Provides built-in test accounts
- Launches tools in iframes

However, if you want **detailed tests for specific tools**, you can create individual test files.

## Two Approaches

### Approach 1: Test All Tools Through Harness (Recommended)

**Use**: `ToolsTestHarnessTest.php`
- Tests that harness loads
- Tests that tools are listed
- Tests that iframes work
- **Covers all tools at once**

**When to use**: 
- Quick smoke testing
- Verifying tool discovery
- Basic functionality checks

### Approach 2: Test Individual Tools (For Detailed Testing)

**Use**: Create specific test files like `AipaperTest.php`
- Tests specific tool functionality
- Tests tool workflows
- Tests tool-specific features

**When to use**:
- Testing complex tool workflows
- Testing tool-specific features
- Regression testing for specific tools

## Creating Tests for Individual Tools

### Step 1: Copy the Template

```bash
cp tests/ToolsTests/ToolTestTemplate.php tests/ToolsTests/YourToolTest.php
```

### Step 2: Customize for Your Tool

```php
class YourToolTest extends BaseTestCase
{
    protected $toolName = 'YourToolName';  // Change this
    protected $testAccount = 'Jane Instructor';  // Or 'Sue Student', 'Jane Student'
    
    // Override testToolFunctionality() with your specific tests
}
```

### Step 3: Test Through Harness

The pattern is:
1. Navigate to `/tools` (test harness)
2. Find your tool in the list
3. Click to launch (opens in iframe)
4. Switch to iframe: `$this->switchToIframe($client, 0)`
5. Test tool functionality
6. Switch back: `$this->switchToMainDocument($client)`

## Example: Testing Aipaper

See `AipaperTest.php` for a complete example:

```php
class AipaperTest extends BaseTestCase
{
    protected $toolName = 'aipaper';
    
    public function testAipaperLaunchesInIframe()
    {
        $client = $this->getPantherClient();
        
        // 1. Go to test harness
        $crawler = $client->request('GET', $this->baseUrl . '/tools');
        
        // 2. Find and click aipaper tool
        // (adjust selectors based on actual UI)
        
        // 3. Wait for iframe
        $this->waitForIframe($client, 'iframe', 10);
        
        // 4. Switch to iframe
        $this->switchToIframe($client, 0);
        
        // 5. Test aipaper functionality
        // ... your tests here ...
        
        // 6. Switch back
        $this->switchToMainDocument($client);
        
        $client->quit();
    }
}
```

## Helper Methods Available

From `BaseTestCase`:

- `switchToIframe($client, $identifier)` - Switch to iframe (by index or name)
- `switchToMainDocument($client)` - Switch back to main document
- `waitForIframe($client, $selector, $timeout)` - Wait for iframe to appear
- `isWatchMode()` - Check if running in watch mode

## Finding Tool Elements

The test harness UI may vary. To find tool elements:

1. **Use watch mode** to see the page:
   ```bash
   php tests/ToolsTests/AipaperTest.php --watch
   ```

2. **Inspect the HTML** to find selectors:
   - Tool links/buttons
   - Test account selectors
   - Iframe containers

3. **Use flexible selectors**:
   ```php
   // Find by text content
   $links = $crawler->filter('a');
   foreach ($links as $link) {
       if (stripos($link->textContent, 'aipaper') !== false) {
           // Found it!
       }
   }
   ```

## Testing Tool Workflows

For complex tools like aipaper, test the full workflow:

```php
public function testAipaperWorkflow()
{
    $client = $this->getPantherClient();
    
    // 1. Launch tool
    $crawler = $client->request('GET', $this->baseUrl . '/tools');
    // ... find and click aipaper ...
    
    // 2. Switch to iframe
    $this->switchToIframe($client, 0);
    
    // 3. Test workflow steps
    // - Create new paper
    // - Add content
    // - Use AI features
    // - Save/submit
    
    // 4. Switch back
    $this->switchToMainDocument($client);
    
    $client->quit();
}
```

## Do You Need Individual Tests?

**You probably DON'T need individual test files if:**
- ✅ Tools work through the harness
- ✅ Basic smoke testing is enough
- ✅ Tools are simple

**You SHOULD create individual tests if:**
- ✅ Tool has complex workflows
- ✅ Tool has specific features to test
- ✅ Tool needs regression testing
- ✅ Tool has known issues to monitor

## Running Tool Tests

```bash
# Test all tools (harness)
php tests/ToolsTests/ToolsTestHarnessTest.php

# Test specific tool
php tests/ToolsTests/AipaperTest.php

# Watch mode
php tests/ToolsTests/AipaperTest.php --watch
```

## Tips

1. **Start simple** - Test that tool launches first
2. **Use watch mode** - See what's happening
3. **Inspect UI** - Understand the harness structure
4. **Test incrementally** - Add tests one feature at a time
5. **Handle iframes** - Always switch to iframe before testing tool content
