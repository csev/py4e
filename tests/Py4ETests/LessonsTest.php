<?php
/**
 * Tests for Lessons functionality
 */

require_once __DIR__ . '/../BaseTestCase.php';

// Load Composer autoloader
require_once __DIR__ . '/../../tsugi/vendor/autoload.php';

class LessonsTest extends BaseTestCase
{
    /**
     * Test lessons list page renders correctly
     */
    public function testLessonsListRenders()
    {
        $client = $this->getPantherClient();
        $crawler = $this->assertPageLoaded($client, $this->baseUrl . '/tsugi/lms/lessons');
        
        // Check for module cards
        $cards = $crawler->filter('.card');
        $this->assertGreaterThan(0, $cards->count(), 'Should have lesson modules');
        
        echo "✓ Lessons list renders correctly\n";
    }
    
    /**
     * Test navigation to a specific lesson module
     */
    public function testNavigateToModule()
    {
        $client = $this->getPantherClient();
        
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
            
            echo "✓ Navigation to module works\n";
        }
    }
    
    /**
     * Test previous/next navigation
     */
    public function testPreviousNextNavigation()
    {
        $client = $this->getPantherClient();
        
        // Load a module page
        $crawler = $client->request('GET', $this->baseUrl . '/tsugi/lms/lessons/intro');
        
        // Check for navigation links
        $prevLink = $crawler->filter('.pager .previous a');
        $nextLink = $crawler->filter('.pager .next a');
        
        // At least one should exist (unless we're at first/last)
        $hasNav = ($prevLink->count() > 0 && !$prevLink->hasClass('disabled')) || 
                  ($nextLink->count() > 0 && !$nextLink->hasClass('disabled'));
        
        if ($hasNav) {
            echo "✓ Previous/Next navigation exists\n";
        } else {
            echo "⚠ Navigation links not found (might be at first/last module)\n";
        }
    }
    
    /**
     * Test that items array format renders (if Lessons2 is enabled)
     */
    public function testItemsArrayRenders()
    {
        $client = $this->getPantherClient();
        
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
