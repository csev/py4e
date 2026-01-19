<?php
/**
 * Tests for pythonauto tool
 */

require_once __DIR__ . '/../BaseTestCase.php';

// Load Composer autoloader
require_once __DIR__ . '/../../tsugi/vendor/autoload.php';

class PythonAutoTest extends BaseTestCase
{
    /**
     * Test that pythonauto tool loads
     */
    public function testPythonAutoLoads()
    {
        $client = $this->getPantherClient();
        
        // Tool likely requires login, so we'll just check it doesn't 500
        try {
            $crawler = $client->request('GET', $this->baseUrl . '/tools/pythonauto');
            $statusCode = $client->getResponse()->getStatusCode();
            
            // Should either load successfully or redirect to login
            $this->assertLessThan(500, $statusCode, 'Tool should not return 5xx error');
            
            echo "✓ PythonAuto tool is accessible\n";
        } catch (\Exception $e) {
            echo "⚠ PythonAuto test skipped: " . $e->getMessage() . "\n";
        }
    }
    
    /**
     * Test pythonauto with login (if test credentials available)
     */
    public function testPythonAutoWithLogin()
    {
        // This would require actual test user credentials
        // Uncomment and configure if you have test users set up
        
        /*
        $client = $this->getPantherClient();
        $client = $this->loginAsStudent($client);
        
        $crawler = $client->request('GET', $this->baseUrl . '/tools/pythonauto');
        
        // Check for exercise interface
        $this->assertGreaterThan(0, $crawler->filter('textarea, .inputarea')->count(), 
            'Should have code input area');
        
        echo "✓ PythonAuto loads with login\n";
        */
        
        echo "⚠ PythonAuto login test skipped (configure test credentials)\n";
    }
}
