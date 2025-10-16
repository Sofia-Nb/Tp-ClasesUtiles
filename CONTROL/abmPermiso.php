<?php

class abmPermiso {

    public function actualizarPermiso($idAlumno, $permiso) {
         $objPermiso = new Permisos();
         $objPermiso->actualizar($idAlumno, $permiso);
    }

    public function mostarPermisoPorAlumno($dni) {
        $objPermiso = new Permisos();
        $permiso = $objPermiso->mostrarPermiso($dni);
        return $permiso;
    }

}