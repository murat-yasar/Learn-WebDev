<?php 
   session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Murat Yaşar - Login Page</title>
</head>
<body>
   <h1>Login</h1>
   <h1>Please Log In</h1>

   <?php include 'message.php'; ?>

   <form method="POST" action="actions.php">
      <table>
         <tbody>
            <tr>
               <td>E-mail: </td>
               <td><input type="email" name="user_email" required></td>
            </tr>
            <tr>
               <td>Password: </td>
               <td><input type="password" name="user_password" required></td>
            </tr>
            <tr>
               <td><input type="submit" name="login" value="Login"></td>
               <td><input type="button" name="cancel" value="Cancel" onclick="window.location.href='index.php'"></td>
            </tr>
         </tbody>
      </table>
   </form>

    <p>
        For a password hint, view source and find a password hint in the HTML comments.
        <!-- Hint: The password is the four character sound a cat makes (all lower case) followed by 123. -->
    </p>
</body>
</html>
