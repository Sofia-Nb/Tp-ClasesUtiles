<?php

class abmAlumno {

        // Listar todos los alumnos o con condición
    public function listar($condicion = "") {
        $alumno = new Alumno();
        return $alumno->listar($condicion);
    }

    // Buscar alumno por Rol
    public function buscarAlumnos($rolAlumnos) {
        $objUsuario = new Usuario();
        $alumnos = $objUsuario->buscarPorRol($rolAlumnos);
        return $alumnos;
    }

    public function alumnoLegajo($idUsuario){
         $alumno = new Alumno();
         $legajo = $alumno->buscarLegajo($idUsuario);
         return $legajo;
    }

    public function DecsencriptarNotas($idNota, $idAlumno) {
        $encriptador = new Encriptador ("1234567890abcdefghijklmnopqrstuv");
        $base = new BaseDatos();
        $sql = "SELECT nota FROM nota WHERE idAlumno_FK  = ':idAlumno'";
        $stmt = $base->prepare($sql);
        $stmt->execute(['idAlumno' => $idAlumno]);

        $notasDesencriptadas = [];
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $notaDesencriptada = $encriptador->desencriptar($fila['nota']);
                $notasDesencriptadas[] = $notaDesencriptada;
            }
        return $notasDesencriptadas;
    }
}