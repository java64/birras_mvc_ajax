<?php
	spl_autoload_register( function( $NombreClase ) {
	    include_once($NombreClase . '.php');
	} );
	require 'vendor/autoload.php';

	class  Db {
		private static $conexion=NULL;
		private function __construct (){}
 
		public static function conectar(){

			try {
				$conexion = new MongoDB\Client;
				self::$conexion = $conexion->ajax;
			} catch (Exception $e){
			    echo $e->getMessage();
			}

			return self::$conexion;
		}		
	} 
?>