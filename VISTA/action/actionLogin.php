<?php
include_once '../structure/header.php';
$datos = datasubmitted();
$objAbmNotas = new abmNota();
$objAbmUsuario = new abmUsuario();
$objAbmAlumno = new abmAlumno();
$alumnos = $objAbmAlumno->buscarAlumnos('alumno');
$usuario = $objAbmUsuario->usuarioExiste($datos);
if ($usuario) {
    if ($usuario['rol'] == 'alumno') {
        include_once ('./interfazAlumnos.php');
    } else if ($usuario['rol'] == 'profe') {
        include_once ('./interfazProfesor.php');
    }
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
?>