<?php
define('APP_STARTED', true);
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';

// Security headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('X-XSS-Protection: 1; mode=block');

startSecureSession();
checkAccess(); // Require country selection

// Only show disclaimer for countries that require it
if (!requiresDisclaimer($_SESSION['country'])) {
    header('Location: /en/files.php');
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify CSRF token
    if (!isset($_POST['csrf_token']) || !verifyCSRFToken($_POST['csrf_token'])) {
        logActivity('CSRF_FAILED', 'Disclaimer response');
        http_response_code(403);
        die('Invalid request');
    }

    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'agree') {
            $_SESSION['disclaimer_agreed'] = true;
            logActivity('DISCLAIMER_AGREED', $_SESSION['country']);
            header('Location: /en/files.php');
            exit();
        } elseif ($_POST['action'] === 'disagree') {
            logActivity('DISCLAIMER_DISAGREED', $_SESSION['country']);
            session_destroy();
            header('Location: /index.php');
            exit();
        }
    }
}

$csrfToken = generateCSRFToken();

include __DIR__ . '/../includes/header_en.php';
?>


<div class="container">
    <h1>WICHTIGER HINWEIS</h1>

    <div class="disclaimer-text">
        <p>The information contained on the following websites and comprised in the documents available on the following websites (the "<strong>Base Prospectuses</strong>") does not constitute an offer of or an invitation to subscribe for or purchase any securities but is provided for information purposes only.</p>

        <p>Securities described on the following websites and in the Base Prospectuses (the "<strong>Securities</strong>") may not be eligible for sale in certain jurisdictions or to certain persons and may not be suitable for all types of investors, and the same may apply with regard to the distribution of any information made available on the following websites and in the Base Prospectuses. Users of the following websites and the Base Prospectuses are requested to inform themselves about and to observe any such restrictions. Nothing in the following websites and in the Base Prospectuses should be regarded as investment advice being provided or a solicitation or a recommendation that any particular investor should subscribe, purchase, sell, hold or otherwise deal in any Securities. Each user is exclusively responsible for conducting his or her own investigation and analysis of the information in the following websites and in the Base Prospectuses and for evaluating the merits and risks involved in investing in the Securities that are referred to therein.</p>

        <p>Furthermore, reference is made to the disclaimers (the "<strong>Disclaimers</strong>") and the selling restrictions (the "<strong>Selling Restrictions</strong>") comprised in the Base Prospectuses.</p>

        <p>By clicking on the "<strong>Accept</strong>" button below, you represent and agree that (i) you will read and accept the Disclaimers and Selling Restrictions comprised in the Base Prospectuses and (ii) you will comply with all applicable laws and regulations in force in any jurisdiction (1) in which Securities might be purchased, offered, sold or delivered and (2) regarding the possession or distribution of the Base Prospectuses. </p>
    </div>

    <form method="POST" action="/de/disclaimer.php" class="disclaimer-form">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">
        <div class="button-group">
            <button type="submit" name="action" value="disagree" class="btn btn-secondary">Ich lehne ab</button>
            <button type="submit" name="action" value="agree" class="btn btn-primary">Ich stimme zu</button>
        </div>
    </form>
</div>


<?php include __DIR__ . '/../includes/footer_de.php'; ?>