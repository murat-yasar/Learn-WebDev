<h1>Interface</h1>
<?php
// Interfaces
interface PayInterface {
   public function payNow($amount);
}
interface LoginInterface {
   public function loginPaypal();
}

class Cash implements PayInterface{
   public function payNow($amount) { echo "<b>$amount</b> $: Paying with cash...<br>";}
   public function paymentHandler($amount){
      $this->payNow($amount);
   }
}
class Visa implements PayInterface{
   public function payNow($amount) { echo "<b>$amount</b> $: Paying with card...<br>";}
   public function paymentHandler($amount){
      $this->payNow($amount);
   }
}
class Paypal implements PayInterface, LoginInterface {
   public function loginPaypal(){echo "Logging in to PayPal...<br>";}

   public function payNow($amount) { echo "<b>$amount</b> $: Paying with paypal...<br>";}
   public function paymentHandler(int $amount){
      $this->loginPaypal();
      $this->payNow($amount);
   }
}


class BuyProduct {
   public function pay(PayInterface $paymentType, $amount){
      $paymentType->paymentHandler($amount);
   }
}



$paymentType = new Cash();
$buyProduct = new BuyProduct();
$buyProduct->pay($paymentType, 2000);

$paymentType = new Paypal();
$buyProduct = new BuyProduct();
$buyProduct->pay($paymentType, 3000);