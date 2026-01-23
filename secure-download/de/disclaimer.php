<?php
define('APP_STARTED', true);
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';

startSecureSession();
checkAccess();

// Only show disclaimer for countries that require it
if (!requiresDisclaimer($_SESSION['country'])) {
    header('Location: /de/files.php');
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify CSRF token
    if (!isset($_POST['csrf_token']) || !verifyCSRFToken($_POST['csrf_token'])) {
        logActivity('CSRF_FAILED', 'Disclaimer response');
        die('Invalid request');
    }

    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'agree') {
            $_SESSION['disclaimer_agreed'] = true;
            logActivity('DISCLAIMER_AGREED', $_SESSION['country']);
            header('Location: /de/files.php');
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

include __DIR__ . '/../includes/header_de.php';
?>


<div class="container">
    <h1>Wichtiger Haftungsausschluss</h1>

    <div class="disclaimer-text">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>

        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
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