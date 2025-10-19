<?php
include_once './structure/header.php';

$email = $datos['emailLogin'];
$contra = $datos['contrasenialogin'];
$usuario = buscarUsuario($email, $contra);
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