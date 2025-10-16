<?php
include_once './structure/header.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="card shadow-sm" style="width: 400px;">
            <div class="card-body">
                <h3 class="text-center mb-4">Iniciar Sesión</h3>
                <form id="loginForm" method="POST" action="action/verificarLogin.php">
                    <div class="form-group">
                        <label for="rol"></label>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="nombreRol" id="radioAlumno" value="1" checked>
                        <label class="form-check-label" for="radioAlumno">
                        Alumno
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="nombreRol" id="radioProfesor" value="2" checked>
                        <label class="form-check-label" for="radioProfesor">
                        Profesor
                        </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email"></label>
                        <input type="email" id="email" class="form-control" placeholder="Ingrese el email" required>
                    </div>
                    <div class="form-group">
                        <label for="dni"></label>
                        <input type="numer" id="dni" class="form-control" placeholder="Ingrese su dni" required>
                    </div>
                    <button type="submit" id="loginButton" class="btn btn-primary btn-block mt-4">Iniciar Sesión</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php
include_once './structure/footer.php';
?>