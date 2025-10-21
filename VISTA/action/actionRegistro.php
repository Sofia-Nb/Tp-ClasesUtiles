<?php
include_once '../structure/header.php';
// Obtiene los datos enviados
$datos = datasubmitted();
$objAbmUsuario = new abmUsuario();
$resultado = $objAbmUsuario->usuarioExiste($datos);

// Aquí estás enviando una respuesta en formato JSON
if ($resultado) {
    echo 'Este usuario ya esta registrado.';
} else {
    $objAbmUsuario->insertarUser($datos);
    echo 'Usuario registrado con éxito!';
}
echo '<br>';
include_once '../structure/footer.php';