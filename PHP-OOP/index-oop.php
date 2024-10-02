<?php 
   declare(strict_types=1);
   include 'includes/autoloader.inc.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Learn PHP (OOP)</title>
</head>
<body>
   <h1>I Learn Object-Oriented PHP</h1>
   <?php
      $user1 = new User("Murat Yaşar", 1982);
      echo $user1->getName();
      echo $user1->getYear();
      echo "<br><br>";

      $user2 = new User("Ihsan Melh", 20018);
      echo $user2->getName();
      echo $user2->getYear();
      echo " --> ";

      echo $user2->setName("Ihsan Melih");
      echo $user2->setYear(2008);
      echo $user2->getName();
      echo $user2->getYear();

      echo "<br><br>";

      echo User::$drivingAge;
      User::setDrivingAge(16);
      echo " --> ";
      echo User::$drivingAge;

      echo "<br><br>";

      $user3 = new User("Orhan Mete", 2016);
      // $user3->setName(2); //! TYPE_ERROR!!!
      echo $user3->getName();
   ?>
</body>
</html>