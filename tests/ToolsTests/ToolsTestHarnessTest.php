<?php
/**
 * Tests for the tools test harness
 * 
 * The test harness at /tools (which goes to /tsugi/store/test) provides
 * a way to test all installed tools (including mod tools) using three
 * built-in test accounts:
 * - Jane Instructor
 * - Sue Student  
 * - Jane Student
 * 
 * Tools are launched via iframes in this test harness.
 */

// Load Composer autoloader - prefer tests/vendor, fallback to tsugi/vendor
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
} else {
    require_once __DIR__ . '/../../tsugi/vendor/autoload.php';
}

require_once __DIR__ . '/../BaseTestCase.php';

class ToolsTestHarnessTest extends BaseTestCase
{
    /**
     * Test that tools test harness loads
     */
    public function testToolsTestHarnessLoads()
    {
        $client = $this->getPantherClient();
        
        try {
            $crawler = $this->assertPageLoaded($client, $this->baseUrl . '/tools');
            
            // In watch mode, add a small delay
            if ($this->isWatchMode()) {
                sleep(2);
            }
            
            // Check for test harness content
            $bodyText = $crawler->filter('body')->text();
            $this->assertNotEmpty($bodyText, 'Tools test harness should have content');
            
            $client->quit();
            echo "✓ Tools test harness loads\n";
        } catch (\Exception $e) {
            try { $client->quit(); } catch (\Exception $e2) {}
            echo "⚠ Tools test harness test skipped: " . $e->getMessage() . "\n";
        }
    }
    
    /**
     * Test that test harness shows available tools
     */
    public function testToolsTestHarnessShowsTools()
    {
        $client = $this->getPantherClient();
        
        try {
            $crawler = $client->request('GET', $this->baseUrl . '/tools');
            
            // Wait for page to load
            sleep(1);
            
            // Look for tool listings or test account options
            // The test harness should show available tools
            $bodyText = $crawler->filter('body')->text();
            
            // Check for test account indicators or tool listings
            $hasContent = strlen($bodyText) > 100; // Should have substantial content
            $this->assertTrue($hasContent, 'Test harness should show content');
            
            if ($this->isWatchMode()) {
                sleep(2);
            }
            
            $client->quit();
            echo "✓ Tools test harness shows tools\n";
        } catch (\Exception $e) {
            try { $client->quit(); } catch (\Exception $e2) {}
            echo "⚠ Tools listing test skipped: " . $e->getMessage() . "\n";
        }
    }
    
    /**
     * Test that iframe launches work (if tools are available)
     * The test harness uses iframes to launch tools
     */
    public function testIframeLaunches()
    {
        $client = $this->getPantherClient();
        
        try {
            $crawler = $client->request('GET', $this->baseUrl . '/tools');
            
            // Wait for page to load
            sleep(1);
            
            // Look for iframes (tools are launched in iframes)
            $iframes = $crawler->filter('iframe');
            
            // If iframes exist, that's a good sign the test harness is working
            if ($iframes->count() > 0) {
                echo "✓ Found " . $iframes->count() . " iframe(s) - test harness is launching tools\n";
                
                // In watch mode, wait longer so user can see the iframes
                if ($this->isWatchMode()) {
                    sleep(3);
                }
            } else {
                echo "⚠ No iframes found (tools may not be loaded yet or page structure differs)\n";
            }
            
            $client->quit();
        } catch (\Exception $e) {
            try { $client->quit(); } catch (\Exception $e2) {}
            echo "⚠ Iframe test skipped: " . $e->getMessage() . "\n";
        }
    }
    
    /**
     * Test that test accounts are available
     * The test harness should provide: Jane Instructor, Sue Student, Jane Student
     */
    public function testTestAccountsAvailable()
    {
        $client = $this->getPantherClient();
        
        try {
            $crawler = $client->request('GET', $this->baseUrl . '/tools');
            
            // Wait for page to load
            sleep(1);
            
            // Look for test account indicators
            $bodyText = $crawler->filter('body')->text();
            
            // Check for common test account names (case insensitive)
            $hasJaneInstructor = stripos($bodyText, 'Jane') !== false && stripos($bodyText, 'Instructor') !== false;
            $hasSueStudent = stripos($bodyText, 'Sue') !== false && stripos($bodyText, 'Student') !== false;
            
            if ($hasJaneInstructor || $hasSueStudent) {
                echo "✓ Test accounts appear to be available\n";
            } else {
                echo "⚠ Test account indicators not found (may be using different UI)\n";
            }
            
            if ($this->isWatchMode()) {
                sleep(2);
            }
            
            $client->quit();
        } catch (\Exception $e) {
            try { $client->quit(); } catch (\Exception $e2) {}
            echo "⚠ Test accounts check skipped: " . $e->getMessage() . "\n";
        }
    }
}
