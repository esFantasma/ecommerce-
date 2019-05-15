<?php

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

// require_once "../controladores/subcategorias.controlador.php";
require_once "../modelos/subcategorias.modelo.php";

// require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class AjaxCategorias{

  /*=============================================
  ACTIVAR CATEGORIA
  ACTIVATE CATEGORY
  =============================================*/	

  public $activarCategoria;
  public $activarId;

  public function ajaxActivarCategoria(){


    ModeloSubCategorias::mdlActualizarSubCategorias("subcategorias", "estado", $this->activarCategoria, "id_categoria", $this->activarId);

    ModeloProductos::mdlActualizarProductos("productos", "estado", $this->activarCategoria, "id_categoria", $this->activarId);

  	$respuesta = ModeloCategorias::mdlActualizarCategoria("categorias", "estado", $this->activarCategoria, "id", $this->activarId);

  	echo $respuesta;

  }

  /*=============================================
  VALIDAR NO REPETIR CATEGORÍA
  DO NOT REPEAT CATEGORY
  =============================================*/ 

  public $validarCategoria;

  public function ajaxValidarCategoria(){

    $item = "categoria";
    $valor = $this->validarCategoria;

    $respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);

    echo json_encode($respuesta);

  }

  /*=============================================
  EDITAR CATEGORIA
  EDIT CATEGORY
  =============================================*/ 

  public $idCategoria;

  public function ajaxEditarCategoria(){

    $item = "id";
    $valor = $this->idCategoria;

    $respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);

    echo json_encode($respuesta);

  }

}

/*=============================================
ACTIVAR CATEGORIA
ACTIVATE CATEGORY
=============================================*/

if(isset($_POST["activarCategoria"])){

	$activarCategoria = new AjaxCategorias();
	$activarCategoria -> activarCategoria = $_POST["activarCategoria"];
	$activarCategoria -> activarId = $_POST["activarId"];
	$activarCategoria -> ajaxActivarCategoria();

}

/*=============================================
VALIDAR NO REPETIR CATEGORÍA
VALIDATE DO NOT REPEAT CATEGORY
=============================================*/

if(isset( $_POST["validarCategoria"])){

  $valCategoria = new AjaxCategorias();
  $valCategoria -> validarCategoria = $_POST["validarCategoria"];
  $valCategoria -> ajaxValidarCategoria();

}

/*=============================================
EDITAR CATEGORIA
EDIT CATEGORY
=============================================*/
if(isset($_POST["idCategoria"])){

  $editar = new AjaxCategorias();
  $editar -> idCategoria = $_POST["idCategoria"];
  $editar -> ajaxEditarCategoria();

}



