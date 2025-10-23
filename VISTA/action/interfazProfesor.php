<?php
include_once '../structure/header.php';
?>
<div class="container">
        <div class="row">
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
        <hr>
        <div class="container align-items-center" style="min-height: 70vh;">
            <h2 class="text-center mb-4">Alumnos y permisos</h2>

                <table class="table table-striped table-bordered text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Nombre Completo</th>
                            <th>Email</th>
                            <th>Legajo</th>
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
                              </tr>";
                    }
                    ?>
                    </tbody>
                </table>
                <table class="table table-striped table-bordered text-center" height="20">
                        <tr>
                            <th>Notas</th>
                            <th>acción</th>
                        </tr>
                    <tbody>
                    <?php
                    foreach ($alumnos as $alumno) {
                        $usuario = $objAbmUsuario->obtenerUsuarioId($alumno->getIdUsuario());
                        echo "<tr>
                                <td>NOTA 1</td>
                                <td>
                                <button type='button' class='btn btn-outline-secondary btn-sm'>Encriptar</button>
                                <button type='button' class='btn btn-outline-secondary btn-sm'>Mostrar</button>
                                </td>
                              </tr>";
                    }
                    ?>
                    </tbody>
                </table>
        </div>
        </div>
        </div>
     <br>
     <div style="text-align: center;">
     <a href="javascript:history.back()" class="btn btn-outline-primary w-50">Volver</a>
     </div>
     <script src="../js/nota.js"></script>
<?php include_once '../structure/footer.php'; ?>
<script src="../js/nota.js"></script>