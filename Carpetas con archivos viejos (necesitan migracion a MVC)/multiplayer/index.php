<?php
    @include_once("../engine/engine.php");
	include_once("algoritmoDeBusqueda.php");

    if (!comprobarSession()) {
        header('location: ../login.php');
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Multiplayer</title>
        <link rel="stylesheet" href="../menus/style/estiloGeneral.css">
        <script type="text/javascript" src="funcionesMultiplayer.js"></script>
    </head>
    <body onload="iniciar();foco();" onkeydown="enviarEnter(event)">
	
	
        <form method="post">
			<header class="menuJuego"><button name="salir" class="opciones2"><p>salir</p></button></header>
		</form>

		<?php
			if (isset($_POST['salir'])) 
			{
				header('location: ../index.php');
			}
		?>

		
        <div class="div1">
            <center>
                <br><br><br>
				<form method="post">
                <?php
				
				session_start();
				
				if(isset($_SESSION['versus']))
				{
					
				}
				elseif(isset($_REQUEST['btnBuscarRival']))
				{ 
				
				?>
					
					<div>
						<font size="32px" color="lime"><?php echo $_SESSION['usuario'] ?></font>
					</div>
					
					<div>
						<font color="red" size="26px">VS</font>
					</div>
					
					<div>
						<img src="lupa.gif"/>
						<br>
						<font color="lime">Buscando rival, por favor espere...</font>
					</div>
					
				<?php 
				
				$multi=new BusquedaContrincante($_SESSION['usuario']);
					
				$multi->RegistrarEnDB();
				
				}
				else
				{ ?>
					<br><br><br>
					<button class="boton1 boton1-grande" name="btnBuscarRival">Buscar Rival</button>
					
				<?php }
				
				?>
				</form>
				
            </center>
        </div>
    </body>
</html>