<?php

Class ControladorNotificaciones{

	/*=============================================
	MOSTRAR NOTIFICACIONES
	SHOW NOTIFICATIONS
	=============================================*/

	static public function ctrMostrarNotificaciones(){

		$tabla = "notificaciones";

		$respuesta = ModeloNotificaciones::mdlMostrarNotificaciones($tabla);

		return $respuesta;

	}

}