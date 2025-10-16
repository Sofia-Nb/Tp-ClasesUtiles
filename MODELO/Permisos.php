<?php
class Permisos {
    private $idAlumno;
    private $permitido;

    // Getters y Setters
    public function getIdAlumno(){ 
        return $this->idAlumno; 
    }
    public function setIdAlumno($idAlumno){ 
        $this->idAlumno = $idAlumno; 
    }

    public function getPermitido(){ 
        return $this->permitido; 
    }
    public function setPermitico($permitido){ 
        $this->permitido = $permitido; 
    }

public function actualizar($idAlumno, $permitido) {
    $base = new BaseDatos();
    $sql = "UPDATE permisos 
            SET permitido = '$permitido' 
            WHERE idAlumno = '$idAlumno'";
    return $base->Ejecutar($sql);
}


    // Obtener permiso de un alumno
    public function mostrarPermiso($idAlumno) {
        $base = new BaseDatos();
        $sql = "SELECT permitido FROM permisos WHERE idAlumno = '$idAlumno'";
        $cant = $base->Ejecutar($sql);

        if ($cant > 0) {
            $fila = $base->Registro();
            return $fila['permitido'] == 1; // true o false
        } else {
            return false;
        }
    }
}
