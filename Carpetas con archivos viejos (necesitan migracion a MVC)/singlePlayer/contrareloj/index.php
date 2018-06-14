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
        <title>Contrareloj</title>
        <link rel="stylesheet" href="../../menus/style/estiloGeneral.css">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <script type="text/javascript" src="funciones.js"></script>
    </head>

    <?php
        if (isset($_POST['jugar'])) {
    ?>

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
                            </center>
                        </td>
                    </tr>

                    <script type="text/javascript">
                        function objetoAjax() {
                          var xmlhttp = false;

                          try {
                            xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                          } catch (e) {
                            try {
                              xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                            } catch (E) {
                              xmlhttp = false;
                            }
                          }

                          if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
                            xmlhttp = new XMLHttpRequest();
                          }

                          return xmlhttp;
                        }

                        var xhttp = objetoAjax();
                        var timer = setInterval(function(){temp();}, 1000);
                        var evaluarPalabra = setInterval(function(){estadoJuego();},1000);

                        function temp() {
                            var t = document.getElementById('txtReloj').value;
                            var clock = document.getElementById("reloj");

                                if (t == 0) {
                                    clearInterval(timer);
                                    timeOff();
                                } else {
                                    t--;
                                    document.getElementById('txtReloj').value = t;
                                    clock.innerHTML = t;
                                }
                        }

                        function timeOff() {
                            xhttp.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    document.getElementById("respuesta").innerHTML = this.responseText;
                                }
                            }

                            xhttp.open("POST","evaluarPalabra.php", true);
                            xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                            xhttp.send("tiempo=1&letra=a");
                        }

                        function stopTime() {
                            clearInterval(timer);
                        }

                        function estadoJuego() {
                            var estado = document.getElementById("estadoJuego").value;

                            if (estado == 1) {
                                stopTime();
                            }
                        }
                    </script>

                    <tr>
                        <td>
                            <center><font color="#4daa32"><h1><p id="reloj">30</p><p>segundos</p><h1></font></center>
                            <input type="hidden" value="30" id="txtReloj">
                        </td>
                    </tr>
                </table>
            <center>
        </div>
    </body>

    <?php
} else {
    ?>

    <body>
        <?php include_once("../../menus/juego/header.php"); ?>

        <div class="div1">
            <center>
                <br><br><br>

                <form method="post">
                    <button class="opciones1" name="jugar"><p>Jugar</p></button>
                </form>
            <center>
        </div>
    </body>

<?php } ?>
</html>
