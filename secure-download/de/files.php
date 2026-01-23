<?php
define('APP_STARTED', true);
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';

startSecureSession();
checkAccess(true);

logActivity('FILES_PAGE_ACCESSED', $_SESSION['country']);

include __DIR__ . '/../includes/header_de.php';
?>

<div class="container">
    <h1>Verfügbare Dokumente</h1>

    <div class="files-list">
        <?php foreach (PDF_FILES as $index => $filename): ?>
            <div class="file-item">
                <span class="file-name">Datei-<?php echo $index + 1; ?></span>
                <a href="/download.php?file=<?php echo urlencode($filename); ?>&lang=de"
                   class="btn btn-download">Herunterladen</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer_de.php'; ?>