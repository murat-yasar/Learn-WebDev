<h1>Anonymus Classes</h1>
<?php

$myObj = new class () {
   public function myFunction($name){
      echo "Hi $name";
   }
};

$myObj->myFunction("Murat");