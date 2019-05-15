<?php

class ControladorCarrito{

	/*=============================================
	MOSTRAR TARIFAS
	SHOW RATES
	=============================================*/

	public function ctrMostrarTarifas(){

		$tabla = "comercio";

		$respuesta = ModeloCarrito::mdlMostrarTarifas($tabla);

		return $respuesta;

	}	

	/*=============================================
	NUEVAS COMPRAS
	NEW PURCHASES
	=============================================*/

	static public function ctrNuevasCompras($datos){

		$tabla = "compras";

		$respuesta = ModeloCarrito::mdlNuevasCompras($tabla, $datos);

		if($respuesta == "ok"){

			$tabla = "comentarios";
			ModeloUsuarios::mdlIngresoComentarios($tabla, $datos);

			/*=============================================
			ACTUALIZAR NOTIFICACIONES NUEVAS VENTAS
			UPDATE NEW SALES NOTIFICATIONS
			=============================================*/

			$traerNotificaciones = ControladorNotificaciones::ctrMostrarNotificaciones();

			$nuevaVenta = $traerNotificaciones["nuevasVentas"] + 1;

			ModeloNotificaciones::mdlActualizarNotificaciones("notificaciones", "nuevasVentas", $nuevaVenta);


		}

		return $respuesta;

	}

	/*=============================================
	VERIFICAR PRODUCTO COMPRADO
	CHECK PURCHASED PRODUCT
	=============================================*/

	static public function ctrVerificarProducto($datos){

		$tabla = "compras";

		$respuesta = ModeloCarrito::mdlVerificarProducto($tabla, $datos);
	 
	    return $respuesta;

		
	}

}