<?php

class ControladorPlantilla{

	/*=============================================
	LLAMAMOS LA PLANTILLA
	WE CALL THE TEMPLATE
	=============================================*/

	public function plantilla(){

		include "vistas/plantilla.php";

	}

	/*=============================================
	TRAEMOS LOS ESTILOS DINÁMICOS DE LA PLANTILLA
	WE BRING THE DYNAMIC STYLES OF THE TEMPLATE
	=============================================*/

	public function ctrEstiloPlantilla(){

		$tabla = "plantilla";

		$respuesta = ModeloPlantilla::mdlEstiloPlantilla($tabla);

		return $respuesta;
	}

	/*=============================================
	TRAEMOS LAS CABECERAS
	WE BRING THE HEADENDS
	=============================================*/

	static public function ctrTraerCabeceras($ruta){

		$tabla = "cabeceras";

		$respuesta = ModeloPlantilla::mdlTraerCabeceras($tabla, $ruta);

		return $respuesta;	

	}

}