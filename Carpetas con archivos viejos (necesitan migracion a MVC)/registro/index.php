<?php
    include_once('../engine/engine.php');

    if (comprobarSession() == true) {
        header('location: ../index.php');
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Registrarse</title>
        <link rel="stylesheet" href="../menus/style/estiloGeneral.css">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <script type="text/javascript" src="funciones.js"></script>
    </head>
    <body onload="foco()" onkeydown="enviarEnter(event)">
        <center><h1><p>Crear Nuevo Usuario</p></h1></center>

        <center>
            <table>
                <tr>
                    <td colspan="2"><p id="resp"></p></td>
                </tr>

                <tr>
                    <td><p>Nombre de Usuario</p></td>
                    <td><p><input id="txtUsername" type="text" name="txtUsername" maxlength="30" placeholder="Usuario123" /></p></td>
                </tr>

                <tr>
                    <td><p>Contrase&ntilde;a</p></td>
                    <td><p><input id="passUsername" type="password" name="passUsername" maxlength="30" placeholder="**********"/></p></td>
                </tr>

                <tr>
                    <td colspan="2"><center><button type="button" onclick="window.location.href = '../login.php';" class="boton2">Log In</button>&nbsp;&nbsp;<button type="button" class="boton1" onclick="registrar();limpiar();">Crear Usuario</button></center></td>
                </tr>
            </table>
        </center>
    </body>
</html>
