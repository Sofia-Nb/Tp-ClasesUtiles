<?php

class abmAlumno {

    // Listar todos los alumnos o con condición
    public function listar($condicion = "") {
        $alumno = new Alumno();
        return $alumno->listar($condicion);
    }

    // Buscar alumno por Rol
    public function buscarPorRol($rol) {
        $profesor = new Alumno();
        return $profesor->buscarPorRol($rol);
    }

    public function DecsencriptarNotas($idNota, $idAlumno) {
        $encriptador = new Encriptador ("1234567890abcdefghijklmnopqrstuv");
        $base = new BaseDatos();
        $sql = "SELECT nota FROM notas WHERE idAlumno = '$idAlumno'";
        $cant = $base->Ejecutar($sql);
        $notasDesencriptadas = [];

        if ($cant > 0) {
            while ($fila = $base->Registro()) {
                $notaDesencriptada = $encriptador->desencriptar($fila['nota']);
                $notasDesencriptadas[] = $notaDesencriptada;
            }
        }
        return $notasDesencriptadas;
    }

}