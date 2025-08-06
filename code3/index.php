<?php
/**
 * Simple PHP Folder and File Lister
 * Replaces Apache's Options +Indexes functionality
 */

// Load configuration
require_once 'config.php';

// Password Protection Logic
if ($PASSWORD_PROTECTION_ENABLED) {
    // Check if user is already authenticated via cookie
    $is_authenticated = false;
    if (isset($_COOKIE[$AUTH_COOKIE_NAME])) {
        $cookie_value = $_COOKIE[$AUTH_COOKIE_NAME];
        // Simple hash verification - in production, use more secure methods
        if ($cookie_value === hash('sha256', $SITE_PASSWORD . 'salt')) {
            $is_authenticated = true;
        }
    }
    
    // Handle login form submission
    if (isset($_POST['password']) && !$is_authenticated) {
        $submitted_password = $_POST['password'];
        if ($submitted_password === $SITE_PASSWORD) {
            // Set authentication cookie
            $cookie_hash = hash('sha256', $SITE_PASSWORD . 'salt');
            setcookie($AUTH_COOKIE_NAME, $cookie_hash, time() + $AUTH_COOKIE_EXPIRY, '/', '', true, true);
            
            // Redirect to the same page to prevent form resubmission
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit;
        } else {
            $login_error = 'Invalid password. Please try again.';
        }
    }
    
    // If not authenticated, show login form
    if (!$is_authenticated) {
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - <?php echo htmlspecialchars($PAGE_TITLE); ?></title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding-top: 10vh;
        }
        .login-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 40px;
            max-width: 400px;
            width: 100%;
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-header h1 {
            margin: 0;
            color: #2c3e50;
            font-size: 24px;
            font-weight: 300;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #2c3e50;
            font-weight: 500;
        }
        .form-group input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        .form-group input[type="password"]:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        }
        .submit-btn {
            width: 100%;
            padding: 12px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .submit-btn:hover {
            background: #2980b9;
        }
        .error-message {
            color: #e74c3c;
            text-align: center;
            margin-bottom: 20px;
            padding: 10px;
            background: #fdf2f2;
            border-radius: 4px;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1><?php echo htmlspecialchars($PAGE_TITLE); ?></h1>
            <p>Please enter the password to access this directory.</p>
        </div>
        
        <?php if (isset($login_error)): ?>
        <div class="error-message">
            <?php echo htmlspecialchars($login_error); ?>
        </div>
        <?php endif; ?>
        
        <form method="post">
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required autofocus>
            </div>
            <button type="submit" class="submit-btn">Login</button>
        </form>
    </div>
</body>
</html>
        <?php
        exit;
    }
}

// Get current folder from URL parameter
$current_folder = isset($_GET['folder']) ? $_GET['folder'] : '';
$current_path = $current_folder;

// Security: Prevent directory traversal
$current_path = str_replace('..', '', $current_path);
$current_path = str_replace('//', '/', $current_path);
$current_path = trim($current_path, '/');

// Build full path
$base_path = __DIR__;
$full_path = $base_path;
if (!empty($current_path)) {
    $full_path .= '/' . $current_path;
}

// Validate path exists and is within base directory
if (!is_dir($full_path) || !is_readable($full_path)) {
    http_response_code(404);
    die('Directory not found or not accessible');
}

// Ensure we're not trying to access parent directories
$real_base = realpath($base_path);
$real_current = realpath($full_path);
if (strpos($real_current, $real_base) !== 0) {
    http_response_code(403);
    die('Access denied');
}

// Function to check if file/folder should be hidden
function shouldHide($name, $is_dir = false) {
    global $HIDDEN_EXTENSIONS, $HIDDEN_FILES, $HIDDEN_FOLDERS, $HIDE_DOT_FILES;
    
    $lower_name = strtolower($name);
    
    // Check if dot files should be hidden
    if ($HIDE_DOT_FILES && $name[0] === '.') {
        return true;
    }
    
    if ($is_dir) {
        return in_array($lower_name, array_map('strtolower', $HIDDEN_FOLDERS));
    } else {
        // Check hidden files
        if (in_array($lower_name, array_map('strtolower', $HIDDEN_FILES))) {
            return true;
        }
        
        // Check hidden extensions
        foreach ($HIDDEN_EXTENSIONS as $ext) {
            if (strcasecmp(substr($name, -strlen($ext)), $ext) === 0) {
                return true;
            }
        }
        
        return false;
    }
}

// Function to format file size
function formatFileSize($bytes) {
    if ($bytes == 0) return '0 B';
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    $i = floor(log($bytes, 1024));
    return round($bytes / pow(1024, $i), 2) . ' ' . $units[$i];
}

// Function to build breadcrumb navigation
function buildBreadcrumbs($path) {
    if (empty($path)) return array();
    
    $parts = explode('/', $path);
    $breadcrumbs = array();
    $current_path = '';
    
    foreach ($parts as $part) {
        $current_path .= ($current_path ? '/' : '') . $part;
        $breadcrumbs[] = array(
            'name' => $part,
            'path' => $current_path
        );
    }
    
    return $breadcrumbs;
}

// Get directory contents
$items = array();
$dir_handle = opendir($full_path);

while (($item = readdir($dir_handle)) !== false) {
    if ($item === '.' || $item === '..') continue;
    
    $item_path = $full_path . '/' . $item;
    $is_dir = is_dir($item_path);
    
    if (!shouldHide($item, $is_dir)) {
        $items[] = array(
            'name' => $item,
            'is_dir' => $is_dir,
            'size' => $is_dir ? null : filesize($item_path),
            'modified' => filemtime($item_path)
        );
    }
}

closedir($dir_handle);

// Sort items: directories first, then files, both alphabetically
usort($items, function($a, $b) {
    if ($a['is_dir'] && !$b['is_dir']) return -1;
    if (!$a['is_dir'] && $b['is_dir']) return 1;
    return strcasecmp($a['name'], $b['name']);
});

$breadcrumbs = buildBreadcrumbs($current_path);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($PAGE_TITLE); ?></title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 60px;
        }
        .header {
            background: #2c3e50;
            color: white;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 300;
        }
        .home-icon {
            color: white;
            text-decoration: none;
            font-size: 20px;
            transition: opacity 0.2s;
        }
        .home-icon:hover {
            opacity: 0.8;
        }
        .breadcrumbs {
            background: #ecf0f1;
            padding: 15px 20px;
            border-bottom: 1px solid #ddd;
        }
        .breadcrumb-item {
            display: inline-block;
        }
        .breadcrumb-item:not(:last-child)::after {
            content: ' / ';
            color: #7f8c8d;
        }
        .breadcrumb-item a {
            color: #3498db;
            text-decoration: none;
        }
        .breadcrumb-item a:hover {
            text-decoration: underline;
        }
        .content {
            padding: 20px;
        }
        .file-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .file-item {
            display: flex;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
            transition: background-color 0.2s;
        }
        .file-item:hover {
            background-color: #f8f9fa;
        }
        .file-item:last-child {
            border-bottom: none;
        }
        .file-icon {
            width: 20px;
            margin-right: 10px;
            text-align: center;
        }
        .file-name {
            flex: 1;
            font-weight: 500;
        }
        .file-name a {
            color: #2c3e50;
            text-decoration: none;
        }
        .file-name a:hover {
            color: #3498db;
        }
        .file-info {
            color: #7f8c8d;
            font-size: 14px;
            text-align: right;
        }
        .folder {
            color: #f39c12;
        }
        .file {
            color: #3498db;
        }
        .parent-links {
            margin-bottom: 20px;
            padding: 15px;
            background: #ecf0f1;
            border-radius: 5px;
        }
        .parent-links a {
            color: #3498db;
            text-decoration: none;
            margin-right: 15px;
        }
        .parent-links a:hover {
            text-decoration: underline;
        }
        .empty-message {
            text-align: center;
            color: #7f8c8d;
            padding: 40px 20px;
            font-style: italic;
        }
        .navigation-links {
            margin-bottom: 20px;
            padding: 15px;
            background: #ecf0f1;
            border-radius: 5px;
        }
        .nav-link {
            color: #3498db;
            text-decoration: none;
            margin-right: 15px;
            font-weight: 500;
        }
        .nav-link:hover {
            text-decoration: underline;
        }
        .github-link {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            padding: 15px;
            border-top: 1px solid #eee;
            background: #f8f9fa;
            z-index: 1000;
        }
        .github-link a {
            color: #6c757d;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.2s;
        }
        .github-link a:hover {
            color: #495057;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><?php echo htmlspecialchars($PAGE_TITLE); ?></h1>
            <?php if (!$HOME_HIDE): ?>
                <?php if (!empty($HOME_URL)): ?>
                    <a href="<?php echo htmlspecialchars($HOME_URL); ?>" class="home-icon" title="Go to Home"<?php echo $HOME_OPEN_IN_NEW_TAB ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>>🏠</a>
                <?php else: ?>
                    <a href="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" class="home-icon" title="Go to Root Directory"<?php echo $HOME_OPEN_IN_NEW_TAB ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>>🏠</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        
        <?php if ($SHOW_BREADCRUMBS && !empty($breadcrumbs)): ?>
        <div class="breadcrumbs">
            <div class="breadcrumb-item">
                <a href="?"><?php echo htmlspecialchars(basename($base_path)); ?></a>
            </div>
            <?php foreach ($breadcrumbs as $crumb): ?>
            <div class="breadcrumb-item">
                <a href="?folder=<?php echo urlencode($crumb['path']); ?>"><?php echo htmlspecialchars($crumb['name']); ?></a>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        
        <div class="content">
            <?php if (empty($items)): ?>
            <div class="empty-message">
                This directory is empty.
            </div>
            <?php else: ?>
            <ul class="file-list">
                <?php foreach ($items as $item): ?>
                <li class="file-item">
                    <div class="file-icon">
                        <?php if ($item['is_dir']): ?>
                            <span class="folder">📁</span>
                        <?php else: ?>
                            <span class="file">📄</span>
                        <?php endif; ?>
                    </div>
                    <div class="file-name">
                        <?php if ($item['is_dir']): ?>
                            <a href="?folder=<?php echo urlencode($current_path . ($current_path ? '/' : '') . $item['name']); ?>">
                                <?php echo htmlspecialchars($item['name']); ?>/
                            </a>
                        <?php else: ?>
                            <a href="<?php echo htmlspecialchars($current_path . ($current_path ? '/' : '') . $item['name']); ?>" target="_blank">
                                <?php echo htmlspecialchars($item['name']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <?php if ($SHOW_FILE_SIZES || $SHOW_FILE_DATES): ?>
                    <div class="file-info">
                        <?php if ($SHOW_FILE_SIZES && !$item['is_dir']): ?>
                            <span><?php echo formatFileSize($item['size']); ?></span>
                        <?php endif; ?>
                        <?php if ($SHOW_FILE_DATES): ?>
                            <?php if ($SHOW_FILE_SIZES && !$item['is_dir']): ?> | <?php endif; ?>
                            <span><?php echo date($DATE_FORMAT, $item['modified']); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
        
        <?php if ($SHOW_GITHUB_LINK && !empty($GITHUB_REPO_URL)): ?>
        <div class="github-link">
            <a href="<?php echo htmlspecialchars($GITHUB_REPO_URL); ?>" target="_blank" rel="noopener noreferrer">
                📦 This Application is available on GitHub
            </a>
        </div>
        <?php endif; ?>
    </div>
</body>
</html> 