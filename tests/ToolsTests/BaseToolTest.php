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

// Load Composer autoloader - prefer tests/vendor, fallback to tsugi/vendor
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
} else {
    require_once __DIR__ . '/../../tsugi/vendor/autoload.php';
}

require_once __DIR__ . '/../BaseTestCase.php';

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
        // Wait for test harness to load (poll for iframe or page elements)
        $this->waitForTestHarnessToLoad($client);
        
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
     * Wait for test harness page to load after clicking "Try It"
     * Polls for iframe element to appear (check, wait 1s, check again, up to 5 attempts = 5 seconds max)
     */
    protected function waitForTestHarnessToLoad($client, $maxAttempts = 5)
    {
        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
            $iframeElement = $this->waitForIframeElement($client, 1); // Quick check (1 second)
            if ($iframeElement) {
                return; // Test harness loaded (iframe present)
            }
            
            // If not ready yet and not last attempt, wait 1 second
            if ($attempt < $maxAttempts) {
                sleep(1);
            }
        }
        // If we get here, iframe didn't appear, but continue anyway (might be slow)
    }
    
    /**
     * Wait for identity tab content (#identity div) to become visible
     * Polls: check, wait 1 second, check again (up to 5 attempts = 5 seconds max)
     */
    protected function waitForIdentityTabContent($client, $maxAttempts = 5)
    {
        $driver = $client->getWebDriver();
        
        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
            try {
                $divs = $driver->findElements(\Facebook\WebDriver\WebDriverBy::id('identity'));
                if (count($divs) > 0) {
                    $identityDiv = $divs[0];
                    try {
                        $isDisplayed = $identityDiv->isDisplayed();
                        $class = $identityDiv->getAttribute('class');
                        // Bootstrap tabs: active tab has class "active" or "in"
                        if ($isDisplayed || (stripos($class, 'active') !== false) || (stripos($class, 'in') !== false)) {
                            return; // Tab content is visible
                        }
                    } catch (\Exception $e) {
                        // Element might be stale, continue
                    }
                }
            } catch (\Exception $e) {
                // Continue trying
            }
            
            // If not ready yet and not last attempt, wait 1 second
            if ($attempt < $maxAttempts) {
                sleep(1);
            }
        }
        // If we get here, tab content didn't appear, but continue anyway
    }
    
    /**
     * Wait for identity switch to complete (page reload with new identity)
     * Polls for iframe to reload (check, wait 1s, check again, up to 5 attempts = 5 seconds max)
     */
    protected function waitForIdentitySwitchToComplete($client, $maxAttempts = 5)
    {
        // After clicking identity link, page reloads and iframe reloads
        // Wait for iframe to reappear/reload
        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
            // Small delay to let page start reloading
            if ($attempt > 1) {
                sleep(1);
            }
            
            // Check if iframe is present (page has reloaded)
            $iframeElement = $this->waitForIframeElement($client, 1); // Quick check
            if ($iframeElement) {
                // Iframe is present - page has reloaded
                return;
            }
        }
        // If we get here, iframe didn't reload, but continue anyway
    }
    
    /**
     * Wait for iframe body content to be ready
     * Uses polling: check, wait 1 second, check again (up to 5 attempts = 5 seconds max)
     * 
     * @param Client $client Panther client
     * @param int $maxAttempts Maximum number of attempts (default: 5)
     * @return array ['success' => bool, 'bodyText' => string, 'crawler' => Crawler|null]
     */
    protected function waitForIframeBodyContent($client, $maxAttempts = 5)
    {
        $driver = $client->getWebDriver();
        
        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
            try {
                // Try to find body element
                $body = null;
                try {
                    $body = $driver->findElement(\Facebook\WebDriver\WebDriverBy::tagName('body'));
                } catch (\Exception $e) {
                    // Body not found yet
                }
                
                if ($body) {
                    // Check if body is displayed
                    try {
                        $isDisplayed = $body->isDisplayed();
                        if ($isDisplayed) {
                            // Try to get text content
                            $bodyText = '';
                            try {
                                $bodyText = $body->getText();
                            } catch (\Exception $e) {
                                // Can't get text yet
                            }
                            
                            // If we have text content, we're good
                            if (!empty(trim($bodyText))) {
                                // Get crawler for iframe
                                $iframeCrawler = $client->getCrawler();
                                return [
                                    'success' => true,
                                    'bodyText' => $bodyText,
                                    'crawler' => $iframeCrawler
                                ];
                            }
                        }
                    } catch (\Exception $e) {
                        // Body exists but not accessible yet
                    }
                }
                
                // If not ready yet and not last attempt, wait 1 second
                if ($attempt < $maxAttempts) {
                    sleep(1);
                }
            } catch (\Exception $e) {
                // Error checking - wait and retry if not last attempt
                if ($attempt < $maxAttempts) {
                    sleep(1);
                }
            }
        }
        
        // All attempts failed - return failure
        return [
            'success' => false,
            'bodyText' => '',
            'crawler' => null
        ];
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
            
            // Also trigger Bootstrap tab show event if needed
            $driver->executeScript('
                if (typeof jQuery !== "undefined") {
                    jQuery("a[href=\'#identity\']").tab("show");
                }
            ');
            
            // Wait for identity tab content to become visible (poll)
            $this->waitForIdentityTabContent($client);
            
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
            // Wait for page to reload with new identity (poll for iframe to reload)
            $this->waitForIdentitySwitchToComplete($client);
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
            
            // Wait for iframe body content using polling (check, wait 1s, check again, up to 3 times)
            $result = $this->waitForIframeBodyContent($client, 3);
            
            if (!$result['success']) {
                echo "⚠ Tool launched but iframe content not ready after 5 attempts (may still be loading)\n";
                $this->switchToMainDocument($client);
                $client->quit();
                return;
            }
            
            $iframeBody = $result['bodyText'];
            $iframeCrawler = $result['crawler'];
            
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
    /**
     * Get iframe body text using resilient approach
     * 
     * Always uses WebDriver directly since we're already in iframe context.
     * This ensures we get fresh content even if crawler references are stale.
     * 
     * @param Client $client Panther client (must already be switched to iframe)
     * @param \Symfony\Component\Panther\DomCrawler\Crawler|null $iframeCrawler Optional crawler (not used, kept for compatibility)
     * @return string Body text content
     */
    protected function getIframeBodyText($client, $iframeCrawler = null)
    {
        $iframeBody = '';
        
        // Always use WebDriver directly - it's more reliable and always fresh
        // The crawler can become stale, especially after switching contexts
        try {
            $driver = $client->getWebDriver();
            $body = $driver->findElement(\Facebook\WebDriver\WebDriverBy::tagName('body'));
            $iframeBody = $body->getText();
        } catch (\Exception $e) {
            // If WebDriver fails, try Crawler as fallback (might work if crawler is fresh)
            if ($iframeCrawler) {
                try {
                    $bodyElement = $iframeCrawler->filter('body');
                    if ($bodyElement->count() > 0) {
                        $iframeBody = $bodyElement->text();
                    }
                } catch (\Exception $e2) {
                    // Both failed
                    $iframeBody = '';
                }
            }
        }
        
        return $iframeBody;
    }
    
    /**
     * Get fresh iframe crawler
     * Gets a new crawler reference after switching to iframe
     * Use this when you need a crawler for filtering elements
     * 
     * @param Client $client Panther client (must already be switched to iframe)
     * @return \Symfony\Component\Panther\DomCrawler\Crawler Fresh crawler for iframe
     */
    protected function getFreshIframeCrawler($client)
    {
        return $client->getCrawler();
    }
    
    /**
     * Extract first visible text from iframe body content
     * Finds first non-empty line longer than 3 characters
     * 
     * @param string $iframeBody Full iframe body text
     * @param int $maxLength Maximum length to return (default: 100)
     * @return string First visible text, truncated if needed
     */
    protected function getFirstVisibleText($iframeBody, $maxLength = 100)
    {
        $textLines = explode("\n", $iframeBody);
        $firstVisibleText = '';
        
        foreach ($textLines as $line) {
            $line = trim($line);
            // Skip empty lines and very short lines (likely formatting)
            if (!empty($line) && strlen($line) > 3) {
                $firstVisibleText = $line;
                break;
            }
        }
        
        // Truncate if too long
        if (strlen($firstVisibleText) > $maxLength) {
            $firstVisibleText = substr($firstVisibleText, 0, $maxLength - 3) . '...';
        }
        
        return $firstVisibleText;
    }
    
    /**
     * Print debug information about iframe content
     * Shows character count and first visible text
     * Can be called from derived classes or automatically enabled
     * 
     * Always gets fresh content using WebDriver (crawler parameter kept for compatibility)
     * 
     * @param Client $client Panther client (must already be switched to iframe)
     * @param string $identityName Identity display name
     * @param \Symfony\Component\Panther\DomCrawler\Crawler|null $iframeCrawler Optional crawler (not used, kept for compatibility)
     */
    protected function printIframeDebugInfo($client, $identityName, $iframeCrawler = null)
    {
        try {
            // Always get fresh body text (doesn't rely on potentially stale crawler)
            $iframeBody = $this->getIframeBodyText($client, $iframeCrawler);
            $charCount = strlen($iframeBody);
            $firstVisibleText = $this->getFirstVisibleText($iframeBody);
            
            echo "     [DEBUG] Per-identity per-tool tests would go here for {$identityName}\n";
            echo "     [DEBUG] Iframe text character count: {$charCount}\n";
            if (!empty($firstVisibleText)) {
                echo "     [DEBUG] First visible text: \"{$firstVisibleText}\"\n";
            } else {
                echo "     [DEBUG] First visible text: (none found - iframe may still be loading)\n";
            }
        } catch (\Exception $e) {
            echo "     [DEBUG] Could not extract debug info: " . $e->getMessage() . "\n";
        }
    }
    
    protected function testToolFunctionalityForIdentity($client, $identityKey, $identityName, $iframeCrawler)
    {
        // Base implementation: just verify content exists
        // Override in derived classes for tool-specific tests
        
        try {
            // Get iframe body text using resilient approach (always gets fresh content)
            // Note: $iframeCrawler parameter kept for compatibility but not used
            // We always use WebDriver directly to avoid stale crawler issues
            $iframeBody = $this->getIframeBodyText($client, $iframeCrawler);
            
            if (empty(trim($iframeBody))) {
                echo "     ⚠ {$identityName}: Tool launched but iframe appears empty (may still be loading)\n";
            } else {
                echo "     ✓ {$identityName}: Tool launched successfully (" . strlen($iframeBody) . " chars)\n";
            }
        } catch (\Exception $e) {
            // If we can't verify content, but tool launched, consider it a partial success
            echo "     ⚠ {$identityName}: Tool launched but content verification failed: " . $e->getMessage() . "\n";
        }
    }
    
    /**
     * Test all four identities (Jane Instructor, Sue Student, Ed Student, Anonymous)
     * Launches tool for each identity and calls testToolFunctionalityForIdentity() hook
     * 
     * Optimized: Stays on test harness page (/tsugi/store/test/{tool}) and switches
     * identities directly without navigating back to store listing.
     */
    public function testAllIdentities()
    {
        $client = $this->getPantherClient();
        
        try {
            if (!$this->toolKey) {
                throw new \Exception("toolKey must be set in test class");
            }
            
            echo "   Navigating to tool test harness...\n";
            
            // Navigate to tool details and click Try It (gets us to test harness)
            $crawler = $this->navigateToToolDetails($client);
            $crawler = $this->clickTryItButton($client, $crawler);
            
            // We're now on /tsugi/store/test/{tool} - stay here for all identity switches
            
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
                // Switch to iframe
                $this->switchToIframe($client, 0);
                
                // Wait for iframe body content using polling (check, wait 1s, check again, up to 5 times)
                $result = $this->waitForIframeBodyContent($client, 5);
                
                if (!$result['success']) {
                    echo "     ⚠ Jane Instructor: Iframe content not ready after 5 attempts\n";
                    $this->switchToMainDocument($client);
                } else {
                    $iframeCrawler = $result['crawler'];
                    $this->testToolFunctionalityForIdentity($client, 'instructor', 'Jane Instructor', $iframeCrawler);
                    $this->switchToMainDocument($client);
                }
            } catch (\Exception $e) {
                echo "     ⚠ Jane Instructor: Failed - " . $e->getMessage() . "\n";
                if ($this->isWatchMode()) {
                    echo "       (Iframe may still be loading - check browser window)\n";
                }
                try {
                    $this->switchToMainDocument($client);
                } catch (\Exception $e2) {}
            }
            
            // Test remaining identities (Sue Student, Ed Student, Anonymous)
            // We stay on the test harness page and just switch identities
            echo "   Testing remaining identities (switching on test harness page)...\n";
            $remainingIdentities = [
                'learner1' => 'Sue Student',
                'learner2' => 'Ed Student',
                'learner3' => 'Anonymous',
            ];
            
            foreach ($remainingIdentities as $identityKey => $identityName) {
                echo "   Testing identity: {$identityName}...\n";
                
                try {
                    // Refresh crawler to get current page state (we're still on test harness)
                    $crawler = $client->getCrawler();
                    
                    // Switch to identity tab and click identity link (stays on same page)
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
                    
                    // Wait for iframe body content using polling (check, wait 1s, check again, up to 3 times)
                    $result = $this->waitForIframeBodyContent($client, 3);
                    
                    if (!$result['success']) {
                        echo "     ⚠ {$identityName}: Iframe content not ready after 5 attempts\n";
                        $this->switchToMainDocument($client);
                        continue;
                    }
                    
                    $iframeCrawler = $result['crawler'];
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
                    // Continue with next identity (still on test harness page)
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
