<?php
require_once 'pdo.php';

$stmt = $pdo->query("SELECT * FROM users");

echo "<table border=1><tr><th>ID</th><th>User Name</th><th>User Email</th><th>Delete</th></tr>";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
   echo "<tr><td>$row[user_id]</td><td>$row[user_name]</td><td>$row[user_email]</td><td><a href='user.php?id=$row[user_id]'>See</a></td></tr>";
}
echo "</table>";
?>