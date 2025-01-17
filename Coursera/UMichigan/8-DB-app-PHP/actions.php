
<?php
include_once 'pdo.php';

//* ADD
if(isset($_POST['add'])){
   // Check Passwords
   if ($_POST['user_password1'] === $_POST['user_password2']) {
      $_POST['user_password'] = $_POST['user_password1'];
   } else {
      echo "<p style='color:red;'>Passwords do not match!</p>";
      echo "<a href='index.php'>Back</a>";
      exit;
   }
   
   // Check if all fields are set
   if(isset($_POST['user_name']) && isset($_POST['user_email']) && isset($_POST['user_password'])) 
   {
      try {
         $sql = "INSERT INTO users (user_name, user_email, user_password) VALUES (:user_name, :user_email, :user_password)";
         $stmt = $pdo->prepare($sql);
         $stmt->execute(
            array(
               ':user_name' => $_POST['user_name'], 
               ':user_email' => $_POST['user_email'], 
               ':user_password' => $_POST['user_password']
            ));
      } catch (PDOException $ex) {
         error_log("Database error: " . $ex->getMessage());
         exit;
      }
      
      header("Location: index.php");
      exit;
   }
}

//* DELETE
if (isset($_POST['delete']) && isset($_POST['user_id'])) {
   try {
      $sql = "DELETE FROM users WHERE user_id = :user_id";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(':user_id' => $_POST['user_id']));
   } catch (PDOException $ex) {
      error_log("Database error: " . $ex->getMessage());
      exit;
   }

   header("Location: index.php");
   exit;
}

