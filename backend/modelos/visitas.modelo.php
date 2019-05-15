<?php

require_once "conexion.php";

class ModeloVisitas{

	/*=============================================
	MOSTRAR EL TOTAL DE Visitas
	SHOW THE TOTAL OF Visits
	=============================================*/	

	static public function mdlMostrarTotalVisitas($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT SUM(cantidad) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR PAISES DE VISITAS
	SHOW VISIT COUNTRIES
	=============================================*/
	
	static public function mdlMostrarPaises($tabla, $orden){
		
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $orden DESC");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();
	
	}

	/*=============================================
	MOSTRAR VISITAS
	SHOW VISITS
	=============================================*/	

	static public function mdlMostrarVisitas($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}



}