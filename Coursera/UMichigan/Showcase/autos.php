<?php 
session_start(); 
   if (!isset($_GET['name'])) {
      $_SESSION['message'] = "Name parameter missing!";
      $_SESSION['color'] = "red";
      header("Location: login.php");
      exit;
   } else {
      $_SESSION['user_name'] = $_GET['name'];
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Murat Yaşar</title>
</head>
<body>
   <h2>User Name: <?= htmlentities($_SESSION['user_name']); ?></h2>
   <?php include 'message.php'; ?>

   <button type='button' name='logout' onclick="window.location.href='index.php'">Log out</button>
   <br><br>

   <?php include 'list.php'; ?>

   <h1>Add a New Car</h1>
   <form method="POST" action="actions.php">
      <table>
         <tbody>
            <tr>
               <td>Make: </td>
               <td><input type="text" name="make" required></td>
            </tr>
            <tr>
               <td>Year: </td>
               <td><input type="number" name="year" required></td>
            </tr>
            <tr>
               <td>Mileage: </td>
               <td><input type="number" name="mileage" required></td>
            </tr>
            <tr>
               <td><input type="submit" name="add" value="Add"></td>
               <td></td>
            </tr>
         </tbody>
      </table>
   </form>
</body>
</html>