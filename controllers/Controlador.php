<?php
	spl_autoload_register( function( $NombreClase ) {
		//Incluir clases del modelo y de la vista
        if (file_exists('views/' . $NombreClase . '.php')) {
            include_once('views/' . $NombreClase . '.php');
        }
        if (file_exists('models/' . $NombreClase . '.php')) {
            include_once('models/' . $NombreClase . '.php');
        }        
	} );

	class Controlador {

		//Constructor, pero podría ser una clase con métodos estáticos
		function __construct() {
	        
	    }

	    //Muestra las cervezas de la api
	    function api() {
			//Si es GET llamo a la API con la página correspondiente
			//No hecho el paginador, pido esta página a piñón		
			$pag = 9;
		    $uri = 'https://sandbox-api.brewerydb.com/v2/beers?p='.$pag.'&key=a1dc1446191ebea66072bac6e03a13f6';
		    $reqPrefs['http']['method'] = 'GET';
		    $reqPrefs['http']['header'] = 'X-Auth-Token: 7c112489898843e6b4949f49284587ed';
		    $stream_context = stream_context_create($reqPrefs);
		    $response = file_get_contents($uri, false, $stream_context);
		    //Llamo a la vista para que con el Json de la API genere Html. Lo paso a Ajax
		    echo VistaApi::render($response);
	    }

	    //Muestra las cervezas favoritas
	    function favoritas() {
			//Obtengo mis cervezas favoritas del modelo
			$cervezas = BDBirra::mostrar();
			//Mostrar devuelve false si hay un error en la BD
			if (!$cervezas) {
				echo VistaError::render("Error en la Base de Datos, consulta con tu administrador");
			} else {
				//Llamo a la vista para que genere html de las cervezas. Lo devuelvo Ajax
				echo VistaFav::render($cervezas);
			}
	    }

	    //Elimina una cerveza de mis favoritas
	    function eliminar($unId) {
	    	//Eliminamos cerveza BD favoritos llamando al modelo
			$estado = BDBirra::eliminar($unId);
			if (!$estado) {
				echo VistaError::render("Error en la Base de Datos, consulta con tu administrador");
			} else {
				$this->favoritas();
			}
		}

		//Añade una cerveza a mis favoritas
		function insertar() {
			//Decodificamos objeto Javascript/Json pasado por POST
			$objeto = json_decode($_POST["objeto"],false);
			//Insertamos cerveza en BD favoritos llamando al modelo
			$estado = BDBirra::insertar($objeto->nombre, $objeto->grados, $objeto->foto);
			if ($estado) {
				$this->favoritas();
			} else {
				echo VistaError::render("Error en la Base de Datos, consulta con tu administrador");
			}

		}

		//Cargamos la pantalla de inicio
		function inicio() {
			echo VistaInicio::render("index.html");
		}

		//En caso de no ser una url/método válido mostramos vista de error
		function error() {
			echo VistaError::render("Anda, prueba con otra");

		}
}



?>