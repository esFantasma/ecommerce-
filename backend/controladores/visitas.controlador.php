<?php

class ControladorVisitas{

	/*=============================================
	MOSTRAR TOTAL VISITAS
	SHOW TOTAL VISITS
	=============================================*/

	public function ctrMostrarTotalVisitas(){

		$tabla = "visitaspaises";

		$respuesta = ModeloVisitas::mdlMostrarTotalVisitas($tabla);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR PAISES DE VISITAS
	SHOW VISIT COUNTRIES
	=============================================*/
	
	static public function ctrMostrarPaises($orden){

		$tabla = "visitaspaises";
	
		$respuesta = ModeloVisitas::mdlMostrarPaises($tabla, $orden);
		
		return $respuesta;
	}

	/*=============================================
	MOSTRAR VISITAS
	SHOW VISITS
	=============================================*/
	
	static public function ctrMostrarVisitas(){

		$tabla = "visitaspersonas";
	
		$respuesta = ModeloVisitas::mdlMostrarVisitas($tabla);
		
		return $respuesta;
	}


}