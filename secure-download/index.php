<?php
define('APP_STARTED', true);
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

startSecureSession();

// Get language from URL parameter or default to 'en'
$lang = isset($_GET['lang']) && validateLanguage($_GET['lang']) ? $_GET['lang'] : 'en';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify CSRF token
    if (!isset($_POST['csrf_token']) || !verifyCSRFToken($_POST['csrf_token'])) {
        logActivity('CSRF_FAILED', 'Country selection');
        die('Invalid request');
    }

    // Validate and store country selection
    if (isset($_POST['country']) && validateCountry($_POST['country'])) {
        $_SESSION['country'] = $_POST['country'];
        $_SESSION['disclaimer_agreed'] = false;

        logActivity('COUNTRY_SELECTED', $_POST['country']);

        // Check if country has no access
        if (hasNoAccess($_POST['country'])) {
            header("Location: /no_access.php?lang={$lang}");
            exit();
        }

        // Redirect based on country
        if (requiresDisclaimer($_POST['country'])) {
            header("Location: /{$lang}/disclaimer.php");
        } else {
            header("Location: /{$lang}/files.php");
        }
        exit();
    } else {
        $error = $lang === 'de' ? 'Ungültige Länderauswahl' : 'Invalid country selection';
        logActivity('INVALID_COUNTRY', $_POST['country'] ?? 'none');
    }
}

// Generate CSRF token
$csrfToken = generateCSRFToken();

// Language-specific content
$content = [
    'en' => [
        'title' => 'Select Your Country',
        'description' => 'Please choose your country to continue',
        'country_label' => 'Country:',
        'select_option' => '-- Select Country --',
        'button' => 'Continue',
        'lang_switch' => 'DE',
        'lang_switch_url' => '/index.php?lang=de'
    ],
    'de' => [
        'title' => 'Wählen Sie Ihr Land',
        'description' => 'Bitte wählen Sie Ihr Land aus, um fortzufahren',
        'country_label' => 'Land:',
        'select_option' => '-- Land wählen --',
        'button' => 'Weiter',
        'lang_switch' => 'EN',
        'lang_switch_url' => '/index.php?lang=en'
    ]
];

$text = $content[$lang];
?>


<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars(APP_NAME); ?></title>
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
            <h1><?php echo htmlspecialchars($text['title']); ?></h1>
            <p><?php echo htmlspecialchars($text['description']); ?></p>

            <?php if (isset($error)): ?>
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form method="POST" action="/index.php?lang=<?php echo $lang; ?>" class="country-form">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">

                <div class="form-group">
                    <label for="country"><?php echo htmlspecialchars($text['country_label']); ?></label>
                    <select name="country" id="country" required>
                        <option value=""><?php echo htmlspecialchars($text['select_option']); ?></option>
                        <?php foreach (ALLOWED_COUNTRIES as $country): ?>
                            <option value="<?php echo htmlspecialchars($country); ?>">
                                <?php echo htmlspecialchars($country); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary"><?php echo htmlspecialchars($text['button']); ?></button>
            </form>
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
