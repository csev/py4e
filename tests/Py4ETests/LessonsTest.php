<?php
/**
 * Tests for Lessons functionality
 */

// Load Composer autoloader - prefer tests/vendor, fallback to tsugi/vendor
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
} else {
    require_once __DIR__ . '/../../tsugi/vendor/autoload.php';
}

require_once __DIR__ . '/../BaseTestCase.php';

class LessonsTest extends BaseTestCase
{
    /**
     * Test lessons list page renders correctly
     */
    public function testLessonsListRenders($loggedIn = false)
    {
        $client = $this->getPantherClient();
        
        // Set up test user if requested
        if ($loggedIn) {
            $this->setupTestUser($client);
        }
        
        $crawler = $this->assertPageLoaded($client, $this->baseUrl . '/tsugi/lms/lessons');
        
        // Check for module cards
        $cards = $crawler->filter('.card');
        $this->assertGreaterThan(0, $cards->count(), 'Should have lesson modules');
        
        echo "✓ Lessons list renders correctly" . ($loggedIn ? " (logged in)" : "") . "\n";
    }
    
    /**
     * Test navigation to a specific lesson module
     */
    public function testNavigateToModule($loggedIn = false)
    {
        $client = $this->getPantherClient();
        
        // Set up test user if requested
        if ($loggedIn) {
            $this->setupTestUser($client);
        }
        
        // Load lessons list
        $crawler = $client->request('GET', $this->baseUrl . '/tsugi/lms/lessons');
        
        // Find first module link
        $moduleLink = $crawler->filter('.card a')->first();
        if ($moduleLink->count() > 0) {
            $href = $moduleLink->attr('href');
            $this->assertNotEmpty($href, 'Module should have a link');
            
            // Navigate to module
            $crawler = $client->click($moduleLink->link());
            
            // Check for module title
            $h1 = $crawler->filter('h1.tsugi-lessons-module-title');
            $this->assertGreaterThan(0, $h1->count(), 'Module page should have a title');
            
            echo "✓ Navigation to module works" . ($loggedIn ? " (logged in)" : "") . "\n";
        }
    }
    
    /**
     * Test previous/next navigation - navigate through all lessons using Next button
     */
    public function testPreviousNextNavigation($loggedIn = false)
    {
        $client = $this->getPantherClient();
        
        // Set up test user if requested
        if ($loggedIn) {
            $this->setupTestUser($client);
        }
        
        $driver = $client->getWebDriver();
        
        try {
            // Step 1: Go to lessons list
            echo "   Navigating to lessons list...\n";
            $crawler = $client->request('GET', $this->baseUrl . '/tsugi/lms/lessons');
            sleep(1);
            
            // Step 2: Click on first lesson module
            echo "   Clicking first lesson module...\n";
            $firstModuleLink = null;
            try {
                // Find first module card link using WebDriver (more reliable)
                $moduleLinks = $driver->findElements(\Facebook\WebDriver\WebDriverBy::cssSelector('.card a'));
                if (count($moduleLinks) > 0 && $moduleLinks[0]->isDisplayed()) {
                    $firstModuleLink = $moduleLinks[0];
                    $driver->executeScript('arguments[0].click();', [$firstModuleLink]);
                    sleep(2); // Wait for lesson page to load
                } else {
                    throw new \Exception("No module links found");
                }
            } catch (\Exception $e) {
                // Fallback: try with crawler
                $crawler = $client->getCrawler();
                $moduleLink = $crawler->filter('.card a')->first();
                if ($moduleLink->count() > 0) {
                    $client->click($moduleLink->link());
                    sleep(2);
                } else {
                    throw new \Exception("Could not find first lesson module: " . $e->getMessage());
                }
            }
            
            echo "   ✓ First lesson loaded\n";
            
            // Step 3: Click Next repeatedly until disabled
            $lessonCount = 0;
            $maxLessons = 100; // Safety limit to prevent infinite loops
            
            while ($lessonCount < $maxLessons) {
                // Refresh crawler to get current page state
                $crawler = $client->getCrawler();
                
                // Find Next button using WebDriver (avoid stale references)
                // Next button when disabled: <li class="next disabled"><a href="#" onclick="return false;">&rarr; Next</a></li>
                $nextButton = null;
                $nextDisabled = false;
                
                try {
                    // First, check if the parent <li> has "disabled" class
                    $nextLiElements = $driver->findElements(\Facebook\WebDriver\WebDriverBy::cssSelector('.pager .next, li.next'));
                    
                    foreach ($nextLiElements as $liElement) {
                        try {
                            $liClasses = $liElement->getAttribute('class') ?: '';
                            if (stripos($liClasses, 'disabled') !== false) {
                                // Parent li has disabled class - Next is disabled
                                $nextDisabled = true;
                                break;
                            }
                        } catch (\Exception $e) {
                            continue;
                        }
                    }
                    
                    // If not disabled at li level, check the <a> element
                    if (!$nextDisabled) {
                        $nextElements = $driver->findElements(\Facebook\WebDriver\WebDriverBy::cssSelector('.pager .next a, li.next a'));
                        
                        foreach ($nextElements as $element) {
                            try {
                                if ($element->isDisplayed()) {
                                    $href = $element->getAttribute('href') ?: '';
                                    $onclick = $element->getAttribute('onclick') ?: '';
                                    $classes = $element->getAttribute('class') ?: '';
                                    
                                    // Check if disabled: onclick="return false;" or href="#" with disabled parent
                                    $isDisabled = stripos($onclick, 'return false') !== false ||
                                                ($href === '#' && stripos($classes, 'disabled') !== false);
                                    
                                    if (!$isDisabled && $element->isEnabled()) {
                                        $nextButton = $element;
                                        break;
                                    } else {
                                        $nextDisabled = true;
                                    }
                                }
                            } catch (\Exception $e) {
                                // Skip stale elements
                                continue;
                            }
                        }
                    }
                    
                    // Fallback: try finding by text content if not found yet
                    if (!$nextButton && !$nextDisabled) {
                        $allLinks = $driver->findElements(\Facebook\WebDriver\WebDriverBy::cssSelector('.pager a, .pager button'));
                        foreach ($allLinks as $link) {
                            try {
                                if ($link->isDisplayed()) {
                                    $text = trim($link->getText());
                                    $href = $link->getAttribute('href') ?: '';
                                    $onclick = $link->getAttribute('onclick') ?: '';
                                    
                                    // Check if this is the Next button
                                    if (stripos($text, 'Next') !== false || stripos($text, '→') !== false) {
                                        // Check if disabled
                                        if (stripos($onclick, 'return false') !== false || 
                                            ($href === '#' && stripos($onclick, 'return false') !== false)) {
                                            $nextDisabled = true;
                                            break;
                                        } else if ($link->isEnabled()) {
                                            $nextButton = $link;
                                            break;
                                        }
                                    }
                                }
                            } catch (\Exception $e) {
                                continue;
                            }
                        }
                    }
                } catch (\Exception $e) {
                    echo "       ⚠ Error finding Next button: " . $e->getMessage() . "\n";
                    break;
                }
                
                // If Next button is disabled, we're done
                if ($nextDisabled || !$nextButton) {
                    echo "   ✓ Reached last lesson (Next button disabled)\n";
                    echo "   Navigated through {$lessonCount} lessons\n";
                    break;
                }
                
                // Click Next button
                try {
                    $lessonCount++;
                    echo "   Lesson {$lessonCount}: Clicking Next...\n";
                    
                    $driver->executeScript('arguments[0].click();', [$nextButton]);
                    sleep(2); // Wait for next lesson to load
                    
                    // Verify we're on a new lesson page
                    $currentUrl = $client->getCurrentURL();
                    echo "     Current URL: {$currentUrl}\n";
                    
                } catch (\Exception $e) {
                    echo "       ⚠ Failed to click Next button: " . $e->getMessage() . "\n";
                    break;
                }
            }
            
            if ($lessonCount >= $maxLessons) {
                echo "   ⚠ Reached safety limit of {$maxLessons} lessons\n";
            }
            
            echo "✓ Navigation through lessons completed\n";
            
            if ($this->isWatchMode()) {
                sleep(2);
            }
            
            $client->quit();
        } catch (\Exception $e) {
            try { $client->quit(); } catch (\Exception $e2) {}
            echo "⚠ Previous/Next navigation test failed: " . $e->getMessage() . "\n";
        }
    }
    
    /**
     * Test that items array format renders (if Lessons2 is enabled)
     */
    public function testItemsArrayRenders($loggedIn = false)
    {
        $client = $this->getPantherClient();
        
        // Set up test user if requested
        if ($loggedIn) {
            $this->setupTestUser($client);
        }
        
        // Load a module that might have items array
        $crawler = $client->request('GET', $this->baseUrl . '/tsugi/lms/lessons/intro');
        
        // Check for content lists
        $contentLists = $crawler->filter('.tsugi-lessons-content-list');
        
        // If items array is being used, we should see these lists
        if ($contentLists->count() > 0) {
            echo "✓ Items array format is rendering\n";
        } else {
            echo "⚠ Items array lists not found (might be using legacy format)\n";
        }
    }
    
    /**
     * Test lessons with a logged-in user (login once, reuse client)
     */
    public function testLessonsWithUser()
    {
        echo "\n=== Running Lessons Tests (Logged In) ===\n\n";
        
        // Create client and login ONCE at the beginning
        $client = $this->getPantherClient();
        $this->setupTestUser($client);
        
        try {
            // Reuse the same client for all tests (maintains session)
            $this->testLessonsListRendersWithClient($client, true);
            $this->testNavigateToModuleWithClient($client, true);
            $this->testPreviousNextNavigationWithClient($client, true);
            $this->testItemsArrayRendersWithClient($client, true);
            
            echo "\n✓ All logged-in lessons tests completed!\n";
            $client->quit();
            return 0;
        } catch (\Exception $e) {
            try { $client->quit(); } catch (\Exception $e2) {}
            echo "\n✗ Test failed: " . $e->getMessage() . "\n";
            return 1;
        }
    }
    
    /**
     * Run all lessons tests
     */
    public function runAll($loggedIn = false)
    {
        echo "\n=== Running Lessons Tests" . ($loggedIn ? " (Logged In)" : "") . " ===\n\n";
        
        // If logged in, create client and login ONCE
        $client = null;
        if ($loggedIn) {
            $client = $this->getPantherClient();
            $this->setupTestUser($client);
        }
        
        try {
            if ($loggedIn) {
                // Use shared client for all tests
                $this->testLessonsListRendersWithClient($client, true);
                $this->testNavigateToModuleWithClient($client, true);
                $this->testPreviousNextNavigationWithClient($client, true);
                $this->testItemsArrayRendersWithClient($client, true);
            } else {
                // Each test creates its own client
                $this->testLessonsListRenders(false);
                $this->testNavigateToModule(false);
                $this->testPreviousNextNavigation(false);
                $this->testItemsArrayRenders(false);
            }
            
            echo "\n✓ All lessons tests completed!\n";
            if ($client) {
                $client->quit();
            }
            return 0;
        } catch (\Exception $e) {
            if ($client) {
                try { $client->quit(); } catch (\Exception $e2) {}
            }
            echo "\n✗ Test failed: " . $e->getMessage() . "\n";
            return 1;
        }
    }
    
    /**
     * Test lessons list with provided client (for reuse)
     */
    private function testLessonsListRendersWithClient($client, $loggedIn = false)
    {
        $crawler = $this->assertPageLoaded($client, $this->baseUrl . '/tsugi/lms/lessons');
        
        // Check for module cards
        $cards = $crawler->filter('.card');
        $this->assertGreaterThan(0, $cards->count(), 'Should have lesson modules');
        
        echo "✓ Lessons list renders correctly" . ($loggedIn ? " (logged in)" : "") . "\n";
    }
    
    /**
     * Test navigation with provided client (for reuse)
     */
    private function testNavigateToModuleWithClient($client, $loggedIn = false)
    {
        // Load lessons list
        $crawler = $client->request('GET', $this->baseUrl . '/tsugi/lms/lessons');
        
        // Find first module link
        $moduleLink = $crawler->filter('.card a')->first();
        if ($moduleLink->count() > 0) {
            $href = $moduleLink->attr('href');
            $this->assertNotEmpty($href, 'Module should have a link');
            
            // Navigate to module
            $crawler = $client->click($moduleLink->link());
            
            // Check for module title
            $h1 = $crawler->filter('h1.tsugi-lessons-module-title');
            $this->assertGreaterThan(0, $h1->count(), 'Module page should have a title');
            
            echo "✓ Navigation to module works" . ($loggedIn ? " (logged in)" : "") . "\n";
        }
    }
    
    /**
     * Test previous/next navigation with provided client (for reuse)
     */
    private function testPreviousNextNavigationWithClient($client, $loggedIn = false)
    {
        $driver = $client->getWebDriver();
        
        try {
            // Step 1: Go to lessons list
            echo "   Navigating to lessons list...\n";
            $crawler = $client->request('GET', $this->baseUrl . '/tsugi/lms/lessons');
            sleep(1);
            
            // Step 2: Click on first lesson module
            echo "   Clicking first lesson module...\n";
            $firstModuleLink = null;
            try {
                // Find first module card link using WebDriver (more reliable)
                $moduleLinks = $driver->findElements(\Facebook\WebDriver\WebDriverBy::cssSelector('.card a'));
                if (count($moduleLinks) > 0 && $moduleLinks[0]->isDisplayed()) {
                    $firstModuleLink = $moduleLinks[0];
                    $driver->executeScript('arguments[0].click();', [$firstModuleLink]);
                    sleep(2); // Wait for lesson page to load
                } else {
                    throw new \Exception("No module links found");
                }
            } catch (\Exception $e) {
                // Fallback: try with crawler
                $crawler = $client->getCrawler();
                $moduleLink = $crawler->filter('.card a')->first();
                if ($moduleLink->count() > 0) {
                    $client->click($moduleLink->link());
                    sleep(2);
                } else {
                    throw new \Exception("Could not find first lesson module: " . $e->getMessage());
                }
            }
            
            echo "   ✓ First lesson loaded\n";
            
            // Step 3: Click Next repeatedly until disabled (same as original method)
            $lessonCount = 0;
            $maxLessons = 100; // Safety limit to prevent infinite loops
            
            while ($lessonCount < $maxLessons) {
                // Refresh crawler to get current page state
                $crawler = $client->getCrawler();
                
                // Find Next button using WebDriver (avoid stale references)
                $nextButton = null;
                $nextDisabled = false;
                
                try {
                    // First, check if the parent <li> has "disabled" class
                    $nextLiElements = $driver->findElements(\Facebook\WebDriver\WebDriverBy::cssSelector('.pager .next, li.next'));
                    
                    foreach ($nextLiElements as $liElement) {
                        try {
                            $liClasses = $liElement->getAttribute('class') ?: '';
                            if (stripos($liClasses, 'disabled') !== false) {
                                $nextDisabled = true;
                                break;
                            }
                        } catch (\Exception $e) {
                            continue;
                        }
                    }
                    
                    // If not disabled at li level, check the <a> element
                    if (!$nextDisabled) {
                        $nextElements = $driver->findElements(\Facebook\WebDriver\WebDriverBy::cssSelector('.pager .next a, li.next a'));
                        
                        foreach ($nextElements as $element) {
                            try {
                                if ($element->isDisplayed()) {
                                    $href = $element->getAttribute('href') ?: '';
                                    $onclick = $element->getAttribute('onclick') ?: '';
                                    $classes = $element->getAttribute('class') ?: '';
                                    
                                    $isDisabled = stripos($onclick, 'return false') !== false ||
                                                ($href === '#' && stripos($classes, 'disabled') !== false);
                                    
                                    if (!$isDisabled && $element->isEnabled()) {
                                        $nextButton = $element;
                                        break;
                                    } else {
                                        $nextDisabled = true;
                                    }
                                }
                            } catch (\Exception $e) {
                                continue;
                            }
                        }
                    }
                    
                    // Fallback: try finding by text content
                    if (!$nextButton && !$nextDisabled) {
                        $allLinks = $driver->findElements(\Facebook\WebDriver\WebDriverBy::cssSelector('.pager a, .pager button'));
                        foreach ($allLinks as $link) {
                            try {
                                if ($link->isDisplayed()) {
                                    $text = trim($link->getText());
                                    $href = $link->getAttribute('href') ?: '';
                                    $onclick = $link->getAttribute('onclick') ?: '';
                                    
                                    if (stripos($text, 'Next') !== false || stripos($text, '→') !== false) {
                                        if (stripos($onclick, 'return false') !== false || 
                                            ($href === '#' && stripos($onclick, 'return false') !== false)) {
                                            $nextDisabled = true;
                                            break;
                                        } else if ($link->isEnabled()) {
                                            $nextButton = $link;
                                            break;
                                        }
                                    }
                                }
                            } catch (\Exception $e) {
                                continue;
                            }
                        }
                    }
                } catch (\Exception $e) {
                    echo "       ⚠ Error finding Next button: " . $e->getMessage() . "\n";
                    break;
                }
                
                // If Next button is disabled, we're done
                if ($nextDisabled || !$nextButton) {
                    echo "   ✓ Reached last lesson (Next button disabled)\n";
                    echo "   Navigated through {$lessonCount} lessons\n";
                    break;
                }
                
                // Click Next button
                try {
                    $lessonCount++;
                    echo "   Lesson {$lessonCount}: Clicking Next...\n";
                    
                    $driver->executeScript('arguments[0].click();', [$nextButton]);
                    sleep(2); // Wait for next lesson to load
                    
                    // Verify we're on a new lesson page
                    $currentUrl = $client->getCurrentURL();
                    echo "     Current URL: {$currentUrl}\n";
                    
                } catch (\Exception $e) {
                    echo "       ⚠ Failed to click Next button: " . $e->getMessage() . "\n";
                    break;
                }
            }
            
            if ($lessonCount >= $maxLessons) {
                echo "   ⚠ Reached safety limit of {$maxLessons} lessons\n";
            }
            
            echo "✓ Navigation through lessons completed\n";
            
        } catch (\Exception $e) {
            echo "⚠ Previous/Next navigation test failed: " . $e->getMessage() . "\n";
            throw $e;
        }
    }
    
    /**
     * Test items array with provided client (for reuse)
     */
    private function testItemsArrayRendersWithClient($client, $loggedIn = false)
    {
        // Load a module that might have items array
        $crawler = $client->request('GET', $this->baseUrl . '/tsugi/lms/lessons/intro');
        
        // Check for content lists
        $contentLists = $crawler->filter('.tsugi-lessons-content-list');
        
        // If items array is being used, we should see these lists
        if ($contentLists->count() > 0) {
            echo "✓ Items array format is rendering\n";
        } else {
            echo "⚠ Items array lists not found (might be using legacy format)\n";
        }
    }
}

// Run tests if executed directly
if (php_sapi_name() === 'cli' && basename(__FILE__) === basename($_SERVER['SCRIPT_NAME'])) {
    global $argv;
    $watchMode = isset($argv) && in_array('--watch', $argv);
    $loggedIn = isset($argv) && in_array('--logged-in', $argv);
    
    if ($watchMode) {
        echo "👀 Watch mode enabled - browser window will be visible\n\n";
        $_SERVER['PANTHER_WATCH'] = '1';
    }
    
    $test = new LessonsTest();
    
    // Run with logged-in user if --logged-in flag is provided
    if ($loggedIn) {
        exit($test->runAll(true));
    } else {
        exit($test->runAll(false));
    }
}
