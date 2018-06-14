<?php
    @include_once("../../engine/engine.php");

    if (comprobarSession() == false) {
        header('location: ../../login.php');
    }
?>

<button name="opcion" value="4" class="opciones1"><p>Modo Libre</p></button>
<button name="opcion" value="5" class="opciones2"><p>Contrareloj</p></button>
<button name="opcion" value="6" class="opciones1"><p>Agregar Palabra</p></button>
<button name="button" class="opciones2"><p>Menu Principal</p></button>
