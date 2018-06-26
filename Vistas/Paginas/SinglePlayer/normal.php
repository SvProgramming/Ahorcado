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
    <div class="div1">
            <br><br><br>
        <center>
            <table>
                <tr>
                    <td>
                        <font color='#b48c01'><p><b>&quot;<?php echo $_SESSION['usuario']; ?>&quot;</b></p></font>
                    </td>
                    <td colspan="2">
                        <div id="respuesta"></div>
                    </td>
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
        </center>
    </div>
</div>