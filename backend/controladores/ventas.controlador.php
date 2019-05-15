<?php

class ControladorVentas{

	/*=============================================
	MOSTRAR TOTAL VENTAS
	SHOW TOTAL SALES
	=============================================*/

	public function ctrMostrarTotalVentas(){

		$tabla = "compras";

		$respuesta = ModeloVentas::mdlMostrarTotalVentas($tabla);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR VENTAS
	SHOW SALES
	=============================================*/

	public function ctrMostrarVentas(){

		$tabla = "compras";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla);

		return $respuesta;

	}

}