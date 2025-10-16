<?php
include_once '../structure/header.php';
require '../../vendor/autoload.php';

$datos = datasubmitted();
$objAbmProfesor = new abmProfesor();
$objAbmAlumno = new abmAlumno();
$rol = (int) $datos['nombreRol'];


if ($rol === 2){
    $permiso = true;
}else{
    $permiso = false;
}

// ----------------------------------------------------------------

// LIBRERIA PHPSECLIB3

// ----------------------------------------------------------------

use phpseclib3\Crypt\AES;

// Clave secreta
$clave = 'clave12345678910'; // AES-128
$iv    = 'ivclave123456789'; // IV de 16 bytes

// Cifrar
$aes = new AES('cbc');
$aes->setKey($clave);
$aes->setIV($iv);

if ($permiso) { // Profesor
    $alumnos = $objAbmAlumno->buscarPorRol(1); // suponiendo 1 = alumno
    foreach ($alumnos as $alumno) {
        $textoPlano = "<h2>Datos del alumno</h2>
                       <p>Nombre: {$alumno['nombre']}</p>
                       <p>Email: {$alumno['email']}</p>";
        $textoCifrado = base64_encode($aes->encrypt($textoPlano));
        echo $aes2->decrypt(base64_decode($textoCifrado));
    }
} else { // Alumno
    $alumno = $objAbmAlumno->buscarPorRol($rol);
    if ($alumno) {
        $textoPlano = "<h2>Tu información</h2>
                       <p>Nombre: {$alumno['nombre']}</p>
                       <p>Email: {$alumno['email']}</p>";
        $textoCifrado = base64_encode($aes->encrypt($textoPlano));
        echo $aes2->decrypt(base64_decode($textoCifrado));
    } else {
        echo '<p>No tiene permiso para ver esta información.</p>';
    }
}