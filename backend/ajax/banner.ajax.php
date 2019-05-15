<?php

require_once "../controladores/banner.controlador.php";
require_once "../modelos/banner.modelo.php";

require_once "../modelos/categorias.modelo.php";
require_once "../modelos/subcategorias.modelo.php";

class AjaxBanner{

  /*=============================================
    ACTIVAR BANNER
    ACTIVATE BANNER
    =============================================*/ 

  public $activarBanner;
  public $activarId;

  public function ajaxActivarBanner(){

    $respuesta = ModeloBanner::mdlActualizarBanner("banner", "estado", $this->activarBanner, "id", $this->activarId);

    echo $respuesta;

  }

    /*=============================================
    TRAER RUTAS DE ACUERDO A LA TABLA
    BRING ROUTES ACCORDING TO THE TABLE
    =============================================*/ 

    public $tabla;

    public function ajaxTraerRutasBanner(){

    $tabla = $this->tabla;
      $item = null;
      $valor = null;

    if($tabla == "categorias"){

        $respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);

        echo json_encode($respuesta);

    }

    if($tabla == "subcategorias"){

          $respuesta = ModeloSubCategorias::mdlMostrarSubCategorias($tabla, $item, $valor);

          echo json_encode($respuesta);

    }

    }

    /*=============================================
   VALIDAR RUTA BANNER
   VALIDATE BANNER ROUTE
    =============================================*/ 

  public $validarRuta;

    public function ajaxValidarRuta(){

      $item = "ruta";
      $valor = $this->validarRuta;

      $respuesta = ControladorBanner::ctrMostrarBanner($item, $valor);

      echo json_encode($respuesta);

    }

    /*=============================================
    EDITAR BANNER
    EDIT BANNER
    =============================================*/ 

    public $idBanner;

    public function ajaxEditarBanner(){

      $item = "id";
      $valor = $this->idBanner;

      $respuesta = ControladorBanner::ctrMostrarBanner($item, $valor);

      echo json_encode($respuesta);

    }

}

/*=============================================
ACTIVAR BANNER
ACTIVATE BANNER
=============================================*/

if(isset($_POST["activarBanner"])){

  $activarBanner = new AjaxBanner();
  $activarBanner -> activarBanner = $_POST["activarBanner"];
  $activarBanner -> activarId = $_POST["activarId"];
  $activarBanner -> ajaxActivarBanner();

}

/*=============================================
TRAER RUTAS DE ACUERDO A LA TABLA
BRING ROUTES ACCORDING TO THE TABLE
=============================================*/
if(isset($_POST["tabla"])){

  $traerRutas = new AjaxBanner();
  $traerRutas -> tabla = $_POST["tabla"];
  $traerRutas -> ajaxTraerRutasBanner();

}

/*=============================================
VALIDAR NO REPETIR RUTA
DO NOT REPEAT ROUTE
=============================================*/

if(isset( $_POST["validarRuta"])){

  $valRuta = new AjaxBanner();
  $valRuta -> validarRuta = $_POST["validarRuta"];
  $valRuta -> ajaxValidarRuta();

}

/*=============================================
EDITAR BANNER
EDIT BANNER
=============================================*/
if(isset($_POST["idBanner"])){

  $editar = new AjaxBanner();
  $editar -> idBanner = $_POST["idBanner"];
  $editar -> ajaxEditarBanner();

}
