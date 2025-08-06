<?php
// Local configuration overrides
$PASSWORD_PROTECTION_ENABLED = false;
$HOME_URL = '..';
$PAGE_TITLE = "Python for Everybody Code Samples";



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
    '.pl',
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


