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

if ($permiso) { // Profesor
    $alumnos = $objAbmAlumno->buscarPorRol(1);

    // Construir la tabla HTML
    $htmlTabla = '<table class="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>';

    foreach ($alumnos as $alumno) {
        $htmlTabla .= '<tr>
            <td>' . htmlspecialchars($alumno->getNombre()) . '</td>
            <td>' . htmlspecialchars($alumno->getEmail()) . '</td>
            <td>
                <form style="display:inline;">
                    <input type="hidden" name="id_alumno" value="' . $alumno->getDni() . '">
                    <button type="submit" class="btn btn-warning">Encriptar</button>
                </form>
                <form style="display:inline;">
                    <input type="hidden" name="id_alumno" value="' . $alumno->getDni() . '">
                    <button type="submit" class="btn btn-success">Desencriptar</button>
                </form>
            </td>
        </tr>';
    }

    $htmlTabla .= '</tbody></table>'; // <-- cierre de tabla fuera del foreach

    // Crear objeto AES
    $aes = new AES('cbc');
    $aes->setKey($clave);
    $aes->setIV($iv);

    // Cifrar y descifrar
    $textoCifrado = base64_encode($aes->encrypt($htmlTabla));

    $aes2 = new AES('cbc');
    $aes2->setKey($clave);
    $aes2->setIV($iv);

    $htmlDescifrado = $aes2->decrypt(base64_decode($textoCifrado));

    echo $htmlDescifrado;
} else { // Alumno
        echo '<p>No tiene permiso para ver esta información.</p>';
}