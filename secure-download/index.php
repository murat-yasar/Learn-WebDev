<?php
define('APP_STARTED', true);
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

startSecureSession();

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
            header('Location: /no_access.php');
            exit();
        }

        // Redirect based on country
        if (requiresDisclaimer($_POST['country'])) {
            header('Location: /en/disclaimer.php');
        } else {
            header('Location: /en/files.php');
        }
        exit();
    } else {
        $error = 'Invalid country selection';
        logActivity('INVALID_COUNTRY', $_POST['country'] ?? 'none');
    }
}

// Generate CSRF token
$csrfToken = generateCSRFToken();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars(APP_NAME); ?></title>
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>
    <main class="main-content">
        <div class="container">
            <h1>Select Your Country</h1>
            <p>Please choose your country to continue</p>

            <?php if (isset($error)): ?>
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form method="POST" action="/index.php" class="country-form">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">

                <div class="form-group">
                    <label for="country">Country:</label>
                    <select name="country" id="country" required>
                        <option value="">-- Select Country --</option>
                        <?php foreach (ALLOWED_COUNTRIES as $country): ?>
                            <option value="<?php echo htmlspecialchars($country); ?>">
                                <?php echo htmlspecialchars($country); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Continue</button>
            </form>
        </div>
    </main>
    <script src="/assets/js/main.js"></script>
</body>
</html>