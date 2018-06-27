<?php
define("__ROOT__", dirname(dirname(__FILE__)));
require_once(__ROOT__ . '/Core/conexDB.php');
require_once (__ROOT__."/Core/encriptacion.php");
$encriptacion= new encriptacion();

class SingleplayerModelo
{
    public function buscarPuntajes($usuario)
    {
        $conex=new funcionesDB();

        $resultado=$conex->ConsultaGeneral('Puntuacion', "usuario='$usuario'");

        return $resultado;
    }

    public function buscarPuntajeMaximo($usuario)
    {
        $conex=new funcionesDB();

        $resultado=$conex->ConsultaPersonalizada("SELECT MAX(puntaje) as puntos FROM Puntuacion WHERE usuario = '$usuario'");

        return $resultado;
    }

    public function buscarPalabra($idPalabra)
    {
        $conex=new funcionesDB();

        $resultado=$conex->ConsultaPersonalizada("SELECT * FROM Palabra WHERE idPalabra=$idPalabra");

        return $resultado;
    }

    public function cantidadDePalabras()
    {
        $conex=new funcionesDB();

        $resultado=$conex->ConsultaPersonalizada("SELECT count(texto) as conteo FROM Palabra");

        return $resultado;
    }

    public function agregarPuntos($puntos,$usuario)
    {
        $conex=new funcionesDB();

        $resultado=$conex->insertar('Puntuacion', 'puntaje,usuario', "'$puntos','$usuario'");

        return $resultado;
    }

    public function obtenerPuntajeMaximo($usuario)
    {
        $conex=new funcionesDB();

        $resultado=$conex->ConsultaGeneral('Jugador', "usuario='$usuario'");

        return $resultado;
    }

    public function actualizarMaximoPuntaje($puntos,$usuario)
    {
        $conex=new funcionesDB();

        $resultado=$conex->ActualizarRegistros('Jugador', "puntajeMaximo=$puntos", "usuario='$usuario'");

        return $resultado;
    }
}

?>
