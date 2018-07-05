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

    public function agregarPalabra()
    {
        require_once('Vistas/Paginas/Singleplayer/Plantillas/cabeceraSingleplayerAgregarPalabra.php');
        require_once('Vistas/Paginas/Singleplayer/Menus/menu.php');
        require_once('Vistas/Paginas/Singleplayer/agregarPalabra.php');
        require_once('Vistas/Paginas/Singleplayer/Plantillas/pieSingleplayerAgregarPalabra.php');
    }

    public function contraReloj()
    {
        require_once('Vistas/Paginas/Singleplayer/Plantillas/cabeceraSingleplayerContraReloj.php');
        require_once('Vistas/Paginas/Singleplayer/Menus/menu.php');
        require_once('Vistas/Paginas/Singleplayer/contraReloj.php');
        require_once('Vistas/Paginas/Singleplayer/Plantillas/pieSingleplayerContraReloj.php');
    }
}

?>
