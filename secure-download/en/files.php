<?php
define('APP_STARTED', true);
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';

startSecureSession();
checkAccess(true);

logActivity('FILES_PAGE_ACCESSED', $_SESSION['country']);

include __DIR__ . '/../includes/header_en.php';
?>

<div class="container">
    <h1>Available Documents</h1>

    <div class="files-list">
        <?php foreach (PDF_FILES as $index => $filename): ?>
            <div class="file-item">
                <span class="file-name">File-<?php echo $index + 1; ?></span>
                <a href="/download.php?file=<?php echo urlencode($filename); ?>&lang=en"
                   class="btn btn-download">Download</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer_en.php'; ?>