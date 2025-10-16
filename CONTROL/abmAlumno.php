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

}