<?php

class ControladorSlide{

	/*=============================================
	MOSTRAR SLIDE
	SHOW SLIDE
	=============================================*/

	static public function ctrMostrarSlide(){

		$tabla = "slide";

		$respuesta = ModeloSlide::mdlMostrarSlide($tabla);

		return $respuesta;
		
	}

	/*=============================================
	CREAR SLIDE
	CREATE SLIDE
	=============================================*/

	static public function ctrCrearSlide($datos){

		$tabla = "slide";

		$traerSlide = ModeloSlide::mdlMostrarSlide($tabla);

		foreach ($traerSlide as $key => $value) {
			
		}

		$orden = $value["orden"] + 1;

		$respuesta = ModeloSlide::mdlCrearSlide($tabla, $datos, $orden);

		return $respuesta;

	}

	/*=============================================
	ACTUALIZAR ORDEN SLIDE
	UPDATE SLIDE ORDER
	=============================================*/

	static public function ctrActualizarOrdenSlide($datos){

		$tabla = "slide";

		$respuesta = ModeloSlide::mdlActualizarOrdenSlide($tabla, $datos);

		return $respuesta;

	}

	/*=============================================
	ACTUALIZAR SLIDE
	UPDATE SLIDE
	=============================================*/

	static public function ctrActualizarSlide($datos){

		$tabla = "slide";
		$ruta1 = null;
		$ruta2 = null;

		/*=============================================
		SI HAY CAMBIO DE FONDO
		IF THERE IS CHANGE OF FUND
		=============================================*/	

		if($datos["subirFondo"] != null){

			/*=============================================
			BORRAMOS EL ANTIGUO FONDO DEL SLIDE
			ERASE THE OLD BACKGROUND OF THE SLIDE
			=============================================*/	

			if($datos["imgFondo"] != "vistas/img/slide/default/fondo.jpg"){	

				unlink("../".$datos["imgFondo"]);

			}

			/*=============================================
			CREAMOS EL DIRECTORIO SI NO EXISTE
			WE CREATE THE DIRECTORY IF THERE DOES NOT EXIST
			=============================================*/	

			$directorio = "../vistas/img/slide/slide".$datos["id"];

			if(!file_exists($directorio)){

				mkdir($directorio, 0755);

			}

			/*=============================================
			CAPTURAMOS EL ANCHO Y ALTO DEL FONDO DEL SLIDE
			CAPTURE THE WIDTH AND HIGH OF THE SLIDE FUND
			=============================================*/

			list($ancho, $alto) = getimagesize($datos["subirFondo"]["tmp_name"]);	

			$nuevoAncho = 1600;
			$nuevoAlto = 520;

			$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

			if($datos["subirFondo"]["type"] == "image/jpeg"){

				$ruta1 = $directorio."/fondo.jpg";

				$origen = imagecreatefromjpeg($datos["subirFondo"]["tmp_name"]);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagejpeg($destino, $ruta1);
		
			}

			if($datos["subirFondo"]["type"] == "image/png"){

				$ruta1 = $directorio."/fondo.png";

				$origen = imagecreatefrompng($datos["subirFondo"]["tmp_name"]);

				imagealphablending($destino, FALSE);
    			
    			imagesavealpha($destino, TRUE);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagepng($destino, $ruta1);
		
			}


			$rutaFondo = substr($ruta1, 3);

		}else{

			$rutaFondo = $datos["imgFondo"];

		}

		/*=============================================
		SI HAY CAMBIO DE PRODUCTO
		IF THERE IS A PRODUCT CHANGE
		=============================================*/		

		if($datos["subirImgProducto"] != null){

			/*=============================================
			CREAMOS EL DIRECTORIO SI NO EXISTE
			WE CREATE THE DIRECTORY IF THERE DOES NOT EXIST
			=============================================*/		

			$directorio = "../vistas/img/slide/slide".$datos["id"];

			if(!file_exists($directorio)){

				mkdir($directorio, 0755);

			}

			/*=============================================
			CAPTURAMOS EL ANCHO Y ALTO DE LA IMAGEN DEL PRODUCTO
			CAPTURE THE WIDTH AND HIGH OF THE PRODUCT IMAGE
			=============================================*/		

			list($ancho, $alto) = getimagesize($datos["subirImgProducto"]["tmp_name"]);

			$nuevoAncho = 600;
			$nuevoAlto = 600;

			$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

			if($datos["subirImgProducto"]["type"] == "image/jpeg"){

				$ruta2 = $directorio."/producto.jpg";

				$origen = imagecreatefromjpeg($datos["subirImgProducto"]["tmp_name"]);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagejpeg($destino, $ruta2);
		
			}

			if($datos["subirImgProducto"]["type"] == "image/png"){

				$ruta2 = $directorio."/producto.png";

				$origen = imagecreatefrompng($datos["subirImgProducto"]["tmp_name"]);

				imagealphablending($destino, FALSE);
    			
    			imagesavealpha($destino, TRUE);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagepng($destino, $ruta2);
		
			}

			$rutaProducto = substr($ruta2, 3);

		}else{

			$rutaProducto = $datos["imgProducto"];

		}

		$respuesta = ModeloSlide::mdlActualizarSlide($tabla, $rutaFondo, $rutaProducto, $datos);

		return $respuesta;

	}

	/*=============================================
	ELIMINAR SLIDE
	ELIMINATE SLIDE
	=============================================*/

	public function ctrEliminarSlide(){

		if(isset($_GET["idSlide"])){

			if($_GET["imgFondo"] != "vistas/img/slide/default/fondo.jpg"){

				unlink($_GET["imgFondo"]);

			}

			if($_GET["imgProducto"] != ""){

				unlink($_GET["imgProducto"]);

			}

			rmdir('vistas/img/slide/slide'.$_GET["idSlide"]);

			$tabla = "slide";
			$id = $_GET["idSlide"];

			$respuesta = ModeloSlide::mdlEliminarSlide($tabla, $id);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El slide ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",		
					  }).then((result) => {
								if (result.value) {

								window.location = "slide";

								}
							})

				</script>';

			}		

		}


	}


}