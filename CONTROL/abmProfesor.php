<?php

class abmProfesor {

    public function listar($condicion = "") {
        $profesor = new Profesor();
        return $profesor->listar($condicion);
    }

    public function buscarPorRol($rol) {
        $profesor = new Profesor();
        return $profesor->buscarPorRol($rol);
    }
}