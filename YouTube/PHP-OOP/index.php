<?php

   class Employee 
   {
      /* PROPERTIES */
      public string $firstName;
      public string $lastName;
      public string $position;

      /* METHODS */
      // Getters
      public function getFirstName():string 
      {
         return $this->firstName;
      }
      public function getLastName():string 
      {
         return $this->lastName;
      }
      public function getPosition():string 
      {
         return $this->position;
      }
      public function getFullName():string 
      {
         return $this->firstName .' '. $this->lastName;
      }

      // Setters
      public function setFirstName(string $firstName): void 
      {
         $this->firstName = $firstName;
      }
      public function setLastName(string $lastName): void 
      {
         $this->lastName = $lastName;
      }
      public function setPosition(string $position): void 
      {
         $this->position = $position;
      }

   }

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