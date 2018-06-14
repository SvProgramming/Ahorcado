<?php
    include_once("../../engine/conexDB.php");
    include_once("../../engine/engine.php");

    if (comprobarSession() == false) {
        header('location: ../../login.php');
    }

    function aggPalabra($palabra, $pista) {
        $datos = "'" . $palabra . "',NULL,'" . $pista . "'";
        $campos = "texto,reporte,pista";
        $tabla = "Palabra";
        $dirDocumentos = "../../engine/datosDB";

        $conexion1 = new conexDB($dirDocumentos);
        $conexion1->ingresarDatos($tabla, $datos, $campos);
        $conexion1->cerrarConex();
    }

    if (isset($_POST['palabra'])) {
        $palabra = trim(strtolower($_POST['palabra']));
        $pista = trim(strtolower($_POST['pista']));

        aggPalabra($palabra, $pista);

        echo "<h1><p><font color='#01b438'>Palabra Ingresada Correctamente</font></p></h1>";
        echo "<h3><p><font color='#01b438'>Palabra:&nbsp;" . $palabra . "&nbsp;Pista:&nbsp;" . $pista . "</font></p></h3>";
    }
?>
