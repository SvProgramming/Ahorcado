<?php
    include_once("conexDB.php");

    function comprobarSession() {
        @session_start();

        if (!isset($_SESSION['usuario'])) {
            return false;
        } else {
            return true;
        }
    }

    function highScore($dirDocumentos, $usuario) {
        $conexion = new conexDB($dirDocumentos);
        $sql = "SELECT * FROM Puntuacion WHERE usuario = '" . $usuario . "'";
        $sql2 = "SELECT MAX(puntaje) puntos FROM Puntuacion WHERE usuario = '" . $usuario . "'";
        $consulta = $conexion->consultaPersonalizada($sql);
        $conexion->cerrarConex();

        if ($consulta === false) {
            return "0";
        } else {
            $conexion2 = new conexDB($dirDocumentos);
            $puntaje = $conexion2->consultaPersonalizada($sql2);
            
            return $puntaje['puntos'];
        }
    }

    function calificar($modoJuego, $vidas, $dirDocumentos, $username, $tiempo = 0) {
        $puntos = 0;

        switch ($vidas) {
            case 6:
                $puntos += 60;
                break;

            case 5:
                $puntos += 50;
                break;

            case 4:
                $puntos += 40;
                break;

            case 3:
                $puntos += 30;
                break;

            case 2:
                $puntos += 20;
                break;

            case 1:
                $puntos += 10;
                break;

            default:
                $puntos += 1;
                break;
        }

        if ($modoJuego == 2) {
            switch ($tiempo) {
                case $tiempo > 20:
                    $puntos += 60;
                    break;

                case $tiempo > 10 || $tiempo <= 20:
                    $puntos += 30;
                    break;

                case $tiempo <= 10 || $tiempo > 0:
                    $puntos += 10;
                    break;

                default:
                    $puntos += 1;
                    break;
            }
        }

        $agregarPuntos = new conexDB($dirDocumentos);
        $tabla = "Puntuacion";
        $campos = "puntaje,usuario";
        $datos = "'" . $puntos . "','" . $username . "'";
        $agregarPuntos->ingresarDatos($tabla, $datos, $campos);

        return $puntos;
    }

    function verificarLetraRepetida($letra, $arrayLetras) {
        $letraRepetida = false;

        for ($i=0; $i < count($arrayLetras); $i++) {
            if ($letra === $arrayLetras[$i]) {
                $letraRepetida = true;
            }
        }

        if ($letraRepetida == true) {
            return true;
        } else {
            return false;
        }
    }

    function filtroLetras($letra){
        $letras = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','ñ','o','p',
                        'q','r','s','t','u','v','w','x','y','z');
        $letrasValidas = 0;

        for ($i=0; $i < count($letras); $i++) {
            if ($letra == $letras[$i]) {
                $letrasValidas++;
            }
        }

        if ($letrasValidas > 0) {
            return true;
        } else {
            return false;
        }
    }


    class motor {
        private $palabra;
        private $posLetra;

        function __construct($palabra) {
            $this->palabra = $palabra;

            for ($i=0; $i < strlen($palabra); $i++) {
                if (substr($palabra, $i, 1) === " ") {
                    $this->posLetra[$i] = " ";
                }
            }
        }

        public function verificarLetra($letra) {
            $letrasCorr = 0; //cantidad de letras correctas en la palabra

            for ($i=0; $i < strlen($this->palabra); $i++) {
                if ($letra == substr($this->palabra, $i, 1)) {
                    $this->posLetra[$i] = $letra;
                    $letrasCorr++;
                } else {
                    $this->posLetra[$i] = 0;
                }
            }

            if ($letrasCorr > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function mensaje(){
            echo "<script>alert('hola mundo');</script>";
        }

        public function getPos() {
            return $this->posLetra;
        }
    }
?>
