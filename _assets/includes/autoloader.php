<?php
class Autoloader {

    /**
     * Enregistre l'autoloader
     */
    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Inclut le fichier de la classe correspondante
     */
    static function autoload($class){
        if(str_contains($class, 'Blog')){
            $filename = strtolower(str_replace('\\', '/', $class));
            $filename = str_replace('blog/', '', $filename);
            require 'modules/' . $filename . '.php';
        } else {
            if (strpos($class, 'Exception')) {
                require '_assets/includes/exceptions/' . $class . '.php';
            } else {
                require '_assets/includes/' . $class . '.php';
            }
        }
    }
}