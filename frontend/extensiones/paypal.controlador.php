<?php

require_once "../modelos/rutas.php";
require_once "../modelos/carrito.modelo.php";

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

class Paypal{

	static public function mdlPagoPaypal($datos){

		require __DIR__ . '/bootstrap.php';

		$tituloArray = explode(",", $datos["tituloArray"]);
		$cantidadArray = explode(",", $datos["cantidadArray"]);
		$valorItemArray = explode(",", $datos["valorItemArray"]);
		$idProductos = str_replace(",","-", $datos["idProductoArray"]);
		$cantidadProductos = str_replace(",","-", $datos["cantidadArray"]);
		$pagoProductos = str_replace(",","-", $datos["valorItemArray"]);


		#Seleccionamos el método de pago
		#We select the payment method
		$payer = new Payer();
		$payer->setPaymentMethod("paypal");

		$item = array();
		$variosItem = array();

		for($i = 0; $i < count($tituloArray); $i ++){

			$item[$i] = new Item();
			$item[$i]->setName($tituloArray[$i])
				    ->setCurrency($datos["divisa"])
				    ->setQuantity($cantidadArray[$i])
				    ->setPrice($valorItemArray[$i]/$cantidadArray[$i]);

				    array_push($variosItem, $item[$i]);
		}

		#Agrupamos los items en una lista de ITEMS
		# We group the items in an ITEMS list
		$itemList = new ItemList();
		$itemList->setItems($variosItem);

		#Agregamos los detalles del pago: impuestos, envíos...etc
		#Add the details of the payment: taxes, shipments ... etc
		$details = new Details();
		$details->setShipping($datos["envio"])
   				->setTax($datos["impuesto"])
    			->setSubtotal($datos["subtotal"]);

    	#definimos el pago total con sus detalles
    	# We define the total payment with your details
    	$amount = new Amount();
		$amount ->setCurrency($datos["divisa"])
		    	->setTotal($datos["total"])
		    	->setDetails($details);	

		#Agregamos las características de la transacción
		#Add the characteristics of the transaction
    	$transaction = new Transaction();
		$transaction->setAmount($amount)
    				->setItemList($itemList)
    				->setDescription("Payment description")
    				->setInvoiceNumber(uniqid());

    	#Agregamos las URL'S después de realizar el pago, o cuando el pago es cancelado
    	#Add the URL's after making the payment, or when the payment is canceled
		#Importante agregar la URL principal en la API developers de Paypal
    	#Important to add the main URL in the Paypal developers API
    	$url = Ruta::ctrRuta();

		$redirectUrls = new RedirectUrls();
		$redirectUrls->setReturnUrl("$url/index.php?ruta=finalizar-compra&paypal=true&productos=".$idProductos."&cantidad=".$cantidadProductos."&pago=".$pagoProductos)
   				     ->setCancelUrl("$url/carrito-de-compras");

   		#Agregamos todas las características del pago
   		#Add all the characteristics of the payment
   		$payment = new Payment();
		$payment->setIntent("sale")
			    ->setPayer($payer)
			    ->setRedirectUrls($redirectUrls)
			    ->setTransactions(array($transaction));

		

		#Tratar de ejcutar un proceso y si falla ejecutar una rutina de error
		#Try to execute a process and if it fails to execute an error routine
		try {
		    // traemos las credenciales $apiContext
		    // we bring the credentials $ apiContext
		    $payment->create($apiContext);
		   
		}catch(PayPal\Exception\PayPalConnectionException $ex){

			echo $ex->getCode(); // Prints the Error Code
			echo $ex->getData(); // Prints the detailed error message 
			die($ex);
			return "$url/error";

		}

		# utilizamos un foreach para itegrar sobre $payment, utilizamos el método llamado getLinks() para obtener todos los enlaces que aparecen en el array $payment y caso de que $Link->getRel() coincida con 'approval_url' extraemos dicho enlace, finalmente enviamos al usuario a esa dirección que guardamos en la variable $redirectUrl on el método getHref();

		# we use a foreach to iterate on $ payment, we use the method called getLinks () to get all the links that appear in the $ payment array and if $ Link-> getRel () matches 'approval_url' we extract that link, finally we send the user to that address that we store in the variable $ redirectUrl on the getHref () method;

		foreach ($payment->getLinks() as $link) {
			
			if($link->getRel() == "approval_url"){

				$redirectUrl = $link->getHref();
			}
		}

		return $redirectUrl;
	}

}