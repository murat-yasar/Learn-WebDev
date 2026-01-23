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
// - 'type' => 'pdf' for downloadable PDFs in assets/pdf/
// - 'type' => 'external' for external links
// - 'active' => true/false to show/hide without deleting
define('DOCUMENTS', [
    [
        'id' => 'doc1',
        'type' => 'pdf',
        'file' => 'document1.pdf',
        'name_en' => 'User Manual',
        'name_de' => 'Benutzerhandbuch',
        'active' => true
    ],
    [
        'id' => 'doc2',
        'type' => 'pdf',
        'file' => 'document2.pdf',
        'name_en' => 'Safety Guidelines',
        'name_de' => 'Sicherheitsrichtlinien',
        'active' => true
    ],
    [
        'id' => 'doc3',
        'type' => 'pdf',
        'file' => 'document3.pdf',
        'name_en' => 'Technical Specifications',
        'name_de' => 'Technische Spezifikationen',
        'active' => true
    ],
    [
        'id' => 'doc4',
        'type' => 'pdf',
        'file' => 'document4.pdf',
        'name_en' => 'Installation Guide',
        'name_de' => 'Installationsanleitung',
        'active' => true
    ],
    [
        'id' => 'doc5',
        'type' => 'pdf',
        'file' => 'document5.pdf',
        'name_en' => 'Warranty Information',
        'name_de' => 'Garantieinformationen',
        'active' => true
    ],
    [
        'id' => 'external1',
        'type' => 'external',
        'url' => 'https://investor-relations.lufthansagroup.com/_assets/1cab50fcd71b9d0954aa17b75006183c/pm/202106/de/files.php',
        'name_en' => 'Capital Increase 2021',
        'name_de' => 'Kapitalerhöhung 2021',
        'active' => true
    ],
    [
        'id' => 'external2',
        'type' => 'external',
        'url' => 'https://example.com/video-tutorials',
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
