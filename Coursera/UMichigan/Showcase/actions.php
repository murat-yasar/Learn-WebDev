<?php
session_start();
include_once 'pdo.php';

//* LOGIN
if (isset($_POST['login'])) {
   if (isset($_POST['user_email']) && isset($_POST['user_password'])) {
      $email = htmlentities($_POST['user_email']);
      $password = htmlentities($_POST['user_password']);

      try {
         $sql = "SELECT * FROM users WHERE user_email = :user_email AND user_password = :user_password";
         $stmt = $pdo->prepare($sql);
         $stmt->execute(array(':user_email' => $email, ':user_password' => $password));
         $user = $stmt->fetch(PDO::FETCH_ASSOC);

         $_SESSION['user_name'] = $user['user_name'];

         if (isset($user) && $email === $user['user_email'] && $password === $user['user_password']) {
            if ($user['user_name'] === "" || $user['user_name' === null]) {
               $_SESSION['message'] = "Name parameter missing!";
               $_SESSION['color'] = "red";
               header("Location: login.php");
               exit;
            } else {
               $_SESSION['message'] = "Succesfully logged in!";
               $_SESSION['color'] = "green";
               header("Location: autos.php?name=".urlencode($_SESSION['user_name']));
               exit;
            }
         } else {
            $_SESSION['message'] = "Incorrect username or password!";
            $_SESSION['color'] = "red";
            header("Location: login.php");
            exit;
         }

      } catch (PDOException $ex) {
         error_log("Database error: " . $ex->getMessage());
         exit;
      }
   }
}


//* ADD
if(isset($_POST['add'])){
   // Check if all fields are set
   if(isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])) {

      if (strlen($_POST['make']) < 1) {
         $_SESSION['message'] = "Make is required!";
         $_SESSION['color'] = "red";
      } else {
         $make = htmlentities($_POST['make']);
      }

      if (is_numeric($_POST['year'])) {
         $year =  htmlentities($_POST['year']);
      } else {
         $year = (int) htmlentities($_POST['year']);
      }

      if (is_numeric($_POST['year'])) {
         $mileage =  htmlentities($_POST['mileage']);
      } else {
         $mileage = (int) htmlentities($_POST['mileage']);
      }
      
      try {
         $sql = "INSERT INTO autos (make, year, mileage) VALUES (:make, :year, :mileage)";
         $stmt = $pdo->prepare($sql);
         $stmt->execute(
            array(
               ':make' => $make, 
               ':year' => $year, 
               ':mileage' => $mileage
            ));
         $_SESSION['message'] = "Record inserted";
         $_SESSION['color'] = "green";
      } catch (PDOException $ex) {
         error_log("Database error: " . $ex->getMessage());
         exit;
      }
      header("Location: autos.php?name=".urlencode($_SESSION['user_name']));
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

   header("Location: autos.php?name=".urlencode($_SESSION['user_name']));
   exit;
}

