<?php
include_once '../structure/header.php';

// Obtiene los datos enviados
$datos = datasubmitted();
$objAbmUsuario = new abmUsuario();
$resultado = $objAbmUsuario->usuarioExiste($datos);

$mensaje = "";
$error = "";

if ($resultado) {
    $error = "Este usuario ya está registrado.";
} else {
    $objAbmUsuario->insertarUser($datos);
    $mensaje = "Usuario registrado con éxito!";
}
?>

<div class="container mt-5">
    <?php if (!empty($mensaje)): ?>
        <div class="alert alert-success text-center fs-1 py-4" role="alert">
            <?= $mensaje ?>
        </div>
        <div class="text-center mt-4">
            <a href="login.php" class="btn btn-primary btn-lg">Ir al Login</a>
        </div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger" role="alert">
            <ul class="mb-0">
                <li><?= $error ?></li>
            </ul>
        </div>
        <div class="text-center mt-3">
            <a href="../registro.php" class="btn btn-secondary">Volver</a>
        </div>
    <?php endif; ?>
</div>

<?php include_once '../structure/footer.php'; ?>
