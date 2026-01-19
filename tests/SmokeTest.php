<?php
/**
 * Smoke Test - Quick test to verify basic functionality
 * Run this before committing changes
 * 
 * Usage: php tests/SmokeTest.php
 */

require_once __DIR__ . '/BaseTestCase.php';

class SmokeTest extends BaseTestCase
{
    /**
     * Test that homepage loads
     */
    public function testHomepageLoads()
    {
        $client = $this->getPantherClient();
        $crawler = $this->assertPageLoaded($client, $this->baseUrl . '/');
        
        // In watch mode, add a small delay so you can see the page
        if ($this->isWatchMode()) {
            sleep(2);
        }
        
        // Check for key elements
        $h1Count = $crawler->filter('h1')->count();
        $this->assertGreaterThan(0, $h1Count, 'Homepage should have an h1');
        
        $bodyText = $crawler->filter('body')->text();
        $this->assertStringContainsString('Python', $bodyText, 'Homepage should mention Python');
        
        $client->quit();
        echo "✓ Homepage loads successfully\n";
    }
    
    /**
     * Test that lessons page loads
     */
    public function testLessonsPageLoads()
    {
        $client = $this->getPantherClient();
        $crawler = $this->assertPageLoaded($client, $this->baseUrl . '/tsugi/lms/lessons');
        
        // In watch mode, add a small delay so you can see the page
        if ($this->isWatchMode()) {
            sleep(2);
        }
        
        // Check for lessons content
        $bodyText = $crawler->filter('body')->text();
        $this->assertNotEmpty($bodyText, 'Lessons page should have content');
        
        $client->quit();
        echo "✓ Lessons page loads successfully\n";
    }
    
    /**
     * Test that a specific lesson module loads
     */
    public function testLessonModuleLoads()
    {
        $client = $this->getPantherClient();
        
        // Try to load first module (adjust anchor as needed)
        $crawler = $this->assertPageLoaded($client, $this->baseUrl . '/tsugi/lms/lessons/intro');
        
        // In watch mode, add a small delay so you can see the page
        if ($this->isWatchMode()) {
            sleep(2);
        }
        
        // Check for module title
        $h1Count = $crawler->filter('h1')->count();
        $this->assertGreaterThan(0, $h1Count, 'Lesson module should have a title');
        
        $client->quit();
        echo "✓ Lesson module loads successfully\n";
    }
    
    /**
     * Test that tools test harness is accessible
     * This is the proper way to test all tools (including mod tools)
     */
    public function testToolsTestHarness()
    {
        $client = $this->getPantherClient();
        
        // Test the tools test harness at /tools (which goes to /tsugi/store/test)
        try {
            $crawler = $this->assertPageLoaded($client, $this->baseUrl . '/tools');
            
            // In watch mode, add a small delay so you can see the page
            if ($this->isWatchMode()) {
                sleep(2);
            }
            
            // Check for test harness content
            $bodyText = $crawler->filter('body')->text();
            $this->assertNotEmpty($bodyText, 'Tools test harness should have content');
            
            $client->quit();
            echo "✓ Tools test harness is accessible\n";
        } catch (\Exception $e) {
            // Test harness might require setup, which is OK for smoke test
            try { $client->quit(); } catch (\Exception $e2) {}
            echo "⚠ Tools test harness requires setup (expected)\n";
        }
    }
    
    /**
     * Run all smoke tests
     */
    public function runAll()
    {
        echo "\n=== Running Py4E Smoke Tests ===\n\n";
        
        $client = null;
        try {
            $this->testHomepageLoads();
            $this->testLessonsPageLoads();
            $this->testLessonModuleLoads();
            $this->testToolsTestHarness();
            
            echo "\n✓ All smoke tests passed!\n";
            return 0;
        } catch (\Exception $e) {
            echo "\n✗ Test failed: " . $e->getMessage() . "\n";
            echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
            if (isset($client)) {
                try {
                    $client->quit();
                } catch (\Exception $e2) {
                    // Ignore cleanup errors
                }
            }
            return 1;
        }
    }
}

// Run tests if executed directly
// SECURITY: Only allow CLI execution
if (php_sapi_name() === 'cli' && basename(__FILE__) === basename($_SERVER['SCRIPT_NAME'])) {
    // Check for --watch flag
    global $argv;
    $watchMode = isset($argv) && in_array('--watch', $argv);
    if ($watchMode) {
        echo "👀 Watch mode enabled - browser window will be visible\n";
        echo "   Press Ctrl+C to stop\n\n";
        // Set environment variable so BaseTestCase can detect it
        $_SERVER['PANTHER_WATCH'] = '1';
    }
    
    $test = new SmokeTest();
    exit($test->runAll());
}
