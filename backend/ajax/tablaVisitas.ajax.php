<?php

require_once "../controladores/visitas.controlador.php";
require_once "../modelos/visitas.modelo.php";

class TablaVisitas{

 	/*=============================================
  	MOSTRAR LA TABLA DE VISITAS
  	SHOW THE VISITING TABLE
  	=============================================*/ 

 	public function mostrarTabla(){

 		$visitas = ControladorVisitas::ctrMostrarVisitas();

 		if(count($visitas) == 0){

	      $datosJson = '{ "data":[]}';

	      echo $datosJson;

	      return;

	    }

 		$datosJson = '{
		 
	 	"data": [ ';

	 	for($i = 0; $i < count($visitas); $i++){

		/*=============================================
		DEVOLVER DATOS JSON
		RETURN JSON DATA
		=============================================*/

		$datosJson	 .= '[
			      "'.($i+1).'",
			      "'.$visitas[$i]["ip"].'",
			      "'.$visitas[$i]["pais"].'",
			      "'.$visitas[$i]["visitas"].'",
			      "'.$visitas[$i]["fecha"].'"    
			    ],';

		}

	 	$datosJson = substr($datosJson, 0, -1);

		$datosJson.=  ']
		  
		}'; 

		echo $datosJson;

 	}


}

/*=============================================
ACTIVAR TABLA DE VISITAS
ACTIVATE TABLE OF VISITS
=============================================*/ 
$activar = new TablaVisitas();
$activar -> mostrarTabla();