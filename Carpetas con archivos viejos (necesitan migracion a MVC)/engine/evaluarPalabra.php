<?php
    include_once('../../engine/conexDB.php');
    include_once('../../engine/engine.php');

    @session_start();

    if (comprobarSession() == false) {
        header('location: ../../login.php');
    }

    $dirDocumentos = "../../engine/datosDB";

    if (isset($_POST['letra'])) {
        $letra = trim(strtolower($_POST['letra']));
        $palabra = $_SESSION['palabra']['texto'];

        if ($_SESSION['juegoFinalizado'] == true) {
            if ($_SESSION['perdiste'] == true) {
                echo "<h1><p><font color='#e24949'>Ya Perdiste la Palabra era:</font></p></h1><br>";
                echo "<h3><p><font color='#e24949'>&quot;<u>" . $_SESSION['palabra']['texto'] . "</u>&quot;</font></p></h3>";
                echo "<h3><p><font color='#e24949'>&quot;<u>Puntaje: " . $_SESSION['puntaje'] . "</u>&quot;</font></p></h3>";
                echo "<button class='opciones1' onclick='iniciar();foco();'><p>Jugar de Nuevo</p></button>";

                exit();
            } else {
                echo "<h1><p><font color='#01b438'>Ya Completaste esta Palabra!</font></p></h1><br>";
                echo "<h3><p><font color='#01b438'>&quot;<u>" . $_SESSION['palabra']['texto'] . "</u>&quot;</font></p></h3>";
                echo "<h3><p><font color='#01b438'>&quot;<u>Puntaje: " . $_SESSION['puntaje'] . "</u>&quot;</font></p></h3>";
                echo "<button class='opciones1' onclick='iniciar();foco();'><p>Jugar de Nuevo</p></button>";

                exit();
            }
        }

        if (filtroLetras($letra) == true) {
            if (verificarLetraRepetida($letra, $_SESSION['letras']) == false) {
                $letraEvaluar = new motor($palabra);

                if ($letraEvaluar->verificarLetra($letra) == true) {
                    $posLetra = $letraEvaluar->getPos();

                    for ($i=0; $i < strlen($_SESSION['palabra']['texto']); $i++) {
                        if (!$posLetra[$i] == 0) {
                            $_SESSION['letras'][$i] = $posLetra[$i];
                        }
                    }

                    $_SESSION['juegoFinalizado'] = true;

                    for ($i=0; $i < strlen($_SESSION['palabra']['texto']); $i++) {
                        if ($_SESSION['letras'][$i] == "0") {
                            $_SESSION['juegoFinalizado'] = false;
                        }
                    }

                    if ($_SESSION['juegoFinalizado'] == true) {
                        $_SESSION['perdiste'] = false;
                        $_SESSION['puntaje'] = calificar(1, $_SESSION['vidas'], $dirDocumentos, $_SESSION['usuario']);

                        echo "<h1><p><font color='#01b438'>Palabra Correcta!</font></p></h1><br>";
                        echo "<h3><p><font color='#01b438'>&quot;<u>" . $_SESSION['palabra']['texto'] . "</u>&quot;</font></p></h3>";
                        echo "<h3><p><font color='#01b438'>&quot;<u>Puntaje: " . $_SESSION['puntaje'] . "</u>&quot;</font></p></h3>";
                        echo "<button class='opciones1' onclick='iniciar();foco();'><p>Jugar de Nuevo</p></button>";

                        exit();
                    }
                } else {
                    echo "<h1><p><font color='#e24949'>letra mala</font></p></h1>";

                    if ($_SESSION['vidas'] > 1) {
                        $_SESSION['vidas']--;
                    } else {
                        echo "<h1><p><font color='#e24949'>Ya no Tienes Vidas la Palabra era:</font></p></h1>";
                        echo "<h3><p><font color='#e24949'>&quot;<u>" . $_SESSION['palabra']['texto'] . "</u>&quot;</font></p></h3>";
                        echo "<h3><p><font color='#e24949'>&quot;<u>Puntaje: " . $_SESSION['puntaje'] . "</u>&quot;</font></p></h3>";
                        echo "<button class='opciones1' onclick='iniciar();foco();'><p>Jugar de Nuevo</p></button>";

                        $_SESSION['juegoFinalizado'] = true;
                        $_SESSION['perdiste'] = true;

                        exit();
                    }
                }
            } else {
                echo "<h1><p><font color='#e28e49'>Ya se Ingreso la Letra " . $letra . "!</font></p></h1><br>";
            }
        } else {
            echo "<h1><p><font color='#e28e49'>Ingresar Solo Letras!</font></p></h1><br>";
        }
    } else {
        unset($_SESSION['letras']);
        $_SESSION['palabra'] = buscarPalabra($dirDocumentos);
        $_SESSION['vidas'] = 6;
        $_SESSION['juegoFinalizado'] = false;
        $_SESSION['puntaje'] = 0;

        for ($i=0; $i < strlen($_SESSION['palabra']['texto']); $i++) {
            if (substr($_SESSION['palabra']['texto'], $i, 1) === " ") {
                $_SESSION['letras'][$i] = " ";
            } else {
                $_SESSION['letras'][$i] = 0;
            }
        }
    }

    $mostrar = "<table><tr><td colspan=" . round((strlen($_SESSION['palabra']['texto'])/2), 0, PHP_ROUND_HALF_UP) . ">";
    $mostrar .= "<center><p><font color='#8fa8f2'>Pista:&nbsp;" . $_SESSION['palabra']['pista'] . "</font></p></center></td>";
    $mostrar .= "<td colspan=" . round((strlen($_SESSION['palabra']['texto'])/2), 0, PHP_ROUND_HALF_DOWN) . "><center><p><font color='#e9d841'>Vidas:&nbsp;";
    $mostrar .= $_SESSION['vidas'] . "</font></p></center></td></tr><tr>";

    for ($i=0; $i < strlen($_SESSION['palabra']['texto']); $i++) {
        if ($_SESSION['letras'][$i] == "0") {
            $espacioLetras = "";
        } elseif ($_SESSION['letras'][$i] === " ") {
            $espacioLetras = "&nbsp;&nbsp;&nbsp;";
        } else {
            $espacioLetras = $_SESSION['letras'][$i];
        }

        $mostrar .= "<td><p>" . $espacioLetras . "</p></td>";
    }

    $mostrar .= "</tr><tr>";

    for ($i=0; $i < strlen($_SESSION['palabra']['texto']); $i++) {
        if ($_SESSION['letras'][$i] === " ") {
            $mostrar .= "<td><p>&nbsp;&nbsp;&nbsp;</p></td>";
        } else {
            $mostrar .= "<td><p>___</p></td>";
        }
    }

    $mostrar .= "</tr></table>";

    echo $mostrar;
?>
