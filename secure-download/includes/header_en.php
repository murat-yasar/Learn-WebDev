<?php
if (!defined('APP_STARTED')) {
    exit('Direct access not permitted');
}
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
    <nav class="navbar">
        <div class="nav-container">
            <a href="/index.php" class="nav-brand"><?php echo htmlspecialchars(APP_NAME); ?></a>
            <div class="nav-links">
                <a href="<?php echo str_replace('/en/', '/de/', $_SERVER['REQUEST_URI']); ?>" class="lang-switch">DE</a>
            </div>
        </div>
    </nav>
    <main class="main-content">