<?php
require_once('../MODELO/conector/baseDatos.php');
require_once("../MODELO/hash.php");
$baseDatos = new BaseDatos();
$hash = new Hasher();
function buscarUsuario($email, $contra)
{
    $res = null;
    $sql = "SELECT * FROM usuario WHERE email = '$email'";
    $resultado = $baseDatos->query($sql);
    if ($resultado && $resultado->rowCount() > 0) {
        if ($hash->verify($contra, $resultado["contra"])) {
            $res = true;
        }
    }
    return $res;
}
