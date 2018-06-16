<?php
define(__ROOT__,dirname(dirname(dirname(__FILE__))));
include_once(__ROOT__."/Controladores/singleplayer.controlador.php");

$objHomeControlador=new SingleplayerControlador('SingleplayerModelo','SingleplayerVista');

if(!$objHomeControlador->comprobarSession())
{
    header('location: login');
}
?>

<div class="div1">
    <center>
        <h1><p>Ahorcado Virtual</p></h1>
    </center>

    <center>
        <h2><p>Bienvenido <font color='#01b438'><?php echo $_SESSION['usuario']; ?></font></p></h2>
    </center>

    <center>
        <h3>
            <p>
                High-Score&nbsp;&nbsp;
                <font color='#aecd17'>
                    <?php
                        $resultado = $objHomeControlador->highScore($_SESSION['usuario']);
                        echo $resultado['puntos'];
                    ?>
                </font>
            </p>
        </h3>
    </center>

    <hr width=100%>
<center>
	<button name="opcion" value="4" class="opciones1" onclick="window.location.href='/AhorcadoPhp/singlePlayer/normal';"><p>Modo Libre</p></button>
	<button name="opcion" value="5" class="opciones2"><p>Contrareloj</p></button>
	<button name="opcion" value="6" class="opciones1"><p>Agregar Palabra</p></button>
	<button name="button" class="opciones2"><p>Menu Principal</p></button>
</center>

</div>