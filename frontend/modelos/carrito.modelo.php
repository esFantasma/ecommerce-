<?php

require_once "conexion.php";

class ModeloCarrito{

	/*=============================================
	MOSTRAR TARIFAS
	SHOW RATES
	=============================================*/

	static public function mdlMostrarTarifas($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$tmt =null;

	}

	/*=============================================
	NUEVAS COMPRAS
	NEW PURCHASES
	=============================================*/

	static public function mdlNuevasCompras($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_usuario, id_producto, metodo, email, direccion, pais, pago) VALUES (:id_usuario, :id_producto, :metodo, :email, :direccion, :pais, :pago)");

		$stmt->bindParam(":id_usuario", $datos["idUsuario"], PDO::PARAM_INT);
		$stmt->bindParam(":id_producto", $datos["idProducto"], PDO::PARAM_INT);
		$stmt->bindParam(":metodo", $datos["metodo"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":pais", $datos["pais"], PDO::PARAM_STR);
		$stmt->bindParam(":pago", $datos["pago"], PDO::PARAM_STR);

		if($stmt->execute()){ 

			return "ok"; 

		}else{ 

			return "error"; 

		}

		$stmt->close();

		$tmt =null;
	}

	/*=============================================
	VERIFICAR PRODUCTO COMPRADO
	CHECK PURCHASED PRODUCT
	=============================================*/

	static public function mdlVerificarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_usuario = :id_usuario AND id_producto = :id_producto");

		$stmt->bindParam(":id_usuario", $datos["idUsuario"], PDO::PARAM_INT);
		$stmt->bindParam(":id_producto", $datos["idProducto"], PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$tmt =null;

	}

}