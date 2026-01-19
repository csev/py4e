<?php
/**
 * Tests for Aipaper tool
 * 
 * Tests the aipaper tool through the /tools test harness.
 * Uses BaseToolTest which provides complete test flow:
 * - Navigate to store, find tool, click Details
 * - Click Try It button
 * - Test all four identities
 */

require_once __DIR__ . '/BaseToolTest.php';

// Load Composer autoloader
require_once __DIR__ . '/../../tsugi/vendor/autoload.php';

class AipaperTest extends BaseToolTest
{
    protected $toolKey = 'aipaper';
    protected $toolName = 'AI Paper';  // Optional: helps find tool in listing
    
    /**
     * Test aipaper-specific functionality for a specific identity
     * 
     * Override testToolFunctionalityForIdentity() to add tool-specific tests.
     * This method is called for each identity (Jane Instructor, Sue Student, Ed Student, Anonymous)
     * after the tool is launched in the iframe.
     * 
     * @param Client $client Panther client
     * @param string $identityKey Identity key (instructor, learner1, learner2, learner3)
     * @param string $identityName Identity display name
     * @param \Symfony\Component\Panther\DomCrawler\Crawler $iframeCrawler Crawler for iframe content
     */
    protected function testToolFunctionalityForIdentity($client, $identityKey, $identityName, $iframeCrawler)
    {
        // Call parent to do basic content check
        parent::testToolFunctionalityForIdentity($client, $identityKey, $identityName, $iframeCrawler);
        
        // Debug output: Show iframe content info (using parent helper method)
        $this->printIframeDebugInfo($client, $identityName, $iframeCrawler);
        
        // TODO: Add aipaper-specific tests here for each identity:
        // 
        // Example for instructor:
        // if ($identityKey === 'instructor') {
        //     $createButton = $iframeCrawler->filter('button.create-paper');
        //     $this->assertGreaterThan(0, $createButton->count(), 'Instructor should have create button');
        // }
        // 
        // Example for students:
        // if (in_array($identityKey, ['learner1', 'learner2'])) {
        //     // Test student-specific features
        // }
        // 
        // Example: Test paper creation workflow
        // $createButton = $iframeCrawler->filter('button.create-paper');
        // if ($createButton->count() > 0) {
        //     $client->click($createButton->link());
        //     // ... test creation flow ...
        // }
    }
    
    /**
     * Run all aipaper tests
     */
    public function runAll()
    {
        echo "\n=== Running Aipaper Tool Tests ===\n\n";
        
        try {
            // Base tests from BaseToolTest
            // testToolAppearsInStore() - checks tool is in store listing
            // testToolLaunchesViaTryIt() - tests initial launch
            // testAllIdentities() - launches tool for all 4 identities and calls testToolFunctionalityForIdentity() for each
            $this->testToolAppearsInStore();
            $this->testToolLaunchesViaTryIt();
            $this->testAllIdentities();
            
            echo "\n✓ All aipaper tests completed!\n";
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
    
    $test = new AipaperTest();
    exit($test->runAll());
}
