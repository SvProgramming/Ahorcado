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
    $modoJuego=$_POST['modoJuego'];

    $resultado=$objSingleplayerControlador->evaluarLetra($modoJuego,$letra,$tiempo);

    if($resultado[0])
    {
        session_start();

        $_SESSION['arrayLetrasUsadas'][]=$resultado[1];
    }
}

if(isset($_POST['iniciarJuego']))
{
    $resultado=$objSingleplayerControlador->iniciarJuego();

    if($resultado=="string")
    {
        echo $resultado;
    }
}

if(isset($_POST['noIngresoNada']))
{
    $resultado=$objSingleplayerControlador->noIngresoNada();
}

if(isset($_POST['actualizarLetrasUsadas']))
{
    $resultado=$objSingleplayerControlador->actualizarLetrasUsadas();
    exit();
}

if(isset($_POST['finalizarJuegoContraReloj']))
{
    echo $objSingleplayerControlador->finalizarJuegoContraReloj();
    exit();
}

$resultado=$objSingleplayerControlador->mostrarEspacioLetras();

echo $resultado;

?>
