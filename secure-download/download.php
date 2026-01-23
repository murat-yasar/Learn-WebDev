<?php
define('APP_STARTED', true);
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

startSecureSession();
checkAccess(true);

// Validate file parameter
if (!isset($_GET['file']) || !in_array($_GET['file'], PDF_FILES, true)) {
    logActivity('INVALID_DOWNLOAD_ATTEMPT', $_GET['file'] ?? 'none');
    http_response_code(404);
    die('File not found');
}

$filename = $_GET['file'];
$filepath = __DIR__ . '/assets/pdf/' . $filename;

// Check if file exists
if (!file_exists($filepath)) {
    logActivity('FILE_NOT_FOUND', $filename);
    http_response_code(404);
    die('File not found');
}

// Log download
logActivity('FILE_DOWNLOADED', $filename);

// Set headers for download
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
header('Content-Length: ' . filesize($filepath));
header('Cache-Control: private, max-age=0, must-revalidate');
header('Pragma: public');

// Output file
readfile($filepath);
exit();