

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Learn PHP (OOP)</title>
</head>
<body>
   <h1>MY/Calc</h1>
   <form action="includes/calculator.inc.php" method="post">
      <input type="number" name="num1" placeholder="First number">
      <select name="operation" >
         <option value="add">Add</option>
         <option value="sub">Subtract</option>
         <option value="mult">Multiply</option>
         <option value="div">Divide</option>
      </select>
      <input type="number" name="num2" placeholder="Second number">
      <button type="submit" name="submit">Calculate</button>
   </form>
</body>
</html>