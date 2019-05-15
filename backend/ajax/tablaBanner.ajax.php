<?php

require_once "../controladores/banner.controlador.php";
require_once "../modelos/banner.modelo.php";

class TablaBanner{

 	/*=============================================
  	MOSTRAR LA TABLA DE BANNER
  	SHOW THE BANNER TABLE
  	=============================================*/ 

 	public function mostrarTabla(){	

 		$item = null;
 		$valor = null;

 		$banner = ControladorBanner::ctrMostrarBanner($item, $valor);	

 		if(count($banner) == 0){

	      $datosJson = '{ "data":[]}';

	      echo $datosJson;

	      return;

	    }

 		$datosJson = '{
		 
		  "data": [ ';

		 for($i = 0; $i < count($banner); $i++){

		 	/*=============================================
			REVISAR ESTADO
			CHECK STATE
			=============================================*/ 
			
			if($banner[$i]["estado"] == 0){
				
				$colorEstado = "btn-danger";
				$textoEstado = "Desactivado";
				$estadoBanner = 1;

			}else{

				$colorEstado = "btn-success";
				$textoEstado = "Activado";
				$estadoBanner = 0;

			}	

			$estado = "<button class='btn ".$colorEstado." btn-xs btnActivar' estadoBanner='".$estadoBanner."' idBanner='".$banner[$i]["id"]."'>".$textoEstado."</button>";

			/*=============================================
			REVISAR IMAGEN BANNER
			CHECK IMAGE BANNER
			=============================================*/ 

			$imgBanner = "<img class='img-thumbnail imgBanner' src='".$banner[$i]["img"]."' width='100px'>";

			/*=============================================
  			CREAR LAS ACCIONES
  			CREATE THE ACTIONS
  			=============================================*/

  			 $acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarBanner' idBanner='".$banner[$i]["id"]."' data-toggle='modal' data-target='#modalEditarBanner'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarBanner' idBanner='".$banner[$i]["id"]."' imgBanner='".$banner[$i]["img"]."'><i class='fa fa-times'></i></button></div>";

  			 $datosJson	 .= '[
					 	"'.($i+1).'",
					 	"'.$imgBanner.'",
				 	 	"'. $estado.'",
				      	"'.$banner[$i]["ruta"].'",
				      	"'.$banner[$i]["tipo"].'",
				      	"'.$acciones.'"		   

  			  ],';
	    
		 }

	  	$datosJson = substr($datosJson, 0, -1);

		$datosJson.=  ']
		  
		}'; 

		echo $datosJson;

 	}


}


/*=============================================
ACTIVAR TABLA DE BANNER
ACTIVATE BANNER TABLE
=============================================*/ 
$activar = new TablaBanner();
$activar -> mostrarTabla();