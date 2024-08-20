<?php
declare(strict_types=1);

require_once "../Models/Employee.php";

   $employee_01 = new Employee();
   $employee_01->setFirstName('Murat');
   $employee_01->setLastName('Yaşar');
   $employee_01->setPosition('Developer');

   $employee_02 = new Employee();
   $employee_02->setFirstName('Ihsan');
   $employee_02->setLastName('Melih');
   $employee_02->setPosition('Designer');

   echo $employee_01->getFullName() .' ('. $employee_01->getPosition().')<br>';
   echo $employee_02->getFullName() .' ('. $employee_02->getPosition().')<br>';
   
?>