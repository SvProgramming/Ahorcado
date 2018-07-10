<?php
define("__ROOT__", dirname(dirname(__FILE__)));
require_once(__ROOT__ . '/Core/conexDB.php');
require_once (__ROOT__."/Core/encriptacion.php");
$encriptacion= new encriptacion();

class RegistroModelo
{
	public function verificarUsuario($usuario)
    {
        $conex=new funcionesDB();

        $resultado=$conex->ConsultaGeneral('Jugador', "usuario='$usuario'");

        return $resultado;
    }

    public function verificarCorreo($correo)
    {
        $conex=new funcionesDB();

        $resultado=$conex->ConsultaGeneral('Jugador', "email='$correo'");

        return $resultado;
    }

    public function registrarUsuario($usuario,$contra,$email,$codigoVerificacion)
    {
        $conex=new funcionesDB();

        $resultado=$conex->insertar('Jugador', '', "'$usuario','$contra','$email',0,0,0,0,'$codigoVerificacion'");

        return $resultado;
    }

    public function borrarUsuario($usuario)
    {
        $conex=new funcionesDB();

        $resultado=$conex->EliminarRegistro('Jugador',"usuario='$usuario'");

        return $resultado;
    }
}

?>
