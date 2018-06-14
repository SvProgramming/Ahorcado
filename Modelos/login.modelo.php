<?php
define("__ROOT__", dirname(dirname(__FILE__)));
require_once(__ROOT__ . '/Core/conexDB.php');
require_once (__ROOT__."/Core/encriptacion.php");
$encriptacion= new encriptacion();

class LoginModelo
{
	public function verificarUsuario($usuario)
    {
        $conex=new funcionesDB();

        $resultado=$conex->ConsultaGeneral('Jugador', "usuario='$usuario'");

        return $resultado;
    }

    public function obtenerContra($usuario)
    {
        $conex=new funcionesDB();

        $resultado=$conex->ConsultaPersonalizada("SELECT contra from Jugador where usuario='$usuario'");

        return $resultado;
    }  

    public function modificarEnLinea($usuario)
    {
        $conex=new funcionesDB();

        $resultado=$conex->ActualizarRegistro('Jugador', 'enLinea', '1', "usuario='$usuario'");

        return $resultado;
    }
}

?>
