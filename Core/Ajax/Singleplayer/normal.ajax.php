<?php
define(__ROOT__,dirname(dirname(dirname(dirname(__FILE__)))));
include_once(__ROOT__."/Controladores/singleplayer.controlador.php");

$objSingleplayerControlador=new SingleplayerControlador('SingleplayerModelo','SingleplayerVista');

if(isset($_POST['juegoFinalizado']))
{
    $resultado=$objSingleplayerControlador->juegoFinalizado();

    echo $resultado;

    exit();
}

if(isset($_POST['evaluarLetra']))
{
    $letra=$_POST['letra'];
    $tiempo=$_POST['tiempo'];

    $resultado=$objSingleplayerControlador->evaluarLetra($letra,$tiempo);
}

if(isset($_POST['iniciarJuego']))
{
    $resultado=$objSingleplayerControlador->iniciarJuego();

    if($resultado=="string")
    {
        echo $resultado;
    }
}

$resultado=$objSingleplayerControlador->mostrarEspacioLetras();

echo $resultado;

?>
