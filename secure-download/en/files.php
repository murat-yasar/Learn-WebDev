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
        <?php
        $documents = getActiveDocuments();
        if (empty($documents)):
        ?>
            <p>No documents available at this time.</p>
        <?php else: ?>
            <?php foreach ($documents as $doc): ?>
                <div class="file-item">
                    <span class="file-name"><?php echo htmlspecialchars($doc['name_en']); ?></span>
                    <?php if ($doc['type'] === 'pdf'): ?>
                        <a href="/download.php?id=<?php echo urlencode($doc['id']); ?>&lang=en"
                           class="btn btn-download">Download</a>
                    <?php elseif ($doc['type'] === 'external'): ?>
                        <a href="<?php echo htmlspecialchars($doc['url']); ?>"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="btn btn-download">Open Link</a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>


<?php include __DIR__ . '/../includes/footer_en.php'; ?>