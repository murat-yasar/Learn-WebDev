<h1>Abstract Classes</h1>
<?php
   include_once 'abstract/PaymentTypes.abstract.php';
   include_once 'classes/BuyProduct.class.php';

   $buyProduct = new BuyProduct();
   $buyProduct->getPayment();