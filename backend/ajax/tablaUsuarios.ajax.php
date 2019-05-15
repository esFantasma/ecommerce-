<?php

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";
require_once "../modelos/rutas.php";

class TablaUsuarios{

 	/*=============================================
  	MOSTRAR LA TABLA DE USUARIOS
  	SHOW THE USER TABLE
  	=============================================*/ 

	public function mostrarTabla(){	

		$item = null;
 		$valor = null;

 		$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

 		$url = Ruta::ctrRuta();

 		if(count($usuarios) == 0){

	      $datosJson = '{ "data":[]}';

	      echo $datosJson;

	      return;

	    }


 		$datosJson = '{
		 
	 	"data": [ ';

	 	for($i = 0; $i < count($usuarios); $i++){

	 		/*=============================================
			TRAER FOTO USUARIO
			BRING USER PHOTO
			=============================================*/

			if($usuarios[$i]["foto"] != ""  && $usuarios[$i]["modo"] == "directo"){

				$foto = "<img class='img-circle' src='".$url.$usuarios[$i]["foto"]."' width='60px'>";

			}else if($usuarios[$i]["foto"] != "" && $usuarios[$i]["modo"] != "directo"){

				$foto = "<img class='img-circle' src='".$usuarios[$i]["foto"]."' width='60px'>";

			}else{

				$foto = "<img class='img-circle' src='vistas/img/usuarios/default/anonymous.png' width='60px'>";
			}

			/*=============================================
  			REVISAR ESTADO
  			CHECK STATE
  			=============================================*/

  			if($usuarios[$i]["modo"] == "directo"){

	  			if( $usuarios[$i]["verificacion"] == 1){

	  				$colorEstado = "btn-danger";
	  				$textoEstado = "Desactivado";
	  				$estadoUsuario = 0;

	  			}else{

	  				$colorEstado = "btn-success";
	  				$textoEstado = "Activado";
	  				$estadoUsuario = 1;

	  			}

	  			$estado = "<button class='btn btn-xs btnActivar ".$colorEstado."' idUsuario='". $usuarios[$i]["id"]."' estadoUsuario='".$estadoUsuario."'>".$textoEstado."</button>";

	  		}else{

	  			$estado = "<button class='btn btn-xs btn-info'>Activado</button>";

	  		}


	 		/*=============================================
			DEVOLVER DATOS JSON
			RETURN JSON DATA
			=============================================*/

			$datosJson	 .= '[
				      "'.($i+1).'",
				      "'.$usuarios[$i]["nombre"].'",
				      "'.$usuarios[$i]["email"].'",
				      "'.$usuarios[$i]["modo"].'",
				      "'.$foto.'",
				      "'.$estado.'",
				      "'.$usuarios[$i]["fecha"].'"    
				    ],';

	 	}

	 	$datosJson = substr($datosJson, 0, -1);

		$datosJson.=  ']
			  
		}'; 

		echo $datosJson;

 	}

}

/*=============================================
ACTIVAR TABLA DE VENTAS
ACTIVATE SALES TABLE
=============================================*/ 
$activar = new TablaUsuarios();
$activar -> mostrarTabla();



