<?php
// Prevent direct access
if (!defined('APP_STARTED')) {
    http_response_code(403);
    exit('Direct access not permitted');
}

// Start secure session
if (!function_exists('startSecureSession')) {
    function startSecureSession() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();

            // Regenerate session ID periodically
            if (!isset($_SESSION['created'])) {
                $_SESSION['created'] = time();
            } elseif (time() - $_SESSION['created'] > 1800) {
                session_regenerate_id(true);
                $_SESSION['created'] = time();
            }
        }
    }
}

// Generate CSRF token
if (!function_exists('generateCSRFToken')) {
    function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
    }
}

// Verify CSRF token
if (!function_exists('verifyCSRFToken')) {
    function verifyCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
}

// Sanitize input
if (!function_exists('sanitizeInput')) {
    function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }
}

// Validate country
if (!function_exists('validateCountry')) {
    function validateCountry($country) {
    return in_array($country, ALLOWED_COUNTRIES, true);
    }
}

// Validate language
if (!function_exists('validateLanguage')) {
    function validateLanguage($lang) {
    return in_array($lang, ALLOWED_LANGUAGES, true);
    }
}

// Check if country requires disclaimer
if (!function_exists('requiresDisclaimer')) {
    function requiresDisclaimer($country) {
    return in_array($country, DISCLAIMER_COUNTRIES, true);
    }
}

// Check if country has no access
if (!function_exists('hasNoAccess')) {
    function hasNoAccess($country) {
        return in_array($country, NO_ACCESS_COUNTRIES, true);
    }
}

// Check if user has selected country
if (!function_exists('hasSelectedCountry')) {
    function hasSelectedCountry() {
    return isset($_SESSION['country']) && validateCountry($_SESSION['country']);
    }
}

// Check if user has agreed to disclaimer
if (!function_exists('hasAgreedToDisclaimer')) {
    function hasAgreedToDisclaimer() {
    return isset($_SESSION['disclaimer_agreed']) && $_SESSION['disclaimer_agreed'] === true;
    }
}

// Check access permissions
if (!function_exists('checkAccess')) {
    function checkAccess($requireDisclaimer = false) {
    if (!hasSelectedCountry()) {
        header('Location: /index.php');
        exit();
    }

    if ($requireDisclaimer && requiresDisclaimer($_SESSION['country']) && !hasAgreedToDisclaimer()) {
        $lang = validateLanguage($_GET['lang'] ?? 'en') ? $_GET['lang'] : 'en';
        header("Location: /{$lang}/disclaimer.php");
        exit();
    }
    }
}

// Log activity
if (!function_exists('logActivity')) {
    function logActivity($action, $details = '') {
    $timestamp = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
    $logMessage = "[{$timestamp}] IP: {$ip} | Action: {$action} | Details: {$details} | UA: {$userAgent}\n";

    @file_put_contents(LOG_FILE, $logMessage, FILE_APPEND | LOCK_EX);
    }
}

// Get language-specific text
if (!function_exists('getText')) {
    function getText($key, $lang) {
        $texts = [
        'en' => [
            'select_country' => 'Select Your Country',
            'choose_country' => 'Please choose your country to continue',
            'submit' => 'Continue',
            'disclaimer_title' => 'Important Disclaimer',
            'agree' => 'I Agree',
            'disagree' => 'I Disagree',
            'files_title' => 'Available Documents',
            'download' => 'Download',
            'home' => 'Home',
        ],
        'de' => [
            'select_country' => 'Wählen Sie Ihr Land',
            'choose_country' => 'Bitte wählen Sie Ihr Land aus, um fortzufahren',
            'submit' => 'Weiter',
            'disclaimer_title' => 'Wichtiger Haftungsausschluss',
            'agree' => 'Ich stimme zu',
            'disagree' => 'Ich lehne ab',
            'files_title' => 'Verfügbare Dokumente',
            'download' => 'Herunterladen',
            'home' => 'Startseite',
        ]
    ];

    return $texts[$lang][$key] ?? $key;
    }
}

// Get active documents
if (!function_exists('getActiveDocuments')) {
    function getActiveDocuments() {
        return array_filter(DOCUMENTS, function($doc) {
            return $doc['active'] === true;
        });
    }
}

// Get document by ID
if (!function_exists('getDocumentById')) {
    function getDocumentById($id) {
        foreach (DOCUMENTS as $doc) {
            if ($doc['id'] === $id && $doc['active'] === true) {
                return $doc;
            }
        }
        return null;
    }
}
