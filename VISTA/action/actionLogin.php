<?php
include_once './structure/header.php';
$datos = datasubmitted();
$objUsuario = new Usuario();
$usuario = $objUsuario->buscarUsuario($datos);
if ($usuario) {
    if ($usuario['rol'] == 'alumno') {
        //view para alumno
    } else if ($usuario['rol'] == 'profe') {
        //view para profe
    } else if ($usuario['rol'] == 'admin') {
        //view para admin
    }
} else {
    "<h2>El usuario o la contraseña son incorrectos</h2>";
}

include_once 'structure/footer.php';