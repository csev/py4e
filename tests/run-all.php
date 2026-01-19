<?php
/**
 * Run all test suites
 * 
 * Usage: php tests/run-all.php
 * 
 * SECURITY: This script can only be run from the command line (CLI)
 */

// Ensure this script can only run from CLI
if (php_sapi_name() !== 'cli') {
    http_response_code(403);
    die("Error: This script can only be run from the command line.\n");
}

// Check for --watch flag
global $argv;
$watchMode = isset($argv) && in_array('--watch', $argv);
if ($watchMode) {
    echo "👀 Watch mode enabled - browser window will be visible\n";
    echo "   Press Ctrl+C to stop\n\n";
    // Set environment variable so BaseTestCase can detect it
    $_SERVER['PANTHER_WATCH'] = '1';
    $_ENV['PANTHER_WATCH'] = '1';
}

require_once __DIR__ . '/SmokeTest.php';
require_once __DIR__ . '/Py4ETests/LessonsTest.php';
require_once __DIR__ . '/Py4ETests/AdminSmokeTest.php';
require_once __DIR__ . '/ToolsTests/PythonAutoTest.php';
require_once __DIR__ . '/ToolsTests/ToolsTestHarnessTest.php';
require_once __DIR__ . '/ToolsTests/AipaperTest.php';
require_once __DIR__ . '/ToolsTests/AllToolsSmokeTest.php';

echo "\n";
echo "========================================\n";
echo "  Py4E Test Suite - Running All Tests\n";
echo "========================================\n\n";

$exitCode = 0;

// Run smoke tests
echo "--- Smoke Tests ---\n";
$smokeTest = new SmokeTest();
try {
    $smokeTest->runAll();
} catch (\Exception $e) {
    echo "✗ Smoke tests failed: " . $e->getMessage() . "\n";
    $exitCode = 1;
}

echo "\n--- Py4E Tests ---\n";
$lessonsTest = new LessonsTest();
try {
    $lessonsTest->testLessonsListRenders();
    $lessonsTest->testNavigateToModule();
    $lessonsTest->testPreviousNextNavigation();
    $lessonsTest->testItemsArrayRenders();
    $lessonsTest->testLessonsWithUser();
} catch (\Exception $e) {
    echo "✗ Lessons tests failed: " . $e->getMessage() . "\n";
    $exitCode = 1;
}

echo "\n--- Admin Tests ---\n";
$adminSmokeTest = new AdminSmokeTest();
try {
    $adminSmokeTest->runAll();
} catch (\Exception $e) {
    echo "✗ Admin tests failed: " . $e->getMessage() . "\n";
    $exitCode = 1;
}

echo "\n--- Tools Tests ---\n";
$pythonAutoTest = new PythonAutoTest();
try {
    $pythonAutoTest->testPythonAutoLoads();
    $pythonAutoTest->testPythonAutoWithLogin();
} catch (\Exception $e) {
    echo "✗ Tools tests failed: " . $e->getMessage() . "\n";
    $exitCode = 1;
}

echo "\n--- Tools Test Harness Tests ---\n";
$toolsHarnessTest = new ToolsTestHarnessTest();
try {
    $toolsHarnessTest->testToolsTestHarnessLoads();
    $toolsHarnessTest->testToolsTestHarnessShowsTools();
    $toolsHarnessTest->testIframeLaunches();
    $toolsHarnessTest->testTestAccountsAvailable();
} catch (\Exception $e) {
    echo "✗ Tools test harness tests failed: " . $e->getMessage() . "\n";
    $exitCode = 1;
}

echo "\n--- Aipaper Tool Tests ---\n";
$aipaperTest = new AipaperTest();
try {
    $aipaperTest->runAll();
} catch (\Exception $e) {
    echo "✗ Aipaper tests failed: " . $e->getMessage() . "\n";
    $exitCode = 1;
}

echo "\n--- All Tools Smoke Tests (Quick Mode) ---\n";
$allToolsSmokeTest = new AllToolsSmokeTest();
try {
    // Run in quick mode to keep it fast - only tests store listing, not full launches
    // Remove --quick flag if you want full tests (will be slower)
    $allToolsSmokeTest->testAllTools(0, true); // 0 = all tools, true = quick mode
} catch (\Exception $e) {
    echo "✗ All tools smoke tests failed: " . $e->getMessage() . "\n";
    $exitCode = 1;
}

echo "\n========================================\n";
if ($exitCode === 0) {
    echo "  All tests completed successfully!\n";
} else {
    echo "  Some tests failed. Check output above.\n";
}
echo "========================================\n\n";

exit($exitCode);
