<?php
include_once 'pdo.php';

if(isset($_GET['id'])) {
   $stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = :user_id");
   $stmt->execute(array(":user_id" => $_GET['id']));
   $row = $stmt->fetch(PDO::FETCH_ASSOC);
   echo "<table border=1><tr><th>ID</th><th>User Name</th><th>User Email</th><th colspan='2'>Actions</th></tr>";
   echo "<tr>
            <td>$row[user_id]</td>
            <td>$row[user_name]</td>
            <td>$row[user_email]</td>
            <td><a href='edit.php?id=$row[user_id]'>Edit</a></td>
            <td><a href='delete.php?id=$row[user_id]'>Delete</a></td>
         </tr>";
   echo "</table>";
} else {
   echo "User-ID not found!";
   echo "<a href='list.php'>Back</a>";
}
?>