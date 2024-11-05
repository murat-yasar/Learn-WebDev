<?php
require_once 'pdo.php';

if (isset($_GET['id'])) {
   $stmt = $pdo->prepare('DELETE FROM users WHERE user_id = :user_id');
   $stmt->execute(array(':user_id' => $_GET['id']));
}
header("Location: index.php");