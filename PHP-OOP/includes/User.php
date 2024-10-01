<?php
 class User {
   // Properties
   private $name;
   private $year;

   public static $drivingAge = 18;

   // Constructor
   public function __construct($name, $year){
      $this->name = $name;
      $this->year = $year;
   }

   // Destructor
   public function __destruct(){
      // echo "<br><br>The class is destructed!<br>";
   }

   // Getters
   public function getName(){
      return $this->name;
   }
   public function getYear(){
      return $this->year;
   }
   public static function getDrivingAge(){
      return self::$drivingAge;
   }

   // Setters
   public function setName($newName){
      $this->name = $newName;
   }
   public function setYear($newYear){
      $this->year = $newYear;
   }
   public static function setDrivingAge($newDrivingAge){
      self::$drivingAge = $newDrivingAge;
   }
 }