<?php 
define(__ROOT__,dirname(dirname(dirname(__FILE__))));
include_once(__ROOT__."/Controladores/registro.controlador.php");

$objRegistroControlador = new RegistroControlador('RegistroModelo','RegistroVista');

if(isset($_POST['verificarUsuario']))
{
	$usuario = $_POST['usuario'];

	$resultado=$objRegistroControlador->verificarUsuario($usuario);

	if($resultado)
	{
		echo true;
	}
	else
	{
		echo false;
	}
}

if(isset($_POST['verificarCorreo']))
{
	$correo = $_POST['correo'];

	$resultado=$objRegistroControlador->verificarCorreo($correo);

	if($resultado)
	{
		echo true;
	}
	else
	{
		echo false;
	}
}

if(isset($_POST['registrar']))
{
	$usuario=$_POST['usuario'];
	$contra=$_POST['contra'];
	$email=$_POST['email'];

	$resultado=$objRegistroControlador->registrarUsuario($usuario,$contra,$email);

	if(!($resultado===1))
	{
		$objRegistroControlador->borrarUsuario($usuario);
	}

	echo $resultado;
}

?>