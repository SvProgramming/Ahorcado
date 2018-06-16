<?php
    @include_once("../../engine/engine.php");

    if (comprobarSession() == false) {
        header('location: ../../login.php');
    }
?>

<button name="opcion" value="7" class="opciones1"><p>Jugar</p></button>
<button name="button" class="opciones2"><p>Menu Principal</p></button>
