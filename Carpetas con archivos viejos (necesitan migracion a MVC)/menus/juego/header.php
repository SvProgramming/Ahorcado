<?php
    include_once("../../engine/engine.php");

    if (comprobarSession() == false) {
        header('location: ../../login.php');
    }
?>

<form method="post">
    <header class="menuJuego"><button name="salir" class="opciones2"><p>salir</p></button></header>
</form>

<?php
    if (isset($_POST['salir'])) {
        header('location: ../../index.php');
    }
?>

<div class="divMenuJuego">

</div>
