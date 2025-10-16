<?php
require_once '../MODELO/encriptador.php';
class abmProfesor {

    public function listar($condicion = "") {
        $profesor = new Profesor();
        return $profesor->listar($condicion);
    }

    public function buscarPorRol($rol) {
        $profesor = new Profesor();
        return $profesor->buscarPorRol($rol);
    }

    public function encriptarNotas($idAlumno, $nota) {
        $encriptador = new Encriptador ("1234567890abcdefghijklmnopqrstuv");
        $notaEncriptada = $encriptador->encriptar($nota);
        $base = new BaseDatos();
        $sql = "INSERT INTO notas (idAlumno, nota) VALUES ('$idAlumno', '$notaEncriptada')";
    }
}