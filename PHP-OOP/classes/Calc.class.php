<?php

class Calc {
   public $num1;
   public $num2;
   public $operator;

   public function __construct(int $num1, int $num2, string $opr){
      $this->num1 = $num1;
      $this->num2 = $num2;
      $this->operator = $opr;
   }

   public function calculate(){
      switch ($this->operator) {
         case 'add':
            return $this->num1 + $this->num2;
         case 'sub':
            return $this->num1 - $this->num2;
         case 'mult':
            return $this->num1 * $this->num2;
         case 'div':
            return $this->num1 / $this->num2;
         default:
            echo "ERROR! $this->operator is not a valid operator!";
            break;
      }
   }
}