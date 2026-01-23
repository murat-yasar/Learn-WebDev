<?php
define('APP_STARTED', true);
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

startSecureSession();
checkAccess(true);

// Validate document ID and language parameters
if (!isset($_GET['id']) || !isset($_GET['lang'])) {
    logActivity('INVALID_DOWNLOAD_ATTEMPT', 'Missing parameters');
    http_response_code(404);
    die('Document not found');
}

$docId = $_GET['id'];
$lang = $_GET['lang'];

// Validate language
if (!validateLanguage($lang)) {
    logActivity('INVALID_LANGUAGE', $lang);
    http_response_code(404);
    die('Invalid language');
}

$document = getDocumentById($docId);

// Check if document exists and is a PDF type
if (!$document || $document['type'] !== 'pdf') {
    logActivity('INVALID_DOWNLOAD_ATTEMPT', $docId);
    http_response_code(404);
    die('Document not found');
}

// Get language-specific filename
$fileKey = 'file_' . $lang;
if (!isset($document[$fileKey])) {
    logActivity('MISSING_LANGUAGE_FILE', $docId . ' - ' . $lang);
    http_response_code(404);
    die('Document not available in this language');
}

$filename = $document[$fileKey];
$filepath = __DIR__ . '/assets/pdf/' . $lang . '/' . $filename;

// Check if file exists
if (!file_exists($filepath)) {
    logActivity('FILE_NOT_FOUND', $filepath);
    http_response_code(404);
    die('File not found');
}

// Log download
logActivity('FILE_DOWNLOADED', $filename . ' (' . $docId . ' - ' . $lang . ')');

// Set headers for download
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
header('Content-Length: ' . filesize($filepath));
header('Cache-Control: private, max-age=0, must-revalidate');
header('Pragma: public');

// Output file
readfile($filepath);
exit();