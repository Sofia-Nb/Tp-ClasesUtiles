<?php
$baseDatos = new BaseDatos();
$hash = new Hasher();

function registrarUsuario ($dni, $email, $nombre, $apellido, $contrasenia, $rol, $legajo = null, $nombreMateria = null) {

    // hashear la contraseña
    $contraseniaHasheada = $hash->hash($contrasenia);

    // insertar usuario
    $sql = "INSERT INTO usuario (dni, email, nombre, apellido, contrasenia, rol) 
    VALUES (:dni, :email, :nombre, :apellido, :contrasenia, :rol)";
    $stmt = $baseDatos->prepare($sql);
    $stmt->execute([
        ':dni' => $dni,
        ':email' => $email,
        ':nombre' => $nombre,
        ':apellido' => $apellido,
        ':contrasenia' => $contraseniaHasheada,
        ':rol' => $rol
    ]);

    $idUsuario = $baseDatos->lastInsertId();

    if ($rol === 'alumno' && $legajo !== null) {
        $sqlAlumno = "INSERT INTO alumno (idUsuario, legajo) VALUES (:idUsuario, :legajo)";
        $stmtAlumno = $baseDatos->prepare($sqlAlumno);
        $stmtAlumno->execute([
            ':idUsuario' => $idUsuario,
            ':legajo' => $legajo
        ]);
    } elseif ($rol === 'profe' && $nombreMateria !== null) {
        $sqlProfe = "INSERT INTO profe (idUsuario, nombreMateria) VALUES (:idUsuario, :nombreMateria)";
        $stmtProfe = $baseDatos->prepare($sqlProfe);
        $stmtProfe->execute([
            ':idUsuario' => $idUsuario,
            ':nombreMateria' => $nombreMateria
        ]);
    }

}