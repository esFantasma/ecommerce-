<?php

require_once "../controladores/cabeceras.controlador.php";
require_once "../modelos/cabeceras.modelo.php";

class AjaxCabeceras{

	/*=============================================
	EDITAR CABECERAS
	EDIT HEADENDS
	=============================================*/	
	public $ruta;

	public function ajaxEditarCabecera(){

		$item = "ruta";
		$valor = $this->ruta;

		$respuesta = ControladorCabeceras::ctrMostrarCabeceras($item, $valor);

		echo json_encode($respuesta);

	}


}

/*=============================================
EDITAR CABECERAS
EDITAR CABECERAS
=============================================*/
if(isset($_POST["ruta"])){

	$editar = new AjaxCabeceras();
	$editar -> ruta = $_POST["ruta"];
	$editar -> ajaxEditarCabecera();

}