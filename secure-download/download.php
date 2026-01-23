<?php
define('APP_STARTED', true);
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

startSecureSession();
checkAccess(true);

// Validate document ID parameter
if (!isset($_GET['id'])) {
    logActivity('INVALID_DOWNLOAD_ATTEMPT', 'No ID provided');
    http_response_code(404);
    die('Document not found');
}

$docId = $_GET['id'];
$document = getDocumentById($docId);

// Check if document exists and is a PDF type
if (!$document || $document['type'] !== 'pdf') {
    logActivity('INVALID_DOWNLOAD_ATTEMPT', $docId);
    http_response_code(404);
    die('Document not found');
}

$filename = $document['file'];
$filepath = __DIR__ . '/assets/pdf/' . $filename;

// Check if file exists
if (!file_exists($filepath)) {
    logActivity('FILE_NOT_FOUND', $filename);
    http_response_code(404);
    die('File not found');
}

// Log download
logActivity('FILE_DOWNLOADED', $filename . ' (' . $docId . ')');

// Set headers for download
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
header('Content-Length: ' . filesize($filepath));
header('Cache-Control: private, max-age=0, must-revalidate');
header('Pragma: public');

// Output file
readfile($filepath);
exit();
