<?php

class RegistroVista
{
    public function cargarVista()
    {
    	require_once('Vistas/Paginas/Plantillas/cabeceraRegistro.php');
        require_once('Vistas/Paginas/registro.php');
        require_once('Vistas/Paginas/Plantillas/pieRegistro.php');
    }

    public function completo()
    {
    	require_once('Vistas/Paginas/Plantillas/cabeceraRegistroCompleto.php');
        require_once('Vistas/Paginas/registroCompleto.php');
        require_once('Vistas/Paginas/Plantillas/pieRegistroCompleto.php');
    }
}

?>
