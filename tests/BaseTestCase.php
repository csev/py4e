<?php

// SECURITY: Only allow tests to run from CLI or localhost
if (php_sapi_name() !== 'cli') {
    // Check if running from localhost
    $isLocalhost = false;
    if (isset($_SERVER['REMOTE_ADDR'])) {
        $remoteAddr = $_SERVER['REMOTE_ADDR'];
        $isLocalhost = in_array($remoteAddr, ['127.0.0.1', '::1', 'localhost']) || 
                       strpos($remoteAddr, '192.168.') === 0 ||
                       strpos($remoteAddr, '10.') === 0;
    }
    
    // Also check for explicit test environment variable
    $testEnvAllowed = isset($_SERVER['ALLOW_WEB_TESTS']) && $_SERVER['ALLOW_WEB_TESTS'] === '1';
    
    if (!$isLocalhost && !$testEnvAllowed) {
        http_response_code(403);
        die("Error: Tests can only be run from the command line or localhost for security reasons.\n");
    }
}

// Load Composer autoloader - prefer tests/vendor, fallback to tsugi/vendor
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
} else {
    require_once __DIR__ . '/../tsugi/vendor/autoload.php';
}

use Symfony\Component\Panther\Client;

/**
 * Base test case for py4e tests
 * Provides common utilities and configuration
 */
abstract class BaseTestCase
{
    protected $baseUrl = 'http://localhost:8888/py4e';
    
    /**
     * Constructor
     */
    public function __construct()
    {
    }
    
    /**
     * Set up a test user session before running tests
     * 
     * This method logs in a test user via the login form, creating the user
     * if needed. The password must match the admin password from config.php.
     * 
     * Panther automatically maintains cookies across requests, so once the
     * login form is submitted and the session cookie is set, it will be
     * included in all subsequent requests.
     * 
     * @param Client $client Panther client
     * @param string $email Test user email (default: 'test@example.com')
     * @param string $displayname Test user display name (default: 'Test User')
     * @param int $role User role: 0 = student, 1000 = instructor (default: 0)
     * @param string $adminPassword Admin password from config.php (required)
     * @return Client The Panther client with session set up
     */
    protected function setupTestUser(Client $client, $email = 'test@gmail.com', $displayname = 'Test User', $role = 0, $adminPassword = null)
    {
        // Get admin password from config if not provided
        if ($adminPassword === null) {
            // Try to read from config.php
            $configFile = __DIR__ . '/../tsugi/config.php';
            if (file_exists($configFile)) {
                $configContent = file_get_contents($configFile);
                // Try to extract adminpw value (basic extraction)
                if (preg_match('/\$CFG->adminpw\s*=\s*[\'"]([^\'"]+)[\'"]/', $configContent, $matches)) {
                    $adminPassword = $matches[1];
                }
            }
            
            if (empty($adminPassword)) {
                throw new \Exception("Admin password is required. Either pass it as parameter or set it in config.php");
            }
        }
        
        // Navigate to test user login page
        $loginUrl = $this->baseUrl . '/tests/login_test_user.php';
        $crawler = $client->request('GET', $loginUrl);
        
        // Wait for form to load
        sleep(1);
        
        // Fill and submit the form
        $form = $crawler->selectButton('Login as Test User')->form([
            'email' => $email,
            'displayname' => $displayname,
            'role' => $role,
            'password' => $adminPassword
        ]);
        
        $crawler = $client->submit($form);
        
        // Wait for redirect/login to complete and cookie to be set
        sleep(2);
        
        // Verify cookies are set (Panther maintains cookies automatically)
        $cookies = $client->getCookieJar()->all();
        $hasSessionCookie = false;
        foreach ($cookies as $cookie) {
            if (strpos($cookie->getName(), 'PHPSESSID') !== false || 
                strpos($cookie->getName(), session_name()) !== false) {
                $hasSessionCookie = true;
                break;
            }
        }
        
        // Verify we're logged in by checking if we're redirected away from login page
        $currentUrl = $client->getCurrentURL();
        if (strpos($currentUrl, 'login_test_user.php') !== false) {
            // Still on login page - check for error message
            try {
                $errorElement = $crawler->filter('.error');
                if ($errorElement->count() > 0) {
                    $errorText = $errorElement->text();
                    throw new \Exception("Failed to log in test user: " . $errorText);
                }
            } catch (\Exception $e) {
                // Error element might not exist
            }
            throw new \Exception("Failed to log in test user - still on login page. Session cookie set: " . ($hasSessionCookie ? 'yes' : 'no'));
        }
        
        // Verify session cookie is present
        if (!$hasSessionCookie) {
            echo "⚠ Warning: Session cookie not detected, but login appears successful\n";
        }
        
        return $client;
    }
    
    /**
     * Get Panther client with proper configuration
     */
    protected function getPantherClient(): Client
    {
        // Get ChromeDriver path
        $chromedriverPath = realpath(__DIR__ . '/../tsugi/drivers/chromedriver');
        if (!$chromedriverPath || !file_exists($chromedriverPath)) {
            throw new \RuntimeException("ChromeDriver not found at: " . __DIR__ . '/../tsugi/drivers/chromedriver');
        }
        
        // Check if we should run in watch mode (visible browser)
        $watchMode = $this->isWatchMode();
        
        // Browser arguments - disable headless if watching
        $browserArguments = [];
        if (!$watchMode) {
            $browserArguments = [
                '--headless',
                '--window-size=1200,1100',
                '--disable-gpu',
            ];
        } else {
            // In watch mode, make window visible and larger
            $browserArguments = [
                '--window-size=1400,1000',
                '--start-maximized',
            ];
        }
        
        // Create Chrome client directly, connecting to existing server
        return Client::createChromeClient(
            $chromedriverPath,  // ChromeDriver binary path
            $browserArguments,  // Browser arguments
            [],                 // Manager options
            'http://localhost:8888'  // Base URI
        );
    }
    
    /**
     * Check if watch mode is enabled (show browser window)
     */
    protected function isWatchMode(): bool
    {
        // Check environment variable (set by test runner when --watch flag is used)
        if (isset($_SERVER['PANTHER_WATCH']) || isset($_ENV['PANTHER_WATCH'])) {
            return filter_var($_SERVER['PANTHER_WATCH'] ?? $_ENV['PANTHER_WATCH'] ?? false, FILTER_VALIDATE_BOOLEAN);
        }
        
        return false;
    }
    
    /**
     * Login as instructor (if test user exists)
     * 
     * ⚠️ SECURITY: Uses placeholder credentials - NOT real credentials!
     * Override this method with actual test account credentials if needed.
     * Never commit real credentials to the repository.
     * 
     * @param Client $client Panther client
     * @param string $email Test email (default: placeholder)
     * @param string $password Test password (default: placeholder)
     */
    protected function loginAsInstructor(Client $client, $email = 'test@example.com', $password = 'testpass')
    {
        // Navigate to login page
        $crawler = $client->request('GET', $this->baseUrl . '/tsugi/lms/login');
        
        // Fill login form if it exists
        try {
            $form = $crawler->selectButton('Login')->form([
                'email' => $email,
                'password' => $password,
            ]);
            $client->submit($form);
            
            // Wait for redirect
            $client->waitFor('.top-nav', 5);
        } catch (\Exception $e) {
            // Login form might not exist or already logged in
            // Continue anyway
        }
        
        return $client;
    }
    
    /**
     * Login as student
     * 
     * ⚠️ SECURITY: Uses placeholder credentials - NOT real credentials!
     * Override this method with actual test account credentials if needed.
     * Never commit real credentials to the repository.
     * 
     * @param Client $client Panther client
     * @param string $email Test email (default: placeholder)
     * @param string $password Test password (default: placeholder)
     */
    protected function loginAsStudent(Client $client, $email = 'student@example.com', $password = 'testpass')
    {
        return $this->loginAsInstructor($client, $email, $password);
    }
    
    /**
     * Wait for an element to appear
     */
    protected function waitForElement(Client $client, string $selector, int $timeout = 10)
    {
        $client->waitFor($selector, $timeout);
    }
    
    /**
     * Check if page loaded successfully (no 500 errors)
     */
    protected function assertPageLoaded(Client $client, string $url)
    {
        $crawler = $client->request('GET', $url);
        
        // Wait a bit for page to load
        sleep(1);
        
        // Check for common error indicators
        $bodyText = $crawler->filter('body')->text();
        if (strpos($bodyText, 'Fatal error') !== false) {
            throw new \Exception("Page has fatal errors: $url");
        }
        if (strpos($bodyText, 'Parse error') !== false) {
            throw new \Exception("Page has parse errors: $url");
        }
        
        return $crawler;
    }
    
    /**
     * Simple assertion helper
     */
    protected function assertTrue($condition, $message = '')
    {
        if (!$condition) {
            throw new \Exception($message ?: 'Assertion failed');
        }
    }
    
    /**
     * Simple assertion helper
     */
    protected function assertGreaterThan($expected, $actual, $message = '')
    {
        if ($actual <= $expected) {
            throw new \Exception($message ?: "Expected value greater than $expected, got $actual");
        }
    }
    
    /**
     * Simple assertion helper
     */
    protected function assertStringContainsString($needle, $haystack, $message = '')
    {
        if (strpos($haystack, $needle) === false) {
            throw new \Exception($message ?: "String '$haystack' does not contain '$needle'");
        }
    }
    
    /**
     * Simple assertion helper
     */
    protected function assertNotEmpty($value, $message = '')
    {
        if (empty($value)) {
            throw new \Exception($message ?: 'Value should not be empty');
        }
    }
    
    /**
     * Take a screenshot (useful for debugging)
     */
    protected function takeScreenshot(Client $client, string $filename)
    {
        $screenshotDir = __DIR__ . '/screenshots';
        if (!is_dir($screenshotDir)) {
            mkdir($screenshotDir, 0755, true);
        }
        $client->takeScreenshot($screenshotDir . '/' . $filename);
    }
    
    /**
     * Switch to an iframe by index or name
     * Useful for testing tools launched in iframes (like in the test harness)
     */
    protected function switchToIframe(Client $client, $iframeIdentifier)
    {
        $webDriver = $client->getWebDriver();
        
        if (is_numeric($iframeIdentifier)) {
            // Switch by index
            $iframes = $webDriver->findElements(\Facebook\WebDriver\WebDriverBy::tagName('iframe'));
            if (isset($iframes[$iframeIdentifier])) {
                $webDriver->switchTo()->frame($iframes[$iframeIdentifier]);
            } else {
                throw new \Exception("Iframe at index $iframeIdentifier not found");
            }
        } else {
            // Switch by name or id
            $webDriver->switchTo()->frame($iframeIdentifier);
        }
    }
    
    /**
     * Switch back to main document from iframe
     */
    protected function switchToMainDocument(Client $client)
    {
        $webDriver = $client->getWebDriver();
        $webDriver->switchTo()->defaultContent();
    }
    
    /**
     * Wait for iframe to load
     */
    protected function waitForIframe(Client $client, $iframeSelector, int $timeout = 10)
    {
        $client->waitFor($iframeSelector, $timeout);
        // Additional wait for iframe content to load
        sleep(1);
    }
}
