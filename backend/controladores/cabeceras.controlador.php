<?php

class ControladorCabeceras{

	/*=============================================
	MOSTRAR CABECERAS
	SHOW HEADLINES
	=============================================*/

	static public function ctrMostrarCabeceras($item, $valor){

		$tabla = "cabeceras";

		$respuesta = ModeloCabeceras::mdlMostrarCabeceras($tabla, $item, $valor);

		return $respuesta;

	}

}