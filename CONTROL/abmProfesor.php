<?php
include_once __DIR__ . '/../MODELO/Profesor.php';
class abmProfesor {

    public function listar($condicion = "") {
        $profesor = new Profe();
        return $profesor->listar($condicion);
    }

    public function encriptarNotas($datos) {
        $resultado = false;
        $profesor = new Profe($datos);

        $idAlumno = $profesor->buscarId($datos['dniAlumno']);
        $idProfesor = $profesor->buscarId($datos['dniProfesor']);
        
        if ($idAlumno && $idProfesor) {
            $encriptador = new Encriptador("1234567890abcdefghijklmnopqrstuv");
            $notaEncriptada = $encriptador->encriptar($datos['valorNota']);

            $base = new BaseDatos();
            $sql = "INSERT INTO nota (valor, fecha, idAlumno_FK, idProfe_FK) 
                    VALUES (:valor, :fecha, :idAlumno, :idProfesor)";
            $stmt = $base->prepare($sql);

            if ($stmt->execute([
                ':valor' => $notaEncriptada,
                ':fecha' => $datos['fechaNota'],
                ':idAlumno' => $idAlumno,
                ':idProfesor' => $idProfesor
            ])) {
                $resultado = true;
            }
        }
        return $resultado;
    }

}