<?php

	class BDBirra {

		//Métodos Base de Datos

		//Muestra las cervezas favoritas
		public static function mostrar() {
			try {
				$dbh=Db::conectar();
				//Seleccionamos colección "birra"
				$coleccion = $dbh->birra;
				$birras = $coleccion->find();		
				$dbh=null;		
			} catch (Exception $e){
			    //Escribir fichero de log el error
				file_put_contents("bd.log", $e->getMessage());
				return false;
			}	

			return json_encode($birras->toArray());
		}	

		//Eliminar una cerveza
		public static function eliminar($idCerveza){
			//Conectamos con la base de datos peliculas
			try {
				$bd=Db::conectar();
				//Se guarda en una variable la coleccion a manipular
				$coleccion = $bd->birra;
				//Buscamos en la coleccion si hay alguna coincidencia
				$coleccion->deleteOne(['_id' => new \MongoDB\BSON\ObjectId($idCerveza)]);
				$bd = null;
			} catch (Exception $e){
			    //Escribir fichero de log el error
				file_put_contents("bd.log", $e->getMessage());
				return false;
			}	
			return true;
		}

		//Metodo para insertar una cerveza que recibe sus datos
		public static function insertar($nombre, $grados, $foto){
			try {
				//Conectamos con la base de datos
				$bd=Db::conectar();
				//Se guarda la coleccion a manipular en una variable
				$coleccion = $bd->birra;
				//Insertamos el anterior documento en la coleccion
				$coleccion->insertOne([
									    'nombre' => $nombre,
									    'grados' => $grados,
									    'foto' => $foto
									   ]);		
				//Se cierra la conexion con la bd
				$bd = null;
			} catch (Exception $e) {
				//Escribir fichero de log el error
				file_put_contents("bd.log", $e->getMessage());
				return false;
			} 

			return true;
		}	

	}

?>