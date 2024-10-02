<?php
spl_autoload_register('myAutoloader');

function myAutoloader(string $className){
   $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

   // if (strpos($url, 'includes') !== false) {$path = '../classes/'} else {$path = 'classes/'};
   $path = strpos($url, 'includes') !== false ? '../classes/' : 'classes/';

   $path = "classes/";
   $fileExt = ".class.php";
   $fullPath = $path . $className . $fileExt;

   if(!file_exists($fullPath)) return false;

   include_once $fullPath;
}