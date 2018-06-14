<?php
define(__ROOT__,dirname(dirname(dirname(__FILE__))));
include_once(__ROOT__."/Controladores/home.controlador.php");

$objHomeControlador=new HomeControlador('HomeModelo','HomeVista');

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
        <form method="post">
            <?php
                if(!isset($_POST['opcion']))
                {
                ?>
                    <button name="opcion" value="1" class="opciones1"><p>SinglePlayer</p></button>
                    <button name="opcion" value="2" class="opciones2"><p>MultiPlayer</p></button>
                    <button name="opcion" value="3" class="opciones1"><p>LogOut</p></button>
                <?php
                }
                else
                {
                    $opcion = $_POST['opcion'];

                    switch($opcion)
                    {
                        case 1:
                            header('location: singlePlayer/');
                            break;
                        case 2:
                            header('location: multiplayer/');
                            break;
                        case 3:
                            header('location: logout');
                            break;
                    }
                }
            ?>
        </form>
    </center>
</div>

