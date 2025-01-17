<?php

class PdoConnect extends Dbh {
   public function getData($sql){
      $stmt = $this->connect()->query($sql);
      $data = $stmt->fetchAll();
      return $data;
   }
   
   public function changeData($sql){
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute();
   }
}