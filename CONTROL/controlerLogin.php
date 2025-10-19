<?php
require_once('../MODELO/conector/baseDatos.php');
require_once("../MODELO/hash.php");
$baseDatos = new BaseDatos();
$hash = new Hasher();

/**
*Funcion que busca un usuario segun su email y contraseña
*@param string $email, $contra
*@return Array|False Devuelve un array con los datos del usuario o false si no lo encuentra
*/
function buscarUsuario($email, $contra) {
    $res = false;
    $sql = "SELECT * FROM usuario WHERE email = '$email'";
    $stmt = $baseDatos->prepare($sql);
    $stmt->execute(['email' => $email]);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($res && $hash->verify($contra, $usuario["contrasenia"])) {
        $res = $usuario;
    }
    return $res;
}
