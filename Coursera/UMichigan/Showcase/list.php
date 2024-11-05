<?php
require_once 'pdo.php';

$sql = "SELECT * FROM autos";
$stmt = $pdo->prepare($sql);
$stmt->execute();

echo "<table border=1><thead><tr><th>ID</th><th>Make</th><th>Year</th><th>Year</th><th  colspan='2'>Actions</th></tr></thead><tbody>";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
   echo "<tr>
            <td>$row[auto_id]</td>
            <td><a href='details.php?id=$row[auto_id]'>$row[make]</td>
            <td>$row[year]</td>
            <td>$row[mileage]</td>
            <td><form method='post' action='actions.php'><input type='hidden' name='auto_id' value='$row[auto_id]'><input type='submit' name='delete' value='Delete'></form></td>
         </tr>";
}
echo "</tbody></table>";
?>