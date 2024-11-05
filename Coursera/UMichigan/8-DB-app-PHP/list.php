<?php
require_once 'pdo.php';

$stmt = $pdo->query("SELECT * FROM users");

echo "<table border=1><thead><tr><th>ID</th><th>User Name</th><th>User Email</th><th  colspan='2'>Actions</th></tr></thead><tbody>";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
   echo "<tr>
            <td>$row[user_id]</td>
            <td><a href='details.php?id=$row[user_id]'>$row[user_name]</td>
            <td>$row[user_email]</td>
            <td><form method='post' action='actions.php'><input type='hidden' name='user_id' value='$row[user_id]'><input type='submit' name='edit' value='Edit'></form></td>
            <td><form method='post' action='actions.php'><input type='hidden' name='user_id' value='$row[user_id]'><input type='submit' name='delete' value='Delete'></form></td>
         </tr>";
}
echo "</tbody></table>";
?>