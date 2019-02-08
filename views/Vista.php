<?php

abstract class Vista {

    function __construct(){
    }

    abstract static function render($codigo);
}

?>