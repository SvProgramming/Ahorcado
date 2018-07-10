<?php
define(__ROOT__,dirname(dirname(dirname(__FILE__))));
include_once(__ROOT__."/Controladores/registro.controlador.php");

$objRegistroControlador = new RegistroControlador('RegistroModelo','RegistroVista');

if($objRegistroControlador->comprobarSession())
{
    header('location: '.urlBase);
}

?>
<div class="centrado">

<center>
    Su cuenta ha sido creada. Por favor ingrese al juego para comprobar su correo desde aqui
</center>

<center><button class='opciones1' onclick='window.location.href="../login"'><p>Login</p></button></center>

</div>