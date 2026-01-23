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
        <?php
        $documents = getActiveDocuments();
        if (empty($documents)):
        ?>
            <p>Derzeit sind keine Dokumente verfügbar.</p>
        <?php else: ?>
            <?php foreach ($documents as $doc): ?>
                <div class="file-item">
                    <span class="file-name"><?php echo htmlspecialchars($doc['name_de']); ?></span>
                    <?php if ($doc['type'] === 'pdf'): ?>
                        <a href="/download.php?id=<?php echo urlencode($doc['id']); ?>&lang=de"
                           class="btn btn-download">Herunterladen</a>
                    <?php elseif ($doc['type'] === 'external'): ?>
                        <a href="<?php echo htmlspecialchars($doc['url']); ?>"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="btn btn-download">Link öffnen</a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>


<?php include __DIR__ . '/../includes/footer_de.php'; ?>