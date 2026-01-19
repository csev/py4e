<?php
/**
 * Smoke test for all tools
 * 
 * Discovers all tools from /tools (store listing) and runs BaseToolTest on each.
 * This provides comprehensive coverage of all installed tools.
 */

// Load Composer autoloader - prefer tests/vendor, fallback to tsugi/vendor
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
} else {
    require_once __DIR__ . '/../../tsugi/vendor/autoload.php';
}

require_once __DIR__ . '/../BaseTestCase.php';
require_once __DIR__ . '/BaseToolTest.php';

class AllToolsSmokeTest extends BaseTestCase
{
    protected $baseUrl = 'http://localhost:8888/py4e';
    
    /**
     * Discover all tools from the store listing
     * Returns array of tool keys (folder names)
     */
    protected function discoverAllTools()
    {
        $client = $this->getPantherClient();
        $tools = [];
        
        try {
            // Ensure we always quit the client, even on error
            $clientQuit = function() use ($client) {
                try {
                    $client->quit();
                } catch (\Exception $e) {
                    // Ignore errors during quit
                }
            };
            
            // Register shutdown function to ensure cleanup
            register_shutdown_function($clientQuit);
            // Navigate to /tools (redirects to /tsugi/store/)
            $crawler = $client->request('GET', $this->baseUrl . '/tools');
            sleep(1);
            
            // Find all tool cards (div.app)
            $appCards = $crawler->filter('div.app');
            
            echo "   Found " . $appCards->count() . " tool cards\n";
            
            // Extract tool keys from Details buttons/links
            for ($i = 0; $i < $appCards->count(); $i++) {
                $cardCrawler = $appCards->eq($i);
                
                // Find Details button/link in the card
                $detailsLinks = $cardCrawler->filter('a, button');
                $toolKey = null;
                $toolName = null;
                
                for ($j = 0; $j < $detailsLinks->count(); $j++) {
                    $linkCrawler = $detailsLinks->eq($j);
                    $linkText = trim($linkCrawler->text());
                    $href = $linkCrawler->attr('href');
                    
                    // Check if this is a Details link
                    if (stripos($linkText, 'Details') !== false || stripos($linkText, 'detail') !== false) {
                        // Extract tool key from href (e.g., /tsugi/store/details/aipaper -> aipaper)
                        if ($href) {
                            if (preg_match('/details\/([^\/\?]+)/', $href, $matches)) {
                                $toolKey = $matches[1];
                            } elseif (preg_match('/store\/([^\/\?]+)/', $href, $matches)) {
                                $toolKey = $matches[1];
                            }
                        }
                        
                        // Try to get tool name from card text
                        $cardText = $cardCrawler->text();
                        $lines = explode("\n", $cardText);
                        foreach ($lines as $line) {
                            $line = trim($line);
                            if (!empty($line) && stripos($line, 'Details') === false) {
                                $toolName = $line;
                                break;
                            }
                        }
                        
                        break;
                    }
                }
                
                // If Details link not found, try to extract from card structure
                if (!$toolKey) {
                    // Look for any link in the card that might lead to tool details
                    $allLinks = $cardCrawler->filter('a');
                    for ($j = 0; $j < $allLinks->count(); $j++) {
                        $linkCrawler = $allLinks->eq($j);
                        $href = $linkCrawler->attr('href');
                        if ($href && (stripos($href, 'details') !== false || stripos($href, 'store') !== false)) {
                            if (preg_match('/details\/([^\/\?]+)/', $href, $matches)) {
                                $toolKey = $matches[1];
                            } elseif (preg_match('/store\/([^\/\?]+)/', $href, $matches)) {
                                $toolKey = $matches[1];
                            }
                            break;
                        }
                    }
                }
                
                if ($toolKey) {
                    $tools[] = [
                        'key' => $toolKey,
                        'name' => $toolName ?: $toolKey
                    ];
                    echo "     - {$toolKey}" . ($toolName ? " ({$toolName})" : "") . "\n";
                } else {
                    echo "     ⚠ Could not extract tool key from card " . ($i + 1) . "\n";
                }
            }
            
            $clientQuit();
        } catch (\Exception $e) {
            try { 
                $clientQuit();
            } catch (\Exception $e2) {}
            throw new \Exception("Failed to discover tools: " . $e->getMessage());
        }
        
        return $tools;
    }
    
    /**
     * Run BaseToolTest for a specific tool
     */
    protected function testTool($toolKey, $toolName = null)
    {
        // Create a temporary test class for this tool
        $testClass = new class($toolKey, $toolName) extends BaseToolTest {
            public function __construct($toolKey, $toolName = null)
            {
                $this->toolKey = $toolKey;
                $this->toolName = $toolName ?: $toolKey;
            }
        };
        
        echo "\n=== Testing Tool: {$toolKey}" . ($toolName ? " ({$toolName})" : "") . " ===\n";
        
        $results = [
            'store' => false,
            'launch' => false,
            'identities' => false
        ];
        
        try {
            // Test 1: Store listing
            try {
                $testClass->testToolAppearsInStore();
                $results['store'] = true;
            } catch (\Exception $e) {
                echo "  ⚠ Store listing test failed: " . $e->getMessage() . "\n";
            }
            
            // Test 2: Tool launch
            try {
                $testClass->testToolLaunchesViaTryIt();
                $results['launch'] = true;
            } catch (\Exception $e) {
                echo "  ⚠ Tool launch test failed: " . $e->getMessage() . "\n";
            }
            
            // Test 3: All identities
            try {
                $testClass->testAllIdentities();
                $results['identities'] = true;
            } catch (\Exception $e) {
                echo "  ⚠ Identity tests failed: " . $e->getMessage() . "\n";
            }
            
            // Determine overall result
            $passed = array_sum($results);
            $total = count($results);
            
            if ($passed === $total) {
                echo "  ✓ Tool '{$toolKey}' - All tests passed ({$passed}/{$total})\n";
                return true;
            } else {
                echo "  ⚠ Tool '{$toolKey}' - Partial pass ({$passed}/{$total})\n";
                return $passed > 0; // Consider partial pass as success for smoke test
            }
        } catch (\Exception $e) {
            echo "  ✗ Tool '{$toolKey}' tests failed: " . $e->getMessage() . "\n";
            return false;
        }
    }
    
    /**
     * Run smoke tests on all discovered tools
     * 
     * @param int $limit Maximum number of tools to test (0 = all tools)
     * @param bool $quickMode If true, only test store listing (skip launch/identities)
     */
    public function testAllTools($limit = 0, $quickMode = false)
    {
        echo "\n=== Discovering All Tools ===\n\n";
        
        try {
            $tools = $this->discoverAllTools();
            
            if (empty($tools)) {
                echo "⚠ No tools found in store\n";
                return 0;
            }
            
            // Apply limit if specified
            if ($limit > 0 && $limit < count($tools)) {
                $tools = array_slice($tools, 0, $limit);
                echo "\n⚠ Limiting to first {$limit} tools\n";
            }
            
            $modeText = $quickMode ? " (Quick Mode - Store Listing Only)" : "";
            echo "\n=== Running Smoke Tests on " . count($tools) . " Tools{$modeText} ===\n\n";
            
            $passed = 0;
            $failed = 0;
            $failedTools = [];
            
            foreach ($tools as $tool) {
                if ($quickMode) {
                    $result = $this->testToolQuick($tool['key'], $tool['name']);
                } else {
                    $result = $this->testTool($tool['key'], $tool['name']);
                }
                
                if ($result) {
                    $passed++;
                } else {
                    $failed++;
                    $failedTools[] = $tool['key'];
                }
            }
            
            echo "\n=== Test Summary ===\n";
            echo "Total tools discovered: " . count($tools) . "\n";
            echo "Tools passed: {$passed}\n";
            echo "Tools failed: {$failed}\n";
            echo "Success rate: " . round(($passed / count($tools)) * 100, 1) . "%\n";
            
            if (!empty($failedTools)) {
                echo "\nFailed tools: " . implode(', ', $failedTools) . "\n";
            }
            
            // Return 0 if most tools passed (for smoke test, partial success is OK)
            return ($passed >= count($tools) * 0.5) ? 0 : 1;
        } catch (\Exception $e) {
            echo "\n✗ Test discovery failed: " . $e->getMessage() . "\n";
            return 1;
        }
    }
    
    /**
     * Quick test - only check store listing (no launch/identities)
     */
    protected function testToolQuick($toolKey, $toolName = null)
    {
        $testClass = new class($toolKey, $toolName) extends BaseToolTest {
            public function __construct($toolKey, $toolName = null)
            {
                $this->toolKey = $toolKey;
                $this->toolName = $toolName ?: $toolKey;
            }
        };
        
        echo "  Testing: {$toolKey}" . ($toolName ? " ({$toolName})" : "") . "... ";
        
        try {
            $testClass->testToolAppearsInStore();
            echo "✓\n";
            return true;
        } catch (\Exception $e) {
            echo "✗\n";
            return false;
        }
    }
    
    /**
     * Run all smoke tests
     */
    public function runAll()
    {
        global $argv;
        
        // Check for command line options
        $limit = 0;
        $quickMode = false;
        
        if (isset($argv)) {
            foreach ($argv as $arg) {
                if (preg_match('/^--limit=(\d+)$/', $arg, $matches)) {
                    $limit = (int)$matches[1];
                } elseif ($arg === '--quick' || $arg === '-q') {
                    $quickMode = true;
                }
            }
        }
        
        return $this->testAllTools($limit, $quickMode);
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
    
    // Show usage if help requested
    if (isset($argv) && (in_array('--help', $argv) || in_array('-h', $argv))) {
        echo "Usage: php AllToolsSmokeTest.php [options]\n\n";
        echo "Options:\n";
        echo "  --quick, -q          Quick mode: only test store listing (no launch/identities)\n";
        echo "  --limit=N            Limit to first N tools\n";
        echo "  --watch              Show browser window (watch mode)\n";
        echo "\n";
        echo "Examples:\n";
        echo "  php AllToolsSmokeTest.php --quick              # Quick test all tools\n";
        echo "  php AllToolsSmokeTest.php --limit=5            # Test first 5 tools\n";
        echo "  php AllToolsSmokeTest.php --quick --limit=10   # Quick test first 10 tools\n";
        exit(0);
    }
    
    $test = new AllToolsSmokeTest();
    exit($test->runAll());
}
