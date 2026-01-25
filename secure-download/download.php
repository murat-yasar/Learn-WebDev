<?php
define('APP_STARTED', true);
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

// Security headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('X-XSS-Protection: 1; mode=block');

startSecureSession();
checkAccess(true);  // CRITICAL: Check access before ANY processing

// Validate document ID and language parameters
if (!isset($_GET['id']) || !isset($_GET['lang'])) {
    logActivity('INVALID_DOWNLOAD_ATTEMPT', 'Missing parameters');
    http_response_code(404);
    die('Document not found');
}

$docId = $_GET['id'];
$lang = $_GET['lang'];

// Validate language
if (!validateLanguage($lang) || !in_array($lang, ALLOWED_LANGUAGES, true)) {
    logActivity('INVALID_LANGUAGE', $lang);
    http_response_code(404);
    die('Invalid language');
}

// SECURITY: Reject path traversal attempts in document ID immediately
if (strpos($docId, '..') !== false ||
    strpos($docId, '/') !== false ||
    strpos($docId, '\\') !== false ||
    strpos($docId, "\0") !== false) {
    logActivity('PATH_TRAVERSAL_ATTEMPT', 'ID: ' . $docId);
    http_response_code(403);
    die('Invalid document ID');
}

// Get document from config (whitelist validation)
$document = getDocumentById($docId);

// Check if document exists and is a PDF type
if (!$document || $document['type'] !== 'pdf' || !$document['active']) {
    logActivity('INVALID_DOWNLOAD_ATTEMPT', $docId);
    http_response_code(404);
    die('Document not found');
}

// Get language-specific filename
$fileKey = 'file_' . $lang;
if (!isset($document[$fileKey]) || empty($document[$fileKey])) {
    logActivity('MISSING_LANGUAGE_FILE', $docId . ' - ' . $lang);
    http_response_code(404);
    die('Document not available in this language');
}

// Get the filename from config (already validated)
$filename = basename($document[$fileKey]);

// Validate filename doesn't contain path traversal sequences
if (strpos($filename, '..') !== false ||
    strpos($filename, '/') !== false ||
    strpos($filename, '\\') !== false ||
    strpos($filename, "\0") !== false) {
    logActivity('PATH_TRAVERSAL_ATTEMPT', 'Filename: ' . $filename);
    http_response_code(403);
    die('Invalid filename');
}

// SECURITY: Filename must end with .pdf
if (substr($filename, -4) !== '.pdf') {
    logActivity('INVALID_FILE_TYPE', 'Filename: ' . $filename);
    http_response_code(403);
    die('Invalid file type');
}

// Construct safe file path
$basePath = realpath(__DIR__ . '/assets/pdf/' . $lang);

// SECURITY: Verify base path exists
if ($basePath === false) {
    logActivity('INVALID_BASE_PATH', $lang);
    http_response_code(500);
    die('Configuration error');
}

$filepath = $basePath . DIRECTORY_SEPARATOR . $filename;

// Ensure the resolved path is within the allowed directory
$realFilepath = realpath($filepath);

// Critical security check: file must exist AND be within base path
if ($realFilepath === false || strpos($realFilepath, $basePath) !== 0) {
    logActivity('PATH_TRAVERSAL_BLOCKED', 'Attempted: ' . $filepath);
    http_response_code(403);
    die('Access denied');
}

// Check if file exists and is a regular file
if (!file_exists($realFilepath) || !is_file($realFilepath)) {
    logActivity('FILE_NOT_FOUND', $filename);
    http_response_code(404);
    die('File not found');
}

// Additional MIME type validation
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mimeType = finfo_file($finfo, $realFilepath);
finfo_close($finfo);

if ($mimeType !== 'application/pdf') {
    logActivity('INVALID_FILE_TYPE', $filename . ' - MIME: ' . $mimeType);
    http_response_code(403);
    die('Invalid file type');
}

// Log successful download
logActivity('FILE_DOWNLOADED', $filename . ' (ID: ' . $docId . ', Lang: ' . $lang . ')');

// Set headers for secure download
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
header('Content-Length: ' . filesize($realFilepath));
header('Cache-Control: private, max-age=0, must-revalidate');
header('Pragma: public');

// Clear any output buffers
if (ob_get_level()) {
    ob_end_clean();
}

// Output file
readfile($realFilepath);
exit();