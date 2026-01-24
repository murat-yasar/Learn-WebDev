<?php
define('APP_STARTED', true);
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

startSecureSession();

// Set 404 header
http_response_code(404);

// Detect language from URL or parameter
$lang = 'en'; // default

// Check if language parameter is provided
if (isset($_GET['lang']) && validateLanguage($_GET['lang'])) {
    $lang = $_GET['lang'];
} else {
    // Try to detect language from the requested URI
    $requestUri = $_SERVER['REQUEST_URI'] ?? '';
    if (strpos($requestUri, '/de/') !== false) {
        $lang = 'de';
    }
}

// Log 404 error
$requestedUrl = $_SERVER['REQUEST_URI'] ?? 'unknown';
logActivity('404_ERROR', $requestedUrl . ' - Lang: ' . $lang);

// Language-specific content
$content = [
    'en' => [
        'title' => 'Page Not Found',
        'heading' => '404 - Page Not Found',
        'message' => "Oops! The page you're looking for doesn't exist.",
        'submessage' => "The page might have been moved, deleted, or the URL might be incorrect.",
        'button_home' => 'Go to Homepage',
        'button_back' => 'Go Back',
        'lang_switch' => 'DE',
        'lang_switch_url' => '/404.php?lang=de'
    ],
    'de' => [
        'title' => 'Seite nicht gefunden',
        'heading' => '404 - Seite nicht gefunden',
        'message' => 'Hoppla! Die Seite, die Sie suchen, existiert nicht.',
        'submessage' => 'Die Seite wurde möglicherweise verschoben, gelöscht oder die URL ist falsch.',
        'button_home' => 'Zur Startseite',
        'button_back' => 'Zurück',
        'lang_switch' => 'EN',
        'lang_switch_url' => '/404.php?lang=en'
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
            <a href="/index.php?lang=<?php echo $lang; ?>" class="nav-brand"><?php echo htmlspecialchars(APP_NAME); ?></a>
            <div class="nav-links">
                <a href="<?php echo htmlspecialchars($text['lang_switch_url']); ?>" class="lang-switch">
                    <?php echo htmlspecialchars($text['lang_switch']); ?>
                </a>
            </div>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            <div class="error-404-content">
                <h1 class="error-404-heading"><?php echo htmlspecialchars($text['heading']); ?></h1>

                <div class="error-404-icon">
                    <svg width="120" height="120" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="60" cy="60" r="55" stroke="#95a5a6" stroke-width="4" fill="none"/>
                        <text x="60" y="75" font-size="48" font-weight="bold" text-anchor="middle" fill="#95a5a6">404</text>
                    </svg>
                </div>

                <p class="error-404-message">
                    <?php echo htmlspecialchars($text['message']); ?>
                </p>

                <p class="error-404-submessage">
                    <?php echo htmlspecialchars($text['submessage']); ?>
                </p>

                <div class="error-404-actions">
                    <!-- <a href="/index.php?lang=<?php echo $lang; ?>" class="btn btn-primary">
                        <?php echo htmlspecialchars($text['button_home']); ?>
                    </a> -->
                    <button onclick="history.back()" class="btn btn-secondary">
                        <?php echo htmlspecialchars($text['button_back']); ?>
                    </button>
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
