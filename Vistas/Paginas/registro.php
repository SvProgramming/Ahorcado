<?php
define(__ROOT__,dirname(dirname(dirname(__FILE__))));
include_once(__ROOT__."/Controladores/registro.controlador.php");

$objRegistroControlador = new RegistroControlador('RegistroModelo','RegistroVista');

if($objRegistroControlador->comprobarSession())
{
    header('location: '.urlBase);
}

?>
<div class="oculto" id="fondoCargando">
    
</div>

<div class="oculto" id="cargando"></div>



<div class="centrado">

<center><h1><p>Crear Nuevo Usuario</p></h1></center>

<div id="divMensajes" class="oculto">
    
</div>

<center>
    <table>
        <tr>
            <td>
                <p>Nombre de Usuario</p>
            </td>
            <td>
                <p><input id="txtUsername" type="text" name="txtUsername" maxlength="30" placeholder="Usuario123" /></p>
            </td>
        </tr>

        <tr>
            <td>
                <p>Contraseña</p>
            </td>
            <td>
                <p><input id="passUsername" type="password" name="passUsername" maxlength="30" placeholder="**********"/></p>
            </td>
        </tr>

        <tr>
            <td>
                <p>Repita su contraseña</p>
            </td>
            <td>
                <p><input id="repetirContra" type="password" name="repetirContra" maxlength="30" placeholder="**********"/></p>
            </td>
        </tr>

        <tr>
            <td>
                E-mail
            </td>
            <td>
                <input id="email" type="email" name="email" maxlength="60" placeholder="ejemplo@ejemplo.com" />
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <center>
                    <button type="button" onclick="window.location.href = 'login';" class="boton2">Log In</button>
                    &nbsp;&nbsp;
                    <button type="button" class="boton1" onclick="verificarDatos()">Crear Usuario</button>
                </center>
            </td>
        </tr>
    </table>
</center>

</div>