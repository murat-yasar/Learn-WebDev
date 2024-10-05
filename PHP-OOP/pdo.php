<h1>DB Connection (PDO)</h1>
<?php

$sql = "SELECT * FROM users";
$pdoObj = new PdoConnect();
$data = $pdoObj->getData($sql);

echo "<pre>";
print_r($data);
echo "</pre>";

echo "<hr>";

foreach($data as $i){
   echo $i['user_fname']." ".$i['user_lname']." (".$i['user_bdate'].")<br>";
}

$sql = "INSERT INTO users (user_fname, user_lname, user_bdate) VALUES ('John', 'Doe', '2000-01-01')";
$pdoObj = new PdoConnect();
$pdoObj->changeData($sql);