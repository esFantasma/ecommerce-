<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

require_once "../controladores/subcategorias.controlador.php";
require_once "../modelos/subcategorias.modelo.php";

require_once "../controladores/cabeceras.controlador.php";
require_once "../modelos/cabeceras.modelo.php";

class TablaProductos{

  /*=============================================
  MOSTRAR LA TABLA DE PRODUCTOS
  SHOW THE PRODUCT TABLE
  =============================================*/ 

  public function mostrarTablaProductos(){	

  	$item = null;
  	$valor = null;

  	$productos = ControladorProductos::ctrMostrarProductos($item, $valor);

    if(count($productos) == 0){

      $datosJson = '{ "data":[]}';

      echo $datosJson;

      return;

    }

  	$datosJson = '

  		{	
  			"data":[';

	 	for($i = 0; $i < count($productos); $i++){

			/*=============================================
  			TRAER LAS CATEGORÍAS
        BRING THE CATEGORIES
  			=============================================*/

  			$item = "id";
			$valor = $productos[$i]["id_categoria"];

			$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

			if($categorias["categoria"] == ""){

				$categoria = "SIN CATEGORÍA";
			
			}else{

				$categoria = $categorias["categoria"];
			}

			/*=============================================
  			TRAER LAS SUBCATEGORÍAS
        BRING THE SUBCATEGORIES
  			=============================================*/

  			$item2 = "id";
			$valor2 = $productos[$i]["id_subcategoria"];

			$subcategorias = ControladorSubCategorias::ctrMostrarSubCategorias($item2, $valor2);

			if($subcategorias[0]["subcategoria"] == ""){

				$subcategoria = "SIN SUBCATEGORÍA";
			
			}else{

				$subcategoria = $subcategorias[0]["subcategoria"];
			}

			/*=============================================
  			AGREGAR ETIQUETAS DE ESTADO
        ADD STATE LABELS
  			=============================================*/

  			if($productos[$i]["estado"] == 0){

  				$colorEstado = "btn-danger";
  				$textoEstado = "Desactivado";
  				$estadoProducto = 1;

  			}else{

  				$colorEstado = "btn-success";
  				$textoEstado = "Activado";
  				$estadoProducto = 0;

  			}

  			$estado = "<button class='btn btn-xs btnActivar ".$colorEstado."' idProducto='".$productos[$i]["id"]."' estadoProducto='".$estadoProducto."'>".$textoEstado."</button>";

  			/*=============================================
  			TRAER LAS CABECERAS
        BRING THE HEADBANDS
  			=============================================*/

  			$item3 = "ruta";
			$valor3 = $productos[$i]["ruta"];

			$cabeceras = ControladorCabeceras::ctrMostrarCabeceras($item3, $valor3);

			if($cabeceras["portada"] != ""){

  				$imagenPortada = "<img src='".$cabeceras["portada"]."' class='img-thumbnail imgPortadaProductos' width='100px'>";

  			}else{

  				$imagenPortada = "<img src='vistas/img/cabeceras/default/default.jpg' class='img-thumbnail imgPortadaProductos' width='100px'>";
  			}

			/*=============================================
  			TRAER IMAGEN PRINCIPAL
        BRING MAIN IMAGE
  			=============================================*/

  			$imagenPrincipal = "<img src='".$productos[$i]["portada"]."' class='img-thumbnail imgTablaPrincipal' width='100px'>";

  			/*=============================================
			TRAER MULTIMEDIA
      BRING MULTIMEDIA
  			=============================================*/

  			if($productos[$i]["multimedia"] != null){

  				$multimedia = json_decode($productos[$i]["multimedia"],true);

  				if($multimedia[0]["foto"] != ""){

  					$vistaMultimedia = "<img src='".$multimedia[0]["foto"]."' class='img-thumbnail imgTablaMultimedia' width='100px'>";

  				}else{

  					$vistaMultimedia = "<img src='http://i3.ytimg.com/vi/".$productos[$i]["multimedia"]."/hqdefault.jpg' class='img-thumbnail imgTablaMultimedia' width='100px'>";

  				}


  			}else{

  				$vistaMultimedia = "<img src='vistas/img/multimedia/default/default.jpg' class='img-thumbnail imgTablaMultimedia' width='100px'>";

  			}

  			/*=============================================
  			TRAER DETALLES
        BRING DETAILS
  			=============================================*/

  			$detalles = json_decode($productos[$i]["detalles"],true);

  			if($productos[$i]["tipo"] == "fisico"){

  				$talla = json_encode($detalles["Talla"]);
				$color = json_encode($detalles["Color"]);
				$marca = json_encode($detalles["Marca"]);

				$vistaDetalles = "Talla: ".str_replace(array("[","]",'"'), "", $talla)." - Color: ".str_replace(array("[","]",'"'), "", $color)." - Marca: ".str_replace(array("[","]",'"'), "", $marca);


  			}else{


				$vistaDetalles = "Clases: ".$detalles["Clases"].", Tiempo: ".$detalles["Tiempo"].", Nivel: ".$detalles["Nivel"].", Acceso: ".$detalles["Acceso"].", Dispositivo: ".$detalles["Dispositivo"].", Certificado: ".$detalles["Certificado"];

  			}

  			/*=============================================
  			TRAER PRECIO
        BRING PRICE
  			=============================================*/

  			if($productos[$i]["precio"] == 0){

  				$precio = "Gratis";
  			
  			}else{

  				$precio = "$ ".number_format($productos[$i]["precio"],2);

  			}

  			/*=============================================
  			TRAER ENTREGA
        BRING DELIVERY
  			=============================================*/

  			if($productos[$i]["entrega"] == 0){

  				$entrega = "Inmediata";
  			
  			}else{

  				$entrega = $productos[$i]["entrega"]. " días hábiles";

  			}

  			/*=============================================
  			REVISAR SI HAY OFERTAS
        CHECK IF THERE ARE OFFERS
  			=============================================*/
  			
			if($productos[$i]["oferta"] != 0){

				if($productos[$i]["precioOferta"] != 0){	

					$tipoOferta = "PRECIO";
					$valorOferta = "$ ".number_format($productos[$i]["precioOferta"],2);

				}else{

					$tipoOferta = "DESCUENTO";
					$valorOferta = $productos[$i]["descuentoOferta"]." %";	

				}	

			}else{

				$tipoOferta = "No tiene oferta";
				$valorOferta = 0;
				
			}

  			/*=============================================
  			TRAER IMAGEN OFERTA
        BRING IMAGE OFFER
  			=============================================*/

  			if($productos[$i]["imgOferta"] != ""){

	  			$imgOferta = "<img src='".$productos[$i]["imgOferta"]."' class='img-thumbnail imgTablaProductos' width='100px'>";

	  		}else{

	  			$imgOferta = "<img src='vistas/img/ofertas/default/default.jpg' class='img-thumbnail imgTablaProductos' width='100px'>";

	  		}

	  		/*=============================================
  			TRAER LAS ACCIONES
        BRING THE ACTIONS
  			=============================================*/

  			$acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["id"]."' imgOferta='".$productos[$i]["imgOferta"]."' rutaCabecera='".$productos[$i]["ruta"]."' imgPortada='".$cabeceras["portada"]."' imgPrincipal='".$productos[$i]["portada"]."'><i class='fa fa-times'></i></button></div>";

  			/*=============================================
  			CONSTRUIR LOS DATOS JSON
        BUILD THE JSON DATA
  			=============================================*/


			$datosJson .='[
					
					"'.($i+1).'",
					"'.$productos[$i]["titulo"].'",
					"'.$categoria.'",
					"'.$subcategoria.'",
					"'.$productos[$i]["ruta"].'",
					"'.$estado.'",
					"'.$productos[$i]["tipo"].'",
					"'.$cabeceras["descripcion"].'",
				  	"'.$cabeceras["palabrasClaves"].'",
				  	"'.$imagenPortada.'",
				  	"'.$imagenPrincipal.'",
			 	  	"'.$vistaMultimedia.'",
				  	"'.$vistaDetalles.'",
		  			"'.$precio.'",
				  	"'.$productos[$i]["peso"].' kg",
				  	"'.$entrega.'",
				  	"'.$tipoOferta.'",
				  	"'.$valorOferta.'",
				  	"'.$imgOferta.'",
				  	"'.$productos[$i]["finOferta"].'",			
				  	"'.$acciones.'"	   

			],';

		}

		$datosJson = substr($datosJson, 0, -1);

		$datosJson .= ']

		}';

		echo $datosJson;

  }


}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
ACTIVATE TABLE OF PRODUCTS
=============================================*/ 
$activarProductos = new TablaProductos();
$activarProductos -> mostrarTablaProductos();