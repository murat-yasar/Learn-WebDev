<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Murat Yaşar</title>
</head>
<body>
   
   <h1>Login</h1>
   <form method="post" action="actions.php">
      <table>
         <tbody>
            <tr>
               <td>User Name: </td>
               <td><input type="text" name="user_name"></td>
            </tr>
            <tr>
               <td>User Email: </td>
               <td><input type="email" name="user_email"></td>
            </tr>
            <tr>
               <td>Password: </td>
               <td><input type="password" name="user_password"></td>
            </tr>
            <tr>
               <td><input type="submit" name="login" value="Login"></td>
               <td></td>
            </tr>
         </tbody>
      </table>
   </form>
</body>
</html>