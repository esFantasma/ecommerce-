<?php

class ControladorVisitas{

	/*=============================================
	GUARDAR IP
	SAVE IP
	=============================================*/

	static public function ctrEnviarIp($ip, $pais, $codigo){

		$tabla = "visitaspersonas";
		$visita = 1;

		$respuestaInsertarIp = null;
		$respuestaActualizarIp = null;

		if($pais == ""){

			$pais = "Unknown";
		}

		/*=============================================
		BUSCAR IP EXISTENTE
		SEARCH FOR EXISTING IP
		=============================================*/

		$buscarIpExistente = ModeloVisitas::mdlSeleccionarIp($tabla, $ip);

		if(!$buscarIpExistente){

			/*=============================================
			GUARDAR IP NUEVA
			SAVE NEW IP
			=============================================*/

			$respuestaInsertarIp = ModeloVisitas::mdlGuardarNuevaIp($tabla, $ip, $pais, $visita);

		}else{

			/*=============================================
			SI LA IP EXISTE Y ES OTRO DIA VOLVERLA A GUARDAR
			IF IP EXISTS AND IS ANOTHER DAY, RETURN IT TO SAVE
			=============================================*/
			date_default_timezone_set('America/Bogota');
			
			$fechaActual = date('Y-m-d');

			foreach ($buscarIpExistente as $key => $value) {

				$compararFecha = substr($value["fecha"],0,10);
	
			}

			if($fechaActual != $compararFecha){

				$respuestaActualizarIp = ModeloVisitas::mdlGuardarNuevaIp($tabla, $ip, $pais, $visita);	
				
			}

		}


		if($respuestaInsertarIp == "ok" || $respuestaActualizarIp == "ok"){

			/*=============================================
			ACTUALIZAR NOTIFICACIONES NUEVAS VISITAS
			UPDATE NEW NOTIFICATIONS VISITS
			=============================================*/

			$traerNotificaciones = ControladorNotificaciones::ctrMostrarNotificaciones();

			$nuevaVisita = $traerNotificaciones["nuevasVisitas"] + 1;

			ModeloNotificaciones::mdlActualizarNotificaciones("notificaciones", "nuevasVisitas", $nuevaVisita);

			$tablaPais = "visitaspaises";

			/*=============================================
			SELECCIONAR PAÍS
			SELECT COUNTRY
			=============================================*/

			$seleccionarPais = ModeloVisitas::mdlSeleccionarPais($tablaPais, $pais);

			if(!$seleccionarPais){

				/*=============================================
				SI NO EXISTE EL PAÍS AGREGAR NUEVO PAÍS
				IF THERE IS NO COUNTRY ADD NEW COUNTRY
				=============================================*/	

				$cantidad = 1;

				$insertarPais = ModeloVisitas::mdlInsertarPais($tablaPais, $pais, $codigo, $cantidad);

			}else{

				/*=============================================
				SI EXISTE EL PAÍS ACTUALIZAR UNA NUEVA VISITA
				IF THE COUNTRY EXISTS UPDATE A NEW VISIT
				=============================================*/	
				 $actualizarCantidad = $seleccionarPais["cantidad"] + 1;

				 $actualizarPais = ModeloVisitas::mdlActualizarPais($tablaPais, $pais, $actualizarCantidad);

			}	

		}
		
	}

	/*=============================================
	MOSTRAR EL TOTAL DE VISITAS
	SHOW THE TOTAL OF VISITS
	=============================================*/	

	public function ctrMostrarTotalVisitas(){

		$tabla = "visitaspaises";

		$respuesta = ModeloVisitas::mdlMostrarTotalVisitas($tabla);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR LOS PRIMEROS 6 PAISES DE VISITAS
	SHOW THE FIRST 6 COUNTRIES OF VISITS
	=============================================*/
	
	public function ctrMostrarPaises(){

		$tabla = "visitaspaises";
	
		$respuesta = ModeloVisitas::mdlMostrarPaises($tabla);
		
		return $respuesta;
	}

}