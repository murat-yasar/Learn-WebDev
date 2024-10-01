<?php
 class User {
   // Properties
   private $name;
   private $year;

   public static $drivingAge = 18;

   // Constructor
   public function __construct(string $name, int $year){
      $this->name = $name;
      $this->year = $year;
   }

   // Destructor
   public function __destruct(){
      // echo "<br><br>The class is destructed!<br>";
   }

   // Getters
   public function getName(): string{
      return $this->name;
   }
   public function getYear(): int{
      return $this->year;
   }
   public static function getDrivingAge(): int{
      return self::$drivingAge;
   }

   // Setters
   public function setName(string $newName){
      $this->name = $newName;
   }
   public function setYear(int $newYear){
      $this->year = $newYear;
   }
   public static function setDrivingAge(int $newDrivingAge){
      self::$drivingAge = $newDrivingAge;
   }
 }