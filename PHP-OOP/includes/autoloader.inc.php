<?php
spl_autoload_register('myAutoloader');

function myAutoloader(string $className){
   $path = "classes/";
   $fileExt = ".class.php";
   $fullPath = $path . $className . $fileExt;

   if(!file_exists($fullPath)) return false;

   include_once $fullPath;
}