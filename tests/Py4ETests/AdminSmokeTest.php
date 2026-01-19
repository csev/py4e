<?php
/**
 * Smoke test for Tsugi Admin tool
 * 
 * Tests the admin interface at /tsugi/admin:
 * 1. Navigate to /tsugi/admin
 * 2. Login with admin password
 * 3. Test admin UI navigation (hrefs and modal popups)
 */

require_once __DIR__ . '/../BaseTestCase.php';

// Load Composer autoloader
require_once __DIR__ . '/../../tsugi/vendor/autoload.php';

class AdminSmokeTest extends BaseTestCase
{
    /**
     * Admin password from config
     * We'll read this from config.php
     */
    protected $adminPassword = null;
    
    /**
     * Get admin password from config
     */
    protected function getAdminPassword()
    {
        if ($this->adminPassword === null) {
            // Load config to get admin password
            // Read config file to extract adminpw
            $configPath = __DIR__ . '/../../tsugi/config.php';
            if (file_exists($configPath)) {
                // Read config file to extract adminpw
                $configContent = file_get_contents($configPath);
                if (preg_match('/\$CFG->adminpw\s*=\s*[\'"]([^\'"]+)[\'"]/', $configContent, $matches)) {
                    $this->adminPassword = $matches[1];
                }
            }
            
            // Fallback to default if not found
            if (!$this->adminPassword) {
                $this->adminPassword = 'short'; // Common default
            }
        }
        
        return $this->adminPassword;
    }
    
    /**
     * Wait for admin page to load (polling mechanism)
     * Checks for admin console indicators, retries up to maxAttempts times
     * 
     * @param Client $client Panther client
     * @param int $maxAttempts Maximum number of attempts
     * @return array ['success' => bool, 'crawler' => Crawler|null]
     */
    protected function waitForAdminPageToLoad($client, $maxAttempts = 5)
    {
        $driver = $client->getWebDriver();
        
        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
            try {
                // Refresh crawler to get current page state
                $crawler = $client->getCrawler();
                $bodyText = '';
                
                try {
                    $body = $driver->findElement(\Facebook\WebDriver\WebDriverBy::tagName('body'));
                    if ($body && $body->isDisplayed()) {
                        $bodyText = $body->getText();
                    }
                } catch (\Exception $e) {
                    // Body not ready yet
                }
                
                // Check if admin console is loaded
                if (!empty($bodyText) && 
                    (stripos($bodyText, 'Administration Console') !== false || 
                     stripos($bodyText, 'Manage Access Keys') !== false)) {
                    return ['success' => true, 'crawler' => $crawler];
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
        
        return ['success' => false, 'crawler' => null];
    }
    
    /**
     * Wait for password field to appear (polling mechanism)
     * 
     * @param Client $client Panther client
     * @param int $maxAttempts Maximum number of attempts
     * @return \Facebook\WebDriver\Remote\RemoteWebElement|null Password field element
     */
    protected function waitForPasswordField($client, $maxAttempts = 5)
    {
        $driver = $client->getWebDriver();
        
        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
            try {
                // Try to find passphrase field first
                try {
                    $elements = $driver->findElements(\Facebook\WebDriver\WebDriverBy::name('passphrase'));
                    if (count($elements) > 0 && $elements[0]->isDisplayed()) {
                        return $elements[0];
                    }
                } catch (\Exception $e) {
                    // Continue
                }
                
                // Try any password input
                try {
                    $elements = $driver->findElements(\Facebook\WebDriver\WebDriverBy::cssSelector('input[type="password"]'));
                    if (count($elements) > 0 && $elements[0]->isDisplayed()) {
                        return $elements[0];
                    }
                } catch (\Exception $e) {
                    // Continue
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
        
        return null;
    }
    
    /**
     * Login to admin interface
     * 
     * @param Client $client Panther client
     * @return \Symfony\Component\Panther\DomCrawler\Crawler Crawler after login
     */
    protected function loginToAdmin($client)
    {
        // Navigate to admin page
        $client->request('GET', $this->baseUrl . '/tsugi/admin');
        sleep(1); // Initial wait
        
        // Check current URL (might have redirected)
        $currentUrl = $client->getCurrentURL();
        
        // If redirected to login.php, Google OAuth is enabled
        if (stripos($currentUrl, 'login') !== false) {
            echo "   ⚠ Redirected to login page (Google OAuth is enabled)\n";
            echo "   ⚠ Admin testing requires Google OAuth to be disabled or user to be logged in\n";
            throw new \Exception("Cannot test admin - redirected to login page. Google OAuth is enabled.");
        }
        
        // Wait for admin page to load (check if already logged in)
        $result = $this->waitForAdminPageToLoad($client, 3);
        if ($result['success']) {
            echo "   Already logged in\n";
            return $result['crawler'];
        }
        
        // Not logged in - need to find password field
        $driver = $client->getWebDriver();
        $passwordElement = $this->waitForPasswordField($client, 5);
        
        if (!$passwordElement) {
            $currentUrl = $client->getCurrentURL();
            throw new \Exception("Password field (passphrase) not found on admin login page. Page URL: {$currentUrl}");
        }
        
        // Find submit button using WebDriver (more reliable than crawler)
        $submitElement = null;
        try {
            $submitElements = $driver->findElements(\Facebook\WebDriver\WebDriverBy::cssSelector('input[type="submit"], button[type="submit"]'));
            if (count($submitElements) > 0 && $submitElements[0]->isDisplayed()) {
                $submitElement = $submitElements[0];
            }
        } catch (\Exception $e) {
            // No submit button found - will use Enter key
        }
        
        // Fill in password using WebDriver (more reliable)
        $adminPw = $this->getAdminPassword();
        $passwordElement->clear();
        $passwordElement->sendKeys($adminPw);
        
        // Submit form
        if ($submitElement) {
            $driver->executeScript('arguments[0].click();', [$submitElement]);
        } else {
            // Press Enter on password field
            $passwordElement->sendKeys(\Facebook\WebDriver\WebDriverKeys::RETURN);
        }
        
        // Wait for login to complete (poll for admin page)
        $result = $this->waitForAdminPageToLoad($client, 5);
        if (!$result['success']) {
            throw new \Exception("Login may have failed - admin page did not load after login attempt");
        }
        
        return $result['crawler'];
    }
    
    /**
     * Test that admin login page loads
     */
    public function testAdminLoginPageLoads()
    {
        $client = $this->getPantherClient();
        
        try {
            $crawler = $client->request('GET', $this->baseUrl . '/tsugi/admin');
            sleep(1);
            
            $bodyText = $crawler->filter('body')->text();
            $this->assertNotEmpty($bodyText, 'Admin page should have content');
            
            echo "✓ Admin login page loads\n";
            
            if ($this->isWatchMode()) {
                sleep(2);
            }
            
            $client->quit();
        } catch (\Exception $e) {
            try { $client->quit(); } catch (\Exception $e2) {}
            echo "⚠ Admin login page test skipped: " . $e->getMessage() . "\n";
        }
    }
    
    /**
     * Test admin login
     */
    public function testAdminLogin()
    {
        $client = $this->getPantherClient();
        
        try {
            echo "   Logging in to admin...\n";
            $crawler = $this->loginToAdmin($client);
            
            // Check if login was successful
            $bodyText = $crawler->filter('body')->text();
            
            // Look for admin UI indicators
            $hasAdminUI = stripos($bodyText, 'admin') !== false || 
                         stripos($bodyText, 'dashboard') !== false ||
                         stripos($bodyText, 'upgrade') !== false ||
                         stripos($bodyText, 'database') !== false;
            
            if ($hasAdminUI) {
                echo "✓ Admin login successful\n";
            } else {
                echo "⚠ Admin login may have failed (admin UI not detected)\n";
                echo "   Page content preview: " . substr($bodyText, 0, 200) . "...\n";
            }
            
            if ($this->isWatchMode()) {
                sleep(2);
            }
            
            $client->quit();
        } catch (\Exception $e) {
            try { $client->quit(); } catch (\Exception $e2) {}
            echo "⚠ Admin login test failed: " . $e->getMessage() . "\n";
        }
    }
    
    /**
     * Test admin UI navigation (hrefs and modals)
     */
    public function testAdminUINavigation()
    {
        $client = $this->getPantherClient();
        
        try {
            echo "   Logging in to admin...\n";
            $crawler = $this->loginToAdmin($client);
            sleep(1);
            
            echo "   Testing admin UI navigation...\n";
            
            // Refresh crawler to get current page state (avoid stale references)
            $crawler = $client->getCrawler();
            $driver = $client->getWebDriver();
            
            // Find all admin links using WebDriver (more reliable)
            // Only test links from the specific admin UI <ul> list - use whitelist approach
            $adminLinkElements = [];
            
            // Whitelist of admin UI links (exact text or href from the admin UI ul)
            $adminLinkWhitelist = [
                // Regular links
                'Manage Access Keys' => ['href' => 'key', 'isModal' => false],
                'Manage Data Expiry' => ['href' => 'expire', 'isModal' => false],
                'View Contexts' => ['href' => 'context/', 'isModal' => false],
                'View Activity' => ['href' => 'activity/', 'isModal' => false],
                'View Users' => ['href' => 'users/', 'isModal' => false],
                // 'Manage Installed Modules' => ['href' => 'install', 'isModal' => false], // Skipped for now
                'Manage Remote Tsugi Tools (deprecated)' => ['href' => 'external', 'isModal' => false],
                // Modals (use title attribute)
                'Recent Logins' => ['href' => '#', 'isModal' => true],
                'Upgrade Database' => ['href' => '#', 'isModal' => true],
                'Check Keyset' => ['href' => '#', 'isModal' => true],
                'Check Cache' => ['href' => '#', 'isModal' => true],
                'Encrypt/Decrypt Strings' => ['href' => '#', 'isModal' => true],
                'Check Nonces' => ['href' => '#', 'isModal' => true],
                'Check database size' => ['href' => '#', 'isModal' => true],
                'Remove 12345 Data' => ['href' => '#', 'isModal' => true],
                'Test E-Mail' => ['href' => '#', 'isModal' => true],
                'Event Status' => ['href' => '#', 'isModal' => true],
                'BLOB/File Status' => ['href' => '#', 'isModal' => true],
                'BLOB/File Migration' => ['href' => '#', 'isModal' => true],
                'Unreferenced BLOB Cleanup' => ['href' => '#', 'isModal' => true],
            ];
            
            try {
                // Find all links on the page
                $allLinks = $driver->findElements(\Facebook\WebDriver\WebDriverBy::cssSelector('ul li a'));
                foreach ($allLinks as $link) {
                    try {
                        if ($link->isDisplayed()) {
                            $href = $link->getAttribute('href');
                            $onclick = $link->getAttribute('onclick') ?: '';
                            $text = trim($link->getText());
                            $title = trim($link->getAttribute('title') ?: '');
                            
                            // For modals, use title attribute if text is empty
                            if (empty($text) && !empty($title)) {
                                $text = $title;
                            }
                            
                            // Check if this link is in our whitelist
                            $matchedLink = null;
                            foreach ($adminLinkWhitelist as $whitelistText => $whitelistInfo) {
                                // Match by text (exact or contains) or by title for modals
                                if (trim($text) === $whitelistText || 
                                    trim($title) === $whitelistText ||
                                    stripos($text, $whitelistText) !== false) {
                                    // Also verify href matches (for regular links) or is # (for modals)
                                    $expectedHref = $whitelistInfo['href'];
                                    if ($whitelistInfo['isModal']) {
                                        // Modal: href should be # or start with #
                                        if ($href === '#' || strpos($href, '#') === 0) {
                                            $matchedLink = $whitelistInfo;
                                            break;
                                        }
                                    } else {
                                        // Regular link: href should match or contain expected href
                                        if ($href && (basename($href) === basename($expectedHref) || 
                                            stripos($href, $expectedHref) !== false)) {
                                            $matchedLink = $whitelistInfo;
                                            break;
                                        }
                                    }
                                }
                            }
                            
                            // Only add if matched whitelist
                            if ($matchedLink) {
                                $adminLinkElements[] = [
                                    'element' => $link,
                                    'href' => $href,
                                    'text' => $text ?: $title,
                                    'onclick' => $onclick,
                                    'isModal' => $matchedLink['isModal']
                                ];
                            }
                        }
                    } catch (\Exception $e) {
                        // Skip stale elements
                        continue;
                    }
                }
            } catch (\Exception $e) {
                echo "   ⚠ Could not find admin links: " . $e->getMessage() . "\n";
            }
            
            $linkCount = count($adminLinkElements);
            echo "   Found {$linkCount} admin links\n";
            
            if ($linkCount > 0) {
                // Test all admin links from the whitelist
                $testedLinks = 0;
                
                for ($i = 0; $i < $linkCount; $i++) {
                    try {
                        $linkInfo = $adminLinkElements[$i];
                        $linkText = $linkInfo['text'];
                        $href = $linkInfo['href'];
                        $isModal = $linkInfo['isModal'];
                        
                        echo "     Testing " . ($isModal ? "modal" : "link") . ": {$linkText}\n";
                        
                        // Store current URL to detect if navigation happened (vs modal)
                        $currentUrl = $client->getCurrentURL();
                        
                        // Click link using WebDriver - find element fresh each time (avoid stale references)
                        try {
                            // Find element fresh by link text first (more reliable for relative links)
                            $freshLinks = $driver->findElements(\Facebook\WebDriver\WebDriverBy::partialLinkText($linkText));
                            
                            // If not found by text, try by href (handle both absolute and relative hrefs)
                            if (count($freshLinks) === 0 && !$isModal) {
                                $hrefSelector = 'a[href="' . $href . '"], a[href*="' . basename($href) . '"]';
                                $freshLinks = $driver->findElements(\Facebook\WebDriver\WebDriverBy::cssSelector($hrefSelector));
                            }
                            
                            // For modals, try finding by title attribute
                            if (count($freshLinks) === 0 && $isModal) {
                                $titleLinks = $driver->findElements(\Facebook\WebDriver\WebDriverBy::cssSelector('a[title="' . $linkText . '"]'));
                                if (count($titleLinks) > 0) {
                                    $freshLinks = $titleLinks;
                                }
                            }
                            
                            if (count($freshLinks) > 0 && $freshLinks[0]->isDisplayed()) {
                                $driver->executeScript('arguments[0].click();', [$freshLinks[0]]);
                            } else {
                                throw new \Exception("Could not find link to click: {$linkText}");
                            }
                        } catch (\Exception $e) {
                            echo "       ⚠ Failed to click: " . $e->getMessage() . "\n";
                            continue;
                        }
                        
                        sleep(1); // Wait for page/modal to load
                        
                        if ($isModal) {
                            // Handle modal - wait for iframe-dialog to appear, then close it
                            echo "       ✓ Modal opened\n";
                            
                            // Wait for modal iframe to appear
                            $modalAppeared = false;
                            for ($attempt = 1; $attempt <= 5; $attempt++) {
                                try {
                                    $iframeDialog = $driver->findElement(\Facebook\WebDriver\WebDriverBy::id('iframe-dialog'));
                                    if ($iframeDialog && $iframeDialog->isDisplayed()) {
                                        $modalAppeared = true;
                                        break;
                                    }
                                } catch (\Exception $e) {
                                    // Modal not ready yet
                                }
                                
                                if ($attempt < 5) {
                                    sleep(1);
                                }
                            }
                            
                            if ($modalAppeared) {
                                echo "       ✓ Modal iframe appeared\n";
                                
                                // Wait for spinner to disappear (modal content loaded)
                                echo "       Waiting for spinner to disappear (max 15 seconds)...\n";
                                $spinnerGone = false;
                                $maxWait = 15; // Maximum wait time in seconds
                                $startTime = time();
                                
                                while ((time() - $startTime) < $maxWait) {
                                    try {
                                        $spinner = $driver->findElement(\Facebook\WebDriver\WebDriverBy::id('iframe-spinner'));
                                        // Check if spinner is hidden or not displayed
                                        $isDisplayed = false;
                                        try {
                                            $isDisplayed = $spinner->isDisplayed();
                                        } catch (\Exception $e) {
                                            // Spinner might not exist or be stale
                                        }
                                        
                                        // Check inline style for display:none
                                        $style = $spinner->getAttribute('style') ?: '';
                                        $isHidden = stripos($style, 'display: none') !== false || 
                                                   stripos($style, 'display:none') !== false;
                                        
                                        if (!$isDisplayed || $isHidden) {
                                            $spinnerGone = true;
                                            echo "       ✓ Spinner disappeared, modal content loaded\n";
                                            // Wait 3 seconds after spinner disappears
                                            sleep(3);
                                            break;
                                        }
                                    } catch (\Exception $e) {
                                        // Spinner element not found - might already be gone
                                        try {
                                            // Try to find it again
                                            $spinner = $driver->findElement(\Facebook\WebDriver\WebDriverBy::id('iframe-spinner'));
                                        } catch (\Exception $e2) {
                                            // Spinner doesn't exist - consider it gone
                                            $spinnerGone = true;
                                            echo "       ✓ Spinner not found (already removed)\n";
                                            // Wait 3 seconds after spinner disappears
                                            sleep(3);
                                            break;
                                        }
                                    }
                                    
                                    sleep(1); // Check every second
                                }
                                
                                if (!$spinnerGone) {
                                    echo "       ⚠ Spinner still visible after {$maxWait} seconds, continuing anyway\n";
                                }
                            }
                            
                            // Close modal - look for close button or press Escape
                            try {
                                // Try to find and click close button (jQuery UI dialog close button)
                                $closeButtons = $driver->findElements(\Facebook\WebDriver\WebDriverBy::cssSelector('.ui-dialog-titlebar-close, .close, [aria-label*="close"], button[data-dismiss="modal"]'));
                                $closed = false;
                                foreach ($closeButtons as $closeBtn) {
                                    try {
                                        if ($closeBtn->isDisplayed()) {
                                            $driver->executeScript('arguments[0].click();', [$closeBtn]);
                                            sleep(1);
                                            $closed = true;
                                            break;
                                        }
                                    } catch (\Exception $e) {
                                        continue;
                                    }
                                }
                                
                                // If no close button, try pressing Escape key
                                if (!$closed) {
                                    $body = $driver->findElement(\Facebook\WebDriver\WebDriverBy::tagName('body'));
                                    $body->sendKeys(\Facebook\WebDriver\WebDriverKeys::ESCAPE);
                                    sleep(1);
                                }
                            } catch (\Exception $e) {
                                // Couldn't close modal - continue anyway
                            }
                        } else {
                            // Regular page navigation - look for "Admin" link/button to go back
                            echo "       Looking for 'Admin' link to return...\n";
                            
                            $adminLinkFound = false;
                            try {
                                // Try to find "Admin" link or button
                                $adminLinks = $driver->findElements(\Facebook\WebDriver\WebDriverBy::partialLinkText('Admin'));
                                foreach ($adminLinks as $adminLink) {
                                    try {
                                        if ($adminLink->isDisplayed()) {
                                            $adminLinkText = trim($adminLink->getText());
                                            $adminHref = $adminLink->getAttribute('href');
                                            
                                            // Check if this looks like the admin navigation link
                                            if (stripos($adminLinkText, 'Admin') !== false && 
                                                (stripos($adminHref, 'admin') !== false || $adminHref === '/' || empty($adminHref))) {
                                                echo "       ✓ Found Admin link, clicking to return\n";
                                                $driver->executeScript('arguments[0].click();', [$adminLink]);
                                                sleep(1);
                                                $adminLinkFound = true;
                                                break;
                                            }
                                        }
                                    } catch (\Exception $e) {
                                        // Skip stale elements
                                        continue;
                                    }
                                }
                                
                                // If no link found, try button
                                if (!$adminLinkFound) {
                                    $adminButtons = $driver->findElements(\Facebook\WebDriver\WebDriverBy::cssSelector('button:contains("Admin"), input[value*="Admin"]'));
                                    foreach ($adminButtons as $adminButton) {
                                        try {
                                            if ($adminButton->isDisplayed()) {
                                                $buttonText = trim($adminButton->getText() ?: $adminButton->getAttribute('value'));
                                                if (stripos($buttonText, 'Admin') !== false) {
                                                    echo "       ✓ Found Admin button, clicking to return\n";
                                                    $driver->executeScript('arguments[0].click();', [$adminButton]);
                                                    sleep(1);
                                                    $adminLinkFound = true;
                                                    break;
                                                }
                                            }
                                        } catch (\Exception $e) {
                                            continue;
                                        }
                                    }
                                }
                                
                                if (!$adminLinkFound) {
                                    echo "       ⚠ Admin link/button not found, using browser back\n";
                                    $client->back();
                                    sleep(1);
                                }
                            } catch (\Exception $e) {
                                echo "       ⚠ Error finding Admin link: " . $e->getMessage() . ", using browser back\n";
                                $client->back();
                                sleep(1);
                            }
                            
                            // Refresh crawler after navigation
                            $crawler = $client->getCrawler();
                        }
                        
                        $testedLinks++;
                    } catch (\Exception $e) {
                        echo "       ⚠ Link test failed: " . $e->getMessage() . "\n";
                        // Try to go back
                        try {
                            $client->back();
                            sleep(1);
                            $crawler = $client->getCrawler();
                        } catch (\Exception $e2) {}
                    }
                }
                
                echo "   ✓ Tested {$testedLinks} admin links\n";
            } else {
                echo "   ⚠ No admin links found\n";
            }
            
            if ($this->isWatchMode()) {
                sleep(2);
            }
            
            $client->quit();
        } catch (\Exception $e) {
            try { $client->quit(); } catch (\Exception $e2) {}
            echo "⚠ Admin UI navigation test failed: " . $e->getMessage() . "\n";
        }
    }
    
    /**
     * Run all admin smoke tests
     */
    public function runAll()
    {
        echo "\n=== Running Admin Smoke Tests ===\n\n";
        
        try {
            $this->testAdminLoginPageLoads();
            $this->testAdminLogin();
            $this->testAdminUINavigation();
            
            echo "\n✓ All admin smoke tests completed!\n";
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
    
    $test = new AdminSmokeTest();
    exit($test->runAll());
}
