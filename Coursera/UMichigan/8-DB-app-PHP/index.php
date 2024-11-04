<?php
echo "<pre>";
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc', 'root', 'root');
$stmt = $pdo->query("SELECT * FROM users");

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
   print_r($row);
}
echo "<pre>";

?>
