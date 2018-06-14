<?php
    include_once("../../engine/engine.php");

    if (comprobarSession() == false) {
        header('location: ../../login.php');
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Normal</title>
        <link rel="stylesheet" href="../../menus/style/estiloGeneral.css">
        <script type="text/javascript" src="funciones.js"></script>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    </head>
    <body onload="iniciar();foco();" onkeydown="enviarEnter(event)">
        <?php include_once("../../menus/juego/header.php"); ?>

        <div class="div1">
            <center>
                <br><br><br>

                <table>
                    <tr>
                        <td><font color='#b48c01'><p><b>&quot;<?php @session_start(); echo $_SESSION['usuario']; ?>&quot;</b></p></font></td>
                        <td colspan="2"><center id="respuesta"></center></td>
                    </tr>

                    <tr>
                        <td colspan="3">
                            <center>
                                <p>Ingrese una letra</p>
                                <button class="boton1" name="btnEnviarLetra" onclick="enviarLetra();foco();limpiar();">Aceptar</button>
                                <input type="text" size="3" name="txtLetra" id="txtLetra" maxlength="1">
                                <button class="boton2" name="btnCambiarLetra" onclick="iniciar();foco();limpiar();">Nueva Palabra</button>
                            </center>
                        </td>
                    </tr>
                </table>
            <center>
        </div>
    </body>
</html>
