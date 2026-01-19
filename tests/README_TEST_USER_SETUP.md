# Test User Setup

## Overview

Panther tests can simulate a logged-in user without OAuth by using the `setupTestUser()` method in `BaseTestCase`. This creates a test user in the database and sets up a session.

## Usage

### Basic Usage

```php
class MyTest extends BaseTestCase
{
    public function testSomething()
    {
        $client = $this->getPantherClient();
        
        // Set up a test user (student role by default)
        $this->setupTestUser($client);
        
        // Now you can navigate to pages that require login
        $crawler = $client->request('GET', $this->baseUrl . '/tsugi/lms/lessons');
        // User is now logged in!
    }
}
```

### With Custom User

```php
// Set up an instructor user
$this->setupTestUser(
    $client,
    'instructor@example.com',
    'Test Instructor',
    1000  // Role: 1000 = instructor, 0 = student
);
```

### Parameters

- `$client` (required): Panther client instance
- `$email` (optional): Test user email (default: 'test@example.com')
- `$displayname` (optional): Display name (default: 'Test User')
- `$role` (optional): User role (default: 0)
  - `0` = Student/Learner
  - `1000` = Instructor
  - `5000` = Administrator

## How It Works

1. `setupTestUser()` navigates to `/tests/setup-test-user.php`
2. The endpoint creates/updates a test user in the `lti_user` table
3. Sets up PHP session with user data (`$_SESSION['user_id']`, etc.)
4. Panther maintains the session via cookies for subsequent requests

## Security

- The setup endpoint (`setup-test-user.php`) is only accessible from:
  - `127.0.0.1` (localhost)
  - `::1` (IPv6 localhost)
  - `192.168.*.*` (local network)
  - `10.*.*.*` (local network)
- All other test files remain blocked from web access

## Database

Test users are created in the `lti_user` table with:
- `user_key`: Generated from email + timestamp
- `key_id`: Uses key '12345' (test key)
- `email`: As specified
- `displayname`: As specified

If a user with the same email already exists, it will be reused and updated.

## Example: Testing as Instructor

```php
public function testAdminFeature()
{
    $client = $this->getPantherClient();
    
    // Set up instructor user
    $this->setupTestUser($client, 'instructor@example.com', 'Test Instructor', 1000);
    
    // Navigate to admin page
    $crawler = $client->request('GET', $this->baseUrl . '/tsugi/admin');
    // Should have access as instructor
}
```

## Example: Testing as Student

```php
public function testStudentFeature()
{
    $client = $this->getPantherClient();
    
    // Set up student user (default)
    $this->setupTestUser($client, 'student@example.com', 'Test Student', 0);
    
    // Navigate to student page
    $crawler = $client->request('GET', $this->baseUrl . '/tsugi/lms/lessons');
    // Should see student view
}
```
