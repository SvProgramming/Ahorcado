<?php
    include_once('../engine/conexDB.php');
    include_once('../engine/engine.php');

    @session_start();

    if (comprobarSession() == true) {
        header('location: ../login.php');
    }

    $dirDocumentos = "../engine/datosDB";

    if (isset($_POST['user']) || isset($_POST['pass'])) {
        $user = trim($_POST['user']);
        $pass = trim($_POST['pass']);

        if ($pass == "" || $user == "") {
            echo "<font color='#e24949'>Debe llenar todos los campos!</font>";
        } elseif (strlen($pass) < 8) {
            echo "<font color='#e28e49'>La contrase&ntilde;a debe tener un m&iacute;nimo de 8 car&aacute;cteres!";
        } else {
            $sql = "SELECT * FROM Jugador WHERE usuario = '" . $user . "'";
            $consultaUser = new conexDB($dirDocumentos);
            $result = $consultaUser->consultaPersonalizada($sql);
            $consultaUser->cerrarConex();

            if (!$result === false) {
                echo "<font color='#e28e49'>El nombre de usuario:&nbsp;<u>" . $user . "</u>&nbsp;ya existe!</font>";
            } else {
                $tabla = "Jugador";
                $values = "'" . $user . "',0,aes_encrypt('" . $pass . "','contra'),0,true";
                $campos = "";
                $ingresarUser = new conexDB($dirDocumentos);

                if ($ingresarUser->ingresarDatos($tabla,$values,$campos) === true) {
                    @session_start();
                    $ingresarUser->cerrarConex();
                    $_SESSION['usuario'] = trim($user);
                    $consultas = new conexDB($dirDocumentos);
                    $sql = "update Jugador set Enlinea = true where usuario = '" . $_SESSION['usuario'] . "'";
                    @$consultas->consultaPersonalizada($sql);
                    @$consultas->cerrarConex();
                    echo "1";
                    exit();
                } else {
                    echo "error";
                }

                @$ingresarUser->cerrarConex();
            }
        }
    } else {
        header('location: ../login.php');
    }
?>
