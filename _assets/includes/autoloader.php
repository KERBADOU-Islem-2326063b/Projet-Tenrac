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
        if(strpos($class, 'Exception')){
            require '_assets/includes/exceptions/'.$class.'.php';
        } else {
            require '_assets/includes/'.$class.'.php';
        }
    }
}