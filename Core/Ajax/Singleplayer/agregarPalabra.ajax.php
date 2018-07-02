<?php
define(__ROOT__,dirname(dirname(dirname(dirname(__FILE__)))));
include_once(__ROOT__."/Controladores/singleplayer.controlador.php");

$objSingleplayerControlador=new SingleplayerControlador('SingleplayerModelo','SingleplayerVista');

if(isset($_POST['agregarPalabra']))
{
    $palabra=$_POST['palabra'];

    $pista=$_POST['pista'];

    $resultado=$objSingleplayerControlador->agregarPalabra($palabra,$pista);
}

?>
