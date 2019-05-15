<?php

class ControladorUsuarios{

	/*=============================================
	MOSTRAR TOTAL USUARIOS
	SHOW TOTAL USERS
	=============================================*/

	static public function ctrMostrarTotalUsuarios($orden){

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::mdlMostrarTotalUsuarios($tabla, $orden);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR USUARIOS
	SHOW USERS
	=============================================*/

	static public function ctrMostrarUsuarios($item, $valor){

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;
	
	}

}