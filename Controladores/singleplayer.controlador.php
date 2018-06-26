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

    public function ajax($pagina)
    {
        define('BaseDir', getcwd());
        require_once BaseDir.'/Core/Ajax/Singleplayer/'.$pagina.'.ajax.php';
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

    public function iniciarJuego()
    {
        session_start();

        unset($_SESSION['letras']);

        $resultado=$this->buscarPalabra();

        if($resultado=="string")
        {
            echo $resultado;
            exit();
        }
        else
        {
            $_SESSION['palabra'] = $resultado;

            $_SESSION['vidas'] = 6;

            $_SESSION['juegoFinalizado'] = false;

            $_SESSION['puntaje'] = 0;

            for($i=0;$i<strlen($_SESSION['palabra']['texto']);$i++)
            {
                if(substr($_SESSION['palabra']['texto'], $i, 1) === " ")
                {
                    $_SESSION['letras'][$i] = " ";
                }
                else
                {
                    $_SESSION['letras'][$i] = 0;
                }
            }
        }        
    }


    public function buscarPalabra()
    {
        $resultado=$this->modelo->cantidadDePalabras();

        if($resultado=="string")
        {
            return $resultado;
        }
        else
        {  
            $idPalabra = mt_rand(1, $resultado->num_rows);

            $resultado=$this->modelo->buscarPalabra($idPalabra);

            return $resultado->fetch_assoc();
        }
    }
}

?>
