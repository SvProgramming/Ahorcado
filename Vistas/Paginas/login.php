<?php
define(__ROOT__,dirname(dirname(dirname(__FILE__))));
include_once(__ROOT__."/Controladores/login.controlador.php");

$objLoginControlador = new LoginControlador('LoginModelo','LoginVista');

if($objLoginControlador->comprobarSession())
{
    header('location: '.urlBase);
}
?>

<div class="centrado">
    <center><h1><p>Ahorcado Virtual</p></h1></center>

    <center>
            <table>
                <tr>
                    <th colspan="2"><center><p>Iniciar sesion</p></center></th>
                </tr>

                <tr>
                    <td colspan="2">
                        <div id="divMensajes" class="oculto">
                            
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <center><p>Username:</p></center>
                    </td>
                    <td>
                        <center>
                            <input type="text" name="txtUsername" id="txtUsername" maxlength="30" placeholder="Usuario123" required/>
                        </center>
                    </td>
                </tr>

                <tr>
                    <td>
                        <center><p>Password:</p></center>
                    </td>
                    <td>
                        <center><input type="password" name="passUsername" id="passUsername" maxlength="30" placeholder="*********" required/></center>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <center>
                            <button type="button" onclick="window.location.href = 'registro/';" class="boton2">Registrarse</button>
                            &nbsp;&nbsp;
                            <button name="login" class="boton1" onclick="verificarDatos()">Login</button>
                        </center>
                    </td>
                </tr>
            </table>
    </center>
</div>