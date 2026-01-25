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
    <h1>DISCLAIMER –IMPORTANT</h1>

    <div class="disclaimer-text">
        <p>You have indicated that you are not located in Germany or the United States. These materials are not intended for, directed at or accessible by persons located outside Germany. However, persons located in jurisdictions other than the United States that make the below certifications can access these materials. Please read the certifications below carefully and provide the information requested in order to receive these materials. If you cannot make the below certifications, please exit this page.</p>

        <h2>Certifications</h2>
        <h3>For users located within the EEA</h3>

        <p><strong>“We are located or resident in a member state of the European Economic Area (“EEA”) in which the Prospectus Regulation is applicable (each, a “Relevant Member State”) and are ‘qualified investors’ within the meaning of Article 2(e) the Prospectus Regulation (“Qualified Investors”). For these purposes, the expression “Prospectus Regulation” means Regulation (EU) 2017/1129 of the European Parliament and of the Council of 14 June 2017 on the prospectus to be published when securities are offered to the public or admitted to trading on a regulated market, and repealing Directive 2003/71/EC. Further, if we are acting as a fiduciary or agent for one or more investor accounts, (a) each such account is a Qualified Investor, (b) we have investment discretion with respect to each account, and (c) we have full power and authority to make the representations, warranties, agreements and acknowledgements herein on behalf of each such account.”</strong></p>

        <p>By clicking “<strong>AGREE”</strong> below, you are certifying that the certifications and information provided are true and accurate, that you would like to access the materials. You agree that the materials you receive are for your own use and will not be released, published or distributed to any person (other than persons in your organization who are not located or resident in the United States, Australia, Canada, Japan or any other jurisdiction in which it would be unlawful to do so).</p>

        <h3>For users outside the US and EEA who are able, under locally applicable law, to access the materials</h3>

        <p><strong>“We confirm that we are an institutional investor and are not located or resident in the United States, Australia, Canada, Japan or any jurisdiction in which it would be unlawful for us to access the prospectus (the “Prospectus”) and other offer materials published by Deutsche Lufthansa Aktiengesellschaft in connection with its initial public offering of ordinary shares which are available on this website (the “Offer Materials”). We confirm that our accessing the Offer Materials, including the Prospectus, is lawful and in accordance with the laws of the jurisdiction in which we are located or resident and we confirm that we will not, nor are we authorized to, deliver, release, publish or distribute the Prospectus or the other Offer Materials, electronically or otherwise, in or into any jurisdiction or to any other person.”</strong></p>

        <p>By clicking “<strong>AGREE”</strong> below, you are certifying that the certifications and information provided are true and accurate, that you would like to access the materials. You agree that the materials you receive are for your own use and will not be released, published or distributed to any person (other than persons in your organization who are not located or resident in the United States, Australia, Canada, Japan or any other jurisdiction in which it would be unlawful to do so).</p>

        <p>Your data will be held by Deutsche Lufthansa Aktiengesellschaft and processed only to ensure our compliance with applicable regulations. </p>

    </div>

    <form method="POST" action="/en/disclaimer.php" class="disclaimer-form">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">
        <div class="button-group">
            <button type="submit" name="action" value="disagree" class="btn btn-secondary">I Disagree</button>
            <button type="submit" name="action" value="agree" class="btn btn-primary">I Agree</button>
        </div>
    </form>
</div>


<?php include __DIR__ . '/../includes/footer_en.php'; ?>