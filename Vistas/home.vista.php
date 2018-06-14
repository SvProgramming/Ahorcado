<?php

class HomeVista
{
    public function cargarVista()
    {
    	require_once('Vistas/Paginas/Plantillas/cabeceraHome.php');
        require_once('Vistas/Paginas/home.php');
        require_once('Vistas/Paginas/Plantillas/pieHome.php');
    }
}

?>
