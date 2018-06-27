<?php 
define("__ROOT__", dirname(dirname(__FILE__)));
require_once (__ROOT__."/Core/encriptacion.php");
require_once (__ROOT__."/Modelos/login.modelo.php");
require_once (__ROOT__."/Vistas/login.vista.php");

class SingleplayerControlador
{
    private $modelo;
    private $vista;

    function __construct($modelo,$vista)
    {
        $this->modelo = new $modelo;
        $this->vista = new $vista;
    }

    public function cargarVista()
    {
    	$this->vista->cargarVista();
    }

    public function comprobarSession()
    {
        session_start();

        if(isset($_SESSION['usuario']))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function ajax($pagina)
    {
        define('BaseDir', getcwd());
        require_once BaseDir.'/Core/Ajax/Singleplayer/'.$pagina.'.ajax.php';
    }

    public function highScore($usuario)
    {
        $resultado=$this->modelo->buscarPuntajes($usuario);

        if(gettype($resultado)=="string")
        {
            return $resultado;
        }
        else
        {
            if($resultado->num_rows == 0)
            {
                return "0";
            }
            else
            {
                $resultado=$this->modelo->buscarPuntajeMaximo($usuario);

                if(gettype($resultado)=="string")
                {
                    return $resultado;
                }
                else
                {
                    return $resultado->fetch_assoc();
                }
            }
        }
    }

    public function iniciarJuego()
    {
        session_start();

        unset($_SESSION['letras']);

        $resultado=$this->buscarPalabra();     

        if(gettype($resultado)=="string")
        {
            return $resultado;
            exit();
        }
        else
        {
            $_SESSION['palabra'] = $resultado;

            $_SESSION['vidas'] = 6;

            $_SESSION['juegoFinalizado'] = false;

            $_SESSION['puntaje'] = 0;

            for($i=0;$i<strlen($_SESSION['palabra']['texto']);$i++)
            {
                if(substr($_SESSION['palabra']['texto'], $i, 1) === " ")
                {
                    $_SESSION['letras'][$i] = " ";
                }
                else
                {
                    $_SESSION['letras'][$i] = 0;
                }
            }
        }        
    }


    public function buscarPalabra()
    {
        $resultado=$this->modelo->cantidadDePalabras();

        if(gettype($resultado)=="string")
        {
            return $resultado;
        }
        else
        {  
            $cantidadPalabras=$resultado->fetch_assoc();

            $idPalabra = mt_rand(1, $cantidadPalabras['conteo']);

            $resultado=$this->modelo->buscarPalabra($idPalabra);

            if(gettype($resultado)=="string")
            {
                return $resultado;
            }
            else
            {
                return $resultado->fetch_assoc();
            }
        }
    }

    public function mostrarEspacioLetras()
    {
        session_start();

        $mostrar="<div class='' id='divRespuesta'><table><tr><td colspan=".round((strlen($_SESSION['palabra']['texto'])/2),0,PHP_ROUND_HALF_UP).">";

        $mostrar .= "<center><p><font color='#8fa8f2'>Pista:&nbsp;" . $_SESSION['palabra']['pista'] . "</font></p></center></td>";

        $mostrar .= "<td colspan=" . round((strlen($_SESSION['palabra']['texto'])/2), 0, PHP_ROUND_HALF_DOWN) . "><center><p><font color='#e9d841'>Vidas:&nbsp;";

        $mostrar .= $_SESSION['vidas'] . "</font></p></center></td></tr><tr>";

        for($i=0; $i < strlen($_SESSION['palabra']['texto']); $i++)
        {
            if($_SESSION['letras'][$i] == "0")
            {
                $espacioLetras = "";
            }
            elseif($_SESSION['letras'][$i] === " ")
            {
                $espacioLetras = "&nbsp;&nbsp;&nbsp;";
            }
            else
            {
                $espacioLetras = $_SESSION['letras'][$i];
            }

            $mostrar .= "<td><p>" . $espacioLetras . "</p></td>";
        }

        $mostrar .= "</tr><tr>";

        for($i=0; $i < strlen($_SESSION['palabra']['texto']); $i++)
        {
            if($_SESSION['letras'][$i] === " ")
            {
                $mostrar .= "<td><p>&nbsp;&nbsp;&nbsp;</p></td>";
            }
            else
            {
                $mostrar .= "<td><p>___</p></td>";
            }
        }

        $mostrar .= "</tr></table></div>";

        return $mostrar;
    }

    public function evaluarLetra($letraRecibida,$tiempoRecibido)
    {
        session_start();

        $letra = trim(strtolower($letraRecibida));

        list($minutos,$segundos)=explode(":", $tiempoRecibido);

        $palabra = $_SESSION['palabra']['texto'];

        if($_SESSION['juegoFinalizado'])
        {
            if($_SESSION['perdiste'])
            {
                echo "<h1><p><font color='#e24949'>Perdiste, la palabra era:</font></p></h1><br>";
                echo "<h3><p><font color='#e24949'>&quot;<u>" . $_SESSION['palabra']['texto'] . "</u>&quot;</font></p></h3>";
                echo "<h3><p><font color='#e24949'>&quot;<u>Puntaje: " . $_SESSION['puntaje'] . "</u>&quot;</font></p></h3>";
                echo "<button class='opciones1' onclick='iniciar();foco();'><p>Jugar de Nuevo</p></button>";

                exit();
            }
            else
            {
                echo "<h1><p><font color='#01b438'>Felicidades, has ganado.</font></p></h1><br>";
                echo "<h3><p><font color='#01b438'>&quot;<u>" . $_SESSION['palabra']['texto'] . "</u>&quot;</font></p></h3>";
                echo "<h3><p><font color='#01b438'>&quot;<u>Puntaje: " . $_SESSION['puntaje'] . "</u>&quot;</font></p></h3>";
                echo "<button class='opciones1' onclick='iniciar();foco();'><p>Jugar de Nuevo</p></button>";

                exit();
            }
        }

        if($this->filtroLetras($letra))
        {
            if(!$this->verificarLetraRepetida($letra, $_SESSION['letras']))
            {
                require_once(__ROOT__."/Core/motor.php");

                $letraEvaluar = new motor($palabra);

                if($letraEvaluar->verificarLetra($letra))
                {
                    $posLetra = $letraEvaluar->getPos();

                    for($i=0;$i<strlen($_SESSION['palabra']['texto']);$i++)
                    {
                        if(!$posLetra[$i] == 0)
                        {
                            $_SESSION['letras'][$i] = $posLetra[$i];
                        }
                    }

                    $_SESSION['juegoFinalizado'] = true;

                    for($i=0; $i<strlen($_SESSION['palabra']['texto']); $i++)
                    {
                        if($_SESSION['letras'][$i] == "0")
                        {
                            $_SESSION['juegoFinalizado'] = false;
                        }
                    }

                    if($_SESSION['juegoFinalizado'])
                    {
                        $_SESSION['perdiste'] = false;

                        $resultado=$this->calificar(1, $_SESSION['vidas'], $_SESSION['usuario'],$minutos,$segundos);
                        
                        $_SESSION['puntaje']=$resultado;
                        echo "<h1><p><font color='#01b438'>Palabra correcta</font></p></h1>";
                        echo "<h3><p><font color='#01b438'><u>La palabra es: " . $_SESSION['palabra']['texto'] . "</u></font></p></h3>";
                        echo "<h3><p><font color='#01b438'><u>Puntaje: " . $_SESSION['puntaje'] . "</u></font></p></h3>";
                        echo "<button class='opciones1' onclick='location.reload()'><p>Jugar de Nuevo</p></button>";
                        
                    }
                }
                else
                {
                    echo "<h1><p><font color='#e24949'>letra mala</font></p></h1>";

                    if($_SESSION['vidas'] > 1)
                    {
                        $_SESSION['vidas']--;
                    }
                    else
                    {
                        echo "<h1><p><font color='#e24949'>Ya no tienes vidas, la palabra era:</font></p></h1>";
                        echo "<h3><p><font color='#e24949'>&quot;<u>" . $_SESSION['palabra']['texto'] . "</u>&quot;</font></p></h3>";
                        echo "<h3><p><font color='#e24949'>&quot;<u>Puntaje: " . $_SESSION['puntaje'] . "</u>&quot;</font></p></h3>";
                        echo "<button class='opciones1' onclick='iniciar();foco();'><p>Jugar de Nuevo</p></button>";

                        $_SESSION['juegoFinalizado'] = true;
                        $_SESSION['perdiste'] = true;

                        exit();
                    }
                }
            }
            else
            {
                echo "<h1><p><font color='#e28e49'>Ya se ingreso la letra " . $letra . "</font></p></h1><br>";
            }
        }
        else
        {
            echo "<h1><p><font color='#e28e49'>Ingrese solo letras.</font></p></h1><br>";
        }
    }

    public function filtroLetras($letra)
    {
        $letras=['a','b','c','d','e','f','g','h','i','j','k','l','m','n','ñ','o','p',
                        'q','r','s','t','u','v','w','x','y','z'];

        $letrasValidas = 0;

        for($i=0; $i<count($letras);$i++)
        {
            if($letra == $letras[$i])
            {
                $letrasValidas++;
            }
        }

        if($letrasValidas>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function juegoFinalizado()
    {
        session_start();
        
        if($_SESSION['juegoFinalizado'])
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function verificarLetraRepetida($letra,$arrayLetras)
    {
        $letraRepetida = false;

        for($i=0;$i<count($arrayLetras);$i++)
        {
            if($letra === $arrayLetras[$i])
            {
                $letraRepetida = true;
            }
        }

        if($letraRepetida)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function calificar($modoJuego, $vidas, $username, $minutos, $segundos)
    {
        $puntos = 0;

        $tiempo=(($minutos*60)+$segundos);

        switch ($vidas)
        {
            case 6:
                $puntos += 600;
                break;

            case 5:
                $puntos += 500;
                break;

            case 4:
                $puntos += 400;
                break;

            case 3:
                $puntos += 300;
                break;

            case 2:
                $puntos += 200;
                break;

            case 1:
                $puntos += 100;
                break;

            default:
                $puntos += 1;
                break;
        }

        $puntos+=(1000-((1000*$tiempo)/300));

        $puntos= str_replace(',', '', number_format($puntos,0));

        $resultado=$this->modelo->agregarPuntos($puntos,$username);

        if(gettype($resultado)=="string")
        {
            return $resultado;
        }
        else
        {
            $resultado=$this->comprobarMaximoPuntaje($puntos,$username);

            if($resultado)
            {
                $resultado=$this->modelo->actualizarMaximoPuntaje($puntos,$username);
            }

            return $puntos;
        }
    }

    public function comprobarMaximoPuntaje($puntos,$usuario)
    {
        $resultado=$this->modelo->obtenerPuntajeMaximo($usuario);

        if(gettype($resultado)=="string")
        {
            return $resultado;
        }
        else
        {
            $puntajeMaximo=$resultado->fetch_assoc();

            $puntajeMaximo=$puntajeMaximo['puntajeMaximo'];

            if($puntajeMaximo>=$puntos)
            {
                return false;
            }
            else
            {
                return true;
            }
        }
    }
}

?>
