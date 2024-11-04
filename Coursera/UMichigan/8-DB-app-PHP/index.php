<?php
require_once 'pdo.php';

$stmt = $pdo->query("SELECT * FROM users");

echo "<table border=1><tr><td>ID</td><td>User Name</td><td>User Email</td></tr>";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
   echo "<tr><td>$row[user_id]</td><td>$row[user_name]</td><td>$row[user_email]</td></tr>";
}
echo "</table>";

?>
