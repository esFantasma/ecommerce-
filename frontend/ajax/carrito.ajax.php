<?php

require_once "../extensiones/paypal.controlador.php";

require_once "../controladores/carrito.controlador.php";
require_once "../modelos/carrito.modelo.php";

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class AjaxCarrito{

	/*=============================================
	MÉTODO PAYPAL
	PAYPAL METHOD
	=============================================*/	

	public $divisa;
	public $total;
	public $totalEncriptado;
	public $impuesto;
	public $envio;
	public $subtotal;
	public $tituloArray;
	public $cantidadArray;
	public $valorItemArray;
	public $idProductoArray;

	public function ajaxEnviarPaypal(){

		if(md5($this->total) == $this->totalEncriptado){

				$datos = array(
						"divisa"=>$this->divisa,
						"total"=>$this->total,
						"impuesto"=>$this->impuesto,
						"envio"=>$this->envio,
						"subtotal"=>$this->subtotal,
						"tituloArray"=>$this->tituloArray,
						"cantidadArray"=>$this->cantidadArray,
						"valorItemArray"=>$this->valorItemArray,
						"idProductoArray"=>$this->idProductoArray,
					);

				$respuesta = Paypal::mdlPagoPaypal($datos);

				echo $respuesta;

		}
	}

	/*=============================================
	MÉTODO PAYU
	PAYU METHOD
	=============================================*/

	public function ajaxTraerComercioPayu(){

		$respuesta = ControladorCarrito::ctrMostrarTarifas(); 

		echo json_encode($respuesta);
	}

	/*=============================================
	VERIFICAR QUE NO TENGA EL PRODUCTO ADQUIRIDO
	VERIFY THAT YOU DO NOT HAVE THE PRODUCT ACQUIRED
	=============================================*/

	public $idUsuario;
	public $idProducto;

	public function ajaxVerificarProducto(){

		$datos = array("idUsuario"=>$this->idUsuario,
					   "idProducto"=>$this->idProducto);

		$respuesta = ControladorCarrito::ctrVerificarProducto($datos);

		echo json_encode($respuesta);

	}

}

/*=============================================
MÉTODO PAYPAL
PAYPAL METHOD
=============================================*/	

if(isset($_POST["divisa"])){

	$idProductos = explode("," , $_POST["idProductoArray"]);
	$cantidadProductos = explode("," , $_POST["cantidadArray"]);
	$precioProductos = explode("," , $_POST["valorItemArray"]);

	$item = "id";

	for($i = 0; $i < count($idProductos); $i ++){

		$valor = $idProductos[$i];

		$verificarProductos = ControladorProductos::ctrMostrarInfoProducto($item, $valor);

		$divisa = file_get_contents("http://free.currconv.com/api/v7/convert?q=USD_".$_POST["divisa"]."&compact=ultra&apiKey=a01ebaf9a1c69eb4ff79");

		$jsonDivisa = json_decode($divisa, true);

		$conversion = $jsonDivisa["USD_".$_POST["divisa"]];

		if($verificarProductos["precioOferta"] == 0){

			$precio = $verificarProductos["precio"]*$conversion;
		
		}else{

			$precio = $verificarProductos["precioOferta"]*$conversion;

		}

		$verificarSubTotal = $cantidadProductos[$i]*$precio;

		if(number_format($verificarSubTotal) != number_format($precioProductos[$i])){

			echo "carrito-de-compras"; 

			return;

		}

	}

	$paypal = new AjaxCarrito();
	$paypal ->divisa = $_POST["divisa"];
	$paypal ->total = $_POST["total"];
	$paypal ->totalEncriptado = $_POST["totalEncriptado"];
	$paypal ->impuesto = $_POST["impuesto"];
	$paypal ->envio = $_POST["envio"];
	$paypal ->subtotal = $_POST["subtotal"];
	$paypal ->tituloArray = $_POST["tituloArray"];
	$paypal ->cantidadArray = $_POST["cantidadArray"];
	$paypal ->valorItemArray = $_POST["valorItemArray"];
	$paypal ->idProductoArray = $_POST["idProductoArray"];
	$paypal -> ajaxEnviarPaypal();


}

/*=============================================
MÉTODO PAYU
PAYU METHOD
=============================================*/	

if(isset($_POST["metodoPago"]) && $_POST["metodoPago"] == "payu"){

	$idProductos = explode("," , $_POST["idProductoArray"]);
	$cantidadProductos = explode("," , $_POST["cantidadArray"]);
	$precioProductos = explode("," , $_POST["valorItemArray"]);

	$item = "id";

	for($i = 0; $i < count($idProductos); $i ++){

		$valor = $idProductos[$i];

		$verificarProductos = ControladorProductos::ctrMostrarInfoProducto($item, $valor);

		$divisa = file_get_contents("http://free.currconv.com/api/v7/convert?q=USD_".$_POST["divisaPayu"]."&compact=ultra&apiKey=a01ebaf9a1c69eb4ff79");

		$jsonDivisa = json_decode($divisa, true);

		$conversion = $jsonDivisa["USD_".$_POST["divisaPayu"]];

		if($verificarProductos["precioOferta"] == 0){

			$precio = $verificarProductos["precio"]*$conversion;
		
		}else{

			$precio = $verificarProductos["precioOferta"]*$conversion;
			
		}



		$verificarSubTotal = $cantidadProductos[$i]*$precio;

		if(number_format($verificarSubTotal) != number_format($precioProductos[$i])){

			echo "carrito-de-compras"; 

			return;

		}

	}

	$payu = new AjaxCarrito();
	$payu -> ajaxTraerComercioPayu();

}


/*=============================================
VERIFICAR QUE NO TENGA EL PRODUCTO ADQUIRIDO
VERIFY THAT YOU DO NOT HAVE THE PRODUCT ACQUIRED
=============================================*/	

if(isset($_POST["idUsuario"])){

	$deseo = new AjaxCarrito();
	$deseo -> idUsuario = $_POST["idUsuario"];
	$deseo -> idProducto = $_POST["idProducto"];
	$deseo ->ajaxVerificarProducto();
}