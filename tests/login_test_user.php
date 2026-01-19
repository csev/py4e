<?php
/**
 * Test User Login Page
 * 
 * This page allows creating and logging in test users for Panther tests.
 * The password must match the admin password from config.php.
 * 
 * SECURITY: Only accessible from localhost
 */

// Security check
$isLocalhost = false;
if (isset($_SERVER['REMOTE_ADDR'])) {
    $remoteAddr = $_SERVER['REMOTE_ADDR'];
    $isLocalhost = in_array($remoteAddr, ['127.0.0.1', '::1', 'localhost']) || 
                   strpos($remoteAddr, '192.168.') === 0 ||
                   strpos($remoteAddr, '10.') === 0;
}

$testEnvAllowed = isset($_SERVER['ALLOW_WEB_TESTS']) && $_SERVER['ALLOW_WEB_TESTS'] === '1';

if (!$isLocalhost && !$testEnvAllowed) {
    http_response_code(403);
    die("Error: Test user login can only be accessed from localhost for security reasons.\n");
}

// Load Tsugi
define('COOKIE_SESSION', true);
require_once __DIR__ . '/../tsugi/config.php';

use \Tsugi\Core\LTIX;
use \Tsugi\Util\U;

// Check if test users are allowed via CFG extension
$CFG = $GLOBALS['CFG'];
if (!$CFG->getExtension('qa_allow_test_users', false)) {
    http_response_code(403);
    die("Error: Test user login is disabled. Set \$CFG->setExtension('qa_allow_test_users', true) in config.php to enable.\n");
}

// Start session
$launch = LTIX::session_start();
$PDOX = LTIX::getConnection();

$error = '';
$success = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? 'test@gmail.com');
    $displayname = trim($_POST['displayname'] ?? 'Test User');
    $password = $_POST['password'] ?? '';
    $role = isset($_POST['role']) ? intval($_POST['role']) : 0; // 0 = student, 1000 = instructor
    
    // Validate inputs
    if (empty($email)) {
        $error = 'Email is required';
    } else if (empty($displayname)) {
        $error = 'Display name is required';
    } else if (empty($password)) {
        $error = 'Password is required';
    } else if ($password !== $CFG->adminpw) {
        $error = 'Invalid password. Password must match admin password from config.php';
    } else {
        // Password matches admin password - create/update user
        
        // Generate user key and SHA256
        $user_key = 'test_' . md5($email . time());
        $userSHA = hash('sha256', $user_key);
        
        // Get Google OAuth key from lti_key table (MUST be 'google.com' key)
        // This must exist - no fallbacks allowed
        $key_stmt = $PDOX->queryDie(
            "SELECT key_id, key_key, secret FROM {$CFG->dbprefix}lti_key 
             WHERE key_key = 'google.com' LIMIT 1"
        );
        $key_row = $key_stmt->fetch(\PDO::FETCH_ASSOC);
        
        if (!$key_row) {
            die('Error: No key found with key_key = "google.com". This key must exist in the lti_key table.');
        }
        
        $key_id = $key_row['key_id'] + 0;
        $google_key_key = $key_row['key_key'];
        $google_secret = $key_row['secret'];
        
        if (empty($google_secret)) {
            die('Error: Google key found but secret is empty. The google.com key must have a secret.');
        }
        
        // Check if test user already exists
        $stmt = $PDOX->queryDie(
            "SELECT user_id, user_key FROM {$CFG->dbprefix}lti_user WHERE email = :EMAIL LIMIT 1",
            array(':EMAIL' => $email)
        );
        $user_row = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        if ($user_row) {
            $user_id = $user_row['user_id'] + 0;
            $user_key = $user_row['user_key'];
            
            // Update user info and login time
            $PDOX->queryDie(
                "UPDATE {$CFG->dbprefix}lti_user 
                 SET displayname = :DN, login_at = NOW(), ipaddr = :IP 
                 WHERE user_id = :ID",
                array(
                    ':DN' => $displayname,
                    ':ID' => $user_id,
                    ':IP' => U::get($_SERVER, 'REMOTE_ADDR', '127.0.0.1')
                )
            );
        } else {
            // Create new test user
            $stmt = $PDOX->queryReturnError(
                "INSERT INTO {$CFG->dbprefix}lti_user
                (user_sha256, user_key, key_id, email, displayname, created_at, updated_at, login_at, ipaddr) ".
                "VALUES ( :SHA, :UKEY, :KEY, :EMAIL, :DN, NOW(), NOW(), NOW(), :IP )",
                array(
                    ':SHA' => $userSHA,
                    ':UKEY' => $user_key,
                    ':KEY' => $key_id,
                    ':EMAIL' => $email,
                    ':DN' => $displayname,
                    ':IP' => U::get($_SERVER, 'REMOTE_ADDR', '127.0.0.1')
                )
            );
            
            if (!$stmt->success) {
                $error = 'Error creating test user: ' . json_encode($stmt->errorInfo);
            } else {
                $user_id = $PDOX->lastInsertId();
            }
        }
        
        if (!$error && isset($user_id)) {
            // Get or create context (same as GoogleLoginHandler)
            $context_key = false;
            $context_id = false;
            if (isset($CFG->context_title)) {
                $context_key = 'course:' . md5($CFG->context_title);
                $row = $PDOX->rowDie(
                    "SELECT context_id FROM {$CFG->dbprefix}lti_context
                        WHERE context_sha256 = :SHA AND key_id = :KID LIMIT 1",
                    array(':SHA' => U::lti_sha256($context_key), ':KID' => $key_id)
                );
                if ($row != false) {
                    $context_id = $row['context_id'] + 0;
                } else {
                    // Create context if it doesn't exist
                    $sql = "INSERT INTO {$CFG->dbprefix}lti_context
                            (context_key, context_sha256, title, key_id, created_at, updated_at) VALUES
                            (:context_key, :context_sha256, :title, :key_id, NOW(), NOW())";
                    $PDOX->queryDie($sql, array(
                        ':context_key' => $context_key,
                        ':context_sha256' => U::lti_sha256($context_key),
                        ':title' => $CFG->context_title,
                        ':key_id' => $key_id
                    ));
                    $context_id = $PDOX->lastInsertId();
                }
            }
            
            // Create/update membership if context exists
            if ($context_id) {
                $PDOX->queryDie(
                    "INSERT INTO {$CFG->dbprefix}lti_membership
                    (context_id, user_id, role, created_at, updated_at)
                    VALUES (:context_id, :user_id, :role, NOW(), NOW())
                    ON DUPLICATE KEY UPDATE role = :role, updated_at = NOW()",
                    array(
                        ':context_id' => $context_id,
                        ':user_id' => $user_id,
                        ':role' => $role
                    )
                );
            }
            
            // Set up session (similar to GoogleLoginHandler)
            $_SESSION["id"] = $user_id;
            $_SESSION["user_id"] = $user_id;
            $_SESSION["user_key"] = $user_key;
            $_SESSION["email"] = $email;
            $_SESSION["displayname"] = $displayname;
            $_SESSION["profile_id"] = null;
            
            // Set up LTI session data
            $lti = array();
            $lti['user_id'] = $user_id;
            $lti['user_key'] = $user_key;
            $lti['email'] = $email;
            $lti['displayname'] = $displayname;
            $lti['key_id'] = $key_id;
            $lti['key_key'] = $google_key_key;
            $_SESSION['lti'] = $lti;
            
            // Set oauth consumer key (use Google key)
            $_SESSION["oauth_consumer_key"] = $google_key_key;
            
            // Set secret from lti_key table (required for Lessons to show LTI links instead of "Login Required")
            if ($google_secret && U::strlen($google_secret) > 1) {
                $_SESSION['secret'] = \Tsugi\Core\LTIX::encrypt_secret($google_secret);
                $lti['secret'] = $_SESSION['secret'];
            } else {
                // Fallback: use a dummy secret encrypted if no secret in database
                $dummySecret = 'test_secret_for_test_user';
                $_SESSION['secret'] = \Tsugi\Core\LTIX::encrypt_secret($dummySecret);
                $lti['secret'] = $_SESSION['secret'];
            }
            
            // Set context_key and context_id if available (for full LTI functionality)
            if ($context_id && $context_key) {
                $_SESSION['context_id'] = $context_id;
                $_SESSION['context_key'] = $context_key;
                $lti['context_id'] = $context_id;
                $lti['context_key'] = $context_key;
            }
            
            // Redirect to home page
            $redirect = $CFG->apphome . '/';
            header('Location: ' . $redirect);
            exit;
        }
    }
}

// Note: User info is read directly from $_SESSION in the template below
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test User Login - Py4E</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 {
            margin-top: 0;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #555;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        select:focus {
            outline: none;
            border-color: #4CAF50;
        }
        .error {
            background-color: #ffebee;
            color: #c62828;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .success {
            background-color: #e8f5e9;
            color: #2e7d32;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .info {
            background-color: #e3f2fd;
            color: #1565c0;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 13px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #45a049;
        }
        .current-user {
            background-color: #f0f0f0;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .current-user strong {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Test User Login</h1>
        
        <?php if (isset($_SESSION['user_id'])): ?>
            <div class="current-user">
                <strong>Currently logged in as:</strong><br>
                User ID: <?php echo htmlspecialchars($_SESSION['id'] ?? ''); ?><br>
                Email: <?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?><br>
                Display Name: <?php echo htmlspecialchars($_SESSION['displayname'] ?? ''); ?><br>
                Context ID: <?php echo htmlspecialchars($_SESSION['context_id'] ?? ''); ?><br>
                Context Key: <?php echo htmlspecialchars($_SESSION['context_key'] ?? ''); ?><br>
                OAuth Consumer Key: <?php echo htmlspecialchars($_SESSION['oauth_consumer_key'] ?? ''); ?><br>
                <a href="<?php echo htmlspecialchars($CFG->apphome . '/logout'); ?>">Logout</a>
            </div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>
        
        <div class="info">
            <strong>Note:</strong> This is for testing only. The password must match the admin password from <code>config.php</code>.
        </div>
        
        <form method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" 
                       value="<?php echo htmlspecialchars($_SESSION['email'] ?? 'test@gmail.com'); ?>" 
                       required>
            </div>
            
            <div class="form-group">
                <label for="displayname">Display Name:</label>
                <input type="text" id="displayname" name="displayname" 
                       value="<?php echo htmlspecialchars($_SESSION['displayname'] ?? ''); ?>" 
                       required>
            </div>
            
            <div class="form-group">
                <label for="role">Role:</label>
                <select id="role" name="role">
                    <option value="0" <?php echo (!isset($_POST['role']) || $_POST['role'] == 0) ? 'selected' : ''; ?>>Student (0)</option>
                    <option value="1000" <?php echo (isset($_POST['role']) && $_POST['role'] == 1000) ? 'selected' : ''; ?>>Instructor (1000)</option>
                    <option value="5000" <?php echo (isset($_POST['role']) && $_POST['role'] == 5000) ? 'selected' : ''; ?>>Administrator (5000)</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="password">Admin Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit">Login as Test User</button>
        </form>
    </div>
</body>
</html>
