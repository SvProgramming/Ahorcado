<?php
define(__ROOT__,dirname(dirname(dirname(dirname(__FILE__)))));
include_once(__ROOT__."/Controladores/singleplayer.controlador.php");

$objSingleplayerControlador=new SingleplayerControlador('SingleplayerModelo','SingleplayerVista');

if(!$objSingleplayerControlador->comprobarSession())
{
    header('location: '.urlBase.'login');
}

?>
<div class="centrado" style="padding-top: 65px">
    <div id="letrasUsadas" class="centrado oculto">
        <h3>Letras usadas:</h3>
    </div>

    <br>

    <div class="div1">
        <center>
            <table>
                <tr>
                    <td>
                        <font color='#b48c01'><p><b>&quot;<?php echo $_SESSION['usuario']; ?>&quot;</b></p></font>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div id="respuesta"></div>
                    </td>
                </tr>

                <tr>
                    <td colspan="3">
                        <div class="" id="divEscribirLetras">
                            <center>
                                <p>Ingrese una letra</p>
                                <button class="boton1" name="btnEnviarLetra" id="btnEnviarLetra" onclick="enviarLetra(2);foco();limpiar();">Iniciar</button>
                                <input type="text" size="3" name="txtLetra" id="txtLetra" maxlength="1">
                                <button class="boton2" name="btnCambiarLetra" id="cambiarLetra" onclick="iniciar();foco();limpiar();">Nueva Palabra</button>
                            </center>
                        </div>
                        <br>
                        <center>
                            <h4>Tiempo:</h4>
                            <input type="text" id="reloj" name="reloj" class="reloj" onfocus="this.blur()">
                        </center>
                    </td>
                </tr>
            </table>
        </center>
    </div>
</div>