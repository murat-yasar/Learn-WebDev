<?php
define('APP_STARTED', true);
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

startSecureSession();

// Check if user has selected a country
if (!hasSelectedCountry()) {
    header('Location: /index.php');
    exit();
}

// Check if this country should be on this page
if (!hasNoAccess($_SESSION['country'])) {
    // If they don't have no-access status, redirect appropriately
    if (requiresDisclaimer($_SESSION['country'])) {
        header('Location: /en/disclaimer.php');
    } else {
        header('Location: /en/files.php');
    }
    exit();
}

logActivity('NO_ACCESS_PAGE_VIEWED', $_SESSION['country']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Not Available - <?php echo htmlspecialchars(APP_NAME); ?></title>
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>
    <main class="main-content">
        <div class="container">
            <div class="no-access-content">
                <h1>Access Not Available</h1>

                <div class="no-access-icon">
                    <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="50" cy="50" r="45" stroke="#e74c3c" stroke-width="4" fill="none"/>
                        <line x1="25" y1="25" x2="75" y2="75" stroke="#e74c3c" stroke-width="4" stroke-linecap="round"/>
                        <line x1="75" y1="25" x2="25" y2="75" stroke="#e74c3c" stroke-width="4" stroke-linecap="round"/>
                    </svg>
                </div>

                <p class="no-access-message">
                    We're sorry, but our services are currently not available in your region
                    <strong>(<?php echo htmlspecialchars($_SESSION['country']); ?>)</strong>.
                </p>

                <p class="no-access-submessage">
                    We apologize for any inconvenience this may cause. If you believe you've reached
                    this page in error, please contact our support team.
                </p>

                <div class="no-access-actions">
                    <a href="/index.php" class="btn btn-primary">Return to Homepage</a>
                </div>
            </div>
        </div>
    </main>
    <script src="/assets/js/main.js"></script>
</body>
</html>