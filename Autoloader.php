<?php
namespace JeanForteroche;

class Autoloader
{
    public static function register()
    {
      spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    public static function autoload($class){
       $class = str_replace('\\', '/', $class);
       $class = str_replace('JeanForteroche', '', $class);
       require_once __DIR__ . $class . '.php';
   }
}
