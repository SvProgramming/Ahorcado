<?php 

class controladorNoEnc
{
    private $modelo;
    private $vista;

    function __construct($modelo,$vista)
    {
        $this->modelo = $modelo;
        $this->vista = $vista;
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
}

?>
