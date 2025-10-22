<?php
include_once '../structure/header.php';
?>

<div class="container my-5">
    <h2 class="text-center mb-4">Mi Información</h2>

    <!-- Información personal -->
    <div class="card shadow-sm border-0">
        <div class="card-header text-dark">
            <h5 class="mb-0"><i class="bi bi-person-circle"></i> Datos Personales</h5>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-4 text-end fw-bold">Nombre:</div>
                <div class="col-md-8"><?= $usuario['nombre'] . ' ' . $usuario['apellido'] ?></div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 text-end fw-bold">Email:</div>
                <div class="col-md-8"><?= $usuario['email'] ?></div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 text-end fw-bold">DNI:</div>
                <div class="col-md-8"><?= $usuario['dni'] ?></div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 text-end fw-bold">Legajo:</div>
                <div class="col-md-8"><?= $objAbmAlumno->alumnoLegajo($usuario['idUsuario']) ?></div>
            </div>
        </div>
    </div>
    <br>
    <!-- Tabla de notas -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Mis Notas</h5>
            <!-- FALTA AGREGAR NOTAS ENCRIPTADAS -->
        </div>
    </div>

    <br>
    <div style="text-align: center;">
    <a href="javascript:history.back()" class="btn btn-outline-primary w-50">Volver</a>
    </div>
</div>

<?php
include_once '../structure/footer.php';
?>