<?php
    /*if (comprobarSession() == false) {
        header('location: ../../login.php');
    }*/
?>
<div class="centrado" style="padding-top: 65px">
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
</div>
</div>