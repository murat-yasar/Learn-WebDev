<?php

class Dbh {
   private $host = "localhost";
   private $user = "root";
   private $pw = "";
   private $dbName = "oop-test";

   protected function connect(){
      $dsn = "mysql: host=$this->host; dbname=$this->dbName";
      $pdo = new PDO($dsn, $this->user, $this->pw);
   }
}