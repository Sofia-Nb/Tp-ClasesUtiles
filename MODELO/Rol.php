<?php
class Rol {
    private $idRol;
    private $nombreRol;

    // Constructor
    public function __construct($datos = []) {
        if (count($datos)) {
            $this->cargarDatos($datos);
        }
    }

    public function cargarDatos($datos) {
        if (isset($datos['idRol'])) $this->idRol = $datos['idRol'];
        if (isset($datos['descripcion'])) $this->nombreRol = $datos['nombreRol'];
    }

    // Getters y Setters
    public function getIdRol(){ 
        return $this->idRol;
    }
    public function setIdRol($idRol){ 
        $this->idRol = $idRol; 
    }

    public function getDescripcion(){ 
        return $this->nombreRol; 
    }
    public function setDescripcion($nombreRol){ 
        $this->nombreRol = $nombreRol; 
    }

    // =====================
    // Métodos de base de datos
    // =====================

    public function listar($condicion = "") {
        $arreglo = [];
        $base = new BaseDatos();

        $sql = "SELECT * FROM rol";
        if ($condicion != "") {
            $sql .= " WHERE " . $condicion;
        }
        $cant = $base->Ejecutar($sql);
        if ($cant > 0) {
            while ($fila = $base->Registro()) {
                $obj = new Rol();
                $obj->setIdRol($fila['idRol']);
                $obj->setDescripcion($fila['descripcion']);
                $arreglo[] = $obj;
            }
        }
        return $arreglo;
    }

    public function buscarPorId($idRol) {
        $base = new BaseDatos();
        $sql = "SELECT * FROM rol WHERE idRol = '$idRol'";
        $cant = $base->Ejecutar($sql);
        if ($cant > 0) {
            $fila = $base->Registro();
            $this->setIdRol($fila['idRol']);
            $this->setDescripcion($fila['descripcion']);
            return $this;
        } else {
            return null;
        }
    }
}
?>
