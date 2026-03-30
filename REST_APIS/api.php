<?php
$json_output = null;
$error = null;
$url = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $url = trim($_POST['url'] ?? '');

  // Basic URL validation
  if (empty($url)) {
    $error = 'Please enter a URL.';
  } elseif (!filter_var($url, FILTER_VALIDATE_URL)) {
    $error = 'That does not look like a valid URL.';
  } else {
    // Call the API
    $context = stream_context_create([
      'http' => [
        'method' => 'GET',
        'timeout' => 8,
        'header' => "Accept: application/json\r\n",
      ]
    ]);

    $response = @file_get_contents($url, false, $context);

    if ($response === false) {
      $error = 'Could not reach that address. Is it a valid, publicly accessible URL?';
    } else {
      $decoded = json_decode($response);

      if (json_last_error() !== JSON_ERROR_NONE) {
        $error = 'The URL responded, but did not return valid JSON. This may not be a REST API.';
      } else {
        $json_output = json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
      }
    }
  }
}
?>