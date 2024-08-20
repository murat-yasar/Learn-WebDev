<?php
declare(strict_types=1);

class Employee 
{
   /* PROPERTIES */
   public string $firstName;
   public string $lastName;
   public string $position;

   /* METHODS */
   // Constructer
   public function __construct(string $position = 'employee')
   {
      echo "<br> Employee class constructed!<br>";
      $this->position = $position;
   }

   // Destructer
   public function __destruct()
   {
      echo "<br> Employee class destructed!<br>";
   }

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