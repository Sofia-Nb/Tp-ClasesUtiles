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
                <form name="loginForm" id="loginForm" method="POST" action="../CONTROL/verificarLogin.php">
                    <div class="form-group">
                        <label for="email"></label>
                        <input type="email" id="email" class="form-control" placeholder="Ingrese el email" name="emailLogin" required>
                    </div>
                    <div class="form-group">
                        <label for="password"></label>
                        <input type="password" id="contrasenia" class="form-control" placeholder="Ingrese la contraseña" name="contrasenialogin" required>
                    </div>
                    <button type="submit" id="loginButton" class="btn btn-primary btn-block mt-4">Iniciar Sesión</button>
                </form>
            </div>
        </div>
    </div>
    <div class="text-center mt-3">
        <p>¿No tenés cuenta?</p>
        <a href="registro.php" class="btn btn-outline-primary w-100">Registrarse</a>
    </div>
</body>

</html>
<?php
include_once 'structure/footer.php';
?>