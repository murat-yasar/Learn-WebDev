<?php
define('APP_STARTED', true);
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

startSecureSession();

// Get language from URL parameter or default to 'en'
$lang = isset($_GET['lang']) && validateLanguage($_GET['lang']) ? $_GET['lang'] : 'en';

// Check if user has selected a country
if (!hasSelectedCountry()) {
    header('Location: /index.php');
    exit();
}

// Check if this country should be on this page
if (!hasNoAccess($_SESSION['country'])) {
    // If they don't have no-access status, redirect appropriately
    if (requiresDisclaimer($_SESSION['country'])) {
        header("Location: /{$lang}/disclaimer.php");
    } else {
        header("Location: /{$lang}/files.php");
    }
    exit();
}

logActivity('NO_ACCESS_PAGE_VIEWED', $_SESSION['country'] . ' - ' . $lang);

// Language-specific content
$content = [
    'en' => [
        'title' => 'We are sorry.',
        'message' => 'Due to applicable legal restrictions, electronic versions of these materials are not accessible by persons located in the jurisdictions you have indicated.',
        'submessage' => 'Thank you for your understanding.',
        'button' => 'Click here to return to the homepage.',
        'lang_switch' => 'DE',
        'lang_switch_url' => '/no_access.php?lang=de'
    ],
    'de' => [
        'title' => 'Wir bitten um Entschuldigung.',
        'message' => 'Leider sind Sie aufgrund Ihres ständigen Wohnortes nicht autorisiert die angeforderten Daten zu lesen.',
        'submessage' => 'Vielen Dank für Ihr Verständnis.',
        'button' => 'Bitte klicken Sie hier, um auf die Homepage zurückzukehren.',
        'lang_switch' => 'EN',
        'lang_switch_url' => '/no_access.php?lang=en'
    ]
];

$text = $content[$lang];
?>


<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($text['title'] . ' - ' . APP_NAME); ?></title>
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="/index.php" class="nav-brand"><?php echo htmlspecialchars(APP_NAME); ?></a>
            <div class="nav-links">
                <a href="<?php echo htmlspecialchars($text['lang_switch_url']); ?>" class="lang-switch">
                    <?php echo htmlspecialchars($text['lang_switch']); ?>
                </a>
            </div>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            <div class="no-access-content">
                <h1><?php echo htmlspecialchars($text['title']); ?></h1>

                <div class="no-access-icon">
                    <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="50" cy="50" r="45" stroke="#e74c3c" stroke-width="4" fill="none"/>
                        <line x1="25" y1="25" x2="75" y2="75" stroke="#e74c3c" stroke-width="4" stroke-linecap="round"/>
                        <line x1="75" y1="25" x2="25" y2="75" stroke="#e74c3c" stroke-width="4" stroke-linecap="round"/>
                    </svg>
                </div>

                <p class="no-access-message">
                    <?php echo htmlspecialchars($text['message']); ?>
                </p>

                <p class="no-access-submessage">
                    <?php echo htmlspecialchars($text['submessage']); ?>
                </p>

                <div class="no-access-actions">
                    <a href="/index.php" class="btn btn-primary"><?php echo htmlspecialchars($text['button']); ?></a>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="footer-container">
            <p>&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars(APP_NAME); ?>.
            <?php echo $lang === 'de' ? 'Alle Rechte vorbehalten.' : 'All rights reserved.'; ?></p>
        </div>
    </footer>

    <script src="/assets/js/main.js"></script>
</body>
</html>