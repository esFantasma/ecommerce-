<?php

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class TablaVentas{

  /*=============================================
  MOSTRAR LA TABLA DE VENTAS
  SHOW THE SALES TABLE
  =============================================*/

  public function mostrarTabla(){	

  	$ventas = ControladorVentas::ctrMostrarVentas();

  	if(count($ventas) == 0){

      $datosJson = '{ "data":[]}';

      echo $datosJson;

      return;

    }

    $datosJson = '{
		 
	 "data": [ ';

	for($i = 0; $i < count($ventas); $i++){

		/*=============================================
		TRAER PRODUCTO
		BRING PRODUCT
		=============================================*/

		$item = "id";
		$valor = $ventas[$i]["id_producto"];

		$traerProducto = ControladorProductos::ctrMostrarProductos($item, $valor);

		$producto = $traerProducto[0]["titulo"];

		$imgProducto = "<img class='img-thumbnail' src='".$traerProducto[0]["portada"]."' width='100px'>";

		$tipo = $traerProducto[0]["tipo"];


		/*=============================================
		TRAER CLIENTE
		BRING CLIENT
		=============================================*/

		$item2 = "id";
		$valor2 = $ventas[$i]["id_usuario"];

		$traerCliente = ControladorUsuarios::ctrMostrarUsuarios($item2, $valor2);

		$cliente = $traerCliente["nombre"];

		/*=============================================
		TRAER FOTO CLIENTE
		BRING CUSTOMER PHOTO
		=============================================*/

		if($traerCliente["foto"] != ""){

			$imgCliente = "<img class='img-circle' src='".$traerCliente["foto"]."' width='70px'>";

		}else{

			$imgCliente = "<img class='img-circle' src='vistas/img/usuarios/default/anonymous.png' width='70px'>";
		}

		/*=============================================
		TRAER EMAIL CLIENTE
		BRING EMAIL CUSTOMER
		=============================================*/

		if($ventas[$i]["email"] == ""){

			$email = $traerCliente["email"];

		}else{

			$email = $ventas[$i]["email"];
		}

		/*=============================================
		TRAER PROCESO DE ENVÍO
		BRING SHIPPING PROCESS
		=============================================*/

		if($ventas[$i]["envio"] == 0 && $tipo == "virtual"){

			$envio = "<button class='btn btn-info btn-xs'>Entrega inmediata</button>";
		
		}else if($ventas[$i]["envio"] == 0 && $tipo == "fisico"){

			$envio ="<button class='btn btn-danger btn-xs btnEnvio' idVenta='".$ventas[$i]["id"]."' etapa='1'>Despachando el producto</button>";

		}else if($ventas[$i]["envio"] == 1 && $tipo == "fisico"){

			$envio = "<button class='btn btn-warning btn-xs btnEnvio' idVenta='".$ventas[$i]["id"]."' etapa='2'>Enviando el producto</button>";

		}else{

			$envio = "<button class='btn btn-success btn-xs'>Producto entregado</button>";

		}

		/*=============================================
		LOGOS PAYPAL Y PAYU
		LOGOS PAYPAL AND PAYU
		=============================================*/

		if($ventas[$i]["metodo"] == "paypal"){

			$metodo = "<img class='img-responsive' src='vistas/img/plantilla/paypal.jpg' width='300px'>";
		
		}else if($ventas[$i]["metodo"] == "payu"){

			$metodo = "<img class='img-responsive' src='vistas/img/plantilla/payu.jpg' width='300px'>";
		
		}else{

			$metodo = "GRATIS";

		}


		/*=============================================
		DEVOLVER DATOS JSON
		RETURN JSON DATA
		=============================================*/
		$datosJson	 .= '[
			      		"'.($i+1).'",
			      		"'.$producto.'",
			      		"'.$imgProducto.'",
			      		"'.$cliente.'",
			      		"'.$imgCliente.'",
			      		"$ '.number_format($ventas[$i]["pago"],2).'",
			      		"'.$tipo.'",
			      		"'.$envio.'",
			      		"'.$metodo.'",	
			      		"'.$email.'",
			      		"'.$ventas[$i]["direccion"].'",
			      		"'.$ventas[$i]["pais"].'",
			      		"'.$ventas[$i]["fecha"].'"	
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
$activar = new TablaVentas();
$activar -> mostrarTabla(); 

