<form method="post">
    <header class="menuJuego"><button name="salir" class="opciones2"><p>salir</p></button></header>
</form>

<?php
    if(isset($_POST['salir']))
    {
        header('location: /AhorcadoPhp/singlePlayer/');
    }
?>

<div class="divMenuJuego">

</div>
