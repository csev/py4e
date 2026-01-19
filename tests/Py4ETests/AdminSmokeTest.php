<?php
/**
 * Smoke test for Tsugi Admin tool
 * 
 * Tests the admin interface at /tsugi/admin:
 * 1. Navigate to /tsugi/admin
 * 2. Login with admin password
 * 3. Test admin UI navigation (hrefs and modal popups)
 */

// Load Composer autoloader BEFORE BaseTestCase (BaseTestCase uses Panther classes)
// Prefer tests/vendor, fallback to tsugi/vendor
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
} else {
    require_once __DIR__ . '/../../tsugi/vendor/autoload.php';
}

require_once __DIR__ . '/../BaseTestCase.php';

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
        
        // Refresh crawler to avoid stale references
        $crawler = $client->getCrawler();
        return $crawler;
    }
    
    /**
     * Test admin login
     */
    public function testAdminLogin()
    {
        $client = $this->getPantherClient();
        $driver = $client->getWebDriver();
        
        try {
            echo "   Logging in to admin...\n";
            $crawler = $this->loginToAdmin($client);
            
            // Check if login was successful using WebDriver (avoid stale crawler references)
            $bodyText = '';
            try {
                $body = $driver->findElement(\Facebook\WebDriver\WebDriverBy::tagName('body'));
                if ($body && $body->isDisplayed()) {
                    $bodyText = $body->getText();
                }
            } catch (\Exception $e) {
                // Fallback to crawler if WebDriver fails
                try {
                    $crawler = $client->getCrawler(); // Refresh crawler
                    $bodyText = $crawler->filter('body')->text();
                } catch (\Exception $e2) {
                    throw new \Exception("Could not get page content: " . $e->getMessage());
                }
            }
            
            // Look for admin UI indicators
            $hasAdminUI = stripos($bodyText, 'Administration Console') !== false || 
                         stripos($bodyText, 'Manage Access Keys') !== false ||
                         stripos($bodyText, 'admin') !== false || 
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
     * Check for PHP errors in page content
     * PHP errors can return HTTP 200 but show error messages in the page
     * Detects: Parse errors, Fatal errors, Warnings, Notices, Deprecated, etc.
     * 
     * @param Client $client Panther client
     * @param bool $checkIframe If true, also check iframe content (for modals)
     * @return array ['hasError' => bool, 'errorMessage' => string|null]
     */
    protected function checkForPhpErrors($client, $checkIframe = false)
    {
        try {
            $driver = $client->getWebDriver();
            
            // Check main page content
            $body = $driver->findElement(\Facebook\WebDriver\WebDriverBy::tagName('body'));
            $bodyText = $body->getText();
            $pageSource = $driver->getPageSource();
            
            // Check for PHP error messages - use specific PHP error format patterns
            // PHP errors typically follow formats like:
            // "PHP Warning: ... in /path/to/file.php on line X"
            // "Parse error: ... in /path/to/file.php on line X"
            // "Fatal error: ... in /path/to/file.php on line X"
            // Note: die() and exit() also return HTTP 200, so we check for those too
            
            $phpErrorPatterns = [
                // Parse errors - must have "Parse error:" or "syntax error" with "on line"
                '/Parse error:\s*[^<]*on line \d+/i',
                '/syntax error[^<]*on line \d+/i',
                '/unexpected[^<]*on line \d+/i',
                
                // Fatal errors - must have "Fatal error:" with file path or "on line"
                '/Fatal error:\s*[^<]*(?:in [^<]+\.php|on line \d+)/i',
                
                // Warnings - must have "PHP Warning:" or "Warning:" with file path or "on line"
                '/PHP Warning:\s*[^<]*(?:in [^<]+\.php|on line \d+)/i',
                '/Warning:\s*[^<]*(?:in [^<]+\.php|on line \d+)/i',
                
                // Notices - must have "PHP Notice:" or "Notice:" with file path or "on line"
                '/PHP Notice:\s*[^<]*(?:in [^<]+\.php|on line \d+)/i',
                '/Notice:\s*[^<]*(?:in [^<]+\.php|on line \d+)/i',
                
                // Deprecated - must have "PHP Deprecated:" or "Deprecated:" with file path or "on line"
                '/PHP Deprecated:\s*[^<]*(?:in [^<]+\.php|on line \d+)/i',
                '/Deprecated:\s*[^<]*(?:in [^<]+\.php|on line \d+)/i',
                
                // Other specific PHP errors - must have error type with file path or "on line"
                '/PHP Error:\s*[^<]*(?:in [^<]+\.php|on line \d+)/i',
                '/Call to undefined[^<]*(?:in [^<]+\.php|on line \d+)/i',
                '/Undefined variable[^<]*(?:in [^<]+\.php|on line \d+)/i',
                '/Undefined index[^<]*(?:in [^<]+\.php|on line \d+)/i',
                '/Undefined property[^<]*(?:in [^<]+\.php|on line \d+)/i',
                '/Trying to access[^<]*(?:in [^<]+\.php|on line \d+)/i',
                '/Cannot redeclare[^<]*(?:in [^<]+\.php|on line \d+)/i',
                '/Class [^<]+ not found[^<]*(?:in [^<]+\.php|on line \d+)/i',
                '/Call to a member function[^<]*(?:in [^<]+\.php|on line \d+)/i',
            ];
            
            foreach ($phpErrorPatterns as $pattern) {
                if (preg_match($pattern, $bodyText, $matches) || preg_match($pattern, $pageSource, $matches)) {
                    // Extract full error message
                    if (!empty($matches[0])) {
                        return ['hasError' => true, 'errorMessage' => trim($matches[0])];
                    }
                }
            }
            
            // Check for die()/exit() - pages that are suspiciously short or incomplete
            // Admin pages should have substantial content (navigation, forms, etc.)
            // If page is very short and doesn't look like a complete admin page, might be die()
            $bodyTextLength = strlen(trim($bodyText));
            $hasAdminContent = stripos($bodyText, 'admin') !== false || 
                             stripos($bodyText, 'Administration') !== false ||
                             stripos($bodyText, 'Manage') !== false ||
                             stripos($bodyText, 'form') !== false ||
                             stripos($bodyText, 'table') !== false ||
                             stripos($pageSource, '<html') !== false ||
                             stripos($pageSource, '<body') !== false;
            
            // If page is very short (< 100 chars) and doesn't have admin content, might be die()
            // But be careful - some admin pages might legitimately be short
            // Only flag if it's suspiciously short AND doesn't have expected admin structure
            if ($bodyTextLength < 100 && !$hasAdminContent && stripos($pageSource, '<html') === false) {
                // Check if it looks like a die() message (short, no HTML structure)
                if (preg_match('/^[^<]{0,200}$/s', $bodyText) && strlen($bodyText) < 100) {
                    return ['hasError' => true, 'errorMessage' => 'Possible die()/exit() - page content: ' . substr($bodyText, 0, 100)];
                }
            }
            
            // Check iframe content if requested (for modals)
            if ($checkIframe) {
                try {
                    $iframe = $driver->findElement(\Facebook\WebDriver\WebDriverBy::id('iframe-frame'));
                    if ($iframe && $iframe->isDisplayed()) {
                        // Switch to iframe context
                        $driver->switchTo()->frame($iframe);
                        
                        try {
                            $iframeBody = $driver->findElement(\Facebook\WebDriver\WebDriverBy::tagName('body'));
                            $iframeText = $iframeBody->getText();
                            $iframeSource = $driver->getPageSource();
                            
                            foreach ($phpErrorPatterns as $pattern) {
                                if (preg_match($pattern, $iframeText, $matches) || preg_match($pattern, $iframeSource, $matches)) {
                                    if (!empty($matches[0])) {
                                        $driver->switchTo()->defaultContent();
                                        return ['hasError' => true, 'errorMessage' => 'Iframe: ' . trim($matches[0])];
                                    }
                                }
                            }
                        } finally {
                            // Always switch back to main document
                            $driver->switchTo()->defaultContent();
                        }
                    }
                } catch (\Exception $e) {
                    // Iframe might not exist or not be accessible - that's okay
                }
            }
            
            return ['hasError' => false, 'errorMessage' => null];
        } catch (\Exception $e) {
            // If we can't check, assume no error (don't fail on check failure)
            return ['hasError' => false, 'errorMessage' => null];
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
            
            // Check for PHP errors on admin main page
            $errorCheck = $this->checkForPhpErrors($client);
            if ($errorCheck['hasError']) {
                throw new \Exception("PHP error detected on admin page: " . $errorCheck['errorMessage']);
            }
            
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
                        
                        // Check for PHP errors after navigation
                        if (!$isModal) {
                            $errorCheck = $this->checkForPhpErrors($client);
                            if ($errorCheck['hasError']) {
                                echo "       ✗ PHP error detected: " . $errorCheck['errorMessage'] . "\n";
                                throw new \Exception("PHP error on page {$linkText}: " . $errorCheck['errorMessage']);
                            }
                        }
                        
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
                                            
                                            // Check for PHP errors in iframe content
                                            $errorCheck = $this->checkForPhpErrors($client, true);
                                            if ($errorCheck['hasError']) {
                                                echo "       ✗ PHP error detected in modal: " . $errorCheck['errorMessage'] . "\n";
                                                throw new \Exception("PHP error in modal {$linkText}: " . $errorCheck['errorMessage']);
                                            }
                                            
                                            // Wait 3 seconds after spinner disappears
                                            sleep(3);
                                            break;
                                        }
                                    } catch (\Exception $e) {
                                        // Check if this is a PHP error exception - rethrow it
                                        if (stripos($e->getMessage(), 'PHP error') !== false) {
                                            throw $e;
                                        }
                                        
                                        // Spinner element not found - might already be gone
                                        try {
                                            // Try to find it again
                                            $spinner = $driver->findElement(\Facebook\WebDriver\WebDriverBy::id('iframe-spinner'));
                                        } catch (\Exception $e2) {
                                            // Spinner doesn't exist - consider it gone
                                            $spinnerGone = true;
                                            echo "       ✓ Spinner not found (already removed)\n";
                                            
                                            // Check for PHP errors in iframe content
                                            $errorCheck = $this->checkForPhpErrors($client, true);
                                            if ($errorCheck['hasError']) {
                                                echo "       ✗ PHP error detected in modal: " . $errorCheck['errorMessage'] . "\n";
                                                throw new \Exception("PHP error in modal {$linkText}: " . $errorCheck['errorMessage']);
                                            }
                                            
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
                                // Regular page navigation - check for pagination "Next" button first
                            echo "       Checking for pagination...\n";
                            
                            // Check for PHP errors before navigating
                            $errorCheck = $this->checkForPhpErrors($client);
                            if ($errorCheck['hasError']) {
                                echo "       ✗ PHP error detected: " . $errorCheck['errorMessage'] . "\n";
                                throw new \Exception("PHP error on page {$linkText}: " . $errorCheck['errorMessage']);
                            }
                            
                            // Look for "Next" button (pagination) - click it once if found
                            try {
                                $nextButtons = $driver->findElements(\Facebook\WebDriver\WebDriverBy::cssSelector('input[type="submit"][value="Next"].btn.btn-default'));
                                if (count($nextButtons) === 0) {
                                    // Also try without the exact class combination
                                    $nextButtons = $driver->findElements(\Facebook\WebDriver\WebDriverBy::cssSelector('input[type="submit"][value="Next"]'));
                                }
                                
                                $nextClicked = false;
                                foreach ($nextButtons as $nextButton) {
                                    try {
                                        if ($nextButton->isDisplayed() && $nextButton->isEnabled()) {
                                            echo "       ✓ Found 'Next' button, clicking once...\n";
                                            $driver->executeScript('arguments[0].click();', [$nextButton]);
                                            sleep(2); // Wait for next page to load
                                            
                                            // Check for PHP errors after clicking Next
                                            $errorCheck = $this->checkForPhpErrors($client);
                                            if ($errorCheck['hasError']) {
                                                echo "       ✗ PHP error detected after clicking Next: " . $errorCheck['errorMessage'] . "\n";
                                                throw new \Exception("PHP error on page {$linkText} after Next: " . $errorCheck['errorMessage']);
                                            }
                                            
                                            $nextClicked = true;
                                            break; // Only click first enabled Next button
                                        }
                                    } catch (\Exception $e) {
                                        // Skip stale/disabled buttons
                                        continue;
                                    }
                                }
                                
                                // If we clicked Next, look for Back button and click it
                                if ($nextClicked) {
                                    try {
                                        $backButtons = $driver->findElements(\Facebook\WebDriver\WebDriverBy::cssSelector('input[type="submit"][value="Back"].btn.btn-default'));
                                        if (count($backButtons) === 0) {
                                            // Also try without the exact class combination
                                            $backButtons = $driver->findElements(\Facebook\WebDriver\WebDriverBy::cssSelector('input[type="submit"][value="Back"]'));
                                        }
                                        
                                        foreach ($backButtons as $backButton) {
                                            try {
                                                if ($backButton->isDisplayed() && $backButton->isEnabled()) {
                                                    echo "       ✓ Found 'Back' button, clicking...\n";
                                                    $driver->executeScript('arguments[0].click();', [$backButton]);
                                                    sleep(2); // Wait for back page to load
                                                    
                                                    // Check for PHP errors after clicking Back
                                                    $errorCheck = $this->checkForPhpErrors($client);
                                                    if ($errorCheck['hasError']) {
                                                        echo "       ✗ PHP error detected after clicking Back: " . $errorCheck['errorMessage'] . "\n";
                                                        throw new \Exception("PHP error on page {$linkText} after Back: " . $errorCheck['errorMessage']);
                                                    }
                                                    
                                                    break; // Only click first enabled Back button
                                                }
                                            } catch (\Exception $e) {
                                                // Skip stale/disabled buttons
                                                continue;
                                            }
                                        }
                                    } catch (\Exception $e) {
                                        // No Back button found or error clicking - that's okay, continue
                                    }
                                }
                            } catch (\Exception $e) {
                                // No Next button found or error clicking - that's okay, continue
                            }
                            
                            // Now look for "Admin" link/button to go back
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
