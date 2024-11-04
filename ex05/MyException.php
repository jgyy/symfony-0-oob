<?php

class MyException extends Exception {
    public function __construct($message = "Invalid HTML tag or structure", $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

?>
