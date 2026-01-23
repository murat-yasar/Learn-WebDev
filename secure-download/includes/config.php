<?php
// Prevent direct access
if (!defined('APP_STARTED')) {
    http_response_code(403);
    exit('Direct access not permitted');
}

// Configuration
define('APP_NAME', 'Secure Document Portal');
define('SESSION_LIFETIME', 3600); // 1 hour
define('LOG_FILE', __DIR__ . '/../logs/access.log');

// Allowed countries
define('ALLOWED_COUNTRIES', ['EU', 'USA-CA', 'AU-NZ', 'Others']);

// Countries requiring disclaimer
define('DISCLAIMER_COUNTRIES', ['EU', 'USA-CA']);

// Allowed languages
define('ALLOWED_LANGUAGES', ['en', 'de']);

// PDF files
define('PDF_FILES', [
    'document1.pdf',
    'document2.pdf',
    'document3.pdf',
    'document4.pdf',
    'document5.pdf'
]);

// Security settings
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // Set to 1 if using HTTPS
ini_set('session.cookie_samesite', 'Strict');