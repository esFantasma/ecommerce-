<?php

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxUsuarios{

	/*=============================================
	VALIDAR EMAIL EXISTENTE
	VALIDATE EXISTING EMAIL
	=============================================*/	

	public $validarEmail;

	public function ajaxValidarEmail(){

		$datos = $this->validarEmail;

		$respuesta = ControladorUsuarios::ctrMostrarUsuario("email", $datos);

		echo json_encode($respuesta);

	}

	/*=============================================
	REGISTRO CON FACEBOOK
	REGISTRATION WITH FACEBOOK
	=============================================*/

	public $email;
	public $nombre;
	public $foto;

	public function ajaxRegistroFacebook(){

		$datos = array("nombre"=>$this->nombre,
					   "email"=>$this->email,
					   "foto"=>$this->foto,
					   "password"=>"null",
					   "modo"=>"facebook",
					   "verificacion"=>0,
					   "emailEncriptado"=>"null");

		$respuesta = ControladorUsuarios::ctrRegistroRedesSociales($datos);

		echo $respuesta;

	}	

	/*=============================================
	AGREGAR A LISTA DE DESEOS
	ADD TO LIST OF WISHES
	=============================================*/	

	public $idUsuario;
	public $idProducto;

	public function ajaxAgregarDeseo(){

		$datos = array("idUsuario"=>$this->idUsuario,
					   "idProducto"=>$this->idProducto);

		$respuesta = ControladorUsuarios::ctrAgregarDeseo($datos);

		echo $respuesta;

	}

	/*=============================================
	QUITAR PRODUCTO DE LISTA DE DESEOS
	REMOVE PRODUCT FROM WISH LIST
	=============================================*/

	public $idDeseo;	

	public function ajaxQuitarDeseo(){

		$datos = $this->idDeseo;

		$respuesta = ControladorUsuarios::ctrQuitarDeseo($datos);

		echo $respuesta;

	}


}

/*=============================================
VALIDAR EMAIL EXISTENTE
VALIDATE EXISTING EMAIL
=============================================*/	

if(isset($_POST["validarEmail"])){

	$valEmail = new AjaxUsuarios();
	$valEmail -> validarEmail = $_POST["validarEmail"];
	$valEmail -> ajaxValidarEmail();

}

/*=============================================
REGISTRO CON FACEBOOK
REGISTRATION WITH FACEBOOK
=============================================*/


if(isset($_POST["email"])){

	$regFacebook = new AjaxUsuarios();
	$regFacebook -> email = $_POST["email"];
	$regFacebook -> nombre = $_POST["nombre"];
	$regFacebook -> foto = $_POST["foto"];
	$regFacebook -> ajaxRegistroFacebook();

}

/*=============================================
AGREGAR A LISTA DE DESEOS
ADD TO LIST OF WISHES
=============================================*/	

if(isset($_POST["idUsuario"])){

	$deseo = new AjaxUsuarios();
	$deseo -> idUsuario = $_POST["idUsuario"];
	$deseo -> idProducto = $_POST["idProducto"];
	$deseo ->ajaxAgregarDeseo();
}

/*=============================================
QUITAR PRODUCTO DE LISTA DE DESEOS
REMOVE PRODUCT FROM WISH LIST
=============================================*/

if(isset($_POST["idDeseo"])){

	$quitarDeseo = new AjaxUsuarios();
	$quitarDeseo -> idDeseo = $_POST["idDeseo"];
	$quitarDeseo ->ajaxQuitarDeseo();
}
