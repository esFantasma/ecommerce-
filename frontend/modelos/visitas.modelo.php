<?php

require_once "conexion.php";

class ModeloVisitas{

	/*=============================================
	BUSCAR IP EXISTENTE
	SEARCH FOR EXISTING IP
	=============================================*/

	static public function mdlSeleccionarIp($tabla, $ip){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE ip = :ip");

		$stmt->bindParam(":ip", $ip, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

	}
	

	/*=============================================
	GUARDAR IP NUEVA
	SAVE NEW IP
	=============================================*/

	static public function mdlGuardarNuevaIp($tabla, $ip, $pais, $visita){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(ip, pais, visitas) VALUES (:ip, :pais, :visitas)");

		$stmt->bindParam(":ip", $ip, PDO::PARAM_STR);
		$stmt->bindParam(":pais", $pais, PDO::PARAM_STR);
		$stmt->bindParam(":visitas", $visita, PDO::PARAM_INT);
	
		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";	
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	SELECCIONAR PAÍS
	SELECT COUNTRY
	=============================================*/
	
	static public function mdlSeleccionarPais($tabla, $pais){
		
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE pais = :pais");
		
		$stmt->bindParam(":pais", $pais, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
	
	}


	/*=============================================
	INSERTAR PAIS
	INSERT COUNTRY
	=============================================*/
	static public function mdlInsertarPais($tabla, $pais, $codigo, $cantidad){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(pais, codigo, cantidad) VALUES (:pais, :codigo, :cantidad)");

		$stmt->bindParam(":pais", $pais, PDO::PARAM_STR);
		$stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";	
		}

		$stmt->close();

		$stmt = null;

	}

	/*=============================================
	SI EXISTE EL PAÍS ACTUALIZAR NUEVA VISITA
	IF THE COUNTRY EXISTS UPDATE NEW VISIT
	=============================================*/	

	static public function mdlActualizarPais($tabla, $pais, $actualizarCantidad){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET cantidad = :cantidad WHERE pais = :pais");

		$stmt->bindParam(":cantidad", $actualizarCantidad, PDO::PARAM_INT);
		$stmt->bindParam(":pais", $pais, PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";	
		}

		$stmt->close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR EL TOTAL DE VISITAS
	SHOW THE TOTAL OF VISITS
	=============================================*/	

	static public function mdlMostrarTotalVisitas($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT SUM(cantidad) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR LOS PRIMEROS 6 PAISES DE VISITAS
	SHOW THE FIRST 6 COUNTRIES OF VISITS
	=============================================*/
	
	static public function mdlMostrarPaises($tabla){
		
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY cantidad DESC LIMIT 6");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();
	
	}

}