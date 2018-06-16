<?php
define("__ROOT__", dirname(dirname(__FILE__)));
require_once(__ROOT__ . '/Core/conexDB.php');
require_once (__ROOT__."/Core/encriptacion.php");
$encriptacion= new encriptacion();

class LogoutModelo
{
    public function actualizarEstadoJugador($usuario)
    {
        $conex=new funcionesDB();

        $resultado=$conex->ActualizarRegistro('Jugador', 'enLinea', '0', "usuario='$usuario'");

        return $resultado;

    }
}

?>
