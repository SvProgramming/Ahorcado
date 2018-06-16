<?php 
define("__ROOT__", dirname(dirname(__FILE__)));
require_once (__ROOT__."/Core/encriptacion.php");
require_once (__ROOT__."/Modelos/logout.modelo.php");
require_once (__ROOT__."/Vistas/logout.vista.php");

class LogoutControlador
{
    private $modelo;
    private $vista;

    function __construct($modelo,$vista)
    {
        $this->modelo = new $modelo;
        $this->vista = new $vista;
    }

    public function cargarVista()
    {
    	$this->vista->cargarVista();
    }

    public function comprobarSession()
    {
        session_start();

        if(isset($_SESSION['usuario']))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function ajax($pagina)
    {
        define('BaseDir', getcwd());
        require_once BaseDir.'/Core/Ajax/'.$pagina.'.ajax.php';
    }

    public function actualizarEstadoJugador($usuario)
    {
        $resultado=$this->modelo->actualizarEstadoJugador($usuario);

        return $resultado;
    }
}

?>
