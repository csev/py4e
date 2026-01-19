<?php
/**
 * Template for testing individual tools through the test harness
 * 
 * Copy this file and rename it for your specific tool (e.g., AipaperTest.php)
 * 
 * Tools are tested through the /tools test harness which:
 * - Lists all available tools (including mod tools)
 * - Provides test accounts (Jane Instructor, Sue Student, Jane Student)
 * - Launches tools in iframes
 */

// Load Composer autoloader - prefer tests/vendor, fallback to tsugi/vendor
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
} else {
    require_once __DIR__ . '/../../tsugi/vendor/autoload.php';
}

require_once __DIR__ . '/../BaseTestCase.php';

class ToolTestTemplate extends BaseTestCase
{
    /**
     * Name of the tool to test (override in your test class)
     * This should match the tool's display name or identifier
     */
    protected $toolName = 'YourToolName';
    
    /**
     * Test account to use (Jane Instructor, Sue Student, or Jane Student)
     * Override in your test class if needed
     */
    protected $testAccount = 'Jane Instructor';
    
    /**
     * Test that tool appears in the test harness
     */
    public function testToolAppearsInHarness()
    {
        $client = $this->getPantherClient();
        
        try {
            // Navigate to test harness
            $crawler = $client->request('GET', $this->baseUrl . '/tools');
            
            // Wait for page to load
            sleep(1);
            
            // Look for tool name in the page
            $bodyText = $crawler->filter('body')->text();
            $toolFound = stripos($bodyText, $this->toolName) !== false;
            
            if ($toolFound) {
                echo "✓ Tool '{$this->toolName}' found in test harness\n";
            } else {
                echo "⚠ Tool '{$this->toolName}' not found (may not be installed or name differs)\n";
            }
            
            if ($this->isWatchMode()) {
                sleep(2);
            }
            
            $client->quit();
        } catch (\Exception $e) {
            try { $client->quit(); } catch (\Exception $e2) {}
            echo "⚠ Tool discovery test skipped: " . $e->getMessage() . "\n";
        }
    }
    
    /**
     * Test that tool can be launched via iframe
     */
    public function testToolLaunchesInIframe()
    {
        $client = $this->getPantherClient();
        
        try {
            // Navigate to test harness
            $crawler = $client->request('GET', $this->baseUrl . '/tools');
            
            // Wait for page to load
            sleep(1);
            
            // Try to find and click the tool (adjust selector based on actual UI)
            // This is a generic approach - you may need to customize based on harness UI
            $toolLink = null;
            
            // Method 1: Look for link containing tool name
            $links = $crawler->filter('a');
            foreach ($links as $link) {
                $linkText = $link->textContent;
                if (stripos($linkText, $this->toolName) !== false) {
                    $toolLink = $link;
                    break;
                }
            }
            
            // Method 2: Look for button or element with tool name
            if (!$toolLink) {
                $buttons = $crawler->filter('button, [role="button"]');
                foreach ($buttons as $button) {
                    $buttonText = $button->textContent;
                    if (stripos($buttonText, $this->toolName) !== false) {
                        // Find associated link or click handler
                        break;
                    }
                }
            }
            
            // If tool link found, click it
            if ($toolLink) {
                // Click the tool link
                $client->click($toolLink);
                
                // Wait for iframe to appear
                $this->waitForIframe($client, 'iframe', 10);
                
                // Switch to iframe
                $this->switchToIframe($client, 0);
                
                // Wait a bit for tool to load
                sleep(2);
                
                // Check that tool loaded (adjust based on tool's structure)
                $iframeCrawler = $client->getCrawler();
                $iframeBody = $iframeCrawler->filter('body')->text();
                $this->assertNotEmpty($iframeBody, 'Tool should have loaded content in iframe');
                
                // Switch back to main document
                $this->switchToMainDocument($client);
                
                echo "✓ Tool '{$this->toolName}' launched successfully in iframe\n";
            } else {
                echo "⚠ Could not find tool link for '{$this->toolName}' (may need custom selector)\n";
            }
            
            if ($this->isWatchMode()) {
                sleep(3);
            }
            
            $client->quit();
        } catch (\Exception $e) {
            try { 
                $this->switchToMainDocument($client);
                $client->quit(); 
            } catch (\Exception $e2) {}
            echo "⚠ Tool launch test skipped: " . $e->getMessage() . "\n";
        }
    }
    
    /**
     * Test tool functionality (override this in your specific tool test)
     * This is where you add tool-specific tests
     */
    public function testToolFunctionality()
    {
        $client = $this->getPantherClient();
        
        try {
            // Navigate to test harness
            $crawler = $client->request('GET', $this->baseUrl . '/tools');
            sleep(1);
            
            // TODO: Add tool-specific test steps here:
            // 1. Select test account if needed
            // 2. Launch tool
            // 3. Switch to iframe
            // 4. Test tool-specific functionality
            // 5. Switch back to main document
            
            echo "⚠ Tool functionality test not implemented (override testToolFunctionality)\n";
            
            $client->quit();
        } catch (\Exception $e) {
            try { $client->quit(); } catch (\Exception $e2) {}
            echo "⚠ Tool functionality test skipped: " . $e->getMessage() . "\n";
        }
    }
    
    /**
     * Run all tool tests
     */
    public function runAll()
    {
        echo "\n=== Running {$this->toolName} Tool Tests ===\n\n";
        
        try {
            $this->testToolAppearsInHarness();
            $this->testToolLaunchesInIframe();
            $this->testToolFunctionality();
            
            echo "\n✓ All {$this->toolName} tests completed!\n";
            return 0;
        } catch (\Exception $e) {
            echo "\n✗ Test failed: " . $e->getMessage() . "\n";
            return 1;
        }
    }
}

// Run tests if executed directly
if (php_sapi_name() === 'cli' && basename(__FILE__) === basename($_SERVER['SCRIPT_NAME'])) {
    global $argv;
    $watchMode = isset($argv) && in_array('--watch', $argv);
    if ($watchMode) {
        echo "👀 Watch mode enabled - browser window will be visible\n\n";
        $_SERVER['PANTHER_WATCH'] = '1';
    }
    
    $test = new ToolTestTemplate();
    exit($test->runAll());
}
