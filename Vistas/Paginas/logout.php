<?php
define(__ROOT__,dirname(dirname(dirname(__FILE__))));
include_once(__ROOT__."/Controladores/logout.controlador.php");

$objLogoutControlador=new LogoutControlador('LogoutModelo','LogoutVista');

if(!$objLogoutControlador->comprobarSession())
{
    header('location: login');
}

$resultado=$objLogoutControlador->actualizarEstadoJugador($_SESSION['usuario']);

if(gettype($resultado)=="string")
{
    echo "Fallo al cerrar sesion";
}
else
{
    session_destroy();
    header('location: login');
}
?>
