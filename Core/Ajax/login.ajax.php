<?php 
define(__ROOT__,dirname(dirname(dirname(__FILE__))));
include_once(__ROOT__."/Controladores/home.controlador.php");

$objLoginControlador = new LoginControlador('LoginModelo','LoginVista');

if(isset($_POST['verificarUsuario']))
{
	$usuario = $_POST['usuario'];

	$resultado=$objLoginControlador->verificarUsuario($usuario);

	if($resultado)
	{
		echo true;
	}
	else
	{
		echo false;
	}
}

if(isset($_POST['comprobarContra']))
{
    $username = $_POST['usuario'];
    $password = $_POST['contra'];

    $resultado=$objLoginControlador->comprobarLogueo($username,$password);

    if(gettype($resultado)=="string")
    {
        echo $resultado;
    }
    else
    {
    	$resultado=$objLoginControlador->crearLogeo($username);

    	echo $resultado;
	}
}
?>