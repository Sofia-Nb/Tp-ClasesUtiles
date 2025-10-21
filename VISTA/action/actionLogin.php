<?php
include_once '../structure/header.php';
$datos = datasubmitted();
$objAbmUsuario = new abmUsuario();
$usuario = $objAbmUsuario->usuarioExiste($datos);
if ($usuario) {
    if ($usuario['rol'] == 'alumno') {
        //view para alumno
        echo "<div class='container align-items-center' style='min-height: 70vh;'>";
        echo "<h2 align='center'>Esta es la informacion del alumno.</h2>";
        echo "<br><br>";
        echo "<a href='javascript:history.back()' class='btn btn-outline-primary w-100'>Volver</a>";
        echo "</div>";
    } else if ($usuario['rol'] == 'profe') {
        ?>
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

                <button type="submit" class="btn btn-primary w-100">Cargar Nota</button>
            </form>

            <br>
            <a href="javascript:history.back()" class="btn btn-outline-primary w-100">Volver</a>
        </div>
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