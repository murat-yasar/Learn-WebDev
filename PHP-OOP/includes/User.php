<?php
 class User {
   // Properties
   private $name;
   private $year;

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

   // Setters
   public function setName($newName){
      $this->name = $newName;
   }
   public function setYear($newYear){
      $this->year = $newYear;
   }
 }