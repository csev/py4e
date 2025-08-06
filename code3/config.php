<?php
/**
 * Configuration file for the Simple PHP Folder Lister
 */

// Page title
$PAGE_TITLE = 'File Browser';

// Home URL for the home icon in the header (leave empty to use current directory)
$HOME_URL = '';

// Whether the home icon should open in a new tab (true/false)
$HOME_OPEN_IN_NEW_TAB = false;

// Whether to hide the home icon completely (true/false)
$HOME_HIDE = false;

// Show GitHub repository link (true/false)
$SHOW_GITHUB_LINK = true;

// GitHub repository URL (leave empty to hide the link)
$GITHUB_REPO_URL = 'https://github.com/csev/htaccess-indexes';

// Enable breadcrumb navigation (true/false)
$SHOW_BREADCRUMBS = true;

 // Maximum file size to display (in bytes) - set to 0 for no limit
$MAX_FILE_SIZE = 0;

// Show file sizes (true/false)
$SHOW_FILE_SIZES = true;

// Show file modification dates (true/false)
$SHOW_FILE_DATES = true;

// Date format for file modification dates
$DATE_FORMAT = 'Y-m-d H:i:s';

// Hide all files that start with a dot (hidden files)
$HIDE_DOT_FILES = true;

// Password Protection Settings
// Enable password protection (true/false)
$PASSWORD_PROTECTION_ENABLED = false;

// The password users must enter to access the site
$SITE_PASSWORD = '42';

// Cookie name for storing authentication
$AUTH_COOKIE_NAME = 'htaccess_auth';

// Cookie expiration time in seconds (2 weeks = 14 * 24 * 60 * 60)
$AUTH_COOKIE_EXPIRY = 1209600;

// Folder names to hide (case-insensitive)
$HIDDEN_FOLDERS = array(
    '.git',
    '.svn',
    'node_modules',
    'vendor'
);

// File names to hide (case-insensitive)
$HIDDEN_FILES = array(
    'index.php',
    'config.php',
    'thumbs.db',
    '.htaccess',
    '*.swp',
    '*.swo',
    '*.tmp',
    '*.temp',
    '*.bak',
    '*.backup',
    '*.orig',
    '*.rej',
    '*.log',
    '*.cache',
    '.DS_Store',
    'Thumbs.db',
    'desktop.ini'
);

// File extensions to hide from the listing
$HIDDEN_EXTENSIONS = array(
    // PHP and web files
    '.php',
    '.php3',
    '.php4',
    '.php5',
    '.php7',
    '.php8',
    '.phtml',
    '.phar',
    '.inc',
    '.htaccess',
    '.gitignore',
    '.config.php',
    
    // Scripting languages
    '.js',
    '.pl',
    '.py',
    '.rb',
    '.sh',
    '.bash',
    
    // Executables and binaries
    '.exe',
    '.com',
    '.bat',
    '.cmd',
    '.vbs',
    '.ps1',
    '.jar',
    '.war',
    '.ear',
    '.class',
    '.so',
    '.dll',
    '.dylib',
    '.bin',
    '.msi',
    '.app',
    '.deb',
    '.rpm',
    '.pkg',
    '.apk',
    '.ipa',
    
    // Temporary and system files
    '.swp',
    '.swo',
    '.tmp',
    '.temp',
    '.bak',
    '.backup',
    '.orig',
    '.rej',
    '.log',
    '.cache',
    '.DS_Store'
);

// Include local configuration overrides if file exists
if (file_exists(__DIR__ . '/config.local.php')) {
    require_once __DIR__ . '/config.local.php';
}

