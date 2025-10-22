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
}