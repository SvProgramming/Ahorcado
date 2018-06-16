<?php

class SingleplayerVista
{
    public function cargarVista()
    {
    	require_once('Vistas/Paginas/Singleplayer/Plantillas/cabeceraSingleplayer.php');
        require_once('Vistas/Paginas/Singleplayer/index.php');
        require_once('Vistas/Paginas/Singleplayer/Plantillas/pieSingleplayer.php');
    }

    public function normal()
    {
    	require_once('Vistas/Paginas/Singleplayer/Plantillas/cabeceraSingleplayerNormal.php');
        require_once('Vistas/Paginas/Singleplayer/Menus/menu.php');
        require_once('Vistas/Paginas/Singleplayer/normal.php');
        require_once('Vistas/Paginas/Singleplayer/Plantillas/pieSingleplayerNormal.php');
    }
}

?>
