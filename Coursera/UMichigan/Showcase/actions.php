
<?php
include_once 'pdo.php';

//* LOGIN
if (isset($_POST['login']) && isset($_POST['user_name']) && isset($_POST['user_password'])) {
   try {
      $name = htmlentities($_POST['user_name'], ENT_QUOTES, 'UTF-8');
      $email = htmlentities($_POST['user_email'], ENT_QUOTES, 'UTF-8');
      $password = htmlentities($_POST['user_password'], ENT_QUOTES, 'UTF-8');

      $sql = "SELECT * FROM users WHERE user_name = :user_name AND user_email = :user_email AND user_password = :user_password";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(':user_name' => $name, ':user_email' => $email, ':user_password' => $password));
      header("Location: autos.php");
      exit;
   } catch (PDOException $ex) {
      error_log("Database error: " . $ex->getMessage());
      exit;
   }
} else {
   header("Location: index.php");
   exit;
}

//* ADD
if(isset($_POST['add'])){
   // Check if all fields are set
   if(isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])) 
   {
      // Retrieve and sanitize user inputs
      $make = htmlentities($_POST['make'], ENT_QUOTES, 'UTF-8');
      $year = htmlentities($_POST['year'], ENT_QUOTES, 'UTF-8');
      $mileage = htmlentities($_POST['mileage'], ENT_QUOTES, 'UTF-8');

      try {
         $sql = "INSERT INTO autos (make, year, mileage) VALUES (:make, :year, :mileage)";
         $stmt = $pdo->prepare($sql);
         $stmt->execute(
            array(
               ':make' => $make, 
               ':year' => $year, 
               ':mileage' => $mileage
            ));
      } catch (Exception $ex) {
         error_log("Exception error: " . $ex->getMessage());
         exit;
      }
      
      header("Location: autos.php");
      exit;
   }
}

//* DELETE
if (isset($_POST['delete']) && isset($_POST['auto_id'])) {
   try {
      $sql = "DELETE FROM autos WHERE auto_id = :auto_id";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(':auto_id' => $_POST['auto_id']));
   } catch (PDOException $ex) {
      error_log("Database error: " . $ex->getMessage());
      exit;
   }

   header("Location: autos.php");
   exit;
}

