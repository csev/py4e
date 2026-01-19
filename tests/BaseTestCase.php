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

// Load Composer autoloader
require_once __DIR__ . '/../tsugi/vendor/autoload.php';

use Symfony\Component\Panther\Client;

/**
 * Base test case for py4e tests
 * Provides common utilities and configuration
 */
abstract class BaseTestCase
{
    protected $baseUrl = 'http://localhost:8888/py4e';
    
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
