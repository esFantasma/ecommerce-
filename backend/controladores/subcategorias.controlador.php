<?php

class ControladorSubCategorias{

	/*=============================================
	MOSTRAR SUBCATEGORIAS
	SHOW SUBCATEGORIES
	=============================================*/

	static public function ctrMostrarSubCategorias($item, $valor){

		$tabla = "subcategorias";

		$respuesta = ModeloSubCategorias::mdlMostrarSubCategorias($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	CREAR SUBCATEGORIA
	CREATE SUBCATEGORY
	=============================================*/

	static public function ctrCrearSubCategoria(){

		if(isset($_POST["tituloSubCategoria"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["tituloSubCategoria"]) && preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcionSubCategoria"])){

				/*=============================================
				VALIDAR IMAGEN PORTADA
				VALIDATE IMAGE COVER
				=============================================*/

				$rutaPortada = "vistas/img/cabeceras/default/default.jpg";

				if(isset($_FILES["fotoPortada"]["tmp_name"]) && !empty($_FILES["fotoPortada"]["tmp_name"])){

					/*=============================================
					DEFINIMOS LAS MEDIDAS
					WE DEFINE THE MEASURES
					=============================================*/

					list($ancho, $alto) = getimagesize($_FILES["fotoPortada"]["tmp_name"]);	

					$nuevoAncho = 1280;
					$nuevoAlto = 720;


					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					ACCORDING TO THE TYPE OF IMAGE WE APPLY THE FUNCTIONS BY DEFAULT OF PHP
					=============================================*/

					if($_FILES["fotoPortada"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						WE SAVE THE IMAGE IN THE DIRECTORY
						=============================================*/

						$rutaPortada = "vistas/img/cabeceras/".$_POST["rutaSubCategoria"].".jpg";

						$origen = imagecreatefromjpeg($_FILES["fotoPortada"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaPortada);

					}

					if($_FILES["fotoPortada"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						WE SAVE THE IMAGE IN THE DIRECTORY
						=============================================*/

						$rutaPortada = "vistas/img/cabeceras/".$_POST["rutaSubCategoria"].".png";

						$origen = imagecreatefrompng($_FILES["fotoPortada"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);
    			
    					imagesavealpha($destino, TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaPortada);

					}

				}

				/*=============================================
				VALIDAR IMAGEN OFERTA
				VALIDATE IMAGE OFFER
				=============================================*/

				$rutaOferta = "";

				if(isset($_FILES["fotoOferta"]["tmp_name"]) && !empty($_FILES["fotoOferta"]["tmp_name"])){

					/*=============================================
					DEFINIMOS LAS MEDIDAS
					WE DEFINE THE MEASURES
					=============================================*/

					list($ancho, $alto) = getimagesize($_FILES["fotoOferta"]["tmp_name"]);

					$nuevoAncho = 640;
					$nuevoAlto = 430;


					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					ACCORDING TO THE TYPE OF IMAGE WE APPLY THE FUNCTIONS BY DEFAULT OF PHP
					=============================================*/

					if($_FILES["fotoOferta"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						WE SAVE THE IMAGE IN THE DIRECTORY
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaOferta = "vistas/img/ofertas/".$_POST["rutaSubCategoria"].".jpg";

						$origen = imagecreatefromjpeg($_FILES["fotoOferta"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaOferta);

					}

					if($_FILES["fotoOferta"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						WE SAVE THE IMAGE IN THE DIRECTORY
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaOferta = "vistas/img/ofertas/".$_POST["rutaSubCategoria"].".png";

						$origen = imagecreatefrompng($_FILES["fotoOferta"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);
    			
    					imagesavealpha($destino, TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaOferta);

					}

				}			

				/*=============================================
				PREGUNTAMOS SI VIENE OFERTE EN CAMINO
				WE ASK IF COMING OFFER IN ROAD
				=============================================*/

				if($_POST["selActivarOferta"] == "oferta"){

					$datos = array("subcategoria"=>$_POST["tituloSubCategoria"],
								   "idCategoria"=>$_POST["seleccionarCategoria"],
								   "ruta"=>$_POST["rutaSubCategoria"],
								   "estado"=> 1,
								   "titulo"=>$_POST["tituloSubCategoria"],
								   "descripcion"=> $_POST["descripcionSubCategoria"],
								   "palabrasClaves"=> $_POST["pClavesSubCategoria"],
								   "imgPortada"=>$rutaPortada,
								   "oferta"=>1,
								   "precioOferta"=>$_POST["precioOferta"],
								   "descuentoOferta"=>$_POST["descuentoOferta"],
								   "imgOferta"=>$rutaOferta,
								   "finOferta"=>$_POST["finOferta"]);

				}else{

					$datos = array("subcategoria"=>$_POST["tituloSubCategoria"],
								   "idCategoria"=>$_POST["seleccionarCategoria"],
								   "ruta"=>$_POST["rutaSubCategoria"],
								   "estado"=> 1,
								   "titulo"=>$_POST["tituloSubCategoria"],
								   "descripcion"=> $_POST["descripcionSubCategoria"],
								   "palabrasClaves"=> $_POST["pClavesSubCategoria"],
								   "imgPortada"=>$rutaPortada,
								   "oferta"=>0,
								   "precioOferta"=>0,
								   "descuentoOferta"=>0,
								   "imgOferta"=>"",								   
								   "finOferta"=>"");

				}
	
				ModeloCabeceras::mdlIngresarCabecera("cabeceras", $datos);

				$respuesta = ModeloSubCategorias::mdlIngresarSubCategoria("subcategorias", $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La subcategoría ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "subcategorias";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La subcategoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "subcategorias";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	EDITAR SUBCATEGORIA
	EDIT SUBCATEGORY
	=============================================*/

	static public function ctreditarSubCategoria(){

		if(isset($_POST["editarTituloSubCategoria"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarTituloSubCategoria"])&& preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcionSubCategoria"]) ){

				/*=============================================
				VALIDAR IMAGEN PORTADA
				VALIDATE IMAGE COVER
				=============================================*/

				$rutaPortada = $_POST["antiguaFotoPortada"];

				if(isset($_FILES["fotoPortada"]["tmp_name"]) && !empty($_FILES["fotoPortada"]["tmp_name"])){

					/*=============================================
					BORRAMOS ANTIGUA FOTO PORTADA
					ERASE OLD PHOTO COVER
					=============================================*/

					unlink($_POST["antiguaFotoPortada"]);

					/*=============================================
					DEFINIMOS LAS MEDIDAS
					WE DEFINE THE MEASURES
					=============================================*/

					list($ancho, $alto) = getimagesize($_FILES["fotoPortada"]["tmp_name"]);	

					$nuevoAncho = 1280;
					$nuevoAlto = 720;


					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					ACCORDING TO THE TYPE OF IMAGE WE APPLY THE FUNCTIONS BY DEFAULT OF PHP
					=============================================*/

					if($_FILES["fotoPortada"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						WE SAVE THE IMAGE IN THE DIRECTORY
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaPortada = "vistas/img/cabeceras/".$_POST["rutaSubCategoria"].".jpg";

						$origen = imagecreatefromjpeg($_FILES["fotoPortada"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaPortada);

					}

					if($_FILES["fotoPortada"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						WE SAVE THE IMAGE IN THE DIRECTORY
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaPortada = "vistas/img/cabeceras/".$_POST["rutaSubCategoria"].".png";

						$origen = imagecreatefrompng($_FILES["fotoPortada"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);
    			
    					imagesavealpha($destino, TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaPortada);

					}

				}

				/*=============================================
				VALIDAR IMAGEN OFERTA
				VALIDATE IMAGE OFFER
				=============================================*/

				$rutaOferta = $_POST["antiguaFotoOferta"];

				if(isset($_FILES["fotoOferta"]["tmp_name"]) && !empty($_FILES["fotoOferta"]["tmp_name"])){

					/*=============================================
					BORRAMOS ANTIGUA FOTO OFERTA
					ERASE OLD PHOTO OFFER
					=============================================*/

					unlink($_POST["antiguaFotoOferta"]);

					/*=============================================
					DEFINIMOS LAS MEDIDAS
					WE DEFINE THE MEASURES
					=============================================*/

					list($ancho, $alto) = getimagesize($_FILES["fotoOferta"]["tmp_name"]);

					$nuevoAncho = 640;
					$nuevoAlto = 430;


					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					ACCORDING TO THE TYPE OF IMAGE WE APPLY THE FUNCTIONS BY DEFAULT OF PHP
					=============================================*/

					if($_FILES["fotoOferta"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						WE SAVE THE IMAGE IN THE DIRECTORY
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaOferta = "vistas/img/ofertas/".$_POST["rutaSubCategoria"].".jpg";

						$origen = imagecreatefromjpeg($_FILES["fotoOferta"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaOferta);

					}

					if($_FILES["fotoOferta"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						WE SAVE THE IMAGE IN THE DIRECTORY
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaOferta = "vistas/img/ofertas/".$_POST["rutaSubCategoria"].".png";

						$origen = imagecreatefrompng($_FILES["fotoOferta"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);
    			
    					imagesavealpha($destino, TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaOferta);

					}

				}			

				/*=============================================
				PREGUNTAMOS SI VIENE OFERTE EN CAMINO
				WE ASK IF COMING OFFER IN ROAD
				=============================================*/

				if($_POST["selActivarOferta"] == "oferta"){

					$datos = array("id"=>$_POST["editarIdSubCategoria"],
								   "subcategoria"=>$_POST["editarTituloSubCategoria"],
								   "idCategoria"=>$_POST["seleccionarCategoria"],
								   "ruta"=>$_POST["rutaSubCategoria"],
								   "estado"=> 1,
								   "idCabecera"=>$_POST["editarIdCabecera"],
								   "titulo"=>$_POST["editarTituloSubCategoria"],
								   "descripcion"=> $_POST["descripcionSubCategoria"],
								   "palabrasClaves"=> $_POST["pClavesSubCategoria"],
								   "imgPortada"=>$rutaPortada,
								   "oferta"=>1,
								   "precioOferta"=>$_POST["precioOferta"],
								   "descuentoOferta"=>$_POST["descuentoOferta"],
								   "imgOferta"=>$rutaOferta,
								   "finOferta"=>$_POST["finOferta"]);

				}else{

					$datos = array("id"=>$_POST["editarIdSubCategoria"],
								   "subcategoria"=>$_POST["editarTituloSubCategoria"],
								   "idCategoria"=>$_POST["seleccionarCategoria"],
								   "ruta"=>$_POST["rutaSubCategoria"],
								   "estado"=> 1,
								   "idCabecera"=>$_POST["editarIdCabecera"],
								   "titulo"=>$_POST["editarTituloSubCategoria"],
								   "descripcion"=> $_POST["descripcionSubCategoria"],
								   "palabrasClaves"=> $_POST["pClavesSubCategoria"],
								   "imgPortada"=>$rutaPortada,
								   "oferta"=>0,
								   "precioOferta"=>0,
								   "descuentoOferta"=>0,
								   "imgOferta"=>"",								   
								   "finOferta"=>"");	

					if($_POST["antiguaFotoOferta"] != ""){

						unlink($_POST["antiguaFotoOferta"]);

					}

				}

				$traerProductos = ModeloProductos::mdlMostrarProductos("productos", "id_subcategoria", $datos["id"]);

				foreach ($traerProductos as $key => $value) {

					if($value["precio"] != 0){
					
						if($datos["oferta"] != 0 && $datos["precioOferta"] == 0){

							$precioOfertaActualizado = $value["precio"]-($value["precio"]*$datos["descuentoOferta"]/100);
							$descuentoOfertaActualizado = $datos["descuentoOferta"];
					
						}

						if($datos["oferta"] != 0 && $datos["descuentoOferta"] == 0){	

							$precioOfertaActualizado = $datos["precioOferta"];
							$descuentoOfertaActualizado = 100 - ($datos["precioOferta"]*100/$value["precio"]);
					
						}

					}

					ModeloProductos::mdlActualizarOfertaProductos("productos", $datos, "ofertadoPorSubCategoria", $precioOfertaActualizado, $descuentoOfertaActualizado, $value["id"]);
				
				}
			
				ModeloCabeceras::mdlEditarCabecera("cabeceras", $datos);

				$respuesta = ModeloSubCategorias::mdleditarSubCategoria("subcategorias", $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La subcategoría ha sido editada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "subcategorias";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La subcategoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "subcategorias";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	ELIMINAR SUBCATEGORIA
	DELETE SUBCATEGORY
	=============================================*/

	static public function ctrEliminarSubCategoria(){

		if(isset($_GET["idSubCategoria"])){

			$datos = $_GET["idSubCategoria"];

			/*=============================================
			ELIMINAR IMAGEN OFERTA
			DELETE IMAGE OFFER
			=============================================*/

			if($_GET["imgOferta"] != ""){

				unlink($_GET["imgOferta"]);		

			}

			/*=============================================
			ELIMINAR CABECERA
			DELETE HEADER
			=============================================*/

			if($_GET["imgPortada"] != "" && $_GET["imgPortada"] != "vistas/img/cabeceras/default/default.jpg"){

				unlink($_GET["imgPortada"]);		

			}

			ModeloCabeceras::mdlEliminarCabecera("cabeceras", $_GET["rutaCabecera"]);

			/*=============================================
			QUITAR LAS SUBATEGORIAS DE LOS PRODUCTOS
			REMOVE THE PRODUCTS SUB-HAIRS
			=============================================*/

			$traerProductos = ModeloProductos::mdlMostrarProductos("productos", "id_subcategoria", $_GET["idSubCategoria"]);

			foreach ($traerProductos as $key => $value) {

				$item1 = "id_subcategoria";
				$valor1 = 0;
				$item2 = "id";
				$valor2 = $value["id"];

				ModeloProductos::mdlActualizarProductos("productos", $item1, $valor1, $item2, $valor2);	
				
			}

			$respuesta = ModeloSubCategorias::mdlEliminarSubCategoria("subcategorias", $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La subcategoría ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "subcategorias";

								}
							})

				</script>';

			}		

		}

	}

}