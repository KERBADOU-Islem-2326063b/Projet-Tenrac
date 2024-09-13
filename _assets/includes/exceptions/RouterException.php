<?php
/**
 * Exception si aucune route n'est trouvée par le router
 */
namespace Includes\Exceptions;

use Exception;

class RouterException extends Exception{
    public function __construct($message, $code = 0, Exception $previous = null){
        parent::__construct($message, $code, $previous);
    }

    public function __toString(){
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

}