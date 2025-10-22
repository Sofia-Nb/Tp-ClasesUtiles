<?php
include_once '../structure/header.php';
$datos = datasubmitted();
$objAbmUsuario = new abmUsuario();
$objAbmAlumno = new abmAlumno();
$alumnos = $objAbmAlumno->buscarAlumnos('alumno');
$usuario = $objAbmUsuario->usuarioExiste($datos);
if ($usuario) {
    if ($usuario['rol'] == 'alumno') {
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
    <a href="javascript:history.back()" class="btn btn-outline-primary w-100 mt-3">Volver</a>
</div>
        <?php
    } else if ($usuario['rol'] == 'profe') {
        ?>
        <div class="container">
        <div class="row">
        <div class="col-md-6">
        <div class="container align-items-center" style="min-height: 70vh;">
            <h2 class="text-center mb-4">Cargar Nota</h2>

            <form name="nota" id="nota" action="actionNota.php" method="POST" class="mx-auto" style="max-width: 500px;">
                <div class="mb-3">
                    <label for="dniAlumno" class="form-label">DNI del Alumno</label>
                    <input type="text" class="form-control" id="dniAlumno" name="dniAlumno" placeholder="Ingrese DNI del alumno">
                </div>

                <div class="mb-3">
                    <label for="dniProfesor" class="form-label">DNI del Profesor</label>
                    <input type="text" class="form-control" id="dniProfesor" name="dniProfesor" placeholder="Ingrese su DNI">
                </div>

                <div class="mb-3">
                    <label for="valorNota" class="form-label">Valor de la Nota</label>
                    <input type="number" class="form-control" id="valorNota" name="valorNota" min="1" max="10" placeholder="Ingrese la nota">
                </div>

                <div class="mb-3">
                    <label for="fechaNota" class="form-label">Fecha de la Nota</label>
                    <input type="date" class="form-control" id="fechaNota" name="fechaNota">
                </div>

                <button type="submit" class="btn btn-success w-100">Cargar Nota</button>
            </form>
        </div>
        </div>
        <div class="col-md-6">
        <div class="container align-items-center" style="min-height: 70vh;">
            <h2 class="text-center mb-4">Alumnos y permisos</h2>

                <table class="table table-striped table-bordered text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Nombre Completo</th>
                            <th>Email</th>
                            <th>Legajo</th>
                            <th>Acción</th>
                            <th>Notas</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($alumnos as $alumno) {
                        $usuario = $objAbmUsuario->obtenerUsuarioId($alumno->getIdUsuario());
                        echo "<tr>
                                <td>{$usuario->getIdUsuario()}</td>
                                <td>{$usuario->getNombreCompleto()}</td>
                                <td>{$usuario->getEmail()}</td>
                                <td>{$objAbmAlumno->alumnoLegajo($alumno->getIdUsuario())}</td>
                                <td><button type='button' class='btn btn-outline-secondary btn-sm'>Mostrar/Encriptar</button></td>
                                <td><a href='' class='btn btn-outline-dark btn-sm'>Notas</a></td>
                              </tr>";
                    }
                    ?>
                    </tbody>
                </table>
        </div>
        </div>
        </div>
        </div>
     <br>
    <a href="javascript:history.back()" class="btn btn-outline-primary w-100">Volver</a>
        <?php
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
echo '<script src="../js/nota.js"></script>';