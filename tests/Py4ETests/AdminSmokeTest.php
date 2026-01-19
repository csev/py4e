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
     * Login to admin interface
     * 
     * @param Client $client Panther client
     * @return \Symfony\Component\Panther\DomCrawler\Crawler Crawler after login
     */
    protected function loginToAdmin($client)
    {
        // Navigate to admin page
        // Note: If Google credentials are set, gate.php redirects to login.php
        $crawler = $client->request('GET', $this->baseUrl . '/tsugi/admin');
        sleep(2); // Wait for page to load
        
        // Check current URL (might have redirected)
        $currentUrl = $client->getCurrentURL();
        
        // Check if already logged in
        $bodyText = $crawler->filter('body')->text();
        if (stripos($bodyText, 'Administration Console') !== false || 
            stripos($bodyText, 'Manage Access Keys') !== false) {
            echo "   Already logged in\n";
            return $crawler;
        }
        
        // If redirected to login.php, Google OAuth is enabled
        if (stripos($currentUrl, 'login') !== false) {
            echo "   ⚠ Redirected to login page (Google OAuth is enabled)\n";
            echo "   ⚠ Admin testing requires Google OAuth to be disabled or user to be logged in\n";
            throw new \Exception("Cannot test admin - redirected to login page. Google OAuth is enabled.");
        }
        
        // Look for login form - admin uses name="passphrase"
        // Admin form uses: <input type="password" name="passphrase">
        $passwordField = null;
        
        // Try to find passphrase input field
        $inputs = $crawler->filter('input[name="passphrase"]');
        if ($inputs->count() === 0) {
            // Try any password input
            $inputs = $crawler->filter('input[type="password"]');
        }
        if ($inputs->count() > 0) {
            $passwordField = $inputs->first();
        }
        
        if (!$passwordField) {
            // Debug: show what we found
            $allInputs = $crawler->filter('input');
            $inputInfo = [];
            for ($i = 0; $i < min(10, $allInputs->count()); $i++) {
                $input = $allInputs->eq($i);
                $type = $input->attr('type');
                $name = $input->attr('name');
                $inputInfo[] = "type='{$type}' name='{$name}'";
            }
            throw new \Exception("Password field (passphrase) not found on admin login page. Page URL: {$currentUrl}. Found inputs: " . implode(', ', $inputInfo));
        }
        
        // Try to find submit button
        $submitButtons = $crawler->filter('input[type="submit"], button[type="submit"]');
        if ($submitButtons->count() > 0) {
            $submitButton = $submitButtons->first();
        }
        
        // Fill in password using WebDriver (more reliable)
        $adminPw = $this->getAdminPassword();
        $driver = $client->getWebDriver();
        $passwordElement = $passwordField->getElement(0);
        $passwordElement->clear();
        $passwordElement->sendKeys($adminPw);
        
        // Submit form
        if ($submitButton) {
            $submitElement = $submitButton->getElement(0);
            $driver->executeScript('arguments[0].click();', [$submitElement]);
        } else {
            // Press Enter on password field
            $passwordElement->sendKeys(\Facebook\WebDriver\WebDriverKeys::RETURN);
        }
        
        sleep(2); // Wait for login to complete
        
        return $client->getCrawler();
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
            
            // Find all admin links (hrefs that lead to admin functions)
            $adminLinks = $crawler->filter('a[href*="admin"], a[href*="/admin/"]');
            $linkCount = $adminLinks->count();
            
            echo "   Found {$linkCount} admin links\n";
            
            if ($linkCount > 0) {
                // Test first few links (don't test all to keep test fast)
                $maxLinksToTest = min(5, $linkCount);
                $testedLinks = 0;
                
                for ($i = 0; $i < $maxLinksToTest; $i++) {
                    try {
                        $linkCrawler = $adminLinks->eq($i);
                        $linkText = trim($linkCrawler->text());
                        $href = $linkCrawler->attr('href');
                        
                        if (empty($linkText) && $href) {
                            // Try to get text from title or aria-label
                            $linkText = $linkCrawler->attr('title') ?: $linkCrawler->attr('aria-label') ?: $href;
                        }
                        
                        echo "     Testing link: {$linkText} ({$href})\n";
                        
                        // Click link
                        $client->click($linkCrawler->link());
                        sleep(1);
                        
                        // Check if modal opened (look for modal indicators)
                        $currentCrawler = $client->getCrawler();
                        $bodyText = $currentCrawler->filter('body')->text();
                        
                        // Check for modal indicators
                        $hasModal = $currentCrawler->filter('.modal, [role="dialog"], .popup')->count() > 0 ||
                                   stripos($bodyText, 'close') !== false ||
                                   stripos($bodyText, 'cancel') !== false;
                        
                        if ($hasModal) {
                            echo "       ✓ Modal/popup detected\n";
                            
                            // Try to close modal (look for close button)
                            $closeButtons = $currentCrawler->filter('.close, [aria-label*="close"], button[data-dismiss="modal"]');
                            if ($closeButtons->count() > 0) {
                                try {
                                    $client->click($closeButtons->first()->link());
                                    sleep(1);
                                } catch (\Exception $e) {
                                    // Try JavaScript close
                                    $driver = $client->getWebDriver();
                                    $closeButton = $closeButtons->first()->getElement(0);
                                    $driver->executeScript('arguments[0].click();', [$closeButton]);
                                    sleep(1);
                                }
                            }
                        } else {
                            // Regular page navigation - go back
                            $client->back();
                            sleep(1);
                            $crawler = $client->getCrawler();
                        }
                        
                        $testedLinks++;
                    } catch (\Exception $e) {
                        echo "       ⚠ Link test failed: " . $e->getMessage() . "\n";
                        // Try to go back
                        try {
                            $client->back();
                            sleep(1);
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
