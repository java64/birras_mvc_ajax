<?php

abstract class VistaFav extends Vista {

    function __construct(){
    }

    //Pinta la vista que se mandará por Ajax con los datos de la API
    static function render($codigo) {

        $favs = json_decode($codigo);
        $cadena = "";
        $cadena .= "<h3>Mis cervezas favoritas</h3>";
        $cadena .= "<ul>";
        foreach($favs as $birra) {
            $id = $birra->_id->{'$oid'};
            $cadena .= "<li>".$birra->nombre." con ".$birra->grados." grados&nbsp;<span onclick=del('".$id."')>-</span></li>";
        }
        
        $cadena .= "</ul><br>";

        return $cadena;

    }
}

?>