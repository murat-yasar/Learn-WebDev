<?php
define('APP_STARTED', true);
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';

// Security headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('X-XSS-Protection: 1; mode=block');

startSecureSession();
checkAccess(true);

logActivity('FILES_PAGE_ACCESSED', $_SESSION['country']);

include __DIR__ . '/../includes/header_en.php';
?>


<div class="container">
    <h1>Verfügbare Dokumente</h1>

    <div class="files-list">
        <?php
        $documents = getActiveDocuments();
        if (empty($documents)):
        ?>

        <p>Derzeit sind keine Dokumente verfügbar.</p>

        <?php else: ?>
            <?php foreach ($documents as $doc): ?>
                <div class="file-item">
                    <?php if ($doc['type'] === 'pdf'): ?>
                        <a href="/download.php?id=<?php echo urlencode($doc['id']); ?>&lang=de" class="file-link">
                            <?php echo htmlspecialchars($doc['name_de']); ?>
                        </a>
                    <?php elseif ($doc['type'] === 'external'): ?>
                        <a href="<?php echo htmlspecialchars($doc['url_de']); ?>"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="file-link file-link-external">
                            <?php echo htmlspecialchars($doc['name_de']); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer_de.php'; ?>