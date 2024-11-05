<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>PHP (MVC) & MySQL (PDO)</title>
</head>
<body>
   <?php include 'list.php'; ?>
   
   <h1>Add a New User</h1>
   <form method="post" action="add.php">
      <table>
         <tr>
            <td>Name: </td>
            <td><input type="text" name="user_name"></td>
         </tr>
         <tr>
            <td>E-mail: </td>
            <td><input type="email" name="user_email"></td>
         </tr>
         <tr>
            <td>Password: </td>
            <td><input type="password" name="user_password1"></td>
         </tr>
         <tr>
            <td>Repeat Password: </td>
            <td><input type="password" name="user_password2"></td>
         </tr>
         <tr>
            <td><input type="submit" value="Add"></td>
            <td></td>
         </tr>
      </table>
   </form>
</body>
</html>