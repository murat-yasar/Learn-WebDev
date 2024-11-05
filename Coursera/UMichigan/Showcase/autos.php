<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Murat Yaşar</title>
</head>
<body>
   <?php include 'list.php'; ?>
   
   <h1>Add a New Auto</h1>
   <form method="post" action="actions.php">
      <table>
         <tbody>
            <tr>
               <td>Make: </td>
               <td><input type="text" name="make"></td>
            </tr>
            <tr>
               <td>Year: </td>
               <td><input type="number" name="year"></td>
            </tr>
            <tr>
               <td>Mileage: </td>
               <td><input type="number" name="mileage"></td>
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