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

// Countries with no access
define('NO_ACCESS_COUNTRIES', ['AU-NZ', 'Others']);

// Allowed languages
define('ALLOWED_LANGUAGES', ['en', 'de']);

// Document configuration
// Each document can be:
// - 'type' => 'pdf' for downloadable PDFs
//   - PDFs stored in assets/pdf/en/ and assets/pdf/de/
// - 'type' => 'external' for external links
// - 'active' => true/false to show/hide without deleting
define('DOCUMENTS', [
    [
        'id' => 'DLH-DIP-2025-First-Supplement.pdf',
        'type' => 'pdf',
        'file_en' => 'DLH-DIP-2025-First-Supplement.pdf',  // File in assets/pdf/en/
        'file_de' => 'DLH-DIP-2025-First-Supplement.pdf',  // File in assets/pdf/de/
        'name_en' => 'Debt Issuance Programme First Supplement 2025',
        'name_de' => 'Debt Issuance Programme First Supplement 2025',
        'active' => true
    ],
    [
        'id' => 'DLH-DIP-2025-Base-Prospectus',
        'type' => 'pdf',
        'file_en' => 'DLH-DIP-2025-Base-Prospectus.pdf',
        'file_de' => 'DLH-DIP-2025-Base-Prospectus.pdf',
        'name_en' => 'Debt Issuance Programme Prospectus 2025',
        'name_de' => 'Debt Issuance Programme Prospectus 2025',
        'active' => true
    ],
    [
        'id' => 'doc3',
        'type' => 'pdf',
        'file_en' => 'document3.pdf',
        'file_de' => 'document3.pdf',
        'name_en' => 'Technical',
        'name_de' => 'Technische',
        'active' => true
    ],
    [
        'id' => 'external1',
        'type' => 'external',
        'url_en' => 'https://investor-relations.lufthansagroup.com/de/investor-relations.html',
        'url_de' => 'https://investor-relations.lufthansagroup.com/de/investor-relations.html',
        'name_en' => 'LHG',
        'name_de' => 'LHG',
        'active' => true
    ]
]);

// Security settings
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // Set to 1 if using HTTPS
ini_set('session.cookie_samesite', 'Strict');