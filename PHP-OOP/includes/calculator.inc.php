<?php 

declare(strict_types=1);
include 'autoloader.inc.php';

$opr = $_POST["operation"];
$num1 = $_POST["num1"];
$num2 = $_POST["num2"];

$calc = new Calc((int)$num1, (int)$num2, $opr);

try {
   echo $calc->calculate();
} catch (TypeError $th) {
   echo "TYPE_ERROR! " . $th->getMessage();
}