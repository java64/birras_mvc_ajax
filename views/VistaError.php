<?php

abstract class VistaError extends Vista {

    function __construct(){
    }

    //Pinta la vista que se mandará por Ajax con los datos de la API
    static function render($codigo) {
    	//Aquí mostramos el mensaje de error, pero se podría volver a incluir
    	//el index.html, ignorando url no válidas o lo que sea
        return "<h3 class='text-danger'>".$codigo."</h3>";

    }
}

?>