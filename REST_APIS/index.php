
<?php include('api.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP API Caller</title>
  <link href="styles.css" rel="stylesheet">
</head>
<body>

  <h1>PHP API Caller</h1>
  <p class="subtitle">Enter any REST API URL — the JSON response will appear below.</p>

  <form method="POST" action="">
    <input
      type="text"
      name="url"
      placeholder="https://jsonplaceholder.typicode.com/todos/1"
      value="<?= htmlspecialchars($url) ?>"
      autofocus
    >
    <button type="submit">Submit</button>
  </form>

  <?php if ($error): ?>
    <div class="warning">⚠️ <?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <?php if ($json_output): ?>
    <pre><?= htmlspecialchars($json_output) ?></pre>
  <?php endif; ?>

</body>
</html>