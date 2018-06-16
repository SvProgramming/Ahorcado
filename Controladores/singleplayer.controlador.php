<?php 
define("__ROOT__", dirname(dirname(__FILE__)));
require_once (__ROOT__."/Core/encriptacion.php");
require_once (__ROOT__."/Modelos/login.modelo.php");
require_once (__ROOT__."/Vistas/login.vista.php");

class SingleplayerControlador
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

        public function highScore($usuario)
    {
        $resultado=$this->modelo->buscarPuntajes($usuario);

        if(gettype($resultado)=="string")
        {
            return $resultado;
        }
        else
        {
            if($resultado->num_rows == 0)
            {
                return "0";
            }
            else
            {
                $resultado=$this->modelo->buscarPuntajeMaximo($usuario);

                if(gettype($resultado)=="string")
                {
                    return $resultado;
                }
                else
                {
                    return $resultado->fetch_assoc();
                }
            }
        }
    }
}

?>
