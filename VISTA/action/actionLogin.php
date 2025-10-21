<?php
include_once '../structure/header.php';
$datos = datasubmitted();
$objAbmUsuario = new abmUsuario();
$usuario = $objAbmUsuario->usuarioExiste($datos);
if ($usuario) {
    if ($usuario['rol'] == 'alumno') {
        //view para alumno
        echo "<div class='container align-items-center' style='min-height: 70vh;'>";
        echo "<h2 align='center'>Esta es la informacion del alumno.</h2>";
        echo "<br><br>";
        echo "<a href='javascript:history.back()' class='btn btn-outline-primary w-100'>Volver</a>";
        echo "</div>";
    } else if ($usuario['rol'] == 'profe') {
        //view para profe
        echo "<div class='container align-items-center' style='min-height: 70vh;'>";
        echo "<h2 align='center'>Esta es la informacion del profesor.</h2>";
        echo "<br><br>";
        echo "<a href='javascript:history.back()' class='btn btn-outline-primary w-100'>Volver</a>";
        echo "</div>";
    }
    // En el caso de haber un admin
    // else if ($usuario['rol'] == 'admin') {
    //view para admin

} else {
    echo "<br><br><br><br><br>";
    echo "<div class='container align-items-center' style='min-height: 50vh;'>";
    echo "<h2 align='center'>Datos incorrectos o el usuario no existe.</h2>";
    echo "<br><br>";
    echo "<p align='center'>¿No tenés cuenta?</p>";
    echo "<a href='../registro.php' class='btn btn-outline-primary w-100'>Registrarse</a>";
    echo "</div>";
}


include_once '../structure/footer.php';