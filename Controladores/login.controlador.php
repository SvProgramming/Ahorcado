<?php 
define("__ROOT__", dirname(dirname(__FILE__)));
require_once (__ROOT__."/Core/encriptacion.php");
require_once (__ROOT__."/Modelos/login.modelo.php");
require_once (__ROOT__."/Vistas/login.vista.php");

class LoginControlador
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

    public function verificarUsuario($usuario)
    {
        $resultado = $this->modelo->verificarUsuario($usuario);

        if($resultado->num_rows == 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function comprobarLogueo($usuario,$contra)
    {
        $encriptacion= new encriptacion();

        $resultado = $this->modelo->obtenerContra($usuario);

        $contraEncriptada = $resultado->fetch_assoc();

        $contraDesencriptada = $encriptacion->desencriptar($contraEncriptada['contra']);

        if($contra == $contraDesencriptada)
        {
            return true;
        }
        else
        {
            return 'La contraseña es incorrecta';
        }
    }

    public function crearLogeo($usuario)
    {

        $resultado=$this->modelo->modificarEnLinea($usuario);

        if(gettype($resultado)=="string")
        {
            return $resultado;
        }
        else
        {
            session_start();

            $_SESSION['usuario'] = trim($usuario);
            return true;
        }
    }

}

?>
