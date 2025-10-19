<?php include_once 'structure/header.php'; ?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-sm" style="width: 450px;">
        <div class="card-body">
            <h3 class="text-center mb-4">Registrarse</h3>

            <form id="registroForm" action="../CONTROL/registrarUsuario.php" method="POST">
                
                <p class="mb-2">Marque el tipo de usuario que desea</p>
                
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipoUsuario" id="radioAlumno" value="alumno" checked>
                    <label class="form-check-label" for="radioAlumno">
                        Alumno
                    </label>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" name="tipoUsuario" id="radioProfesor" value="profe">
                    <label class="form-check-label" for="radioProfesor">
                        Profesor
                    </label>
                </div>

                <div class="mb-3">
                    <input type="text" class="form-control" name="nombre" placeholder="Ingrese su nombre" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="apellido" placeholder="Ingrese su apellido" required>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Ingrese el email" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="dni" placeholder="Ingrese su número de documento" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="contrasenia" placeholder="Ingrese una contraseña" required>
                </div>


                <div id="camposAlumno">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="legajo" id="inputLegajo" placeholder="Ingrese su legajo" required>
                    </div>
                </div>

                <div id="camposProfesor" style="display: none;">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="nombreMateria" id="inputMateria" placeholder="Ingrese la materia que dicta">
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary w-100">Registrarse</button>
            </form>
        </div>
    </div>
</div>
<script src="js/formularioRegistro.js"></script>

<?php include_once 'structure/footer.php'; ?>