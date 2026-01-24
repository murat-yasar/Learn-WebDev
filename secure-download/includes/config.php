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
    // [
    //     'id' => 'doc1',
    //     'type' => 'pdf',
    //     'file_en' => 'doc1',  // File in assets/pdf/en/
    //     'file_de' => 'doc1',  // File in assets/pdf/de/
    //     'name_en' => 'doc1',
    //     'name_de' => 'doc1',
    //     'active' => true
    // ],
    [
        'id' => 'DLH-DIP-2025-Base-Prospectus',
        'type' => 'pdf',
        'file_en' => 'DLH-DIP-2025-Base-Prospectus.pdf',
        'file_de' => 'DLH-DIP-2025-Base-Prospectus.pdf',
        'name_en' => 'Debt Issuance Programme First Supplement 2025',
        'name_de' => 'Debt Issuance Programme First Supplement 2025',
        'active' => true
    ],
    [
        'id' => 'DLH-DIP-2025-First-Supplement',
        'type' => 'pdf',
        'file_en' => 'DLH-DIP-2025-First-Supplement.pdf',
        'file_de' => 'DLH-DIP-2025-First-Supplement.pdf',
        'name_en' => 'Debt Issuance Programme Prospectus 2025',
        'name_de' => 'Debt Issuance Programme Prospectus 2025',
        'active' => true
    ],
    [
        'id' => 'DLH-DIP-2024-Third-Supplement',
        'type' => 'pdf',
        'file_en' => 'DLH-DIP-2024-Third-Supplement.pdf',
        'file_de' => 'DLH-DIP-2024-Third-Supplement.pdf',
        'name_en' => 'Debt Issuance Programme Third Supplement 2024',
        'name_de' => 'Debt Issuance Programme Third Supplement 2024',
        'active' => true
    ],
    [
        'id' => 'DLH-DIP-2024-Second-Supplement',
        'type' => 'pdf',
        'file_en' => 'DLH-DIP-2024-Second-Supplement.pdf',
        'file_de' => 'DLH-DIP-2024-Second-Supplement.pdf',
        'name_en' => 'Debt Issuance Programme Second Supplement 2024',
        'name_de' => 'Debt Issuance Programme Second Supplement 2024',
        'active' => true
    ],
    [
        'id' => 'DLH-DIP-2024-First-Supplement',
        'type' => 'pdf',
        'file_en' => 'DLH-DIP-2024-First-Supplement.pdf',
        'file_de' => 'DLH-DIP-2024-First-Supplement.pdf',
        'name_en' => 'Debt Issuance Programme First Supplement 2024',
        'name_de' => 'Debt Issuance Programme First Supplement 2024',
        'active' => true
    ],
    [
        'id' => 'DLH-DIP-2024-Base-Prospectus',
        'type' => 'pdf',
        'file_en' => 'DLH-DIP-2024-Base-Prospectus.pdf',
        'file_de' => 'DLH-DIP-2024-Base-Prospectus.pdf',
        'name_en' => 'Debt Issuance Programme Prospectus 2024',
        'name_de' => 'Debt Issuance Programme Prospectus 2024',
        'active' => true
    ],
    [
        'id' => 'DLH-DIP-2023-Base-Prospectus',
        'type' => 'pdf',
        'file_en' => 'DLH-DIP-2023-Base-Prospectus.pdf',
        'file_de' => 'DLH-DIP-2023-Base-Prospectus.pdf',
        'name_en' => 'Debt Issuance Programme Prospectus 2023',
        'name_de' => 'Debt Issuance Programme Prospectus 2023',
        'active' => true
    ],
    [
        'id' => 'DLH-DIP-2022-Base-Prospectus',
        'type' => 'pdf',
        'file_en' => 'DLH-DIP-2022-Base-Prospectus.pdf',
        'file_de' => 'DLH-DIP-2022-Base-Prospectus.pdf',
        'name_en' => 'Debt Issuance Programme Prospectus 2022',
        'name_de' => 'Debt Issuance Programme Prospectus 2022',
        'active' => true
    ],

    [
        'id' => 'DLH-DIP-2021-Second-Base-Prospectus',
        'type' => 'pdf',
        'file_en' => 'DLH-DIP-2021-Second-Base-Prospectus.pdf',
        'file_de' => 'DLH-DIP-2021-Second-Base-Prospectus.pdf',
        'name_en' => 'Debt Issuance Programme Second Prospectus 2021',
        'name_de' => 'Debt Issuance Programme Second Prospectus 2021',
        'active' => true
    ],
    [
        'id' => 'DLH-DIP-2021-Base-Prospectus',
        'type' => 'pdf',
        'file_en' => 'DLH-DIP-2021-Base-Prospectus.pdf',
        'file_de' => 'DLH-DIP-2021-Base-Prospectus.pdf',
        'name_en' => 'Debt Issuance Programme Prospectus 2021',
        'name_de' => 'Debt Issuance Programme Prospectus 2021',
        'active' => true
    ],
    [
        'id' => 'DLH-DIP-2020-First-Supplement',
        'type' => 'pdf',
        'file_en' => 'DLH-DIP-2020-First-Supplement.pdf',
        'file_de' => 'DLH-DIP-2020-First-Supplement.pdf',
        'name_en' => 'Debt Issuance Programme First Supplement 2020',
        'name_de' => 'Debt Issuance Programme First Supplement 2020',
        'active' => true
    ],
    [
        'id' => 'DLH-DIP-2020-Base-Prospectus',
        'type' => 'pdf',
        'file_en' => 'DLH-DIP-2020-Base-Prospectus.pdf',
        'file_de' => 'DLH-DIP-2020-Base-Prospectus.pdf',
        'name_en' => 'Debt Issuance Programme Prospectus 2020',
        'name_de' => 'Debt Issuance Programme Prospectus 2020',
        'active' => true
    ],
    [
        'id' => 'DLH-DIP-2019-Second-Supplement',
        'type' => 'pdf',
        'file_en' => 'DLH-DIP-2019-Second-Supplement.pdf',
        'file_de' => 'DLH-DIP-2019-Second-Supplement.pdf',
        'name_en' => 'Debt Issuance Programme Second Supplement 2019',
        'name_de' => 'Debt Issuance Programme Second Supplement 2019',
        'active' => true
    ],
    [
        'id' => 'DLH-DIP-2019-First-Supplement',
        'type' => 'pdf',
        'file_en' => 'DLH-DIP-2019-First-Supplement.pdf',
        'file_de' => 'DLH-DIP-2019-First-Supplement.pdf',
        'name_en' => 'Debt Issuance Programme First Supplement 2019',
        'name_de' => 'Debt Issuance Programme First Supplement 2019',
        'active' => true
    ],
    [
        'id' => 'DLH-DIP-2019-Base-Prospectus',
        'type' => 'pdf',
        'file_en' => 'DLH-DIP-2019-Base-Prospectus.pdf',
        'file_de' => 'DLH-DIP-2019-Base-Prospectus.pdf',
        'name_en' => 'Debt Issuance Programme Prospectus 2019',
        'name_de' => 'Debt Issuance Programme Prospectus 2019',
        'active' => true
    ],
    [
        'id' => 'DLH-DIP-2018-First-Supplement',
        'type' => 'pdf',
        'file_en' => 'DLH-DIP-2018-First-Supplement.pdf',
        'file_de' => 'DLH-DIP-2018-First-Supplement.pdf',
        'name_en' => 'Debt Issuance Programme First Supplement 2018',
        'name_de' => 'Debt Issuance Programme First Supplement 2018',
        'active' => true
    ],
    [
        'id' => 'DLH-DIP-2018-Base-Prospectus',
        'type' => 'pdf',
        'file_en' => 'DLH-DIP-2018-Base-Prospectus.pdf',
        'file_de' => 'DLH-DIP-2018-Base-Prospectus.pdf',
        'name_en' => 'Debt Issuance Programme Prospectus 2018',
        'name_de' => 'Debt Issuance Programme Prospectus 2018',
        'active' => true
    ],
    [
        'id' => 'DLH-DIP-2017-Base-Prospectus',
        'type' => 'pdf',
        'file_en' => 'DLH-DIP-2017-Base-Prospectus.pdf',
        'file_de' => 'DLH-DIP-2017-Base-Prospectus.pdf',
        'name_en' => 'Debt Issuance Programme Prospectus 2017',
        'name_de' => 'Debt Issuance Programme Prospectus 2017',
        'active' => true
    ],
    [
        'id' => 'DLH-DIP-2016-First-Supplement',
        'type' => 'pdf',
        'file_en' => 'DLH-DIP-2016-First-Supplement.pdf',
        'file_de' => 'DLH-DIP-2016-First-Supplement.pdf',
        'name_en' => 'Debt Issuance Programme First Supplement 2016',
        'name_de' => 'Debt Issuance Programme First Supplement 2016',
        'active' => true
    ],
    [
        'id' => 'DLH-DIP-2016-Base-Prospectus',
        'type' => 'pdf',
        'file_en' => 'DLH-DIP-2016-Base-Prospectus.pdf',
        'file_de' => 'DLH-DIP-2016-Base-Prospectus.pdf',
        'name_en' => 'Debt Issuance Programme Prospectus 2016',
        'name_de' => 'Debt Issuance Programme Prospectus 2016',
        'active' => true
    ],
    // [
    //     'id' => 'external1',
    //     'type' => 'external',
    //     'url_en' => 'https://investor-relations.lufthansagroup.com/de/investor-relations.html',
    //     'url_de' => 'https://investor-relations.lufthansagroup.com/de/investor-relations.html',
    //     'name_en' => 'LHG',
    //     'name_de' => 'LHG',
    //     'active' => true
    // ]
]);

// Security settings
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // Set to 1 if using HTTPS
ini_set('session.cookie_samesite', 'Strict');