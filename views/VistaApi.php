<?php

abstract class VistaApi extends Vista {

    function __construct(){
    }

    //Pinta la vista que se mandará por Ajax con los datos de la API
    static function render($codigo) {
    	//echo $codigo;
    	$birras = json_decode($codigo);
    	$cadena = "";
    	$cadena .= "<h3>Cervezas del mundo</h3>";
    	$cadena .= "<ul>";
    	foreach($birras->data as $birra) {
    		$foto = "";    		
    		if (isset($birra->labels->medium)) {
    			$foto = $birra->labels->medium;
    			if (isset($birra->abv)) {
    				$grados = $birra->abv;
    			} else {
    				$grados = "desconocido";
    			}
    			$cadena .= "<li>".$birra->nameDisplay."<span onclick=add('".urlencode($birra->nameDisplay)."','".urlencode($grados)."','".urlencode($foto)."')>+</span></li>";
            }
        }			

        $cadena .= "</ul><br>";

        return $cadena;

    }
}

?>