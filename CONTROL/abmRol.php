<?php

class AbmRol {

    // Buscar rol por ID
    public function buscarPorIdRol($idRol) {
        $rol = new Rol();
        return $rol->buscarPorId($idRol);
    }

}