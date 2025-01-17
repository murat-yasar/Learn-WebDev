<?php

abstract class Visa {
   public function visaPayment(){
      echo "Perform a payment with visa...";
   }
   abstract public function getPayment();
}