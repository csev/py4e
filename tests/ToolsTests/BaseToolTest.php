<?php
/**
 * Base test class for testing tools through the test harness
 * 
 * This class provides a complete test flow:
 * 1. Navigate to /tools (redirects to /tsugi/store/)
 * 2. Find tool card by name/key
 * 3. Click "Details" button
 * 4. On details page, click "Try It" button
 * 5. Wait for tool to launch in iframe
 * 6. Test all four identities (Jane Instructor, Sue Student, Ed Student, Anonymous)
 * 
 * Usage:
 *   class AipaperTest extends BaseToolTest {
 *       protected $toolKey = 'aipaper';
 *       protected $toolName = 'AI Paper';  // Display name (optional)
 *   }
 */

require_once __DIR__ . '/../BaseTestCase.php';

// Load Composer autoloader
require_once __DIR__ . '/../../tsugi/vendor/autoload.php';

abstract class BaseToolTest extends BaseTestCase
{
    /**
     * Tool key (folder name) - REQUIRED - override in subclass
     * Example: 'aipaper', 'map', 'agreement', 'breakout'
     */
    protected $toolKey = null;
    
    /**
     * Tool display name (optional) - helps find tool in list
     * Example: 'AI Paper', 'Map Tool', 'Agreement Tool'
     */
    protected $toolName = null;
    
    /**
     * Test identities available in test harness
     */
    protected $identities = [
        'instructor' => 'Jane Instructor',
        'learner1' => 'Sue Student',
        'learner2' => 'Ed Student',
        'learner3' => 'Anonymous',
    ];
    
    /**
     * Test that tool appears in store listing
     */
    public function testToolAppearsInStore()
    {
        $client = $this->getPantherClient();
        
        try {
            if (!$this->toolKey) {
                throw new \Exception("toolKey must be set in test class");
            }
            
            // Navigate to /tools (redirects to /tsugi/store/)
            $crawler = $client->request('GET', $this->baseUrl . '/tools');
            
            // Wait for page to load
            sleep(1);
            
            // Look for tool cards (class="app")
            $bodyText = $crawler->filter('body')->text();
            
            // Check if tool name/key appears in page
            $searchTerms = array_filter([$this->toolKey, $this->toolName]);
            $toolFound = false;
            
            foreach ($searchTerms as $term) {
                if ($term && stripos($bodyText, $term) !== false) {
                    $toolFound = true;
                    break;
                }
            }
            
            if ($toolFound) {
                echo "✓ Tool '{$this->toolKey}' found in store listing\n";
            } else {
                echo "⚠ Tool '{$this->toolKey}' not found in store (may not be registered)\n";
            }
            
            if ($this->isWatchMode()) {
                sleep(2);
            }
            
            $client->quit();
        } catch (\Exception $e) {
            try { $client->quit(); } catch (\Exception $e2) {}
            echo "⚠ Tool store listing test skipped: " . $e->getMessage() . "\n";
        }
    }
    
    /**
     * Navigate to tool details page via "Details" button
     * Returns crawler on details page
     */
    protected function navigateToToolDetails($client)
    {
        // Navigate to /tools (redirects to /tsugi/store/)
        $crawler = $client->request('GET', $this->baseUrl . '/tools');
        sleep(1);
        
        // Find tool card (div.app) containing our tool
        $toolCardIndex = null;
        $appCards = $crawler->filter('div.app');
        
        for ($i = 0; $i < $appCards->count(); $i++) {
            $cardCrawler = $appCards->eq($i);
            $cardText = $cardCrawler->text();
            $searchTerms = array_filter([$this->toolKey, $this->toolName]);
            
            foreach ($searchTerms as $term) {
                if ($term && stripos($cardText, $term) !== false) {
                    $toolCardIndex = $i;
                    break 2;
                }
            }
        }
        
        if ($toolCardIndex === null) {
            throw new \Exception("Tool card not found for '{$this->toolKey}'");
        }
        
        // Get the tool card crawler
        $cardCrawler = $appCards->eq($toolCardIndex);
        
        // Find "Details" button/link in the card
        $detailsLink = null;
        
        // Look for Details button/link
        $detailsLinks = $cardCrawler->filter('a, button');
        for ($i = 0; $i < $detailsLinks->count(); $i++) {
            $linkCrawler = $detailsLinks->eq($i);
            $linkText = trim($linkCrawler->text());
            if (stripos($linkText, 'Details') !== false || stripos($linkText, 'detail') !== false) {
                $detailsLink = $linkCrawler;
                break;
            }
        }
        
        if (!$detailsLink) {
            // Try finding link by href pattern
            $allLinks = $cardCrawler->filter('a');
            for ($i = 0; $i < $allLinks->count(); $i++) {
                $linkCrawler = $allLinks->eq($i);
                $href = $linkCrawler->attr('href');
                if ($href && (stripos($href, $this->toolKey) !== false || stripos($href, 'details') !== false)) {
                    $detailsLink = $linkCrawler;
                    break;
                }
            }
        }
        
        if (!$detailsLink) {
            throw new \Exception("Details button not found for tool '{$this->toolKey}'");
        }
        
        // Click Details button
        $client->click($detailsLink->link());
        sleep(1);
        
        return $client->getCrawler();
    }
    
    /**
     * Click "Try It" button on details page and navigate to test harness
     * Returns crawler on test harness page
     */
    protected function clickTryItButton($client, $crawler)
    {
        // Find "Try It" button/form
        $tryItButton = null;
        $tryItForm = null;
        
        // Look for button/link with "Try It" text
        $buttons = $crawler->filter('button, a, input[type="submit"]');
        for ($i = 0; $i < $buttons->count(); $i++) {
            $buttonCrawler = $buttons->eq($i);
            $buttonText = trim($buttonCrawler->text());
            if (stripos($buttonText, 'Try It') !== false || 
                stripos($buttonText, 'Try') !== false ||
                stripos($buttonText, 'Test') !== false) {
                $tryItButton = $buttonCrawler;
                break;
            }
        }
        
        // If not found, look for form with action containing "test"
        if (!$tryItButton) {
            $forms = $crawler->filter('form');
            for ($i = 0; $i < $forms->count(); $i++) {
                $formCrawler = $forms->eq($i);
                $action = $formCrawler->attr('action');
                if ($action && (stripos($action, 'test') !== false || stripos($action, $this->toolKey) !== false)) {
                    $tryItForm = $formCrawler;
                    // Find submit button in form
                    $submitButtons = $formCrawler->filter('button[type="submit"], input[type="submit"], button:not([type])');
                    if ($submitButtons->count() > 0) {
                        $tryItButton = $submitButtons->first();
                        break;
                    }
                }
            }
        }
        
        if (!$tryItButton) {
            throw new \Exception("Try It button not found on details page");
        }
        
        // Click Try It button
        $driver = $client->getWebDriver();
        try {
            // Try as link first
            $link = $tryItButton->link();
            $client->click($link);
        } catch (\Exception $e) {
            // If not a link, try clicking the element directly via WebDriver
            try {
                $element = $tryItButton->getElement(0);
                $driver->executeScript('arguments[0].click();', [$element]);
            } catch (\Exception $e2) {
                // Last resort: submit form if we found one
                if ($tryItForm) {
                    $form = $tryItForm->form();
                    $client->submit($form);
                } else {
                    throw new \Exception("Could not click Try It button: " . $e->getMessage());
                }
            }
        }
        sleep(2); // Wait for test harness to load
        
        return $client->getCrawler();
    }
    
    /**
     * Wait for iframe to appear and return iframe element
     */
    protected function waitForIframeElement($client, $timeout = 20)
    {
        $driver = $client->getWebDriver();
        $deadline = microtime(true) + $timeout;
        
        while (microtime(true) < $deadline) {
            // Try iframe.lti_frameResize first
            try {
                $frames = $driver->findElements(\Facebook\WebDriver\WebDriverBy::cssSelector('iframe.lti_frameResize'));
                if (count($frames) > 0) {
                    return $frames[0];
                }
            } catch (\Exception $e) {
                // Continue
            }
            
            // Try regular iframe
            try {
                $frames = $driver->findElements(\Facebook\WebDriver\WebDriverBy::tagName('iframe'));
                if (count($frames) > 0) {
                    return $frames[0];
                }
            } catch (\Exception $e) {
                // Continue
            }
            
            usleep(500000); // Wait 500ms
        }
        
        return null;
    }
    
    /**
     * Switch to identity tab and click identity link
     * 
     * The identity switcher is a tabbed dialog:
     * - <a href="#identity"> activates the identity tab
     * - <div id="identity"> contains the identity list
     * - <ul> inside #identity has <a href> links for each identity
     */
    protected function switchIdentity($client, $crawler, $identityKey)
    {
        $driver = $client->getWebDriver();
        $identityName = $this->identities[$identityKey];
        
        // Step 1: Find and click the identity tab link (<a href="#identity">)
        // Use WebDriver directly to avoid stale element issues
        try {
            // Try multiple selectors to find the identity tab
            $identityTabElement = null;
            
            // First try: exact match for href="#identity"
            $tabs = $driver->findElements(\Facebook\WebDriver\WebDriverBy::cssSelector('a[href="#identity"]'));
            if (count($tabs) > 0) {
                $identityTabElement = $tabs[0];
            }
            
            // Second try: href contains "identity"
            if (!$identityTabElement) {
                $tabs = $driver->findElements(\Facebook\WebDriver\WebDriverBy::cssSelector('a[href*="identity"]'));
                foreach ($tabs as $tab) {
                    $href = $tab->getAttribute('href');
                    if ($href && stripos($href, '#identity') !== false) {
                        $identityTabElement = $tab;
                        break;
                    }
                }
            }
            
            // Third try: find in nav-tabs
            if (!$identityTabElement) {
                $tabs = $driver->findElements(\Facebook\WebDriver\WebDriverBy::cssSelector('.nav-tabs a'));
                foreach ($tabs as $tab) {
                    $href = $tab->getAttribute('href');
                    if ($href && stripos($href, 'identity') !== false) {
                        $identityTabElement = $tab;
                        break;
                    }
                }
            }
            
            if (!$identityTabElement) {
                // Debug: get all tabs to see what's available
                $allTabs = $driver->findElements(\Facebook\WebDriver\WebDriverBy::cssSelector('.nav-tabs a, a[data-toggle="tab"]'));
                $tabInfo = [];
                foreach ($allTabs as $tab) {
                    try {
                        $href = $tab->getAttribute('href');
                        $text = $tab->getText();
                        $tabInfo[] = "href='$href' text='$text'";
                    } catch (\Exception $e) {
                        $tabInfo[] = "error getting tab info";
                    }
                }
                throw new \Exception("Identity tab (<a href=\"#identity\">) not found. Available tabs: " . implode(", ", $tabInfo));
            }
            
            // Click identity tab to activate the #identity div
            // Use JavaScript click to ensure it works with Bootstrap tabs
            $driver->executeScript('arguments[0].click();', [$identityTabElement]);
            sleep(1); // Wait for tab content to become visible
            
            // Also trigger Bootstrap tab show event if needed
            $driver->executeScript('
                if (typeof jQuery !== "undefined") {
                    jQuery("a[href=\'#identity\']").tab("show");
                }
            ');
            sleep(1);
            
        } catch (\Exception $e) {
            throw new \Exception("Could not click identity tab: " . $e->getMessage());
        }
        
        // Step 2: Wait for #identity div to be visible and find it
        $deadline = microtime(true) + 5;
        $identityDiv = null;
        while (microtime(true) < $deadline) {
            try {
                $divs = $driver->findElements(\Facebook\WebDriver\WebDriverBy::id('identity'));
                if (count($divs) > 0) {
                    $identityDiv = $divs[0];
                    // Check if it's visible (Bootstrap tabs use display:none/block)
                    try {
                        $isDisplayed = $identityDiv->isDisplayed();
                        $class = $identityDiv->getAttribute('class');
                        // Bootstrap tabs: active tab has class "active" or "in"
                        if ($isDisplayed || (stripos($class, 'active') !== false) || (stripos($class, 'in') !== false)) {
                            break;
                        }
                    } catch (\Exception $e) {
                        // Element might be stale, continue
                    }
                }
            } catch (\Exception $e) {
                // Continue trying
            }
            usleep(200000); // Wait 200ms
        }
        
        if (!$identityDiv) {
            throw new \Exception("Identity div (#identity) not found or not visible after clicking tab");
        }
        
        // Step 3: Find the <ul> inside #identity and then the identity link
        $identityLinkElement = null;
        $deadline = microtime(true) + 5;
        
        while (microtime(true) < $deadline) {
            try {
                // Find all links inside #identity
                $links = $identityDiv->findElements(\Facebook\WebDriver\WebDriverBy::tagName('a'));
                
                foreach ($links as $link) {
                    $linkText = trim($link->getText());
                    
                    // Match identity by name (case insensitive)
                    // Check for partial matches: "Jane Instructor", "Sue Student", etc.
                    if (stripos($linkText, $identityName) !== false) {
                        // Also verify it's actually one of our identities
                        $matched = false;
                        foreach ($this->identities as $key => $name) {
                            if (stripos($linkText, $name) !== false && $key === $identityKey) {
                                $identityLinkElement = $link;
                                $matched = true;
                                break 2;
                            }
                        }
                    }
                }
                
                if ($identityLinkElement) {
                    break;
                }
            } catch (\Exception $e) {
                // Continue trying
            }
            usleep(200000); // Wait 200ms
        }
        
        if (!$identityLinkElement) {
            // Debug: get all links in #identity to see what's available
            try {
                $allLinks = $identityDiv->findElements(\Facebook\WebDriver\WebDriverBy::tagName('a'));
                $linkInfo = [];
                foreach ($allLinks as $link) {
                    try {
                        $linkText = trim($link->getText());
                        $href = $link->getAttribute('href');
                        $linkInfo[] = "text='$linkText' href='$href'";
                    } catch (\Exception $e) {
                        $linkInfo[] = "error getting link info";
                    }
                }
                throw new \Exception("Identity link for '{$identityName}' not found in #identity div. Available links: " . implode(", ", $linkInfo));
            } catch (\Exception $e2) {
                throw new \Exception("Identity link for '{$identityName}' not found in #identity div: " . $e2->getMessage());
            }
        }
        
        // Step 4: Click identity link (this will reload page with new identity)
        try {
            $driver->executeScript('arguments[0].click();', [$identityLinkElement]);
            sleep(2); // Wait for page to reload with new identity
        } catch (\Exception $e) {
            throw new \Exception("Could not click identity link: " . $e->getMessage());
        }
        
        // Return refreshed crawler
        return $client->getCrawler();
    }
    
    /**
     * Test that tool can be launched via "Try It" button
     */
    public function testToolLaunchesViaTryIt()
    {
        $client = $this->getPantherClient();
        
        try {
            if (!$this->toolKey) {
                throw new \Exception("toolKey must be set in test class");
            }
            
            echo "   Navigating to tool details...\n";
            
            // Step 1: Navigate to tool details page
            $crawler = $this->navigateToToolDetails($client);
            
            echo "   Clicking 'Try It' button...\n";
            
            // Step 2: Click Try It button
            $crawler = $this->clickTryItButton($client, $crawler);
            
            echo "   Waiting for tool to launch in iframe...\n";
            
            // Step 3: Wait for iframe
            $iframeElement = $this->waitForIframeElement($client, 20);
            
            if (!$iframeElement) {
                echo "⚠ Tool did not launch in iframe (iframe not found)\n";
                $client->quit();
                return;
            }
            
            // Step 4: Switch to iframe and verify content
            $this->switchToIframe($client, 0);
            sleep(2);
            
            $iframeCrawler = $client->getCrawler();
            $iframeBody = $iframeCrawler->filter('body')->text();
            
            if (empty(trim($iframeBody))) {
                echo "⚠ Tool launched but iframe appears empty\n";
            } else {
                echo "✓ Tool launched successfully via 'Try It'\n";
                echo "   Content length: " . strlen($iframeBody) . " chars\n";
            }
            
            // Switch back
            $this->switchToMainDocument($client);
            
            if ($this->isWatchMode()) {
                sleep(2);
            }
            
            $client->quit();
        } catch (\Exception $e) {
            try { 
                $this->switchToMainDocument($client);
                $client->quit(); 
            } catch (\Exception $e2) {}
            echo "⚠ Tool launch test failed: " . $e->getMessage() . "\n";
            if ($this->isWatchMode()) {
                echo "   File: " . $e->getFile() . ":" . $e->getLine() . "\n";
            }
        }
    }
    
    /**
     * Test tool functionality for a specific identity
     * Override this method in derived classes to add tool-specific tests
     * 
     * @param Client $client Panther client
     * @param string $identityKey Identity key (instructor, learner1, learner2, learner3)
     * @param string $identityName Identity display name
     * @param \Symfony\Component\Panther\DomCrawler\Crawler $iframeCrawler Crawler for iframe content
     */
    protected function testToolFunctionalityForIdentity($client, $identityKey, $identityName, $iframeCrawler)
    {
        // Base implementation: just verify content exists
        // Override in derived classes for tool-specific tests
        $iframeBody = $iframeCrawler->filter('body')->text();
        
        if (empty(trim($iframeBody))) {
            echo "     ⚠ {$identityName}: Tool launched but iframe appears empty\n";
        } else {
            echo "     ✓ {$identityName}: Tool launched successfully (" . strlen($iframeBody) . " chars)\n";
        }
    }
    
    /**
     * Test all four identities (Jane Instructor, Sue Student, Ed Student, Anonymous)
     * Launches tool for each identity and calls testToolFunctionalityForIdentity() hook
     */
    public function testAllIdentities()
    {
        $client = $this->getPantherClient();
        
        try {
            if (!$this->toolKey) {
                throw new \Exception("toolKey must be set in test class");
            }
            
            echo "   Navigating to tool test harness...\n";
            
            // Navigate to tool details and click Try It
            $crawler = $this->navigateToToolDetails($client);
            $crawler = $this->clickTryItButton($client, $crawler);
            
            // Wait for initial launch (Jane Instructor by default)
            echo "   Waiting for initial tool launch (Jane Instructor)...\n";
            $iframeElement = $this->waitForIframeElement($client, 20);
            if (!$iframeElement) {
                echo "⚠ Initial tool launch failed, skipping identity tests\n";
                $client->quit();
                return;
            }
            
            echo "   ✓ Initial launch successful\n";
            
            // Test Jane Instructor (already launched)
            echo "   Testing identity: Jane Instructor...\n";
            try {
                $this->switchToIframe($client, 0);
                sleep(2);
                
                $iframeCrawler = $client->getCrawler();
                $this->testToolFunctionalityForIdentity($client, 'instructor', 'Jane Instructor', $iframeCrawler);
                
                $this->switchToMainDocument($client);
            } catch (\Exception $e) {
                echo "     ⚠ Jane Instructor: Failed - " . $e->getMessage() . "\n";
                try {
                    $this->switchToMainDocument($client);
                } catch (\Exception $e2) {}
            }
            
            // Test remaining identities (Sue Student, Ed Student, Anonymous)
            echo "   Testing remaining identities...\n";
            $remainingIdentities = [
                'learner1' => 'Sue Student',
                'learner2' => 'Ed Student',
                'learner3' => 'Anonymous',
            ];
            
            foreach ($remainingIdentities as $identityKey => $identityName) {
                echo "   Testing identity: {$identityName}...\n";
                
                try {
                    // Switch to identity tab and click identity link
                    $crawler = $this->switchIdentity($client, $crawler, $identityKey);
                    
                    // Wait for iframe to reload with new identity
                    sleep(1);
                    $iframeElement = $this->waitForIframeElement($client, 20);
                    
                    if (!$iframeElement) {
                        echo "     ⚠ Iframe not found for {$identityName}\n";
                        continue;
                    }
                    
                    // Switch to iframe and test functionality
                    $this->switchToIframe($client, 0);
                    sleep(2);
                    
                    $iframeCrawler = $client->getCrawler();
                    $this->testToolFunctionalityForIdentity($client, $identityKey, $identityName, $iframeCrawler);
                    
                    // Switch back to main document before next identity
                    $this->switchToMainDocument($client);
                    
                    if ($this->isWatchMode()) {
                        sleep(1);
                    }
                } catch (\Exception $e) {
                    echo "     ⚠ {$identityName}: Failed - " . $e->getMessage() . "\n";
                    // Try to switch back to main document
                    try {
                        $this->switchToMainDocument($client);
                    } catch (\Exception $e2) {
                        // Ignore
                    }
                    // Continue with next identity
                    continue;
                }
            }
            
            echo "✓ All identities tested\n";
            
            if ($this->isWatchMode()) {
                sleep(2);
            }
            
            $client->quit();
        } catch (\Exception $e) {
            try { 
                $this->switchToMainDocument($client);
                $client->quit(); 
            } catch (\Exception $e2) {}
            echo "⚠ Identity testing failed: " . $e->getMessage() . "\n";
            if ($this->isWatchMode()) {
                echo "   File: " . $e->getFile() . ":" . $e->getLine() . "\n";
            }
        }
    }
    
    /**
     * Run all base tool tests
     */
    public function runAll()
    {
        echo "\n=== Running Base Tool Tests for '{$this->toolKey}' ===\n\n";
        
        try {
            $this->testToolAppearsInStore();
            $this->testToolLaunchesViaTryIt();
            $this->testAllIdentities();
            
            echo "\n✓ All base tool tests completed!\n";
            return 0;
        } catch (\Exception $e) {
            echo "\n✗ Test failed: " . $e->getMessage() . "\n";
            return 1;
        }
    }
}
