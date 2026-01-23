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

// Document configuration
// Each document can be:
// - 'type' => 'pdf' for downloadable PDFs
//   - PDFs stored in assets/pdf/en/ and assets/pdf/de/
// - 'type' => 'external' for external links
// - 'active' => true/false to show/hide without deleting
define('DOCUMENTS', [
    [
        'id' => 'doc1',
        'type' => 'pdf',
        'file_en' => 'document1.pdf',  // File in assets/pdf/en/
        'file_de' => 'document1.pdf',  // File in assets/pdf/de/
        'name_en' => 'User Manual',
        'name_de' => 'Benutzerhandbuch',
        'active' => true
    ],
    [
        'id' => 'doc2',
        'type' => 'pdf',
        'file_en' => 'document2.pdf',
        'file_de' => 'document2.pdf',
        'name_en' => 'Safety Guidelines',
        'name_de' => 'Sicherheitsrichtlinien',
        'active' => true
    ],
    [
        'id' => 'doc3',
        'type' => 'pdf',
        'file_en' => 'document3.pdf',
        'file_de' => 'document3.pdf',
        'name_en' => 'Technical Specifications',
        'name_de' => 'Technische Spezifikationen',
        'active' => true
    ],
    [
        'id' => 'doc4',
        'type' => 'pdf',
        'file_en' => 'document4.pdf',
        'file_de' => 'document4.pdf',
        'name_en' => 'Installation Guide',
        'name_de' => 'Installationsanleitung',
        'active' => true
    ],
    [
        'id' => 'doc5',
        'type' => 'pdf',
        'file_en' => 'document5.pdf',
        'file_de' => 'document5.pdf',
        'name_en' => 'Warranty Information',
        'name_de' => 'Garantieinformationen',
        'active' => true
    ],
    [
        'id' => 'external1',
        'type' => 'external',
        'url_en' => 'https://example.com/en/support',
        'url_de' => 'https://example.com/de/support',
        'name_en' => 'Online Support Portal',
        'name_de' => 'Online-Support-Portal',
        'active' => true
    ],
    [
        'id' => 'external2',
        'type' => 'external',
        'url_en' => 'https://example.com/en/video-tutorials',
        'url_de' => 'https://example.com/de/video-tutorials',
        'name_en' => 'Video Tutorials',
        'name_de' => 'Video-Anleitungen',
        'active' => true
    ]
]);

// Security settings
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // Set to 1 if using HTTPS
ini_set('session.cookie_samesite', 'Strict');